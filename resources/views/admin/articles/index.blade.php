@extends('layouts.admin')

@section('title', 'Kelola Artikel Edukasi')
@section('page_title', 'Kelola Artikel Edukasi Narkoba')
@section('page_subtitle', 'Tambah, edit, publikasikan, dan hapus artikel edukasi bahaya narkoba')

@section('page_action')
    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg shadow-sm hover:bg-[#1a467a] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tulis Artikel Baru
    </a>
@endsection

@section('content')
<div class="space-y-4">

    <!-- Filters & Search Bar -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul artikel..." class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <div>
                <select name="category_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                    <option value="">Semua Kelompok Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terpublikasi</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg hover:bg-[#1a467a] transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Articles Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Thumbnail</th>
                        <th class="px-4 py-3">Judul & Ringkasan</th>
                        <th class="px-4 py-3">Kelompok Kategori</th>
                        <th class="px-4 py-3">Penulis</th>
                        <th class="px-4 py-3">Waktu Baca</th>
                        <th class="px-4 py-3">Views</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($articles as $art)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-3">
                                @if($art->thumbnail)
                                    <img src="{{ asset('storage/' . $art->thumbnail) }}" alt="{{ $art->title }}" class="w-12 h-12 object-cover rounded-lg border border-slate-200">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-blue-50 border border-blue-200 text-[#0c3866] flex items-center justify-center font-bold text-[10px]">
                                        BNN
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-[#0c3866] line-clamp-1">
                                    {{ $art->title }}
                                </a>
                                <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $art->summary }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 bg-blue-50 text-[#0c3866] font-bold rounded-md text-[10px]">
                                    {{ $art->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $art->author->name ?? 'Admin BNN' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $art->reading_time }} mnt
                            </td>
                            <td class="px-4 py-3 font-bold text-slate-700">
                                {{ $art->views_count }} x
                            </td>
                            <td class="px-4 py-3">
                                @if($art->is_published)
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 font-bold rounded-md text-[10px]">
                                        Publik
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 font-bold rounded-md text-[10px]">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="p-1.5 text-[#0c3866] bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Edit Artikel">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors" title="Hapus Artikel">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-xs text-slate-400">
                                Tidak ada artikel yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $articles->links() }}
        </div>
    </div>

</div>
@endsection
