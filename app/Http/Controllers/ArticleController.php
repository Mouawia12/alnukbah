<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(12);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:4096',
            'gallery.*'   => 'nullable|image|max:4096',
        ]);

        $folder = 'articles/' . now()->format('F_Y');

        // ✅ حفظ صورة الغلاف
        $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs($folder, $filename, 'public');

        // ✅ حفظ المعرض إن وجد
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $gPath = $file->storeAs($folder, $gName, 'public');
                $galleryPaths[] = $gPath;
            }
        }

        Article::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'image'       => $path,
            'images'      => !empty($galleryPaths) ? $galleryPaths : null,
        ]);

        return redirect()->route('admin.articles.index')->with('ok', '✅ تمت إضافة المقال بنجاح');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
            'gallery.*'   => 'nullable|image|max:4096',
        ]);

        $folder = 'articles/' . now()->format('F_Y');

        // ✅ تحديث العنوان والمحتوى
        $article->title = $data['title'];
        $article->description = $data['description'] ?? $article->description;

        // ✅ تحديث صورة الغلاف إن تم اختيار واحدة جديدة
        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $filename = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs($folder, $filename, 'public');
            $article->image = $path;
        }

        // ✅ تحديث المعرض (تعويض القديم بالكامل)
        if ($request->hasFile('gallery')) {

            // حذف الصور القديمة من التخزين
            $oldGallery = $article->images;
            if (!is_array($oldGallery)) {
                $oldGallery = json_decode((string) $oldGallery, true) ?: [];
            }

            if (!empty($oldGallery)) {
                foreach ($oldGallery as $oldImg) {
                    if (Storage::disk('public')->exists($oldImg)) {
                        Storage::disk('public')->delete($oldImg);
                    }
                }
            }

            // حفظ الصور الجديدة فقط
            $newGallery = [];
            foreach ($request->file('gallery') as $file) {
                $gName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $gPath = $file->storeAs($folder, $gName, 'public');
                $newGallery[] = $gPath;
            }

            $article->images = $newGallery;
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('ok', '✅ تم تعديل المقال بنجاح');
    }

    public function destroyGalleryImage(Article $article, $index)
    {
        $gallery = $article->images;
        if (!is_array($gallery)) {
            $gallery = json_decode((string) $gallery, true) ?: [];
        }

        if (filter_var($index, FILTER_VALIDATE_INT) === false || !array_key_exists((int) $index, $gallery)) {
            if (request()->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => '⚠️ الصورة المحددة غير موجودة.'], 404);
            }
            return back()->with('error', '⚠️ الصورة المحددة غير موجودة.');
        }

        $targetIndex = (int) $index;
        $imagePath = $gallery[$targetIndex] ?? null;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        unset($gallery[$targetIndex]);
        $gallery = array_values(array_filter($gallery));

        $article->images = !empty($gallery) ? $gallery : null;
        $article->save();

        if (request()->expectsJson()) {
            return response()->json(['status' => 'ok', 'message' => '🗑️ تم حذف الصورة من المعرض.' ]);
        }

        return back()->with('ok', '🗑️ تم حذف الصورة من المعرض.');
    }

    public function destroy(Article $article)
    {
        // ✅ حذف صورة الغلاف
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // ✅ حذف صور المعرض
        $gallery = $article->images;
        if (!is_array($gallery)) {
            $gallery = json_decode((string) $gallery, true) ?: [];
        }

        foreach ($gallery as $img) {
            if (Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('ok', '🗑️ تم حذف المقال');
    }
}
