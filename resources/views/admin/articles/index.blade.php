@extends('admin.layouts.app')

@section('title', 'قائمة المقالات')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">المقالات</h1>

        @if(session('ok'))
            <p class="text-emerald-400 mt-2">{{ session('ok') }}</p>
        @endif
    </div>
    <a href="{{ route('admin.articles.create') }}"
       class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 font-semibold flex items-center gap-1">
        <i data-lucide="plus" class="w-4 h-4"></i> مقال جديد
    </a>
</div>

<div class="bg-slate-800/50 border border-slate-700 rounded-2xl shadow-soft overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800/70">
            <tr class="text-slate-300">
                <th class="p-3 text-right">#</th>
                <th class="p-3 text-right">صورة رئيسية</th>
                <th class="p-3 text-right">الصور الثانوية</th>
                <th class="p-3 text-right">العنوان</th>
                <th class="p-3 text-right">تاريخ الإنشاء</th>
                <th class="p-3 text-right">إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $a)
                <tr class="border-t border-slate-700 hover:bg-slate-800/40">
                    <td class="p-3">{{ $a->id }}</td>

                    {{-- الصورة الرئيسية --}}
                    <td class="p-3">
                        @if($a->image)
                            <img src="{{ asset('storage/'.$a->image) }}" alt="" class="h-12 w-16 object-cover rounded-md border border-slate-700">
                        @endif
                    </td>

                    {{-- الصور الثانوية (Gallery) --}}
                    <td class="p-3">
                        @php
                            // تعميم: images قد تكون null أو JSON String أو Array
                            $gallery = [];
                            if (!is_null($a->images) && $a->images !== '') {
                                if (is_string($a->images)) {
                                    $decoded = json_decode($a->images, true);
                                    $gallery = is_array($decoded) ? $decoded : [];
                                } elseif (is_array($a->images)) {
                                    $gallery = $a->images;
                                }
                            }
                        @endphp

                        @if(!empty($gallery))
                            <div class="flex items-center gap-1">
                                @foreach(array_slice($gallery, 0, 2) as $g)
                                    <img src="{{ asset('storage/'.$g) }}" alt="" class="h-10 w-10 object-cover rounded-md border border-slate-700">
                                @endforeach
                                @if(count($gallery) > 2)
                                    <span class="text-xs text-gray-400">+{{ count($gallery) - 2 }}</span>
                                @endif
                            </div>
                        @else
                            <span class="text-slate-500 text-xs">لا يوجد</span>
                        @endif
                    </td>

                    <td class="p-3 font-semibold">{{ $a->title }}</td>
                    <td class="p-3">{{ $a->created_at ? $a->created_at->format('Y-m-d H:i') : '-' }}</td>

                    <td class="p-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.articles.edit', $a->id) }}"
                               class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white flex items-center gap-1">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> تعديل
                            </a>
                            <form action="{{ route('admin.articles.destroy', $a->id) }}" method="POST" onsubmit="return confirm('حذف هذا المقال؟')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-500 text-white flex items-center gap-1">
                                    <i data-lucide="trash" class="w-4 h-4"></i> حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-slate-400">لا توجد مقالات بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $articles->links() }}
</div>
@endsection

@push('scripts')
<script>lucide.createIcons();</script>
@endpush
