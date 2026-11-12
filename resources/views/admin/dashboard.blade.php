@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Utama')
@section('page_subtitle', 'Ringkasan data & aktivitas layanan edukasi BNN Kota Jakarta Timur')

@section('page_action')
    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg shadow-sm hover:bg-[#1a467a] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Artikel Baru
    </a>
@endsection

@section('content')
<div class="space-y-6">

    <!-- METRIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Articles -->
        <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Total Artikel</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-800 mt-2">{{ $totalArticles }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Artikel bahaya narkoba terpublikasi</div>
        </div>

        <!-- Total Categories -->
        <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Kelompok Artikel</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-800 mt-2">{{ $totalCategories }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Klasifikasi topik & jenis zat</div>
        </div>

        <!-- Total Users -->
        <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Pengguna Terdaftar</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-800 mt-2">{{ $totalUsers }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Akun masyarakat / siswa aktif</div>
        </div>

        <!-- Feedback & Pending -->
        <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Kritik & Masukan</span>
                <div class="w-8 h-8 rounded-lg {{ $pendingFeedback > 0 ? 'bg-amber-50 text-amber-700' : 'bg-blue-50 text-[#0c3866]' }} flex items-center justify-center font-bold text-xs">
                    {{ $pendingFeedback }}
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-800 mt-2">{{ $totalFeedback }}</div>
            <div class="text-[11px] text-slate-400 mt-1">
                @if($pendingFeedback > 0)
                    <strong class="text-amber-600 font-bold">{{ $pendingFeedback }} belum dibalas via email</strong>
                @else
                    Semua pesan telah dibalas
                @endif
            </div>
        </div>
    </div>

    <!-- MAIN TWO COLUMN SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Feedbacks / Inquiries (Needs Reply) -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Kritik & Saran Masyarakat Terbaru</h2>
                    <p class="text-[11px] text-slate-400">Pesan dari masyarakat yang membutuhkan respon atau tindak lanjut.</p>
                </div>
                <a href="{{ route('admin.feedbacks.index') }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentFeedbacks as $fb)
                    <div class="p-4 flex items-start justify-between gap-4 hover:bg-slate-50/70 transition-colors">
                        <div class="space-y-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-800">{{ $fb->name }}</span>
                                <span class="text-[10px] text-slate-400">&lt;{{ $fb->email }}&gt;</span>
                                @if($fb->status === 'pending')
                                    <span class="px-2 py-0.5 bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-bold rounded-md">
                                        Perlu Balasan
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-bold rounded-md">
                                        Sudah Dibalas
                                    </span>
                                @endif
                            </div>
                            <div class="text-xs font-semibold text-slate-700">{{ $fb->subject }}</div>
                            <p class="text-xs text-slate-500 line-clamp-1">"{{ $fb->message }}"</p>
                            <div class="text-[10px] text-slate-400">{{ $fb->created_at->diffForHumans() }}</div>
                        </div>

                        <a href="{{ route('admin.feedbacks.show', $fb->id) }}" class="px-3 py-1.5 bg-[#0c3866] text-white text-xs font-bold rounded-lg hover:bg-[#1a467a] transition-colors flex-shrink-0">
                            {{ $fb->status === 'pending' ? 'Balas Email' : 'Detail Pesan' }}
                        </a>
                    </div>
                @empty
                    <div class="p-6 text-center text-xs text-slate-400">
                        Belum ada pesan kritik atau saran yang masuk.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Article Categories Summary -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-slate-800">Distribusi Kategori</h2>
                <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                    Kelola
                </a>
            </div>

            <div class="p-4 space-y-3">
                @foreach($categoriesWithCount as $cat)
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-medium text-slate-700 truncate max-w-[180px]">{{ $cat->name }}</span>
                        <span class="px-2 py-0.5 bg-slate-100 text-slate-700 font-bold rounded-md">
                            {{ $cat->articles_count }} Artikel
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- RECENT ARTICLES TABLE -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-bold text-slate-800">Artikel Edukasi Terbaru</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-[#0c3866] hover:underline">
                Kelola Semua Artikel
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Judul Artikel</th>
                        <th class="px-4 py-3">Kelompok / Kategori</th>
                        <th class="px-4 py-3">Waktu Baca</th>
                        <th class="px-4 py-3">Views</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentArticles as $art)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-3 font-semibold text-slate-800">
                                {{ $art->title }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 bg-blue-50 text-[#0c3866] font-bold rounded-md text-[10px]">
                                    {{ $art->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $art->reading_time }} menit</td>
                            <td class="px-4 py-3 font-bold text-slate-700">{{ $art->views_count }} x</td>
                            <td class="px-4 py-3 text-slate-400">{{ $art->created_at->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.articles.edit', $art->id) }}" class="text-[#0c3866] font-bold hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
