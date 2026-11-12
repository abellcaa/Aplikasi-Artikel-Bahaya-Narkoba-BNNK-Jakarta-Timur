@extends('layouts.admin')

@section('title', 'Kritik & Saran Masuk')
@section('page_title', 'Kelola Kritik & Saran Masuk')
@section('page_subtitle', 'Tinjau masukan dari masyarakat dan berikan tanggapan resmi via email')

@section('content')
<div class="space-y-4">

    <!-- Filters & Status Tabs -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
        <form action="{{ route('admin.feedbacks.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            <div class="sm:col-span-2 lg:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama pengirim, email, subjek atau pesan..." class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <select name="category" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                <option value="">Semua Kategori</option>
                @foreach(\App\Models\Feedback::CATEGORIES as $value => $label)
                    <option value="{{ $value }}" {{ request('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ request('date_from') }}" aria-label="Tanggal mulai" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg">
            <input type="date" name="date_to" value="{{ request('date_to') }}" aria-label="Tanggal akhir" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg">

            <div class="flex items-center gap-2">
                <select name="status" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                    <option value="">Semua Status ({{ $feedbacks->total() }})</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Balasan ({{ $pendingCount }})</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Sudah Dibalas ({{ $repliedCount }})</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg hover:bg-[#1a467a] transition-colors">
                    Terapkan
                </button>
            </div>
        </form>
        <div class="mt-3 flex justify-end">
            <a href="{{ route('admin.feedbacks.print', request()->query()) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-slate-100 text-slate-700 text-xs font-semibold rounded-lg hover:bg-slate-200">
                <span aria-hidden="true">&#128438;</span> Cetak / Simpan PDF
            </a>
        </div>
    </div>

    <!-- Feedbacks Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Pengirim</th>
                        <th class="px-4 py-3">Subjek & Pesan</th>
                        <th class="px-4 py-3">Status Balasan</th>
                        <th class="px-4 py-3">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($feedbacks as $fb)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-3">
                                <div class="font-bold text-slate-900">{{ $fb->name }}</div>
                                <div class="text-[11px] text-slate-400 font-mono">{{ $fb->email }}</div>
                            </td>
                            <td class="px-4 py-3 max-w-sm">
                                <div class="font-bold text-slate-800">{{ $fb->category_label }}</div>
                                <p class="text-[11px] text-slate-500 line-clamp-2 mt-0.5">{{ $fb->message }}</p>
                            </td>
                            <td class="px-4 py-3">
                                @if($fb->status === 'replied')
                                    <span class="px-2.5 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-[10px] rounded-md inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Sudah Dibalas
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-amber-50 border border-amber-200 text-amber-700 font-bold text-[10px] rounded-md inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Menunggu Balasan
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-400">
                                {{ $fb->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.feedbacks.show', $fb->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 bg-[#0c3866] text-white text-xs font-bold rounded-lg hover:bg-[#1a467a] transition-colors">
                                        <span>{{ $fb->status === 'pending' ? 'Balas Email' : 'Lihat' }}</span>
                                    </a>

                                    <form action="{{ route('admin.feedbacks.destroy', $fb->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors" title="Hapus Pesan">
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
                            <td colspan="5" class="p-8 text-center text-xs text-slate-400">
                                Belum ada pesan kritik dan saran masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $feedbacks->links() }}
        </div>
    </div>

</div>
@endsection
