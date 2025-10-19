@extends('admin.layouts.app')
@section('title', 'تعديل خدمة')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل الخدمة</h1>
        <p class="text-slate-400 mt-1">قم بتحديث بيانات الخدمة الحالية</p>
    </div>
    <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">الرجوع</a>
</div>

<form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data" class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf
    @method('PUT')

    {{-- 🏷️ الاسم --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">اسم الخدمة *</label>
        <input type="text" name="name" value="{{ old('name', $service->name) }}" required
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- 📝 الوصف --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الوصف</label>
        <textarea name="description" rows="5"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('description', $service->description) }}</textarea>
    </div>

    {{-- 📝 نص العلامة المائية --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">نص العلامة المائية</label>
        <input type="text" name="watermark_text" value="{{ old('watermark_text') }}" maxlength="255"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500"
               placeholder="مثال: www.example.com أو 966-555-123456">
        <p class="text-xs text-slate-500 mt-2">اترك الحقل فارغاً لاستخدام الاسم الافتراضي للتطبيق.</p>
        @error('watermark_text')
            <p class="text-xs text-rose-400 mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- 🏷️ خيار العلامة المائية --}}
    <div class="flex items-start gap-3">
        <input type="checkbox" id="apply_watermark" name="apply_watermark" value="1"
               class="mt-1 h-5 w-5 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500"
               {{ old('apply_watermark') ? 'checked' : '' }}>
        <label for="apply_watermark" class="text-sm text-slate-300 leading-relaxed">
            تطبيق علامة مائية على كل الصور الحالية والجديدة عند حفظ التعديلات.
            <span class="block text-xs text-slate-500 mt-1">اترك الخيار غير محدد إذا كنت لا ترغب في تعديل الصور الحالية.</span>
        </label>
    </div>

    {{-- 🖼️ الصورة الرئيسية --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة الرئيسية الحالية</label>
        @if($service->image)
            <img src="{{ asset('storage/' . $service->image) }}" class="w-40 rounded-xl mb-3 border border-slate-700">
        @else
            <p class="text-slate-500 text-sm mb-3">لا توجد صورة حالية</p>
        @endif

        <input type="file" name="image" accept="image/*"
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">اختياري - استبدل الصورة الحالية إن رغبت</p>
    </div>

    {{-- 🖼️ الصور الإضافية القديمة --}}
    @php
        $extraImages = $service->images;
        if (is_string($extraImages)) {
            $extraImages = json_decode($extraImages, true);
        }
    @endphp

    @if(!empty($extraImages) && is_array($extraImages))
        <div>
            <label class="block mb-2 text-sm text-slate-300">الصور الإضافية الحالية</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($extraImages as $img)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . str_replace('\\', '/', $img)) }}" class="w-full h-32 object-cover rounded-xl border border-slate-700">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 🖼️ رفع صور إضافية جديدة --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">إضافة صور جديدة (اختياري)</label>
        <input type="file" name="images[]" accept="image/*" multiple
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">يمكنك اختيار عدة صور دفعة واحدة</p>
    </div>

    {{-- 💾 زر الحفظ --}}
    <div class="pt-3">
        <button type="submit"
                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            حفظ التعديلات
        </button>
    </div>
</form>
@endsection
