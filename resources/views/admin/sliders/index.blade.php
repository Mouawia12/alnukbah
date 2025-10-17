@extends('admin.layouts.app')
@section('title', 'معرض الصور')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">معرض الصور</h1>
        <p class="text-slate-400 mt-1">عرض جميع صور السلايدر</p>
    </div>
    <a href="{{ route('admin.sliders.create') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500">إضافة صورة</a>
</div>

@if (session('ok'))
    <div class="mb-4 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

<div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($sliders as $s)
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden shadow-soft">
            <img src="{{ asset('storage/' . $s->img) }}" alt="" class="w-full h-52 object-cover">
            <div class="p-4">
                <p class="text-sm text-slate-100 font-bold">{{ $s->title ?? '— بدون عنوان —' }}</p>
                <p class="text-xs text-slate-400 mt-1 truncate">{{ $s->subtitle ?? '— بدون عنوان فرعي —' }}</p>
                <div class="mt-3 flex justify-between items-center">
                    <form method="POST" action="{{ route('admin.sliders.destroy', $s) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-slate-400 col-span-full text-center">لا توجد صور في المعرض حاليًا.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $sliders->links() }}
</div>
@endsection
