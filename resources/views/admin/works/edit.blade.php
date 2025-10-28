@extends('admin.layouts.app')
@section('title', 'تعديل العمل')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">✏️ تعديل العمل</h1>
        <p class="text-slate-400 mt-1">قم بتحديث بيانات المشروع أو صوره</p>
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

<form method="POST" action="{{ route('admin.works.update', $work->id) }}" enctype="multipart/form-data" class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf
    @method('PUT')

    {{-- العنوان --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">عنوان المشروع</label>
        <input type="text" name="title" value="{{ old('title', $work->title) }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- الوصف --}}
    <div>
        <label class="block mb-2 text-sm text-slate-300">الوصف</label>
        <textarea name="text" rows="4"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('text', $work->text) }}</textarea>
    </div>

    {{-- الصورة الرئيسية --}}
    <div>
        <label class="block mb-3 text-sm text-slate-300">الصورة الرئيسية الحالية</label>

        @if ($work->img)
            <img src="{{ asset('storage/' . $work->img) }}" alt="preview"
                 class="h-40 w-auto rounded-xl border border-slate-700 object-cover mb-4">
        @else
            <p class="text-slate-500 text-sm mb-4">لا توجد صورة حالية.</p>
        @endif

        <label class="block mb-2 text-sm text-slate-300">تغيير الصورة الرئيسية</label>
        <input type="file" name="img" accept="image/*"
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">اتركها فارغة إذا لا تريد التغيير</p>
    </div>

    {{-- الصور الإضافية --}}
    @php
        $extraImages = is_array($work->image) ? $work->image : json_decode($work->image ?? '[]', true);
    @endphp
    <div>
        <label class="block mb-3 text-sm text-slate-300">الصور الإضافية الحالية</label>

        @if (!empty($extraImages))
            <div class="flex flex-wrap gap-3 mb-4">
                @foreach ($extraImages as $index => $img)
                    @php $containerId = 'work-image-' . $work->id . '-' . $index; @endphp
                    <div class="relative group" id="{{ $containerId }}" data-image-wrapper>
                        <img src="{{ asset('storage/' . $img) }}" class="h-24 w-24 rounded-lg border border-slate-700 object-cover">
                        <button type="button"
                                class="px-1.5 py-0.5 text-[11px] rounded bg-rose-600 hover:bg-rose-500 text-white shadow-lg shadow-rose-500/30 transition absolute top-1 right-1"
                                data-delete-image
                                data-url="{{ route('admin.works.images.destroy', ['work' => $work->id, 'index' => $index]) }}"
                                data-target="{{ $containerId }}"
                                data-success-message="🗑️ تم حذف الصورة بنجاح"
                                data-confirm="هل أنت متأكد من حذف هذه الصورة؟">
                            حذف
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-slate-500 text-sm mb-4">لا توجد صور إضافية حالياً.</p>
        @endif

        <label class="block mb-2 text-sm text-slate-300">إضافة صور جديدة</label>
        <input type="file" name="images[]" multiple accept="image/*"
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">يمكنك اختيار أكثر من صورة</p>
    </div>

    {{-- زر الحفظ --}}
    <div>
        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            💾 حفظ التعديلات
        </button>
    </div>
</form>
@endsection
