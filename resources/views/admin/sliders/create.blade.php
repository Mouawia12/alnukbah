@extends('admin.layouts.app')
@section('title', 'إضافة صورة للمعرض')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">إضافة صورة للمعرض</h1>
        <p class="text-slate-400 mt-1">قم برفع صورة جديدة للمعرض</p>
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

<form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf

    {{-- العنوان --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">العنوان الرئيسي (اختياري)</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- العنوان الفرعي --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">العنوان الفرعي (اختياري)</label>
        <input type="text" name="subtitle" value="{{ old('subtitle') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- الصورة --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة *</label>
        <input type="file" name="image" accept="image/*" required
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">الحد الأقصى: 4MB</p>
    </div>

    <div>
        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            حفظ الصورة
        </button>
    </div>
</form>
@endsection
