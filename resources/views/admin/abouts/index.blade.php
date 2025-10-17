@extends('admin.layouts.app')
@section('title', 'معاينة حول الشركة')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">حول الشركة</h1>
        <p class="text-slate-400 mt-1">عرض بيانات قسم "من نحن"</p>
    </div>
    <a href="{{ route('admin.abouts.edit') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500">
        تعديل
    </a>
</div>

<div class="bg-slate-800/50 border border-slate-700 rounded-2xl shadow-soft p-6">
    @if (session('ok'))
        <div class="mb-4 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
            {{ session('ok') }}
        </div>
    @endif

    @if ($about)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-right">
                <thead class="bg-slate-900/50 text-slate-400">
                    <tr>
                        <th class="p-3">الإجراءات</th>
                        <th class="p-3">سنوات الخبرة</th>
                        <th class="p-3">الوصف</th>
                        <th class="p-3">الصورة</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-slate-700">
                        <td class="p-3">
                            <a href="{{ route('admin.abouts.edit') }}" class="bg-blue-600 hover:bg-blue-500 px-3 py-1 rounded text-white text-sm">تعديل</a>
                        </td>
                        <td class="p-3">{{ $about->experiance }}</td>
                        <td class="p-3 text-slate-300 max-w-xl overflow-hidden text-ellipsis">{{ $about->text }}</td>
                        <td class="p-3">
                            @if($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" class="w-32 rounded-xl border border-slate-700">
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <p class="text-slate-400">لم تتم إضافة بيانات بعد.</p>
    @endif
</div>
@endsection
