<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        // نقسم الإعدادات حسب المجموعة (Site / Admin)
        $groups = Setting::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.settings.index', compact('groups'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if (!$setting) continue;

            // إذا نوعها صورة
            if ($setting->isImage() && $request->hasFile($key)) {
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                $folder = 'settings/' . now()->format('F_Y');
                $filename = Str::uuid() . '.' . $request->file($key)->getClientOriginalExtension();
                $path = $request->file($key)->storeAs($folder, $filename, 'public');

                $setting->value = $path;
            } else {
                // نص أو رابط
                $setting->value = $value;
            }

            $setting->save();
        }

        return redirect()->route('admin.settings.index')->with('ok', '✅ تم حفظ الإعدادات بنجاح');
    }
}
