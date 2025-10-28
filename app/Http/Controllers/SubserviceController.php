<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubserviceController extends Controller
{
    /**
     * Normalize stored media representations (JSON string / array / null) into arrays.
     */
    protected function normalizeMedia($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    /**
     * Store uploaded gallery images and return their storage paths.
     */
    protected function uploadGallery(array $files): array
    {
        $paths = [];

        foreach ($files as $file) {
            $folder = 'subservices/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $paths[] = $file->storeAs($folder, $filename, 'public');
        }

        return $paths;
    }

    public function index()
    {
        $services = Service::orderBy('name')->get(['id', 'name']);
        $selectedService = request('service_id');

        $subservices = Subservice::with('service')
            ->when($selectedService, fn ($query) => $query->where('service_id', $selectedService))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.subservices.index', compact('subservices', 'services', 'selectedService'));
    }

    public function create()
    {
        $services = Service::orderBy('name')->get(['id', 'name']);
        
        if ($services->isEmpty()) {
            return redirect()->route('admin.services.create')
                ->with('error', '⚠️ الرجاء إنشاء خدمة رئيسية أولاً قبل إضافة خدمات فرعية.');
        }

        return view('admin.subservices.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096',
            'setnumberonimage' => 'nullable|boolean',
        ]);

        $galleryPaths = $request->hasFile('images')
            ? $this->uploadGallery($request->file('images'))
            : [];

        Subservice::create([
            'service_id' => $data['service_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'images' => !empty($galleryPaths) ? $galleryPaths : null,
            'setnumberonimage' => $request->boolean('setnumberonimage'),
        ]);

        return redirect()->route('admin.subservices.index')->with('ok', '✅ تمت إضافة الخدمة الفرعية بنجاح');
    }

    public function edit(Subservice $subservice)
    {
        $services = Service::orderBy('name')->get(['id', 'name']);
        $subservice->load('service');

        return view('admin.subservices.edit', compact('subservice', 'services'));
    }

    public function update(Request $request, Subservice $subservice)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096',
            'setnumberonimage' => 'nullable|boolean',
        ]);

        $existingGallery = $this->normalizeMedia($subservice->getRawOriginal('images'));
        if ($request->hasFile('images')) {
            $existingGallery = array_merge($existingGallery, $this->uploadGallery($request->file('images')));
        }

        $subservice->fill([
            'service_id' => $data['service_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'setnumberonimage' => $request->boolean('setnumberonimage'),
        ]);

        $subservice->images = !empty($existingGallery) ? $existingGallery : null;
        $subservice->save();

        return redirect()->route('admin.subservices.index')->with('ok', '✅ تم تحديث الخدمة الفرعية بنجاح');
    }

    public function destroy(Subservice $subservice)
    {
        foreach ($this->normalizeMedia($subservice->getRawOriginal('images')) as $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $subservice->delete();

        return redirect()->route('admin.subservices.index')->with('ok', '🗑️ تم حذف الخدمة الفرعية بنجاح');
    }

    public function destroyImage(Subservice $subservice, $index)
    {
        $images = $this->normalizeMedia($subservice->getRawOriginal('images'));

        if (filter_var($index, FILTER_VALIDATE_INT) === false || !array_key_exists((int) $index, $images)) {
            if (request()->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => '⚠️ الصورة المحددة غير موجودة.'], 404);
            }
            return back()->with('error', '⚠️ الصورة المحددة غير موجودة.');
        }

        $targetIndex = (int) $index;
        $imagePath = $images[$targetIndex] ?? null;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        unset($images[$targetIndex]);
        $images = array_values(array_filter($images));

        $subservice->images = !empty($images) ? $images : null;
        $subservice->save();

        if (request()->expectsJson()) {
            return response()->json(['status' => 'ok', 'message' => '🗑️ تم حذف الصورة بنجاح']);
        }

        return back()->with('ok', '🗑️ تم حذف الصورة بنجاح');
    }
}
