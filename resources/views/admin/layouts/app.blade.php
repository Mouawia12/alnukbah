<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'لوحة التحكم')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ✅ خط Tajawal --}}
    <link href="{{ asset('assets/css/fonts-local.css') }}" rel="stylesheet">

    {{-- ✅ Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    @php
        $adminFavicon = app_setting('site.favicon');
        $adminFaviconPath = null;

        if ($adminFavicon) {
            $decodedFavicon = json_decode($adminFavicon);
            if (is_array($decodedFavicon) && isset($decodedFavicon[0]->download_link)) {
                $adminFaviconPath = asset('storage/' . ltrim($decodedFavicon[0]->download_link, '/'));
            }
        }
    @endphp

    @if ($adminFaviconPath)
        <link rel="shortcut icon" href="{{ $adminFaviconPath }}" type="image/x-icon">
        <link rel="icon" href="{{ $adminFaviconPath }}" type="image/x-icon">
    @endif

    <style>
        body {
            font-family: "Tajawal", sans-serif;
        }

        .sidebar {
            width: 16rem;
            background-color: rgba(2, 6, 23, 0.8);
            border-left: 1px solid rgb(30 41 59);
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            z-index: 30;
            transform: translateX(100%);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .sidebar.is-open {
            transform: translateX(0);
            opacity: 1;
            pointer-events: auto;
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
                opacity: 1;
                pointer-events: auto;
            }
        }

        .sidebar-overlay {
            background-color: rgba(15, 23, 42, 0.55);
        }

        @media (min-width: 768px) {
            .sidebar-overlay {
                display: none !important;
            }
        }

        .admin-main {
            margin-right: 0;
            transition: margin 0.25s ease;
        }

        @media (min-width: 768px) {
            .admin-main {
                margin-right: 16rem;
            }
        }

        .admin-header {
            min-height: 4rem;
        }

        @media (max-width: 767px) {
            .admin-header {
                padding-inline: 0.75rem;
                gap: 0.75rem;
            }

            .content-wrapper {
                padding: 1.5rem 1rem;
            }

            .content-wrapper .card {
                padding: 1rem;
            }

            .content-wrapper table {
                font-size: 0.875rem;
            }

            .content-wrapper h1 {
                font-size: 1.5rem;
            }

            .content-wrapper h2 {
                font-size: 1.35rem;
            }

            .content-wrapper h3 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 767px) {
            .content-wrapper .grid:not(.grid-cols-1) {
                grid-template-columns: 1fr !important;
            }
        }

        .thin-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
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

    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 hidden"></div>

    {{-- ✅ Sidebar --}}
    <aside id="sidebar"
        class="sidebar bg-slate-950/80 border-l border-slate-800 flex-col">
        <div class="h-16 flex items-center justify-center text-lg font-bold border-b border-slate-800 px-4 relative">
            <button id="closeSidebar"
                class="md:hidden text-slate-300 hover:text-white transition-colors flex items-center justify-center w-9 h-9 rounded-lg bg-slate-800/70 absolute left-4 top-1/2 -translate-y-1/2">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
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
    <main id="mainContent" class="admin-main flex-1">
        <header 
            class="admin-header h-16 bg-slate-900/80 border-b border-slate-800 backdrop-blur px-4 flex items-center justify-between sticky top-0 z-20">
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
                    <a href="{{ route('admin.password.edit') }}" class="block px-3 py-2 hover:bg-slate-700 rounded">
                        تغيير كلمة المرور
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button class="w-full text-right px-3 py-2 hover:bg-slate-700 rounded">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="content-wrapper p-6 space-y-6">
            @yield('content')
        </div>
    </main>

    <script>
        lucide.createIcons();

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const openBtn = document.getElementById('openMobile');
        const closeBtn = document.getElementById('closeSidebar');
        const body = document.body;

        const lockScroll = () => {
            body.dataset.prevOverflow = body.style.overflow || '';
            body.style.overflow = 'hidden';
        };

        const unlockScroll = () => {
            body.style.overflow = body.dataset.prevOverflow || '';
            delete body.dataset.prevOverflow;
        };

        const openSidebar = () => {
            if (!sidebar) return;
            sidebar.classList.add('is-open');
            overlay?.classList.remove('hidden');
            lockScroll();
        };

        const closeSidebar = () => {
            if (!sidebar) return;
            sidebar.classList.remove('is-open');
            overlay?.classList.add('hidden');
            unlockScroll();
        };

        openBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (window.matchMedia('(min-width: 768px)').matches) {
                sidebar?.classList.add('is-open');
                overlay?.classList.add('hidden');
                unlockScroll();
            } else {
                sidebar?.classList.remove('is-open');
            }
        });

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

        if (window.matchMedia('(min-width: 768px)').matches) {
            sidebar?.classList.add('is-open');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>
