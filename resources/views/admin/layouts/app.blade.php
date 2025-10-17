<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'لوحة التحكم')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ✅ Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    {{-- ✅ خط Tajawal --}}
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    {{-- ✅ Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @stack('styles')
    <style>
        body {
            font-family: "Tajawal", sans-serif;
        }

        .thin-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .thin-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-100 min-h-screen flex">

    {{-- ✅ Sidebar --}}
    <aside
        class="w-64 bg-slate-950/80 border-l border-slate-800 h-screen fixed right-0 top-0 hidden md:flex flex-col z-30">
        <div class="h-16 flex items-center justify-center text-lg font-bold border-b border-slate-800">
            لوحة التحكم
        </div>

        <nav class="flex-1 overflow-y-auto thin-scroll p-4 space-y-2">

            {{-- 🏠 الرئيسية --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span>الرئيسية</span>
            </a>

            {{-- 👤 المستخدمون --}}
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>المستخدمون</span>
            </a>


            {{-- 🏢 حول الشركة --}}
            <a href="{{ route('admin.abouts.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.abouts.*') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="info" class="w-5 h-5"></i>
                <span>حول الشركة</span>
            </a>

            {{-- 🖼️ معرض الصور (السلايدر) --}}
            <div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 hover:bg-slate-800/50 rounded-lg menu-toggle"
                    data-target="#menu-sliders">
                    <span class="flex items-center gap-2"><i data-lucide="images" class="w-5 h-5"></i> معرض الصور</span>
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <div id="menu-sliders" class="hidden mt-2 ps-6 space-y-1">
                    <a href="{{ route('admin.sliders.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">قائمة المعرض</a>
                    <a href="{{ route('admin.sliders.create') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">إضافة صور</a>
                </div>
            </div>


            {{-- 🧱 الخدمات --}}
            <div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 hover:bg-slate-800/50 rounded-lg menu-toggle"
                    data-target="#menu-services">
                    <span class="flex items-center gap-2"><i data-lucide="briefcase" class="w-5 h-5"></i> الخدمات</span>
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <div id="menu-services" class="hidden mt-2 ps-6 space-y-1">
                    <a href="{{ route('admin.services.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">قائمة الخدمات</a>
                    <a href="{{ route('admin.services.create') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">إضافة خدمة</a>
                </div>
            </div>

            {{-- 🧱 أعمالنا / معرض الأعمال --}}
            <div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 hover:bg-slate-800/50 rounded-lg menu-toggle"
                    data-target="#menu-works">
                    <span class="flex items-center gap-2"><i data-lucide="layout" class="w-5 h-5"></i> أعمالنا</span>
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <div id="menu-works" class="hidden mt-2 ps-6 space-y-1">
                    <a href="{{ route('admin.works.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">قائمة الأعمال</a>
                    <a href="{{ route('admin.works.create') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">إضافة عمل</a>
                </div>
            </div>

            {{-- 📰 المقالات --}}
            <div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 hover:bg-slate-800/50 rounded-lg menu-toggle"
                    data-target="#menu-articles">
                    <span class="flex items-center gap-2"><i data-lucide="file-text" class="w-5 h-5"></i>
                        المقالات</span>
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <div id="menu-articles" class="hidden mt-2 ps-6 space-y-1">
                    <a href="{{ route('admin.articles.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">قائمة المقالات</a>
                    <a href="{{ route('admin.articles.create') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">إضافة مقال</a>
                </div>
            </div>

            {{-- 📊 الإحصائيات --}}
            <div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 hover:bg-slate-800/50 rounded-lg menu-toggle"
                    data-target="#menu-statistics">
                    <span class="flex items-center gap-2"><i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                        الإحصائيات</span>
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <div id="menu-statistics" class="hidden mt-2 ps-6 space-y-1">
                    <a href="{{ route('admin.statistics.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">قائمة الإحصائيات</a>
                    <a href="{{ route('admin.statistics.create') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-800/40">إضافة إحصائية</a>
                </div>
            </div>

            {{-- 📬 الاشتراكات --}}
            <a href="{{ route('admin.subscribes.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.subscribes.*') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="mail" class="w-5 h-5"></i>
                <span>الاشتراكات</span>
            </a>

            {{-- 📞 رسائل التواصل --}}
            <a href="{{ route('admin.contacts.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.contacts.*') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="inbox" class="w-5 h-5"></i>
                <span>رسائل التواصل</span>
            </a>

            {{-- ⚙️ الإعدادات --}}
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-800/60 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-800/80' : '' }}">
                <i data-lucide="settings" class="w-5 h-5"></i>
                <span>الإعدادات</span>
            </a>
        </nav>

        {{-- 🚪 تسجيل الخروج --}}
        <form action="{{ route('logout') }}" method="POST" class="p-4">
            @csrf
            <button
                class="w-full bg-slate-800 hover:bg-slate-700 py-2 rounded-lg flex items-center justify-center gap-2">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                تسجيل الخروج
            </button>
        </form>
    </aside>

    {{-- ✅ المحتوى الرئيسي --}}
    <main class="flex-1 md:mr-64">
        <header
            class="h-16 bg-slate-900/80 border-b border-slate-800 backdrop-blur px-4 flex items-center justify-between sticky top-0 z-20">
            <button id="openMobile"
                class="md:hidden bg-slate-800 hover:bg-slate-700 w-10 h-10 flex items-center justify-center rounded-lg">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <div class="font-semibold">لوحة التحكم</div>

            <div class="relative">
                <button id="profileBtn"
                    class="flex items-center gap-2 bg-slate-800 px-3 py-2 rounded-lg hover:bg-slate-700">
                    {{ auth()->user()->name ?? 'Admin' }}
                    <i data-lucide="user" class="w-4 h-4"></i>
                </button>
                <div id="profileMenu"
                    class="hidden absolute left-0 mt-2 bg-slate-800 rounded-lg shadow-lg border border-slate-700 p-2 w-48">
                    <a href="#" class="block px-3 py-2 hover:bg-slate-700 rounded">الملف الشخصي</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button class="w-full text-right px-3 py-2 hover:bg-slate-700 rounded">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="p-6">
            @yield('content')
        </div>
    </main>

    <script>
        lucide.createIcons();

        // ✅ Toggle submenus
        document.querySelectorAll('.menu-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.querySelector(btn.dataset.target);
                target.classList.toggle('hidden');
            });
        });

        // ✅ Profile dropdown
        document.addEventListener('click', e => {
            const btn = document.getElementById('profileBtn');
            const menu = document.getElementById('profileMenu');
            if (btn.contains(e.target)) menu.classList.toggle('hidden');
            else if (!menu.contains(e.target)) menu.classList.add('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>
