@extends('admin.layouts.app')
@section('title', 'الإعدادات')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold">⚙️ إعدادات الموقع</h1>
        <p class="text-slate-400 mt-1">قم بتعديل بيانات الموقع ولوحة التحكم من هنا.</p>
    </div>
</div>

@if (session('ok'))
    <div class="mb-6 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
        {{ session('ok') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-10">
    @csrf

    @foreach ($groups as $group => $settings)
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h2 class="text-xl font-bold mb-6 text-indigo-400">{{ ucfirst($group) }} Settings</h2>

            <div class="grid md:grid-cols-2 gap-8">
                @foreach ($settings as $setting)
                    <div>
                        <label class="block mb-2 text-sm text-slate-300">{{ $setting->display_name }}</label>

                        {{-- نوع: صورة --}}
                        @if ($setting->isImage())
                            @if ($setting->value)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $setting->value) }}" alt="preview"
                                         class="h-20 rounded-lg border border-slate-700 object-contain">
                                </div>
                            @endif
                            <input type="file" name="{{ $setting->key }}" accept="image/*"
                                   class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg
                                   file:bg-indigo-600 file:text-white hover:file:bg-indigo-500
                                   bg-slate-800/70 border border-slate-700 rounded-xl">
                        @else
                            {{-- نوع: نص أو رابط --}}
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                   class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3
                                   text-slate-100 focus:ring-2 focus:ring-indigo-500">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="flex justify-end">
        <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg">
            💾 حفظ الإعدادات
        </button>
    </div>
</form>
@endsection
