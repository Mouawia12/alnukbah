@extends('admin.layouts.app')
@section('title', 'قائمة الخدمات')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">الخدمات</h1>
        <p class="text-slate-400 mt-1">إدارة جميع الخدمات المسجلة</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500">إضافة خدمة</a>
</div>

@if (session('ok'))
    <div class="mb-4 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

<div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($services as $service)
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden shadow-soft">
            <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $service->name }}</h3>
                <p class="text-slate-400 text-sm mt-2 line-clamp-3">{{ $service->description }}</p>

                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded text-xs">تعديل</a>

                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-slate-400 col-span-full text-center">لا توجد خدمات حالياً.</p>
    @endforelse
</div>

<div class="mt-6">{{ $services->links() }}</div>
@endsection
