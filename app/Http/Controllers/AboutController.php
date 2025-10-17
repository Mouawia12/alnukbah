<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first(); // يوجد سجل واحد فقط
        return view('admin.abouts.index', compact('about'));
    }

    public function edit()
    {
        $about = About::first();
        return view('admin.abouts.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'experiance' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $about = About::first();

        if (!$about) {
            $about = new About();
        }

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }

            $folder = 'about/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs($folder, $filename, 'public');
        }

        $about->fill($data)->save();

        return redirect()->route('admin.abouts.index')->with('ok', '✅ تم تحديث معلومات "حول الشركة" بنجاح');
    }
}
