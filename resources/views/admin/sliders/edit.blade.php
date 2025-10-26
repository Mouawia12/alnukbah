@extends('admin.layouts.app')
@section('title', 'تعديل بيانات السلايدر')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل بيانات السلايدر</h1>
        <p class="text-slate-400 mt-1">تعديل العناوين أو استبدال الصورة الحالية</p>
    </div>
    <a href="{{ route('admin.sliders.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">الرجوع</a>
</div>

@if ($errors->any())
    <div class="rounded-lg border border-red-500/50 bg-red-500/10 p-4 mb-6">
        <div class="font-bold mb-2 text-red-300">حدثت أخطاء:</div>
        <ul class="list-disc pr-6 text-red-400">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" enctype="multipart/form-data" class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            @csrf
            @method('PUT')

            {{-- العنوان --}}
            <div>
                <label class="block mb-2 text-sm text-slate-300">العنوان الرئيسي (اختياري)</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                       class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- العنوان الفرعي --}}
            <div>
                <label class="block mb-2 text-sm text-slate-300">العنوان الفرعي (اختياري)</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}"
                       class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- الصورة --}}
            <div>
                <label class="block mb-2 text-sm text-slate-300">استبدال الصورة (اختياري)</label>
                <input type="file" name="image" accept="image/*"
                       class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
                <p class="text-xs text-slate-500 mt-2">اترك الحقل فارغًا للاحتفاظ بالصورة الحالية. الحد الأقصى: 4MB</p>
            </div>

            <div>
                <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="p-4 border-b border-slate-700">
            <p class="text-sm font-semibold text-slate-200">معاينة الصورة الحالية</p>
            <p class="text-xs text-slate-400 mt-1">يتم حفظ الصورة الجديدة فور رفعها وحفظ التغييرات</p>
        </div>
        <img src="{{ asset('storage/' . $slider->img) }}" alt="" class="w-full h-64 object-cover">
        <div class="p-4 space-y-2 text-sm text-slate-300">
            <p><span class="text-slate-400">العنوان:</span> {{ $slider->title ?: '— بدون عنوان —' }}</p>
            <p><span class="text-slate-400">العنوان الفرعي:</span> {{ $slider->subtitle ?: '— بدون عنوان فرعي —' }}</p>
        </div>
    </div>
</div>
@endsection
