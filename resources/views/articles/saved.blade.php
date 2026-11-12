@extends('layouts.app')

@section('title', 'Artikel Tersimpan')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Koleksi Artikel Favorit Anda</div>
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-4">

    <div>
        <h1 class="text-sm font-bold text-slate-800">Artikel Tersimpan</h1>
        <p class="text-[11px] text-slate-500">Koleksi artikel yang Anda simpan untuk dibaca kembali.</p>
    </div>

    @if($bookmarks->isEmpty())
        <div class="text-center py-14 px-4 bg-slate-50 rounded-2xl border border-slate-200">
            <div class="w-12 h-12 mx-auto rounded-full bg-blue-50 text-[#0c3866] flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </div>
            <h3 class="text-xs font-bold text-slate-800">Belum Ada Artikel yang Disimpan</h3>
            <p class="text-[11px] text-slate-500 mt-1 max-w-xs mx-auto">
                Anda dapat menyimpan artikel bermanfaat saat membacanya dengan menekan ikon simpan.
            </p>
            <div class="mt-4">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors">
                    Jelajahi Artikel Sekarang
                </a>
            </div>
        </div>
    @else
        <div class="space-y-3">
            @foreach($bookmarks as $bkm)
                @if($bkm->article)
                    <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs hover:border-[#0c3866] transition-all">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] font-bold text-[#0c3866] bg-blue-50 px-2 py-0.5 rounded-md">
                                {{ $bkm->article->category->name }}
                            </span>
                            <span class="text-[10px] text-slate-400">
                                Disimpan {{ $bkm->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h2 class="text-xs font-bold text-slate-900 leading-snug">
                            <a href="{{ route('articles.show', $bkm->article->slug) }}" class="hover:text-[#0c3866]">
                                {{ $bkm->article->title }}
                            </a>
                        </h2>

                        <p class="text-[11px] text-slate-600 mt-1 line-clamp-2 leading-relaxed">
                            {{ $bkm->article->summary }}
                        </p>

                        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                            <form action="{{ route('bookmarks.toggle', $bkm->article->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 text-[11px] text-rose-600 font-semibold hover:text-rose-800 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Simpanan
                                </button>
                            </form>

                            <a href="{{ route('articles.show', $bkm->article->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#0c3866] hover:underline">
                                Baca Sekarang
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="pt-2">
            {{ $bookmarks->links() }}
        </div>
    @endif

</div>
@endsection
