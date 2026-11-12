@extends('layouts.app')

@section('title', 'Daftar Artikel Bahaya Narkoba')

@section('header_sub')
<!-- Horizontal Category Filter Pills -->
<div class="px-4 pb-3 overflow-x-auto no-scrollbar flex items-center gap-1.5 pt-1">
    <a href="{{ route('articles.index', ['sort' => $sort]) }}" class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap transition-colors {{ empty($selectedCategory) ? 'bg-white text-[#0c3866] shadow-sm' : 'bg-white/10 text-blue-100 hover:bg-white/20' }}">
        Semua
    </a>
    @foreach($categories as $cat)
        <a href="{{ route('articles.index', ['category' => $cat->slug, 'sort' => $sort]) }}" class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap transition-colors {{ (!empty($selectedCategory) && $selectedCategory->id === $cat->id) ? 'bg-white text-[#0c3866] shadow-sm' : 'bg-white/10 text-blue-100 hover:bg-white/20' }}">
            {{ $cat->name }}
        </a>
    @endforeach
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-4">

    <!-- Active filter / Sorting header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-sm font-bold text-slate-800">
                {{ $selectedCategory ? $selectedCategory->name : 'Semua Kelompok Artikel' }}
            </h1>
            <p class="text-[11px] text-slate-500">
                Menampilkan {{ $articles->total() }} artikel edukasi
            </p>
        </div>

        <form action="{{ route('articles.index') }}" method="GET" class="flex items-center">
            @if($selectedCategory)
                <input type="hidden" name="category" value="{{ $selectedCategory->slug }}">
            @endif
            <select name="sort" onchange="this.form.submit()" class="text-xs bg-slate-100 border border-slate-200 text-slate-700 font-semibold py-1.5 px-2.5 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Terpopuler</option>
            </select>
        </form>
    </div>

    <!-- Category description if selected -->
    @if($selectedCategory && $selectedCategory->description)
        <div class="p-3 bg-blue-50/70 border border-blue-100 rounded-xl text-xs text-slate-700 leading-relaxed">
            <span class="font-bold text-[#0c3866]">Tentang Kategori:</span> {{ $selectedCategory->description }}
        </div>
    @endif

    <!-- Articles List -->
    @if($articles->isEmpty())
        <div class="text-center py-12 px-4 bg-slate-50 rounded-2xl border border-slate-200">
            <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 text-slate-400 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-700">Belum ada artikel pada kelompok ini</h3>
            <p class="text-[11px] text-slate-400 mt-1">Silakan pilih kelompok artikel lain atau gunakan fitur pencarian.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($articles as $art)
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs hover:border-[#0c3866] transition-all">
                    <div class="flex items-center justify-between mb-1.5">
                        <a href="{{ route('articles.index', ['category' => $art->category->slug]) }}" class="text-[10px] font-bold text-[#0c3866] bg-blue-50 px-2 py-0.5 rounded-md hover:bg-blue-100 transition-colors">
                            {{ $art->category->name }}
                        </a>
                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $art->reading_time }} mnt baca
                        </span>
                    </div>

                    <h2 class="text-sm font-bold text-slate-900 leading-snug">
                        <a href="{{ route('articles.show', $art->slug) }}" class="hover:text-[#0c3866]">
                            {{ $art->title }}
                        </a>
                    </h2>

                    <p class="text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                        {{ $art->summary }}
                    </p>

                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                        <div class="text-[11px] text-slate-400 flex items-center gap-2">
                            <span>{{ $art->created_at->translatedFormat('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ $art->views_count }} dibaca</span>
                        </div>

                        <div class="flex items-center gap-2">
                            @auth
                                <form action="{{ route('bookmarks.toggle', $art->id) }}" method="POST">
                                    @csrf
                                    @php $isSaved = $art->isBookmarkedBy(Auth::user()); @endphp
                                    <button type="submit" class="p-1.5 rounded-lg border {{ $isSaved ? 'bg-blue-50 border-blue-200 text-[#0c3866]' : 'border-slate-200 text-slate-400 hover:text-slate-600' }} transition-colors" title="{{ $isSaved ? 'Hapus dari simpanan' : 'Simpan artikel' }}">
                                        <svg class="w-4 h-4" fill="{{ $isSaved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endauth

                            <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#0c3866] hover:underline">
                                Baca
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-2">
            {{ $articles->links() }}
        </div>
    @endif

</div>
@endsection
