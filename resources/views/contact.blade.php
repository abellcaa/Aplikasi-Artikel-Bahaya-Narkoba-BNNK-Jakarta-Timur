@extends('layouts.app')

@section('title', 'Kontak & Lokasi Kantor BNN')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Layanan Bantuan, Alamat Kantor & Call Center</div>
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-4">

    <!-- Emergency Hotline Card -->
    <div class="p-4 bg-gradient-to-r from-[#0c3866] to-[#1a467a] text-white rounded-2xl shadow-sm">
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-amber-400 text-slate-900 text-[10px] font-extrabold rounded-md uppercase">
                Call Center Bebas Pulsa
            </span>
        </div>
        <div class="text-2xl font-black tracking-tight mt-1">184</div>
        <p class="text-[11px] text-blue-100 mt-1 leading-snug">
            Layanan pengaduan, informasi narkoba, dan konsultasi rehabilitasi 24 jam BNN Republik Indonesia.
        </p>
        <div class="mt-3">
            <a href="tel:184" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-[#0c3866] text-xs font-bold rounded-lg hover:bg-blue-50 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Panggil Sekarang (184)
            </a>
        </div>
    </div>

    <!-- Kantor BNN Jakarta Timur Details -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 space-y-4 shadow-2xs">
        <div>
            <h2 class="text-xs font-bold text-[#0c3866] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                Kantor BNN Kota Jakarta Timur
            </h2>
            <div class="space-y-3 text-xs text-slate-700">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Alamat Kantor</div>
                        <div class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                            Jl. Otista Raya No. 469, RT.01/RW.07, Cipinang Cempedak, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13340
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Telepon Kantor / Pengaduan</div>
                        <div class="text-[11px] text-slate-600 mt-0.5">(021) 819-2041 / 0812-8899-0011</div>
                    </div>
                </div>

                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Email Resmi</div>
                        <div class="text-[11px] text-slate-600 mt-0.5">info@bnn-jaktim.go.id</div>
                    </div>
                </div>

                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[#0c3866] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Jam Pelayanan Kantor & Klinik Pratama</div>
                        <div class="text-[11px] text-slate-600 mt-0.5">Senin - Jumat: 08.00 - 16.00 WIB (Sabtu & Minggu Tutup)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick action to feedback -->
    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-slate-800">Ada Pertanyaan Khusus?</h3>
            <p class="text-[11px] text-slate-500">Kirim kritik atau pertanyaan melalui form online kami.</p>
        </div>
        <a href="{{ route('feedback.index') }}" class="px-3 py-1.5 bg-[#0c3866] text-white text-xs font-bold rounded-lg shadow-sm hover:bg-[#1a467a] transition-colors whitespace-nowrap">
            Kritik & Saran
        </a>
    </div>

</div>
@endsection
