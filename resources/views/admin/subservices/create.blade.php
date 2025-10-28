@extends('admin.layouts.app')
@section('title', 'إضافة خدمة فرعية')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">إضافة خدمة فرعية</h1>
        <p class="text-slate-400 mt-1">قم بربط الخدمة الجديدة بالخدمة الرئيسية المناسبة.</p>
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

<form method="POST" action="{{ route('admin.subservices.store') }}" enctype="multipart/form-data"
      class="space-y-8 bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
    @csrf

    <div>
        <label class="block mb-2 text-sm text-slate-300">الخدمة الرئيسية *</label>
        <select name="service_id" required
                class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
            <option value="">اختر الخدمة</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">اسم الخدمة الفرعية *</label>
        <input type="text" name="name" value="{{ old('name') }}" required
               class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">وصف الخدمة</label>
        <textarea name="description" rows="5"
                  class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 text-slate-100 focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
    </div>

    <div class="flex items-start gap-3">
        <input type="checkbox" id="setnumberonimage" name="setnumberonimage" value="1"
               class="mt-1 h-5 w-5 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500"
               {{ old('setnumberonimage') ? 'checked' : '' }}>
        <label for="setnumberonimage" class="text-sm text-slate-300 leading-relaxed">
            إظهار رقم التواصل على الصور داخل هذه الخدمة الفرعية.
            <span class="block text-xs text-slate-500 mt-1">يتم استخدام رقم الهاتف من الإعدادات العامة للموقع.</span>
        </label>
    </div>

    <div>
        <label class="block mb-2 text-sm text-slate-300">صور إضافية (اختياري)</label>
        <input type="file" name="images[]" accept="image/*" multiple
               class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 bg-slate-800/70 border border-slate-700 rounded-xl">
        <p class="text-xs text-slate-500 mt-2">يمكن رفع عدة صور دفعة واحدة لعرضها في معرض الخدمة.</p>
    </div>

    <div class="pt-3">
        <button type="submit"
                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
            حفظ الخدمة الفرعية
        </button>
    </div>
</form>
@endsection
