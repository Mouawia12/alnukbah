@extends('admin.layouts.app')
@section('title', 'قائمة الاشتراكات')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold">📬 قائمة الاشتراكات</h1>
            <p class="text-slate-400 mt-1">عرض جميع عناوين البريد الإلكتروني المسجلة.</p>
        </div>
    </div>

    @if (session('ok'))
        <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
            {{ session('ok') }}
        </div>
    @endif

    @if ($subscribes->isEmpty())
        <p class="text-slate-400 text-center py-10">لا توجد اشتراكات بعد.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-slate-200 text-center">
                <thead class="bg-slate-800/70 text-slate-400">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">البريد الإلكتروني</th>
                        <th class="py-3 px-4">تاريخ الاشتراك</th>
                        <th class="py-3 px-4">الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribes as $sub)
                        <tr class="border-b border-slate-700/50 hover:bg-slate-800/40 transition">
                            <td class="py-3 px-4">{{ $sub->id }}</td>
                            <td class="py-3 px-4 font-medium text-indigo-300">{{ $sub->email ?? '—' }}</td>
                            <td class="py-3 px-4">
                                {{ $sub->created_at ? $sub->created_at->format('Y-m-d H:i') : '—' }}
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.subscribes.destroy', $sub->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الاشتراك؟')">
                                    @csrf @method('DELETE')
                                    <button class="px-4 py-1 rounded-lg bg-red-600 hover:bg-red-500 text-sm">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-6">
            {{ $subscribes->links() }}
        </div>
    @endif
@endsection
