<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(12);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'nullable|string|max:255',
            'subtitle'  => 'nullable|string|max:255',
            'image'     => 'required|image|max:4096',
        ]);

        $folder = 'sliders/' . now()->format('F_Y');
        $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs($folder, $filename, 'public');

        Slider::create([
            'title'     => $data['title'] ?? null,
            'subtitle'  => $data['subtitle'] ?? null,
            'img'       => $path,
        ]);

        return redirect()->route('admin.sliders.index')->with('ok', '✅ تمت إضافة الصورة بنجاح إلى المعرض');
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'     => 'nullable|string|max:255',
            'subtitle'  => 'nullable|string|max:255',
            'image'     => 'nullable|image|max:4096',
        ]);

        $slider->title = $data['title'] ?? null;
        $slider->subtitle = $data['subtitle'] ?? null;

        if ($request->hasFile('image')) {
            if ($slider->img && Storage::disk('public')->exists($slider->img)) {
                Storage::disk('public')->delete($slider->img);
            }

            $folder = 'sliders/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs($folder, $filename, 'public');
            $slider->img = $path;
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('ok', '✅ تم تحديث بيانات السلايدر بنجاح');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->img && Storage::disk('public')->exists($slider->img)) {
            Storage::disk('public')->delete($slider->img);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('ok', '🗑️ تم حذف الصورة من المعرض');
    }
}
