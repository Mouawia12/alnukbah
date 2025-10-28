@extends('admin.layouts.app')
@section('title', 'إضافة خدمة جديدة')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">إضافة خدمة جديدة</h1>
        <p class="text-slate-400 mt-1">قم بملء تفاصيل الخدمة الجديدة</p>
    </div>
    <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">الرجوع</a>
</div>

@if (session('error'))
    <div class="rounded-lg border border-rose-500/50 bg-rose-500/10 p-4 mb-6 text-rose-200">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf

    <div>
        <label class="block mb-2 text-sm text-slate-300">اسم الخدمة *</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">الوصف</label>
        <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">{{ old('description') }}</textarea>
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">نص العلامة المائية</label>
        <input type="text" name="watermark_text" value="{{ old('watermark_text') }}" maxlength="255"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100"
               placeholder="مثال: www.example.com أو 966-555-123456">
        <p class="text-xs text-slate-500 mt-2">اترك الحقل فارغاً لاستخدام الاسم الافتراضي للتطبيق.</p>
        @error('watermark_text')
            <p class="text-xs text-rose-400 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3">
        <input type="checkbox" id="apply_watermark" name="apply_watermark" value="1"
               class="h-5 w-5 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500"
               {{ old('apply_watermark') ? 'checked' : '' }}>
        <label for="apply_watermark" class="text-sm text-slate-300">
            إضافة علامة مائية تلقائياً على الصور المرفوعة لحماية الحقوق.
        </label>
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة الرئيسية</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm file:py-2 file:px-4 file:bg-indigo-600 file:text-white rounded-lg">
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">صور إضافية (اختياري)</label>
        <input type="file" name="images[]" accept="image/*" multiple class="w-full text-sm file:py-2 file:px-4 file:bg-indigo-600 file:text-white rounded-lg">
    </div>

    <div>
        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            حفظ الخدمة
        </button>
    </div>
</form>
@endsection
