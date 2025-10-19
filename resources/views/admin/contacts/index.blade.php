@extends('admin.layouts.app')
@section('title', 'رسائل التواصل')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold">📞 رسائل التواصل</h1>
        <p class="text-slate-400 mt-1">عرض كل الرسائل المرسلة من صفحة "اتصل بنا".</p>
    </div>
</div>

@if (session('ok'))
    <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

@if ($contacts->isEmpty())
    <p class="text-slate-400 text-center py-10">لا توجد رسائل بعد.</p>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-slate-200 text-center">
            <thead class="bg-slate-800/70 text-slate-400">
                <tr>
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">الاسم</th>
                    <th class="py-3 px-4">البريد الإلكتروني</th>
                    <th class="py-3 px-4">رقم الهاتف</th>
                    <th class="py-3 px-4">الموقع</th>
                    <th class="py-3 px-4">الرسالة</th>
                    <th class="py-3 px-4">تاريخ الإرسال</th>
                    <th class="py-3 px-4">الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $c)
                    <tr class="border-b border-slate-700/50 hover:bg-slate-800/40 transition">
                        <td class="py-3 px-4">{{ $c->id }}</td>
                        <td class="py-3 px-4">{{ $c->name ?? '—' }}</td>
                        <td class="py-3 px-4 text-indigo-300">{{ $c->email ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $c->phone ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $c->location ?? '—' }}</td>
                        <td class="py-3 px-4 text-slate-400 truncate max-w-[200px]">
                            {{ Str::limit($c->message, 40) }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $c->created_at ? $c->created_at->format('Y-m-d H:i') : '—' }}
                        </td>
                        <td class="py-3 px-4 flex justify-center gap-2">
                            <a href="{{ route('admin.contacts.show', $c->id) }}"
                               class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 rounded text-sm">عرض</a>
                            <form action="{{ route('admin.contacts.destroy', $c->id) }}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 hover:bg-red-500 rounded text-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
@endif
@endsection
