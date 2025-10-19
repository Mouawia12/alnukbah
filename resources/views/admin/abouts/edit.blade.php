@extends('admin.layouts.app')
@section('title', 'تعديل حول الشركة')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل بيانات "حول الشركة"</h1>
        <p class="text-slate-400 mt-1">قم بتحديث النص أو الصورة أو عدد سنوات الخبرة</p>
    </div>
    <a href="{{ route('admin.abouts.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">
        الرجوع
    </a>
</div>

<div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 space-y-6">
    <form method="POST" action="{{ route('admin.abouts.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 text-sm text-slate-300">الوصف *</label>
            <textarea name="text" rows="6" class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('text', $about->text ?? '') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 text-sm text-slate-300">سنوات الخبرة *</label>
            <input type="text" name="experiance" value="{{ old('experiance', $about->experiance ?? '') }}" required
                class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block mb-2 text-sm text-slate-300">صورة الشركة (اختياري)</label>
            <input type="file" name="image" accept="image/*"
                class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
            @if (!empty($about->image))
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $about->image) }}" class="w-40 rounded-xl border border-slate-700">
                </div>
            @endif
        </div>

        <div class="pt-3">
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection
