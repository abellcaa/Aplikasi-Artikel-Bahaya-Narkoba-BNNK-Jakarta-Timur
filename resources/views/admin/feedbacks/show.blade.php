@extends('layouts.admin')

@section('title', 'Detail Kritik & Tanggapan Email')
@section('page_title', 'Detail Kritik & Saran')
@section('page_subtitle', 'Subjek: ' . $feedback->subject)

@section('page_action')
    <a href="{{ route('admin.feedbacks.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-600 font-semibold hover:text-[#0c3866]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-3xl space-y-6">

    <!-- USER INQUIRY CARD -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs space-y-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400">PENGIRIM MASUKAN</span>
                <div class="text-sm font-bold text-slate-900 mt-0.5">{{ $feedback->name }}</div>
                <div class="text-xs text-slate-500 font-mono">{{ $feedback->email }}</div>
            </div>
            <div class="text-right">
                <div class="text-xs text-slate-400">Diterima pada:</div>
                <div class="text-xs font-semibold text-slate-700 mt-0.5">
                    {{ $feedback->created_at->translatedFormat('d F Y, H:i') }} WIB
                </div>
                <div class="mt-1">
                    @if($feedback->status === 'replied')
                        <span class="px-2.5 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-[10px] rounded-md">
                            Sudah Dibalas Admin
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 bg-amber-50 border border-amber-200 text-amber-700 font-bold text-[10px] rounded-md">
                            Menunggu Balasan
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <div class="text-xs font-bold text-slate-800 mb-1">Subjek:</div>
            <div class="p-3 bg-slate-50 rounded-xl text-xs font-semibold text-slate-900 border border-slate-100">
                {{ $feedback->subject }}
            </div>
        </div>

        <div>
            <div class="text-xs font-bold text-slate-800 mb-1">Isi Pesan / Kritik:</div>
            <div class="p-4 bg-slate-50 rounded-xl text-xs text-slate-800 leading-relaxed border border-slate-100 whitespace-pre-line">
                {{ $feedback->message }}
            </div>
        </div>
    </div>

    <!-- PREVIOUS ADMIN REPLY (IF REPLIED) -->
    @if($feedback->status === 'replied' && $feedback->admin_reply)
        <div class="bg-blue-50/80 p-6 rounded-2xl border border-blue-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-[#0c3866] text-white flex items-center justify-center text-xs font-bold">
                        ✓
                    </div>
                    <span class="text-xs font-bold text-[#0c3866] uppercase tracking-wider">
                        Balasan Resmi Terkirim via Email
                    </span>
                </div>
                <span class="text-[11px] text-slate-500">
                    {{ $feedback->replied_at ? $feedback->replied_at->translatedFormat('d F Y, H:i') : '' }}
                </span>
            </div>

            <div class="p-4 bg-white rounded-xl text-xs text-slate-800 leading-relaxed border border-blue-100 whitespace-pre-line">
                {{ $feedback->admin_reply }}
            </div>

            <div class="text-[11px] text-slate-500 flex items-center justify-between">
                <span>Dibalas oleh: <strong>{{ $feedback->repliedBy->name ?? 'Administrator BNN' }}</strong></span>
                <span class="text-[#0c3866] font-medium">Email tujuan: {{ $feedback->email }}</span>
            </div>
        </div>
    @endif

    <!-- ADMIN REPLY FORM -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs space-y-4">
        <div>
            <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                {{ $feedback->status === 'replied' ? 'Kirim Balasan Ulang / Tambahan via Email' : 'Tulis Tanggapan Resmi BNN via Email' }}
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Pesan ini akan tersimpan ke database dan otomatis dikirimkan ke email <strong>{{ $feedback->email }}</strong> menggunakan format resmi BNN Kota Jakarta Timur.
            </p>
        </div>

        <form action="{{ route('admin.feedbacks.reply', $feedback->id) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Isi Tanggapan / Jawaban Administrator <span class="text-rose-500">*</span></label>
                <textarea name="reply_message" rows="6" required placeholder="Tuliskan balasan resmi dari BNN Kota Jakarta Timur untuk masyarakat..." class="w-full px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">{{ old('reply_message', $feedback->admin_reply) }}</textarea>
                @error('reply_message')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-2">
                <div class="text-[11px] text-slate-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Sistem akan mengirim email langsung ke {{ $feedback->email }}
                </div>

                <button type="submit" class="px-5 py-2.5 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Kirim Balasan Resmi via Email
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
