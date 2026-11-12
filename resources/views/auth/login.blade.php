@extends('layouts.app')

@section('title', 'Masuk Akun')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Masuk untuk Simpan Artikel & Kirim Saran</div>
</div>
@endsection

@section('content')
<div class="px-5 py-6 space-y-6">

    <div class="text-center pt-2">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#0c3866] text-white mb-3 shadow-sm border-2 border-slate-100">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-slate-900">Masuk ke Akun Anda</h1>
        <p class="text-xs text-slate-500 mt-1">Gunakan akun Pengguna atau Akun Administrator</p>
    </div>

    <!-- Login Form -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-2xs">
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('email')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-slate-700">Password <span class="text-rose-500">*</span></label>
                </div>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('password')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#0c3866] focus:ring-[#0c3866]">
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-4 pt-4 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-600">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-bold text-[#0c3866] hover:underline">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

    <!-- Demo Accounts info for easy testing -->
    <div class="p-3.5 bg-blue-50/70 border border-blue-200 rounded-xl space-y-2 text-xs">
        <div class="font-bold text-[#0c3866] text-[11px] uppercase tracking-wider">Akun Demo Cepat (Uji Coba):</div>
        <div class="space-y-1.5 text-[11px] text-slate-700">
            <div class="flex items-center justify-between p-1.5 bg-white rounded-lg border border-blue-100">
                <div>
                    <strong>Admin:</strong> admin@bnn-jaktim.go.id / <code>password</code>
                </div>
                <button type="button" onclick="fillLogin('admin@bnn-jaktim.go.id', 'password')" class="text-[10px] text-[#0c3866] font-bold underline">
                    Pakai
                </button>
            </div>
            <div class="flex items-center justify-between p-1.5 bg-white rounded-lg border border-blue-100">
                <div>
                    <strong>User:</strong> bella@gmail.com / <code>password</code>
                </div>
                <button type="button" onclick="fillLogin('bella@gmail.com', 'password')" class="text-[10px] text-[#0c3866] font-bold underline">
                    Pakai
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function fillLogin(email, password) {
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="password"]').value = password;
    }
</script>
@endsection
