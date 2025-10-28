@extends('admin.layouts.app')
@section('title', 'الخدمات الفرعية')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">الخدمات الفرعية</h1>
        <p class="text-slate-400 mt-1">إدارة الخدمات التابعة لكل خدمة رئيسية.</p>
    </div>
    <a href="{{ route('admin.subservices.create') }}"
       class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500">
        إضافة خدمة فرعية
    </a>
</div>

@if (session('ok'))
    <div class="mb-4 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-lg border border-rose-500/50 bg-rose-500/10 p-4 text-rose-300">
        {{ session('error') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.subservices.index') }}"
      class="mb-6 flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-slate-800/50 border border-slate-700 rounded-2xl p-4">
    <div class="w-full sm:w-64">
        <label for="serviceFilter" class="block mb-2 text-sm text-slate-300">الخدمة الرئيسية</label>
        <select id="serviceFilter" name="service_id"
                class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-2.5 text-slate-100">
            <option value="">كل الخدمات</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ (string) $selectedService === (string) $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center gap-2">
        <button type="submit"
                class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-100">
            تطبيق الفلتر
        </button>
        @if ($selectedService)
            <a href="{{ route('admin.subservices.index') }}"
               class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200">
                إعادة التعيين
            </a>
        @endif
    </div>
</form>

<div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse ($subservices as $subservice)
        @php
            $gallery = $subservice->images;
            if (is_string($gallery)) {
                $decoded = json_decode($gallery, true);
                $gallery = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($gallery)) {
                $gallery = [];
            }
            $cover = $gallery[0] ?? null;
        @endphp

        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden shadow-soft flex flex-col">
            <div class="h-44 bg-slate-900">
                @if ($cover)
                    <img src="{{ asset('storage/' . str_replace('\\', '/', $cover)) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="h-full flex items-center justify-center text-slate-500 text-sm">
                        لا توجد صورة
                    </div>
                @endif
            </div>
            <div class="p-5 flex-1 flex flex-col gap-4">
                <div>
                    <span class="text-xs font-semibold text-indigo-300">
                        {{ optional($subservice->service)->name ?? 'غير مرتبط' }}
                    </span>
                    <h3 class="font-bold text-lg mt-2">{{ $subservice->name }}</h3>
                    @if ($subservice->description)
                        <p class="text-slate-400 text-sm mt-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($subservice->description), 120) }}
                        </p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-lg border border-slate-600 px-2.5 py-1 text-xs text-slate-200">
                        <i data-lucide="images" class="w-4 h-4"></i>
                        {{ count($gallery) }}
                    </span>
                    @if ($subservice->setnumberonimage)
                        <span class="inline-flex items-center gap-1 rounded-lg border border-emerald-600 px-2.5 py-1 text-xs text-emerald-300">
                            <i data-lucide="hash" class="w-4 h-4"></i>
                            إظهار الرقم على الصور
                        </span>
                    @endif
                </div>
                <div class="flex items-center justify-between mt-auto pt-2">
                    <a href="{{ route('admin.subservices.edit', $subservice) }}"
                       class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1.5 rounded text-xs">
                        تعديل
                    </a>
                    <form action="{{ route('admin.subservices.destroy', $subservice) }}" method="POST"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة الفرعية؟');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-rose-600 hover:bg-rose-500 text-white px-3 py-1.5 rounded text-xs">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-slate-400 col-span-full text-center">لا توجد خدمات فرعية حالياً.</p>
    @endforelse
</div>

<div class="mt-6">{{ $subservices->links() }}</div>
@endsection
