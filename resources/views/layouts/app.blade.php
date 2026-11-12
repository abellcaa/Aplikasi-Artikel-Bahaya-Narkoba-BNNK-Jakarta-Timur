<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Aplikasi Edukasi Bahaya Narkoba') - BNN Kota Jakarta Timur</title>
    <meta name="description" content="Aplikasi Informasi dan Artikel Bahaya Narkoba Berbasis Mobile di BNN Kota Jakarta Timur. Cegah narkoba sejak dini untuk generasi muda bersinar.">

    <!-- Google Fonts: Plus Jakarta Sans for clean, modern readability -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        bnn: {
                            50: '#f0f6fc',
                            100: '#e1ecf8',
                            200: '#c3dbf2',
                            300: '#94c2e9',
                            400: '#5fa3dd',
                            500: '#3884cf',
                            600: '#2669b6',
                            700: '#1e5394',
                            800: '#1a467a',
                            900: '#0c3866', // Primary Navy Color
                            950: '#082342',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
            -webkit-tap-highlight-color: transparent;
        }
        /* Responsive application shell */
        .mobile-container {
            max-width: 1280px;
            min-height: 100vh;
            margin: 0 auto;
            background-color: #ffffff;
            position: relative;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }
        @media (min-width: 640px) {
            .mobile-container {
                border-left: 1px solid #e2e8f0;
                border-right: 1px solid #e2e8f0;
            }
        }

        @media (min-width: 1024px) {
            .mobile-container {
                max-width: none;
                box-shadow: 0 4px 24px -4px rgba(15, 23, 42, 0.12);
            }
        }
        /* Hide scrollbars for clean mobile look */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-100 flex justify-center min-h-screen">

    <div class="mobile-container w-full bg-white flex flex-col justify-between">

        <!-- TOP APP HEADER -->
        <header class="sticky top-0 z-40 lg:ml-64 bg-[#0c3866] text-white border-b border-[#1a467a] shadow-sm">
            <div class="max-w-6xl mx-auto w-full px-4 py-3 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center border border-white/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-blue-200 leading-none">BNN KOTA JAKARTA TIMUR</div>
                        <div class="text-sm font-bold text-white leading-tight">Edukasi Narkoba</div>
                    </div>
                </a>

                <div class="flex items-center gap-1.5">
                    <a href="{{ route('search') }}" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors" title="Pencarian">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </a>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1 text-xs font-semibold bg-white text-[#0c3866] rounded-md hover:bg-blue-50 transition-colors">
                                Panel Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            @yield('header_sub')
        </header>

        <!-- FLASH NOTIFICATIONS -->
        @if(session('success'))
            <div class="mx-4 mt-3 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-lg flex items-start gap-2 shadow-sm">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 mt-3 p-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-lg flex items-start gap-2 shadow-sm">
                <svg class="w-4 h-4 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- MAIN CONTENT AREA -->
        <main class="flex-grow pb-24 lg:ml-64">
            @yield('content')
        </main>

        <!-- STICKY BOTTOM NAVIGATION BAR -->
        <nav class="fixed bottom-0 z-40 bg-white border-t border-slate-200 w-full max-w-[1280px] shadow-[0_-2px_10px_rgba(0,0,0,0.04)] lg:top-0 lg:left-0 lg:bottom-auto lg:w-64 lg:max-w-none lg:h-screen lg:border-t-0 lg:border-r lg:shadow-[2px_0_12px_rgba(0,0,0,0.06)]">
            <div class="grid grid-cols-5 h-16 lg:flex lg:flex-col lg:h-auto lg:gap-2 lg:p-4">
                <a href="{{ route('home') }}" class="hidden lg:flex items-center gap-3 px-2 pb-5 mb-2 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-[#0c3866] text-white flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 leading-none">BNN Kota Jakarta Timur</div>
                        <div class="text-sm font-bold text-[#0c3866] leading-tight">Edukasi Narkoba</div>
                    </div>
                </a>

                <!-- Beranda -->
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('home') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('home') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>

                <!-- Artikel / Kelompok -->
                <a href="{{ route('articles.index') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('articles.index') || request()->routeIs('articles.show') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('articles.index') || request()->routeIs('articles.show') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Artikel
                </a>

                <!-- Simpan / Bookmark -->
                <a href="{{ route('bookmarks.index') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('bookmarks.index') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('bookmarks.index') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Tersimpan
                </a>

                <!-- Kritik & Saran -->
                <a href="{{ route('feedback.index') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('feedback.*') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('feedback.*') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    Kritik
                </a>

                <!-- Profil / Akun -->
                @auth
                    <a href="{{ route('profile') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('profile') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                        <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('profile') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Akun
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex flex-col items-center justify-center text-[10px] font-medium lg:flex-row lg:justify-start lg:gap-3 lg:px-4 lg:py-3 lg:text-sm lg:rounded-lg {{ request()->routeIs('login') || request()->routeIs('register') ? 'text-[#0c3866] font-bold lg:bg-blue-50' : 'text-slate-500 hover:text-slate-800 lg:hover:bg-slate-50' }}">
                        <svg class="w-5 h-5 mb-1 lg:mb-0 {{ request()->routeIs('login') ? 'text-[#0c3866]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </a>
                @endauth
            </div>
        </nav>

    </div>

    @yield('scripts')
</body>
</html>
