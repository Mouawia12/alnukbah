@extends('admin.layouts.app')
@section('title', 'تفاصيل الرسالة')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">📩 تفاصيل الرسالة</h1>
        <p class="text-slate-400 mt-1">محتوى رسالة المرسل بالتفصيل.</p>
    </div>
    <a href="{{ route('admin.contacts.index') }}"
       class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg">الرجوع</a>
</div>

<div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 space-y-4">
    <p><strong class="text-slate-300">👤 الاسم:</strong> {{ $contact->name ?? '—' }}</p>
    <p><strong class="text-slate-300">📧 البريد الإلكتروني:</strong> {{ $contact->email ?? '—' }}</p>
    <p><strong class="text-slate-300">📱 الهاتف:</strong> {{ $contact->phone ?? '—' }}</p>
    <p><strong class="text-slate-300">📍 الموقع:</strong> {{ $contact->location ?? '—' }}</p>
    <hr class="border-slate-700">
    <div>
        <strong class="text-slate-300 block mb-2">💬 الرسالة:</strong>
        <p class="text-slate-100 whitespace-pre-line leading-relaxed">{{ $contact->message ?? '—' }}</p>
    </div>
    <p class="text-sm text-slate-500 mt-4">
        🕓 أُرسلت في {{ $contact->created_at ? $contact->created_at->format('Y-m-d H:i') : '—' }}
    </p>
</div>
@endsection
