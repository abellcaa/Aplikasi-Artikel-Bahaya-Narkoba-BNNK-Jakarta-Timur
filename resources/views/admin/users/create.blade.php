@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')
@section('page_title', 'Tambah Akun Pengguna')
@section('page_subtitle', 'Daftarkan akun petugas BNN atau pengguna masyarakat')

@section('page_action')
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-600 font-semibold hover:text-[#0c3866]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-xl bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap pengguna" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email <span class="text-rose-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@domain.com" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon (Opsional)</label>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Hak Akses (Role) <span class="text-rose-500">*</span></label>
            <select name="role" required class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Masyarakat / Siswa (User)</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Petugas BNN (Administrator)</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Password Awal <span class="text-rose-500">*</span></label>
            <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
        </div>

        <div class="pt-4 flex items-center justify-end gap-2 border-t border-slate-100">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 text-xs font-semibold rounded-xl hover:bg-slate-200 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors">
                Simpan Akun
            </button>
        </div>
    </form>
</div>
@endsection
