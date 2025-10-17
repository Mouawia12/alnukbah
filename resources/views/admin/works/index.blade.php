@extends('admin.layouts.app')
@section('title', 'أعمالنا')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold flex items-center gap-2">
            🧱 أعمالنا
        </h1>
        <p class="text-slate-400 mt-1">استعرض هنا كل المشاريع المنجزة ضمن معرض الأعمال</p>
    </div>
    <a href="{{ route('admin.works.create') }}"
       class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-md shadow-indigo-600/20 transition">
        + إضافة عمل جديد
    </a>
</div>

{{-- ✅ رسالة نجاح --}}
@if (session('ok'))
    <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

{{-- ✅ عرض المشاريع --}}
@if ($works->count())
<div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($works as $w)
        <div class="group bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden shadow-soft hover:shadow-lg hover:shadow-indigo-500/10 transition-all duration-300">
            
            {{-- صورة العمل --}}
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $w->img) }}"
                     alt="{{ $w->title }}"
                     class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent"></div>
                <div class="absolute bottom-3 right-3 left-3">
                    <h3 class="font-bold text-slate-100 truncate">{{ $w->title }}</h3>
                </div>
            </div>

            {{-- نص ووصف المشروع --}}
            <div class="p-4 flex flex-col justify-between h-36">
                <p class="text-sm text-slate-400 line-clamp-3">{{ $w->text }}</p>

                <div class="flex justify-between items-center mt-4 pt-2 border-t border-slate-700/50">
                    <a href="{{ route('admin.works.edit', $w->id) }}"
                       class="text-indigo-400 hover:text-indigo-300 text-sm font-medium flex items-center gap-1">
                        <i data-lucide="pencil" class="w-4 h-4"></i> تعديل
                    </a>
                    <form method="POST" action="{{ route('admin.works.destroy', $w->id) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا العمل؟')"
                                class="text-red-400 hover:text-red-300 text-sm font-medium flex items-center gap-1">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- ✅ Pagination --}}
<div class="mt-8">
    {{ $works->links() }}
</div>

@else
    <div class="text-center py-16 text-slate-400 border border-slate-700 rounded-2xl bg-slate-800/30">
        لا توجد أعمال مضافة حاليًا.<br>
        <a href="{{ route('admin.works.create') }}" class="text-indigo-400 hover:underline mt-2 inline-block">
            أضف أول عمل الآن
        </a>
    </div>
@endif
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
