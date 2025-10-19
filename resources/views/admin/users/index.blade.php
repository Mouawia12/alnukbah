@extends('admin.layouts.app')
@section('title', 'المستخدمون')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">👤 المستخدمون</h1>
        <p class="text-slate-400 mt-1">إدارة مستخدمي النظام وصلاحياتهم</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg">
        ➕ إضافة مستخدم جديد
    </a>
</div>

{{-- ✅ إشعارات النجاح --}}
@if (session('ok'))
    <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

{{-- ✅ عرض كلمة المرور التلقائية إن وُجدت --}}
@if (session('generated_password'))
    <div class="mb-6 rounded-lg border border-yellow-500/50 bg-yellow-500/10 p-4 text-yellow-300">
        <strong>🔑 تم توليد كلمة مرور تلقائية للمستخدم الجديد:</strong>
        <div class="mt-2 font-mono bg-slate-800/80 text-white rounded p-2 text-sm">
            {{ session('generated_password') }}
        </div>
        <p class="mt-2 text-sm text-yellow-400">رجاءً انسخها وشاركها مع المستخدم الجديد.</p>
    </div>
@endif

{{-- ✅ جدول المستخدمين --}}
<div class="overflow-x-auto rounded-xl border border-slate-800 shadow">
    <table class="min-w-full divide-y divide-slate-800">
        <thead class="bg-slate-800/70 text-slate-300">
            <tr>
                <th class="p-3 text-right">#</th>
                <th class="p-3 text-right">الصورة</th>
                <th class="p-3 text-right">الاسم</th>
                <th class="p-3 text-right">البريد الإلكتروني</th>
                <th class="p-3 text-right">الدور</th>
                <th class="p-3 text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @forelse ($users as $u)
                <tr class="hover:bg-slate-800/40 transition">
                    <td class="p-3 text-slate-400">{{ $u->id }}</td>

                    <td class="p-3">
                        <img src="{{ asset('storage/' . $u->avatar) }}"
                             class="h-10 w-10 rounded-full object-cover border border-slate-700">
                    </td>

                    <td class="p-3 font-semibold text-slate-100">{{ $u->name }}</td>
                    <td class="p-3 text-slate-300">{{ $u->email }}</td>

                    {{-- ✅ الدور --}}
                    <td class="p-3 text-indigo-400">
                        {{ $u->role->name ?? '— بدون دور —' }}
                    </td>

                    <td class="p-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.users.edit', $u->id) }}"
                               class="text-indigo-400 hover:text-indigo-300 text-sm">
                                تعديل
                            </a>

                            <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('هل أنت متأكد من الحذف؟')"
                                        class="text-red-400 hover:text-red-300 text-sm">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-slate-500">
                        🚫 لا يوجد مستخدمون حالياً.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ✅ روابط الصفحات --}}
<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection
