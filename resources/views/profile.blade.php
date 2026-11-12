@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Pengaturan Akun & Informasi Pribadi</div>
</div>
@endsection

@section('content')
<div class="px-5 py-5 space-y-5">

    <!-- Profile Header Card -->
    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-3.5">
        <div class="w-14 h-14 rounded-2xl bg-[#0c3866] text-white flex items-center justify-center text-xl font-bold shadow-sm flex-shrink-0">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <h1 class="text-sm font-bold text-slate-900 truncate">{{ $user->name }}</h1>
                @if($user->role === 'admin')
                    <span class="px-2 py-0.5 bg-[#0c3866] text-white text-[9px] font-bold rounded-md uppercase">
                        Admin
                    </span>
                @else
                    <span class="px-2 py-0.5 bg-blue-50 text-[#0c3866] text-[9px] font-bold rounded-md uppercase border border-blue-200">
                        User
                    </span>
                @endif
            </div>
            <div class="text-xs text-slate-500 mt-0.5 truncate">{{ $user->email }}</div>
            <div class="text-[10px] text-slate-400 mt-1">Bergabung sejak {{ $user->created_at->translatedFormat('F Y') }}</div>
        </div>
    </div>

    <!-- Quick Stats & Actions -->
    <div class="grid grid-cols-2 gap-2.5">
        <a href="{{ route('bookmarks.index') }}" class="p-3 bg-white border border-slate-200 rounded-xl hover:border-[#0c3866] transition-colors">
            <div class="text-xs text-slate-500">Artikel Tersimpan</div>
            <div class="text-lg font-extrabold text-[#0c3866] mt-0.5">{{ $bookmarksCount }}</div>
        </a>

        <a href="{{ route('feedback.index') }}" class="p-3 bg-white border border-slate-200 rounded-xl hover:border-[#0c3866] transition-colors">
            <div class="text-xs text-slate-500">Kritik & Masukan</div>
            <div class="text-lg font-extrabold text-[#0c3866] mt-0.5">{{ $feedbacksCount }}</div>
        </a>
    </div>

    <section class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Riwayat Masukan & Balasan</h2>
            <a href="{{ route('feedback.index') }}" class="text-[10px] font-bold text-[#0c3866]">Kirim masukan</a>
        </div>
        @forelse($feedbacks as $feedback)
            <article class="p-3.5 bg-white border border-slate-200 rounded-xl space-y-2">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h3 class="text-xs font-bold text-slate-800">{{ $feedback->category_label }}</h3>
                        <p class="text-[10px] text-slate-400">{{ $feedback->created_at->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                    <span class="text-[10px] font-bold {{ $feedback->status === 'replied' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $feedback->status === 'replied' ? 'Sudah dibalas' : 'Menunggu balasan' }}
                    </span>
                </div>
                <p class="text-[11px] text-slate-600 whitespace-pre-line">{{ $feedback->message }}</p>
                @if($feedback->admin_reply)
                    <div class="p-2.5 bg-blue-50 border border-blue-100 rounded-lg">
                        <div class="text-[10px] font-bold text-[#0c3866]">Balasan Admin</div>
                        <p class="text-[11px] text-slate-700 mt-1 whitespace-pre-line">{{ $feedback->admin_reply }}</p>
                    </div>
                @endif
            </article>
        @empty
            <p class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-500">Belum ada riwayat masukan untuk akun {{ $user->email }}.</p>
        @endforelse
    </section>

    @if($user->role === 'admin')
        <div class="p-3.5 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-[#0c3866]">Anda Masuk Sebagai Administrator</div>
                <div class="text-[10px] text-slate-500">Kelola artikel, kategori, pengguna, dan balas kritik.</div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 bg-[#0c3866] text-white text-xs font-bold rounded-lg shadow-sm hover:bg-[#1a467a] transition-colors whitespace-nowrap">
                Buka Panel Admin
            </a>
        </div>
    @endif

    <!-- Edit Profile Form -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs">
        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
            Perbarui Data Diri
        </h3>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-3">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('name')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('phone')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2 border-t border-slate-100">
                <div class="text-[11px] font-bold text-slate-700 mb-2">Ganti Password (Kosongkan jika tidak ingin diubah):</div>

                <div class="space-y-2">
                    <div>
                        <label class="block text-[11px] text-slate-600 mb-0.5">Password Saat Ini</label>
                        <input type="password" name="current_password" placeholder="Password lama Anda" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                        @error('current_password')
                            <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] text-slate-600 mb-0.5">Password Baru</label>
                        <input type="password" name="new_password" placeholder="Minimal 6 karakter" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                        @error('new_password')
                            <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] text-slate-600 mb-0.5">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" placeholder="Ulangi password baru" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <!-- Logout Button -->
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-2.5 px-4 bg-white border border-rose-200 text-rose-600 text-xs font-bold rounded-xl hover:bg-rose-50 transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar dari Akun
            </button>
        </form>
    </div>

</div>
@endsection
