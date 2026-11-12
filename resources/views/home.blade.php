@extends('layouts.app')

@section('title', 'Beranda')

@section('header_sub')
<!-- Search bar in header -->
<div class="px-4 pb-3">
    <form action="{{ route('search') }}" method="GET" class="relative">
        <input type="text" name="q" placeholder="Cari info narkoba, sabu, ekstasi, rehabilitasi..." class="w-full pl-9 pr-4 py-2 bg-white text-slate-800 text-xs rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-inner placeholder-slate-400">
        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </form>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-4 lg:px-8 lg:py-8 space-y-6 lg:space-y-8">

    <!-- BNN HOTLINE 184 BANNER -->
    <div class="bg-gradient-to-r from-[#0c3866] to-[#1a467a] text-white p-4 rounded-2xl shadow-sm relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 bg-amber-400 text-slate-900 text-[10px] font-extrabold rounded-md uppercase tracking-wider">
                    Hotline P4GN
                </span>
                <span class="text-[11px] text-blue-200">BNN Jakarta Timur</span>
            </div>
            <h2 class="text-base font-bold leading-snug">
                Layanan Konseling & Lapor Narkoba Bebas Pidana
            </h2>
            <p class="text-xs text-blue-100 mt-1 leading-relaxed">
                Pecandu adalah korban yang wajib direhabilitasi. Hubungi call center 24 jam.
            </p>
            <div class="mt-3 flex items-center gap-2">
                <a href="tel:184" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-[#0c3866] text-xs font-bold rounded-lg shadow-sm hover:bg-blue-50 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Hubungi 184
                </a>
                <a href="{{ route('about') }}" class="px-3 py-1.5 bg-white/10 text-white text-xs font-semibold rounded-lg hover:bg-white/20 transition-colors border border-white/20">
                    Tentang BNN
                </a>
            </div>
        </div>
    </div>

    <!-- KELOMPOK / KATEGORI ARTIKEL -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Kelompok Artikel
            </h2>
            <a href="{{ route('articles.index') }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 lg:gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" class="p-3 bg-slate-50 border border-slate-200 rounded-xl hover:border-[#0c3866] hover:bg-blue-50/50 transition-all flex flex-col justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-[#0c3866] flex items-center justify-center flex-shrink-0 shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xs font-bold text-slate-800 leading-snug line-clamp-1">
                            {{ $cat->name }}
                        </h3>
                    </div>
                    <div class="mt-2 text-[10px] text-slate-500 font-medium">
                        {{ $cat->published_articles_count }} Artikel
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- ARTIKEL PILIHAN / TERBARU -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Artikel Utama
            </h2>
            <a href="{{ route('articles.index', ['sort' => 'latest']) }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                Daftar Lengkap
            </a>
        </div>

        @if($featuredArticles->isNotEmpty())
            <!-- Hero Article Card -->
            @php $topArticle = $featuredArticles->first(); @endphp
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow mb-3">
                <div class="h-36 bg-[#0c3866] p-4 flex flex-col justify-between text-white relative">
                    <div class="flex items-center justify-between z-10">
                        <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-xs text-white text-[10px] font-bold rounded-md border border-white/20">
                            {{ $topArticle->category->name }}
                        </span>
                        <span class="text-[11px] text-blue-200 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $topArticle->reading_time }} mnt baca
                        </span>
                    </div>

                    <div class="z-10">
                        <h3 class="text-sm font-bold text-white leading-snug line-clamp-2">
                            <a href="{{ route('articles.show', $topArticle->slug) }}" class="hover:underline">
                                {{ $topArticle->title }}
                            </a>
                        </h3>
                    </div>
                </div>
                <div class="p-3.5 bg-white">
                    <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                        {{ $topArticle->summary }}
                    </p>
                    <div class="mt-3 flex items-center justify-between pt-2 border-t border-slate-100">
                        <span class="text-[11px] text-slate-400">
                            {{ $topArticle->created_at->translatedFormat('d M Y') }}
                        </span>
                        <a href="{{ route('articles.show', $topArticle->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#0c3866] hover:gap-1.5 transition-all">
                            Baca Selengkapnya
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Smaller Article List -->
            <div class="space-y-2.5">
                @foreach($featuredArticles->skip(1) as $art)
                    <a href="{{ route('articles.show', $art->slug) }}" class="p-3 bg-white border border-slate-200 rounded-xl hover:border-[#0c3866] flex items-start justify-between gap-3 transition-colors">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold text-[#0c3866] uppercase">
                                    {{ $art->category->name }}
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="text-[10px] text-slate-400">{{ $art->reading_time }} mnt</span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2">
                                {{ $art->title }}
                            </h4>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-[#0c3866]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- ARTIKEL TERPOPULER -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Paling Sering Dibaca
            </h2>
            <a href="{{ route('articles.index', ['sort' => 'popular']) }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="space-y-2">
            @foreach($popularArticles as $index => $pop)
                <a href="{{ route('articles.show', $pop->slug) }}" class="p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-3 hover:bg-blue-50/50 hover:border-blue-200 transition-colors">
                    <span class="w-6 h-6 rounded-md bg-[#0c3866] text-white text-xs font-extrabold flex items-center justify-center flex-shrink-0">
                        {{ $index + 1 }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-slate-800 truncate">{{ $pop->title }}</h4>
                        <div class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-2">
                            <span>{{ $pop->category->name }}</span>
                            <span>•</span>
                            <span>{{ $pop->views_count }} x dibaca</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- QUICK ACCESS TO ABOUT & CONTACT -->
    <div class="grid grid-cols-2 gap-2.5 pt-2">
        <a href="{{ route('about') }}" class="p-3 bg-[#0c3866]/5 border border-[#0c3866]/20 rounded-xl text-center hover:bg-[#0c3866]/10 transition-colors">
            <div class="w-8 h-8 mx-auto rounded-full bg-[#0c3866] text-white flex items-center justify-center mb-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="text-xs font-bold text-[#0c3866]">Tentang BNN</div>
            <div class="text-[10px] text-slate-500">Profil & Visi Misi</div>
        </a>

        <a href="{{ route('contact') }}" class="p-3 bg-[#0c3866]/5 border border-[#0c3866]/20 rounded-xl text-center hover:bg-[#0c3866]/10 transition-colors">
            <div class="w-8 h-8 mx-auto rounded-full bg-[#0c3866] text-white flex items-center justify-center mb-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div class="text-xs font-bold text-[#0c3866]">Kontak Kantor</div>
            <div class="text-[10px] text-slate-500">Alamat & Lokasi</div>
        </a>
    </div>

</div>
@endsection
