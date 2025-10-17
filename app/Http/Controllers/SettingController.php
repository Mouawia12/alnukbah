<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Support\TextSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $settings = Setting::query()->get()->keyBy('key');

        $rules = $settings->mapWithKeys(function (Setting $setting) {
            return [$setting->key => $this->validationRuleFor($setting)];
        })->toArray();

        $validated = $request->validate($rules);

        foreach ($settings as $key => $setting) {
            if ($setting->isImage()) {
                if (!$request->hasFile($key)) {
                    continue;
                }

                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                $folder = 'settings/' . now()->format('F_Y');
                $filename = Str::uuid() . '.' . $request->file($key)->getClientOriginalExtension();
                $path = $request->file($key)->storeAs($folder, $filename, 'public');
                $setting->value = $path;
            } elseif (array_key_exists($key, $validated)) {
                $setting->value = $this->sanitizeSettingValue($setting, $validated[$key]);
            }

            $setting->save();
        }

        Cache::forget('front.settings');

        return redirect()->route('admin.settings.index')->with('ok', '✅ تم حفظ الإعدادات بنجاح');
    }

    private function validationRuleFor(Setting $setting): string
    {
        return match ($setting->type) {
            'image' => 'nullable|image|max:4096',
            'email' => 'nullable|email|max:255',
            'number' => 'nullable|numeric',
            'url' => 'nullable|url|max:2048',
            default => 'nullable|string|max:5000',
        };
    }

    private function sanitizeSettingValue(Setting $setting, $value): ?string
    {
        return match ($setting->type) {
            'email', 'url', 'number' => is_string($value) ? trim($value) : (string) $value,
            default => TextSanitizer::clean(is_string($value) ? $value : null),
        };
    }
}
