@extends('admin.layouts.app')
@section('title', 'إضافة مستخدم جديد')

@section('content')
    <div class="max-w-2xl mx-auto bg-slate-900/60 border border-slate-700 rounded-2xl p-6 shadow-lg">

        <h1 class="text-2xl font-bold mb-6">👤 إضافة مستخدم جديد</h1>

        {{-- ✅ عرض رسالة نجاح --}}
        @if (session('ok'))
            <div class="mb-4 rounded-lg border border-green-500/50 bg-green-500/10 p-4 text-green-300">
                {{ session('ok') }}
            </div>
        @endif

        {{-- ✅ عرض كلمة المرور المولّدة تلقائياً (إن وُجدت) --}}
        @if (session('generated_password'))
            <div class="mb-4 rounded-lg border border-yellow-500/50 bg-yellow-500/10 p-4 text-yellow-300">
                <strong>🔑 ملاحظة:</strong> تم توليد كلمة مرور تلقائية للمستخدم الجديد:
                <div class="mt-2 font-mono bg-slate-800 p-2 rounded text-sm text-white">
                    {{ session('generated_password') }}
                </div>
                <p class="mt-2 text-sm text-yellow-400">
                    رجاءً انسخها وابعثها للمستخدم أو اطلب منه تغييرها عند أول تسجيل دخول.
                </p>
            </div>
        @endif

        {{-- ✅ نموذج إنشاء مستخدم --}}
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- الاسم --}}
            <div>
                <label class="block text-slate-300 mb-2">الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100
                          focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- البريد الإلكتروني --}}
            <div>
                <label class="block text-slate-300 mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100
                          focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- الدور --}}
            <div>
                <label class="block text-slate-300 mb-2">الدور</label>
                <select name="role_id" class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- كلمة المرور --}}
            <div>
                <label class="block text-slate-300 mb-2">كلمة المرور
                    <span class="text-slate-400 text-sm">(اتركها فارغة لتوليد كلمة مرور تلقائياً)</span>
                </label>
                <input type="password" name="password"
                    class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100
                          focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- الصورة الشخصية --}}
            <div>
                <label class="block text-slate-300 mb-2">الصورة الشخصية</label>
                <input type="file" name="avatar" accept="image/*"
                    class="w-full text-slate-200 bg-slate-800 border border-slate-700 rounded-lg p-2
                          file:mr-3 file:bg-indigo-600 file:text-white file:px-3 file:py-2 file:rounded-md
                          file:border-0 hover:file:bg-indigo-500">
                @error('avatar')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- زر الحفظ --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 px-6 py-2 rounded-lg text-white font-semibold">
                    💾 حفظ المستخدم
                </button>
            </div>
        </form>
    </div>
@endsection
