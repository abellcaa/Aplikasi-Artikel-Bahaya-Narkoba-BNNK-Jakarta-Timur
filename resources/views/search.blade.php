@extends('layouts.app')

@section('title', 'Pencarian Artikel Narkoba')

@section('header_sub')
<div class="px-4 pb-3">
    <form action="{{ route('search') }}" method="GET" class="space-y-2">
        <div class="relative">
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Ketik kata kunci (sabu, ganja, rehabilitasi, hukum)..." autofocus class="w-full pl-9 pr-4 py-2.5 bg-white text-slate-800 text-xs rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-inner">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <div class="flex items-center gap-2">
            <select name="category_id" class="flex-1 text-xs bg-white text-slate-700 py-1.5 px-3 rounded-lg border-0 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">Semua Kelompok</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-3.5 py-1.5 bg-blue-900 text-white text-xs font-bold rounded-lg border border-blue-400/30 hover:bg-blue-950 transition-colors">
                Cari
            </button>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-4">

    @if(!empty($keyword) || !empty($categoryId))
        <div class="flex items-center justify-between">
            <h1 class="text-xs font-bold text-slate-800">
                Hasil Pencarian @if($keyword) untuk "<span class="text-[#0c3866]">{{ $keyword }}</span>" @endif
            </h1>
            <span class="text-[11px] text-slate-500">
                {{ $articles->total() }} ditemukan
            </span>
        </div>

        @if($articles->isEmpty())
            <div class="text-center py-12 px-4 bg-slate-50 rounded-2xl border border-slate-200">
                <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 text-slate-400 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-800">Tidak Ada Artikel Ditemukan</h3>
                <p class="text-[11px] text-slate-500 mt-1 max-w-xs mx-auto">
                    Coba gunakan kata kunci lain yang lebih umum seperti "sabu", "rehabilitasi", "remaja", atau "psikotropika".
                </p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($articles as $art)
                    <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs hover:border-[#0c3866] transition-all">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] font-bold text-[#0c3866] bg-blue-50 px-2 py-0.5 rounded-md">
                                {{ $art->category->name }}
                            </span>
                            <span class="text-[10px] text-slate-400">
                                {{ $art->reading_time }} mnt baca
                            </span>
                        </div>

                        <h2 class="text-xs font-bold text-slate-900 leading-snug">
                            <a href="{{ route('articles.show', $art->slug) }}" class="hover:text-[#0c3866]">
                                {{ $art->title }}
                            </a>
                        </h2>

                        <p class="text-[11px] text-slate-600 mt-1 line-clamp-2 leading-relaxed">
                            {{ $art->summary }}
                        </p>

                        <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[10px] text-slate-400">{{ $art->created_at->translatedFormat('d M Y') }}</span>
                            <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-bold text-[#0c3866] hover:underline flex items-center gap-1">
                                Baca Lengkap
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pt-2">
                {{ $articles->links() }}
            </div>
        @endif

    @else
        <!-- Search suggestions -->
        <div class="space-y-4 pt-2">
            <div>
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kata Kunci Populer</h3>
                <div class="flex flex-wrap gap-1.5">
                    <a href="{{ route('search', ['q' => 'sabu']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Sabu Metamfetamin
                    </a>
                    <a href="{{ route('search', ['q' => 'rehabilitasi']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Alur Rehabilitasi Gratis
                    </a>
                    <a href="{{ route('search', ['q' => 'tramadol']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Obat Keras Tramadol
                    </a>
                    <a href="{{ route('search', ['q' => 'remaja']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Pencegahan Remaja
                    </a>
                    <a href="{{ route('search', ['q' => 'ganja']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Dampak Ganja
                    </a>
                    <a href="{{ route('search', ['q' => 'hukum']) }}" class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs text-slate-700 hover:border-[#0c3866] hover:text-[#0c3866] transition-colors">
                        # Sanksi Pidana P4GN
                    </a>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                <div class="text-xs font-bold text-slate-800 mb-1">Tips Pencarian Efektif:</div>
                <ul class="text-[11px] text-slate-600 space-y-1 list-disc list-inside">
                    <li>Gunakan nama zat spesifik seperti <em>sabu</em>, <em>ekstasi</em>, atau <em>hexymer</em>.</li>
                    <li>Gunakan topik seperti <em>pencegahan</em>, <em>tanda-tanda</em>, atau <em>rehabilitasi</em>.</li>
                    <li>Pilih filter kelompok kategori untuk mempersempit hasil.</li>
                </ul>
            </div>
        </div>
    @endif

</div>
@endsection
