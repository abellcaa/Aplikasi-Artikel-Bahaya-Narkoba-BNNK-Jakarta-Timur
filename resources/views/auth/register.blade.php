@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Pendaftaran Pengguna BNN Kota Jakarta Timur</div>
</div>
@endsection

@section('content')
<div class="px-5 py-6 space-y-6">

    <div class="text-center pt-2">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#0c3866] text-white mb-3 shadow-sm border-2 border-slate-100">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-slate-900">Buat Akun Baru</h1>
        <p class="text-xs text-slate-500 mt-1">Daftar untuk mengakses seluruh fitur edukasi bahaya narkoba</p>
    </div>

    <!-- Registration Form -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-2xs">
        <form action="{{ route('register.post') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Bella Nurfadilah" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('name')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@domain.com" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('email')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp (Opsional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('phone')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Daftar Sebagai (Hak Akses) <span class="text-rose-500">*</span></label>
                <select name="role" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Masyarakat / Siswa (User)</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Petugas BNN (Administrator)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password <span class="text-rose-500">*</span></label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('password')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Password <span class="text-rose-500">*</span></label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi password di atas" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all">
                Daftar Akun Sekarang
            </button>
        </form>

        <div class="mt-4 pt-4 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-600">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-[#0c3866] hover:underline">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

</div>
@endsection
