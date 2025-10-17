@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold">لوحة التحكم</h1>
    <p class="text-slate-400 mt-1 text-sm">نظرة عامة على أداء الموقع</p>
</div>

{{-- 🔹 البطاقات --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5 mb-10">
    @php
        $cards = [
            ['label'=>'المقالات','value'=>$stats['articles'],'icon'=>'book-open','color'=>'indigo'],
            ['label'=>'الخدمات','value'=>$stats['services'],'icon'=>'layers','color'=>'emerald'],
            ['label'=>'الأعمال','value'=>$stats['works'],'icon'=>'briefcase','color'=>'amber'],
            ['label'=>'المستخدمون','value'=>$stats['users'],'icon'=>'users','color'=>'blue'],
            ['label'=>'الرسائل','value'=>$stats['contacts'],'icon'=>'mail','color'=>'rose'],
            ['label'=>'المشتركين','value'=>$stats['subscribes'],'icon'=>'inbox','color'=>'violet'],
        ];
    @endphp

    @foreach ($cards as $c)
        <div class="rounded-2xl bg-gradient-to-br from-{{ $c['color'] }}-600/90 to-{{ $c['color'] }}-400/70 p-5 shadow-lg border border-{{ $c['color'] }}-400/40">
            <div class="flex items-center justify-between">
                <h3 class="text-sm text-white/90">{{ $c['label'] }}</h3>
                <i data-lucide="{{ $c['icon'] }}" class="w-6 h-6 text-white/70"></i>
            </div>
            <div class="mt-3 text-3xl font-extrabold text-white">{{ $c['value'] }}</div>
        </div>
    @endforeach
</div>

{{-- 🔹 المخطط --}}
<div class="rounded-2xl bg-slate-800/70 border border-slate-700 p-6 shadow-soft mb-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold flex items-center gap-2 text-white">
            <i data-lucide="bar-chart-3" class="w-5 h-5 text-indigo-400"></i> النشاط الشهري
        </h2>
        <span class="text-xs text-slate-400">آخر 12 شهرًا</span>
    </div>
    <div class="relative" style="height: 320px">
        <canvas id="globalChart"></canvas>
    </div>
</div>

{{-- 🔹 الجداول --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- مقالات --}}
    <x-admin.latest-table title="أحدث المقالات" :items="$latestArticles" route="admin.articles.edit" color="indigo" field="title" />

    {{-- رسائل --}}
    <x-admin.latest-table title="أحدث الرسائل" :items="$latestContacts" route="admin.contacts.show" color="rose" field="name" />

    {{-- اشتراكات --}}
    <x-admin.latest-table title="أحدث المشتركين" :items="$latestSubscribes" route="admin.subscribes.index" color="emerald" field="email" />
</div>
@endsection

@push('scripts')
<script>
lucide.createIcons();

const ctx = document.getElementById('globalChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [
            {
                label: 'المقالات',
                data: @json($chartValues['articles']),
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderRadius: 6
            },
            {
                label: 'الخدمات',
                data: @json($chartValues['services']),
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderRadius: 6
            },
            {
                label: 'الأعمال',
                data: @json($chartValues['works']),
                backgroundColor: 'rgba(251, 191, 36, 0.7)',
                borderRadius: 6
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#cbd5e1' } },
            y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#cbd5e1' } }
        },
        plugins: {
            legend: { labels: { color: '#e2e8f0' } },
            tooltip: { rtl: true, titleAlign: 'right', bodyAlign: 'right' }
        }
    }
});
</script>
@endpush
