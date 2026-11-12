<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - BNN Kota Jakarta Timur</title>
    
    <!-- Google Fonts -->
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
                            900: '#0c3866',
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
            background-color: #f8fafc;
            color: #0f172a;
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col md:flex-row bg-slate-50">

    <!-- SIDEBAR -->
    <aside class="w-full md:w-64 bg-[#0c3866] text-white flex-shrink-0 flex flex-col justify-between">
        <div>
            <!-- Admin Brand -->
            <div class="p-4 border-b border-[#1a467a] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center border border-white/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-blue-200">PANEL ADMINISTRATOR</div>
                        <div class="text-sm font-bold text-white">BNN Jakarta Timur</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white shadow-sm' : 'text-blue-100 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.articles.*') ? 'bg-white/15 text-white shadow-sm' : 'text-blue-100 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Kelola Artikel
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.categories.*') ? 'bg-white/15 text-white shadow-sm' : 'text-blue-100 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kelompok / Kategori
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white shadow-sm' : 'text-blue-100 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Kelola Pengguna
                </a>

                <a href="{{ route('admin.feedbacks.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.feedbacks.*') ? 'bg-white/15 text-white shadow-sm' : 'text-blue-100 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        Kritik & Balasan
                    </div>
                    @php
                        $unreadFeedbacks = \App\Models\Feedback::where('status', 'pending')->count();
                    @endphp
                    @if($unreadFeedbacks > 0)
                        <span class="px-2 py-0.5 text-[10px] bg-amber-400 text-slate-900 font-bold rounded-full">
                            {{ $unreadFeedbacks }}
                        </span>
                    @endif
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-3 border-t border-[#1a467a] space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-blue-200 hover:text-white rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Aplikasi User
            </a>

            <div class="px-3 py-2 bg-white/5 rounded-lg flex items-center justify-between">
                <div>
                    <div class="text-[11px] font-bold text-white leading-tight truncate max-w-[130px]">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-blue-300">Administrator</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-300 hover:text-white p-1 rounded transition-colors" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN ADMIN CONTENT -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top header bar -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">
            <div>
                <h1 class="text-lg font-bold text-slate-800 leading-tight">@yield('page_title', 'Dashboard')</h1>
                <p class="text-xs text-slate-500">@yield('page_subtitle', 'Badan Narkotika Nasional Kota Jakarta Timur')</p>
            </div>
            <div>
                @yield('page_action')
            </div>
        </header>

        <!-- Notification alerts -->
        <div class="p-6 pb-0">
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-start gap-2.5 shadow-sm mb-4">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <span class="font-bold">Berhasil!</span> {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-start gap-2.5 shadow-sm mb-4">
                    <svg class="w-4 h-4 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-bold">Perhatian:</span> {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl shadow-sm mb-4">
                    <div class="font-bold mb-1">Terdapat beberapa kesalahan pengisian form:</div>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
