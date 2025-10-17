<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>تسجيل الدخول</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html,body{background:#0b1220}
  </style>
</head>
<body class="min-h-screen flex items-center justify-center text-gray-100">
  <div class="w-[92%] max-w-md bg-slate-900/60 border border-slate-800 rounded-2xl shadow-2xl p-6">
    <div class="text-center mb-6">
      <h1 class="text-2xl font-extrabold">لوحة التحكم</h1>
      <p class="text-slate-400 mt-1">سجّل دخولك للمتابعة</p>
    </div>

    @if (session('ok'))
      <div class="mb-4 rounded-lg border border-emerald-500/40 bg-emerald-500/10 px-3 py-2 text-sm">
        {{ session('ok') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-4 rounded-lg border border-red-500/40 bg-red-500/10 px-3 py-2 text-sm">
        <ul class="list-disc pr-5">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block mb-2 text-sm text-slate-300">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div>
        <label class="block mb-2 text-sm text-slate-300">كلمة المرور</label>
        <input type="password" name="password" required
               class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="flex items-center justify-between">
        <label class="inline-flex items-center gap-2 text-sm text-slate-300">
          <input type="checkbox" name="remember" class="rounded border-slate-600 bg-slate-800">
          تذكرني
        </label>
        <a href="/" class="text-xs text-slate-400 hover:text-slate-200">العودة للموقع</a>
      </div>

      <button type="submit"
              class="w-full mt-2 px-4 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
        دخول
      </button>
    </form>
  </div>
</body>
</html>
