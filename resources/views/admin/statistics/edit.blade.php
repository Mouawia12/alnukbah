@extends('admin.layouts.app')
@section('title', 'تعديل الإحصائيات')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل الإحصائيات</h1>
        <p class="text-slate-400 mt-1">قم بتحديث الأرقام أو الصور الظاهرة في قسم الإحصائيات.</p>
    </div>
    <a href="{{ route('admin.statistics.index') }}"
       class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg">
       الرجوع
    </a>
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

<form method="POST"
      action="{{ route('admin.statistics.update', $stat->id) }}"
      enctype="multipart/form-data"
      class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 space-y-6">
    @csrf
    @method('PUT')

    {{-- 🧮 الحقول الرقمية --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div>
            <label class="block mb-2 text-sm text-slate-300">عدد المشاريع</label>
            <input type="number" name="projects"
                   value="{{ old('projects', $stat->projects) }}"
                   class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
        </div>
        <div>
            <label class="block mb-2 text-sm text-slate-300">عدد العملاء</label>
            <input type="number" name="client"
                   value="{{ old('client', $stat->client) }}"
                   class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
        </div>
        <div>
            <label class="block mb-2 text-sm text-slate-300">عدد الموظفين</label>
            <input type="number" name="employer"
                   value="{{ old('employer', $stat->employer) }}"
                   class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
        </div>
        <div>
            <label class="block mb-2 text-sm text-slate-300">سنوات الخبرة</label>
            <input type="number" name="experience"
                   value="{{ old('experience', $stat->experience) }}"
                   class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100">
        </div>
    </div>

    {{-- 🖼️ الصور الحالية --}}
    <div class="grid sm:grid-cols-2 gap-6">
        {{-- الصورة 1 --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">الصورة الأولى</label>
            @if($stat->img1)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$stat->img1) }}"
                         class="w-full h-40 object-cover rounded-xl border border-slate-700">
                </div>
            @endif
            <input type="file" name="img1" accept="image/*"
                   class="block w-full text-sm file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:bg-indigo-600 file:text-white
                          hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
            <p class="text-xs text-slate-500 mt-2">اتركها فارغة إذا لا تريد التغيير</p>
        </div>

        {{-- الصورة 2 --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">الصورة الثانية</label>
            @if($stat->img2)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$stat->img2) }}"
                         class="w-full h-40 object-cover rounded-xl border border-slate-700">
                </div>
            @endif
            <input type="file" name="img2" accept="image/*"
                   class="block w-full text-sm file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:bg-indigo-600 file:text-white
                          hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
            <p class="text-xs text-slate-500 mt-2">اتركها فارغة إذا لا تريد التغيير</p>
        </div>
    </div>

    {{-- زر الحفظ --}}
    <div class="pt-3 text-center">
        <button type="submit"
                class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500
                       font-semibold shadow-lg shadow-indigo-500/20">
            💾 حفظ التعديلات
        </button>
    </div>
</form>
@endsection
