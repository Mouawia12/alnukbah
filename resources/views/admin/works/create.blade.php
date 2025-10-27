@extends('admin.layouts.app')
@section('title', 'إضافة عمل جديد')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">🧱 إضافة عمل جديد</h1>
        <p class="text-slate-400 mt-1">قم بإضافة مشروع جديد إلى قائمة الأعمال</p>
    </div>
    <a href="{{ route('admin.works.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">
        الرجوع للقائمة
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

<form method="POST" action="{{ route('admin.works.store') }}" enctype="multipart/form-data"
      class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf

    {{-- العنوان --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">عنوان المشروع *</label>
        <input type="text" name="title" value="{{ old('title') }}" required
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- الوصف --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الوصف</label>
        <textarea name="text" rows="4"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('text') }}</textarea>
    </div>

    {{-- الصورة الرئيسية --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الصورة الرئيسية *</label>

        {{-- عرض المعاينة قبل الرفع --}}
        <img id="mainPreview" src="#" alt="preview" class="hidden h-40 w-auto rounded-xl border border-slate-700 object-cover mb-4">

        <input type="file" name="img" accept="image/*" required
               onchange="previewMain(event)"
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">الحد الأقصى: 4MB</p>
    </div>

    {{-- الصور الإضافية --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الصور الإضافية (اختياري)</label>

        {{-- المعاينات --}}
        <div id="extraPreview" class="flex flex-wrap gap-3 mb-4"></div>

        <input type="file" name="images[]" multiple accept="image/*"
               onchange="previewExtra(event)"
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">يمكنك اختيار أكثر من صورة</p>
    </div>

    {{-- زر الحفظ --}}
    <div>
        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            💾 حفظ العمل
        </button>
    </div>
</form>

{{-- سكريبت معاينة الصور --}}
@push('scripts')
<script>
    // معاينة الصورة الرئيسية
    function previewMain(event) {
        const img = document.getElementById('mainPreview');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.classList.remove('hidden');
    }

    // معاينة الصور الإضافية
    function previewExtra(event) {
        const container = document.getElementById('extraPreview');
        container.innerHTML = '';
        for (const file of event.target.files) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('h-24', 'w-24', 'rounded-lg', 'border', 'border-slate-700', 'object-cover');
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
