@extends('layouts.app')

@section('title', $article->title)

@section('header_sub')
<!-- Breadcrumb Header -->
<div class="px-4 pb-2.5 flex items-center justify-between">
    <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" class="inline-flex items-center gap-1 text-xs text-blue-100 hover:text-white font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke {{ $article->category->name }}
    </a>

    @auth
        <div class="flex items-center gap-2">
            <form action="{{ route('bookmarks.toggle', $article->id) }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold {{ $isBookmarked ? 'bg-white text-[#0c3866]' : 'bg-white/10 text-white hover:bg-white/20' }} transition-colors">
                    <svg class="w-3.5 h-3.5" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    <span>{{ $isBookmarked ? 'Tersimpan' : 'Simpan' }}</span>
                </button>
            </form>
            <a href="{{ route('articles.download', $article->slug) }}" class="flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-white/10 text-white hover:bg-white/20 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M7 10l5 5 5-5M12 15V3"></path>
                </svg>
                <span>Unduh PDF</span>
            </a>
        </div>
    @endauth
</div>
@endsection

@section('content')
<article class="px-4 py-5 space-y-5">

    <!-- Meta Info -->
    <div>
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" class="px-2.5 py-0.5 bg-blue-50 text-[#0c3866] text-[10px] font-bold rounded-md uppercase tracking-wider">
                {{ $article->category->name }}
            </a>
            <span class="text-slate-300">•</span>
            <span class="text-xs text-slate-400">{{ $article->reading_time }} menit membaca</span>
        </div>

        <h1 class="text-lg font-extrabold text-slate-900 leading-snug">
            {{ $article->title }}
        </h1>

        <div class="mt-3 flex items-center justify-between text-[11px] text-slate-400 pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-[#0c3866] text-white flex items-center justify-center font-bold text-[10px]">
                    BNN
                </div>
                <span>Ditulis oleh: <strong class="text-slate-700">{{ $article->author->name ?? 'Tim Edukasi BNN' }}</strong></span>
            </div>
            <div>
                {{ $article->created_at->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="p-3.5 bg-slate-50 border-l-4 border-[#0c3866] rounded-r-xl">
        <div class="text-[11px] font-bold uppercase tracking-wider text-[#0c3866] mb-1">Ringkasan Materi</div>
        <p class="text-xs text-slate-700 leading-relaxed font-medium">
            {{ $article->summary }}
        </p>
    </div>

    <!-- Article Body Content -->
    <div class="text-xs text-slate-800 leading-relaxed space-y-4 article-body">
        {!! nl2br(e($article->content)) !!}
    </div>

    <!-- BNN Jakarta Timur Advisory Note -->
    <div class="p-4 bg-blue-50/70 border border-blue-200 rounded-2xl">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#0c3866] text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-[#0c3866]">Pesan Pencegahan BNN Kota Jakarta Timur</h3>
                <p class="text-[11px] text-slate-600 mt-1 leading-snug">
                    Narkoba merusak masa depan, keluarga, dan kesehatan Anda. Jika Anda atau kerabat membutuhkan konsultasi atau rehabilitasi, hubungi Klinik Pratama BNN Kota Jakarta Timur atau Hotline <strong>184</strong>.
                </p>
                <div class="mt-2.5 flex items-center gap-2">
                    <a href="{{ route('feedback.index') }}" class="px-2.5 py-1 bg-[#0c3866] text-white text-[10px] font-bold rounded-md hover:bg-[#1a467a] transition-colors">
                        Kirim Pertanyaan / Saran
                    </a>
                    <a href="{{ route('contact') }}" class="px-2.5 py-1 bg-white border border-slate-200 text-slate-700 text-[10px] font-semibold rounded-md hover:bg-slate-50 transition-colors">
                        Lihat Lokasi Kantor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->isNotEmpty())
        <div class="pt-4 border-t border-slate-200">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Artikel Terkait Lainnya
            </h3>
            <div class="space-y-2">
                @foreach($relatedArticles as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="p-3 bg-white border border-slate-200 rounded-xl flex items-center justify-between gap-3 hover:border-[#0c3866] transition-colors">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-slate-800 line-clamp-1">{{ $rel->title }}</h4>
                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $rel->reading_time }} mnt baca • {{ $rel->views_count }} x dibaca</div>
                        </div>
                        <svg class="w-4 h-4 text-[#0c3866] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</article>
@endsection
