@extends('layouts.app')

@section('title', 'Tentang BNN Kota Jakarta Timur')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Profil & Program Kerja Pencegahan Narkoba</div>
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-5">

    <!-- Agency Header Box -->
    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl text-center">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-[#0c3866] text-white flex items-center justify-center mb-3 shadow-sm border-2 border-slate-100">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>
        <h1 class="text-sm font-extrabold text-slate-900">
            Badan Narkotika Nasional Kota Jakarta Timur
        </h1>
        <p class="text-[11px] text-slate-500 mt-1 max-w-xs mx-auto leading-relaxed">
            Instansi vertikal BNN Republik Indonesia yang bertugas melaksanakan kebijakan nasional P4GN di wilayah Kota Administrasi Jakarta Timur.
        </p>
    </div>

    <!-- Visi & Misi -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 space-y-4">
        <div>
            <h2 class="text-xs font-bold text-[#0c3866] uppercase tracking-wider mb-1 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Visi BNN
            </h2>
            <p class="text-xs text-slate-700 leading-relaxed font-medium bg-slate-50 p-3 rounded-xl border border-slate-100">
                "Menjadi lembaga yang profesional, tangguh, dan terpercaya dalam pencegahan dan pemberantasan penyalahgunaan dan peredaran gelap narkotika di Indonesia."
            </p>
        </div>

        <div>
            <h2 class="text-xs font-bold text-[#0c3866] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Misi Strategis BNN
            </h2>
            <ul class="text-xs text-slate-700 space-y-2">
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-blue-50 text-[#0c3866] flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">1</span>
                    <span>Mengembangkan ketahanan keluarga dan masyarakat terhadap ancaman bahaya narkoba.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-blue-50 text-[#0c3866] flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">2</span>
                    <span>Melaksanakan rehabilitasi medis dan sosial yang bermutu dan humanis bagi penyalahguna narkoba.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-blue-50 text-[#0c3866] flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">3</span>
                    <span>Melakukan penegakan hukum yang tegas dan terukur terhadap sindikat dan peredaran gelap narkotika.</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- 4 Pilar P4GN -->
    <div>
        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
            4 Pilar Utama Program P4GN
        </h2>

        <div class="space-y-2.5">
            <div class="p-3 bg-white border border-slate-200 rounded-xl">
                <h3 class="text-xs font-bold text-[#0c3866]">1. Pencegahan (Prevention)</h3>
                <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                    Penyuluhan ke sekolah, kampus, dan lingkungan masyarakat mengenai bahaya dan konsekuensi hukum penyalahgunaan zat.
                </p>
            </div>

            <div class="p-3 bg-white border border-slate-200 rounded-xl">
                <h3 class="text-xs font-bold text-[#0c3866]">2. Pemberdayaan Masyarakat (Empowerment)</h3>
                <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                    Membentuk relawan dan pegiat anti narkoba di tingkat RT/RW dan kelurahan di seluruh Jakarta Timur.
                </p>
            </div>

            <div class="p-3 bg-white border border-slate-200 rounded-xl">
                <h3 class="text-xs font-bold text-[#0c3866]">3. Rehabilitasi (Rehabilitation)</h3>
                <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                    Pemulihan fisik, psikis, dan sosial pecandu secara sukarela tanpa penuntutan pidana melalui Klinik Pratama BNN.
                </p>
            </div>

            <div class="p-3 bg-white border border-slate-200 rounded-xl">
                <h3 class="text-xs font-bold text-[#0c3866]">4. Pemberantasan (Eradication)</h3>
                <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                    Penindakan sindikat peredaran gelap zat terlarang bersama TNI, Polri, dan instansi penegak hukum terkait.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Callout -->
    <div class="pt-2">
        <a href="{{ route('contact') }}" class="w-full py-2.5 px-4 bg-[#0c3866] text-white text-center text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors block">
            Lihat Informasi Kontak & Jam Kerja Kantor
        </a>
    </div>

</div>
@endsection
