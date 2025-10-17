<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Support\TextSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(12);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
            'images.*'    => 'nullable|image|max:4096',
        ]);

        // 📸 الصورة الرئيسية
        $path = null;
        if ($request->hasFile('image')) {
            $folder = 'services/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs($folder, $filename, 'public');
        }

        // 🖼️ الصور الإضافية
        $extra = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $folder = 'services/' . now()->format('F_Y');
                $filename = Str::uuid() . '.' . $img->getClientOriginalExtension();
                $extra[] = $img->storeAs($folder, $filename, 'public');
            }
        }

        Service::create([
            'name'        => $data['name'],
            'description' => TextSanitizer::clean($data['description'] ?? null),
            'image'       => $path,
            'images'      => !empty($extra) ? $extra : null,
        ]);

        Cache::forget('front.services');

        return redirect()->route('admin.services.index')->with('ok', '✅ تمت إضافة الخدمة بنجاح');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
            'images.*'    => 'nullable|image|max:4096',
        ]);

        // ✅ تحديث الصورة الرئيسية
        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $folder = 'services/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs($folder, $filename, 'public');
        } else {
            unset($data['image']);
        }

        // ✅ تحديث الصور الإضافية
        if ($request->hasFile('images')) {
            $data['images'] = [];
            foreach ($request->file('images') as $img) {
                $folder = 'services/' . now()->format('F_Y');
                $filename = Str::uuid() . '.' . $img->getClientOriginalExtension();
                $data['images'][] = $img->storeAs($folder, $filename, 'public');
            }
        } else {
            unset($data['images']);
        }

        if (array_key_exists('description', $data)) {
            $data['description'] = TextSanitizer::clean($data['description']);
        }

        $service->update($data);

        Cache::forget('front.services');

        return redirect()->route('admin.services.index')->with('ok', '✅ تم تحديث بيانات الخدمة بنجاح');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // 🗑️ حذف الصور من التخزين
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $storedImages = $service->images;
        if ($storedImages) {
            $images = is_array($storedImages)
                ? $storedImages
                : (json_decode($storedImages, true) ?: []);
            foreach ($images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $service->delete();

        Cache::forget('front.services');
        return redirect()->route('admin.services.index')->with('ok', '🗑️ تم حذف الخدمة بنجاح');
    }
}
