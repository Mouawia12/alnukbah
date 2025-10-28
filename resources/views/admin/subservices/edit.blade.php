@extends('admin.layouts.app')
@section('title', 'تعديل خدمة فرعية')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل الخدمة الفرعية</h1>
        <p class="text-slate-400 mt-1">قم بتحديث بيانات الخدمة أو صورها التابعة.</p>
    </div>
    <a href="{{ route('admin.subservices.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">
        الرجوع للقائمة
    </a>
</div>

@if ($errors->any())
    <div class="rounded-lg border border-rose-500/50 bg-rose-500/10 p-4 mb-6">
        <div class="font-bold mb-2 text-rose-300">هناك أخطاء يجب معالجتها:</div>
        <ul class="list-disc pr-6 text-rose-300 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.subservices.update', $subservice) }}" enctype="multipart/form-data"
      class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-2 text-sm text-slate-300">الخدمة الرئيسية *</label>
        <select name="service_id" required
                class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
            @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id', $subservice->service_id) == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">اسم الخدمة الفرعية *</label>
        <input type="text" name="name" value="{{ old('name', $subservice->name) }}" required
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">وصف الخدمة</label>
        <textarea name="description" rows="5"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('description', $subservice->description) }}</textarea>
    </div>

    <div class="flex items-start gap-3">
        <input type="checkbox" id="setnumberonimage" name="setnumberonimage" value="1"
               class="mt-1 h-5 w-5 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500"
               {{ old('setnumberonimage', $subservice->setnumberonimage) ? 'checked' : '' }}>
        <label for="setnumberonimage" class="text-sm text-slate-300 leading-relaxed">
            إظهار رقم التواصل على صور هذه الخدمة الفرعية.
            <span class="block text-xs text-slate-500 mt-1">يتم استخدام رقم الهاتف من الإعدادات العامة للموقع.</span>
        </label>
    </div>

    @php
        $gallery = $subservice->images;
        if (is_string($gallery)) {
            $decoded = json_decode($gallery, true);
            $gallery = is_array($decoded) ? $decoded : [];
        } elseif (!is_array($gallery)) {
            $gallery = [];
        }
    @endphp

    @if (!empty($gallery))
        <div>
            <label class="block mb-2 text-sm text-slate-300">الصور الحالية</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($gallery as $index => $img)
                    @php $containerId = 'subservice-image-' . $subservice->id . '-' . $index; @endphp
                    <div class="relative group" id="{{ $containerId }}" data-image-wrapper>
                        <img src="{{ asset('storage/' . str_replace('\\', '/', $img)) }}"
                             class="w-full h-32 object-cover rounded-xl border border-slate-700">
                        <button type="button"
                                class="px-2 py-1 text-xs rounded-lg bg-rose-600 hover:bg-rose-500 text-white shadow-lg shadow-rose-500/30 transition absolute top-2 right-2"
                                data-delete-image
                                data-url="{{ route('admin.subservices.images.destroy', ['subservice' => $subservice->id, 'index' => $index]) }}"
                                data-target="{{ $containerId }}"
                                data-success-message="🗑️ تم حذف الصورة بنجاح"
                                data-confirm="هل أنت متأكد من حذف هذه الصورة؟">
                            حذف
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div>
        <label class="block mb-2 text-sm text-slate-300">إضافة صور جديدة (اختياري)</label>
        <input type="file" name="images[]" accept="image/*" multiple
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">يتم إضافة الصور الجديدة إلى المعرض دون حذف الحالية.</p>
    </div>

    <div class="pt-3">
        <button type="submit"
                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            حفظ التعديلات
        </button>
    </div>
</form>
@endsection
