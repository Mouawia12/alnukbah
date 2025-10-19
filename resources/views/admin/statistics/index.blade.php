@extends('admin.layouts.app')
@section('title', 'الإحصائيات')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-extrabold">📊 الإحصائيات</h1>
    <a href="{{ route('admin.statistics.create') }}"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg shadow-lg shadow-indigo-500/20">
        إضافة جديدة
    </a>
</div>

@if (session('ok'))
    <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

@if ($statistics->isEmpty())
    <p class="text-slate-400 text-center py-10">لا توجد إحصائيات مضافة بعد.</p>
@else
    @foreach ($statistics as $s)
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl shadow-soft mb-6 p-6">
            <div class="flex flex-col items-center text-center space-y-6">

                {{-- 🧮 القيم --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 w-full text-center">
                    <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                        <p class="text-slate-400 text-sm">المشاريع</p>
                        <h3 class="text-2xl font-bold text-white">{{ $s->projects }}</h3>
                    </div>
                    <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                        <p class="text-slate-400 text-sm">العملاء</p>
                        <h3 class="text-2xl font-bold text-white">{{ $s->client }}</h3>
                    </div>
                    <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                        <p class="text-slate-400 text-sm">الموظفون</p>
                        <h3 class="text-2xl font-bold text-white">{{ $s->employer }}</h3>
                    </div>
                    <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                        <p class="text-slate-400 text-sm">الخبرة (بالسنوات)</p>
                        <h3 class="text-2xl font-bold text-white">{{ $s->experience }}</h3>
                    </div>
                </div>

                {{-- 🖼️ الصور --}}
                <div class="flex gap-4 justify-center">
                    @if($s->img1)
                        <img src="{{ asset('storage/'.$s->img1) }}" class="w-48 h-32 object-cover rounded-xl border border-slate-700">
                    @endif
                    @if($s->img2)
                        <img src="{{ asset('storage/'.$s->img2) }}" class="w-48 h-32 object-cover rounded-xl border border-slate-700">
                    @endif
                </div>

                {{-- 🔧 أزرار التحكم --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.statistics.edit', $s->id) }}"
                       class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-sm font-medium">
                        تعديل
                    </a>
                    <form action="{{ route('admin.statistics.destroy', $s->id) }}" method="POST"
                          onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf @method('DELETE')
                        <button class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-500 text-sm font-medium">
                            حذف
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

    <div class="mt-6">
        {{ $statistics->links() }}
    </div>
@endif
@endsection
