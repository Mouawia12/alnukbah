@extends('admin.layouts.app')
@section('title', 'تعديل المستخدم')

@section('content')
<div class="max-w-2xl mx-auto bg-slate-900/60 border border-slate-700 rounded-2xl p-6 shadow-lg">

    <h1 class="text-2xl font-bold mb-6">✏️ تعديل المستخدم</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- الدور --}}
        <div>
            <label class="block text-slate-300 mb-2">الدور</label>
            <select name="role_id" class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- الاسم --}}
        <div>
            <label class="block text-slate-300 mb-2">الاسم</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- البريد الإلكتروني --}}
        <div>
            <label class="block text-slate-300 mb-2">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
            @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- كلمة المرور الجديدة --}}
        <div>
            <label class="block text-slate-300 mb-2">كلمة المرور الجديدة (اختياري)</label>
            <input type="password" name="password"
                   class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-slate-100 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20">
            @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- الصورة الحالية + الجديدة --}}
        <div>
            <label class="block text-slate-300 mb-2">الصورة الحالية</label>
            <div class="flex items-center gap-4 flex-wrap">
                <img src="{{ asset('storage/' . $user->avatar) }}" class="h-16 w-16 rounded-full border border-slate-600 object-cover">
                <div class="flex flex-col gap-2 w-full sm:w-auto">
                    <label class="block text-slate-300">تغيير الصورة</label>
                    <input type="file" name="avatar" accept="image/*"
                        class="text-slate-200 bg-slate-800 border border-slate-700 rounded-lg p-2 file:mr-3 file:bg-indigo-600 file:text-white file:px-3 file:py-2 file:rounded-md file:border-0 hover:file:bg-indigo-500">
                    @error('avatar') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- زر الحفظ --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 px-6 py-2 rounded-lg text-white font-semibold">
                💾 تحديث المستخدم
            </button>
        </div>
    </form>
</div>
@endsection
