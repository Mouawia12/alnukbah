<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Support\TextSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::latest()->paginate(12);
        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        return view('admin.works.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'img' => 'required|image|max:4096',
            'images.*' => 'nullable|image|max:4096',
        ]);

        // الصورة الرئيسية
        $folder = 'works/' . now()->format('F_Y');
        $filename = Str::uuid() . '.' . $request->file('img')->getClientOriginalExtension();
        $mainPath = $request->file('img')->storeAs($folder, $filename, 'public');

        // الصور الإضافية
        $extraPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $extraPaths[] = $file->storeAs($folder, Str::uuid() . '.' . $file->getClientOriginalExtension(), 'public');
            }
        }

        Work::create([
            'title' => $data['title'],
            'text' => TextSanitizer::clean($data['text'] ?? null),
            'img' => $mainPath,
            'image' => $extraPaths ?: null,
        ]);

        Cache::forget('front.works.latest');

        return redirect()->route('admin.works.index')->with('ok', '✅ تمت إضافة العمل بنجاح');
    }

    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('admin.works.edit', compact('work'));
    }

    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'img' => 'nullable|image|max:4096',
            'images.*' => 'nullable|image|max:4096',
        ]);

        // تحديث الصورة الرئيسية
        if ($request->hasFile('img')) {
            if ($work->img && Storage::disk('public')->exists($work->img)) {
                Storage::disk('public')->delete($work->img);
            }
            $folder = 'works/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('img')->getClientOriginalExtension();
            $work->img = $request->file('img')->storeAs($folder, $filename, 'public');
        }

        // تحديث الصور الإضافية
        $extraPaths = $work->image ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $extraPaths[] = $file->storeAs('works/' . now()->format('F_Y'), Str::uuid() . '.' . $file->getClientOriginalExtension(), 'public');
            }
            $work->image = $extraPaths;
        }

        $work->update([
            'title' => $data['title'],
            'text' => TextSanitizer::clean($data['text'] ?? null),
        ]);

        Cache::forget('front.works.latest');

        return redirect()->route('admin.works.index')->with('ok', '✅ تم تحديث بيانات العمل بنجاح');
    }

    public function destroy($id)
    {
        $work = Work::findOrFail($id);

        // حذف الصور
        if ($work->img && Storage::disk('public')->exists($work->img)) {
            Storage::disk('public')->delete($work->img);
        }
        if (is_array($work->image)) {
            foreach ($work->image as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $work->delete();

        Cache::forget('front.works.latest');
        return redirect()->route('admin.works.index')->with('ok', '🗑️ تم حذف العمل بنجاح');
    }
}
