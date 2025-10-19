@extends('admin.layouts.app')

@section('title', 'تغيير كلمة المرور')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="space-y-2 text-center">
        <h1 class="text-2xl font-extrabold">تغيير كلمة المرور</h1>
        <p class="text-slate-400">قم بتحديث كلمة المرور الخاصة بك للحفاظ على أمان حسابك.</p>
    </div>

    @if (session('ok'))
        <div class="rounded-xl border border-emerald-500/40 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
            {{ session('ok') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5 bg-slate-800/60 border border-slate-700 rounded-2xl p-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label for="current_password" class="block mb-2 text-sm text-slate-300">كلمة المرور الحالية</label>
            <div class="relative">
                <input
                    type="password"
                    name="current_password"
                    id="current_password"
                    required
                    class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 pr-12 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                <button type="button"
                        class="absolute inset-y-0 left-3 flex items-center text-slate-400 hover:text-slate-100 transition-colors"
                        data-password-toggle="#current_password"
                        aria-label="إظهار كلمة المرور الحالية">
                    <i data-lucide="eye" class="w-5 h-5 toggle-icon-show"></i>
                    <i data-lucide="eye-off" class="w-5 h-5 toggle-icon-hide hidden"></i>
                </button>
            </div>
            @error('current_password')
                <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block mb-2 text-sm text-slate-300">كلمة المرور الجديدة</label>
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 pr-12 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                <button type="button"
                        class="absolute inset-y-0 left-3 flex items-center text-slate-400 hover:text-slate-100 transition-colors"
                        data-password-toggle="#password"
                        aria-label="إظهار كلمة المرور الجديدة">
                    <i data-lucide="eye" class="w-5 h-5 toggle-icon-show"></i>
                    <i data-lucide="eye-off" class="w-5 h-5 toggle-icon-hide hidden"></i>
                </button>
            </div>
            @error('password')
                <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block mb-2 text-sm text-slate-300">تأكيد كلمة المرور الجديدة</label>
            <div class="relative">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="w-full rounded-xl border border-slate-700 bg-slate-900/60 p-3 pr-12 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                <button type="button"
                        class="absolute inset-y-0 left-3 flex items-center text-slate-400 hover:text-slate-100 transition-colors"
                        data-password-toggle="#password_confirmation"
                        aria-label="إظهار تأكيد كلمة المرور">
                    <i data-lucide="eye" class="w-5 h-5 toggle-icon-show"></i>
                    <i data-lucide="eye-off" class="w-5 h-5 toggle-icon-hide hidden"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('admin.dashboard') }}"
               class="px-4 py-2 rounded-xl border border-slate-600 text-slate-200 hover:bg-slate-700/60 transition-colors">
                إلغاء
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20 transition-colors">
                تحديث كلمة المرور
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('[data-password-toggle]').forEach(button => {
        const targetSelector = button.getAttribute('data-password-toggle');
        const input = document.querySelector(targetSelector);
        if (!input) return;

        button.addEventListener('click', () => {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            button.querySelectorAll('.toggle-icon-show, .toggle-icon-hide').forEach(icon => {
                icon.classList.toggle('hidden');
            });
        });
    });
</script>
@endpush
