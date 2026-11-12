@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="px-5 py-6 flex flex-col justify-between min-h-[calc(100vh-140px)]">
    
    <!-- Welcome Header / Hero -->
    <div class="text-center pt-4">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-[#0c3866] text-white shadow-md mb-4 border-4 border-slate-100">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>

        <div class="inline-block px-3 py-1 bg-blue-50 text-[#0c3866] text-xs font-semibold rounded-full mb-2 border border-blue-100">
            Aplikasi Resmi Edukasi P4GN
        </div>

        <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">
            BNN Kota Jakarta Timur
        </h1>
        <p class="text-xs text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
            Pusat informasi, edukasi bahaya narkoba, dan panduan pencegahan untuk mewujudkan masyarakat Jakarta Timur yang Bersinar (Bersih Narkoba).
        </p>
    </div>

    <!-- Feature highlights -->
    <div class="space-y-3 my-6">
        <div class="flex items-start gap-3 p-3.5 bg-slate-50 rounded-xl border border-slate-200">
            <div class="w-8 h-8 rounded-lg bg-[#0c3866] text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-slate-800">Artikel Edukasi Terstruktur</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">Klasifikasi lengkap jenis narkotika, gejala adiksi, dan dampak buruk kesehatan.</p>
            </div>
        </div>

        <div class="flex items-start gap-3 p-3.5 bg-slate-50 rounded-xl border border-slate-200">
            <div class="w-8 h-8 rounded-lg bg-[#0c3866] text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-slate-800">Simpan & Akses Cepat</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">Simpan artikel penting ke daftar bacaan untuk tugas dan referensi belajar.</p>
            </div>
        </div>

        <div class="flex items-start gap-3 p-3.5 bg-slate-50 rounded-xl border border-slate-200">
            <div class="w-8 h-8 rounded-lg bg-[#0c3866] text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-slate-800">Layanan Kritik & Balasan Email</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">Kirim pertanyaan atau masukan dan dapatkan jawaban resmi langsung dari admin BNN.</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="space-y-2.5 pt-2">
        <a href="{{ route('home') }}" class="w-full py-3 px-4 bg-[#0c3866] text-white text-center text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all block">
            Mulai Eksplorasi Beranda
        </a>

        @guest
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('login') }}" class="py-2.5 px-3 bg-white border border-slate-200 text-slate-700 text-center text-xs font-semibold rounded-xl hover:bg-slate-50 transition-colors">
                    Masuk Akun
                </a>
                <a href="{{ route('register') }}" class="py-2.5 px-3 bg-blue-50 border border-blue-200 text-[#0c3866] text-center text-xs font-semibold rounded-xl hover:bg-blue-100 transition-colors">
                    Daftar Baru
                </a>
            </div>
        @endguest
    </div>

</div>
@endsection
