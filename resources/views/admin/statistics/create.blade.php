@extends('admin.layouts.app')
@section('title', 'إضافة إحصائيات')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold">إضافة إحصائيات جديدة</h1>
    <a href="{{ route('admin.statistics.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg">الرجوع</a>
</div>

<form method="POST" action="{{ route('admin.statistics.store') }}" enctype="multipart/form-data" class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 space-y-6">
    @csrf

    @foreach(['projects' => 'عدد المشاريع', 'client' => 'عدد العملاء', 'employer' => 'عدد الموظفين', 'experience' => 'سنوات الخبرة'] as $field => $label)
        <div>
            <label class="block mb-2 text-sm text-slate-300">{{ $label }}</label>
            <input type="number" name="{{ $field }}" required class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
        </div>
    @endforeach

    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة الأولى (اختياري)</label>
        <input type="file" name="img1" accept="image/*" class="w-full border border-slate-700 rounded-xl bg-slate-900/60 text-slate-100 p-2">
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة الثانية (اختياري)</label>
        <input type="file" name="img2" accept="image/*" class="w-full border border-slate-700 rounded-xl bg-slate-900/60 text-slate-100 p-2">
    </div>

    <button class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">حفظ</button>
</form>
@endsection
