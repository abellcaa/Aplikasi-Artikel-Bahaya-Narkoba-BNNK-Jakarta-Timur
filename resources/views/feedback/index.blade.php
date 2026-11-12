@extends('layouts.app')

@section('title', 'Kritik & Saran')

@section('header_sub')
<div class="px-4 pb-2.5">
    <div class="text-xs text-blue-100 font-medium">Layanan Suara Masyarakat & Balasan Resmi</div>
</div>
@endsection

@section('content')
<div class="px-4 py-4 space-y-6">

    <!-- Information Header -->
    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#0c3866] text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-xs font-bold text-slate-800">Form Kritik, Saran & Pertanyaan</h2>
                <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                    Masukan Anda akan tersimpan di database BNN Kota Jakarta Timur. Administrator kami akan memberikan tanggapan resmi langsung ke alamat email Anda.
                </p>
            </div>
        </div>
    </div>

    <!-- FEEDBACK FORM -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs">
        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
            Kirim Masukan Anda
        </h3>

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-3">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required placeholder="Masukkan nama Anda" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                @error('name')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email Aktif <span class="text-rose-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required placeholder="email@domain.com" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                <span class="text-[10px] text-slate-400 mt-0.5 block">Balasan admin akan dikirimkan ke email ini.</span>
                @error('email')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori Masukan <span class="text-rose-500">*</span></label>
                <select name="category" required class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">
                    <option value="">Pilih kategori masukan</option>
                    @foreach(\App\Models\Feedback::CATEGORIES as $value => $label)
                        <option value="{{ $value }}" {{ old('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Isi Kritik / Saran / Pertanyaan <span class="text-rose-500">*</span></label>
                <textarea name="message" rows="4" required placeholder="Tuliskan secara jelas kritik, saran, atau pertanyaan Anda untuk BNN Kota Jakarta Timur..." class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0c3866]/30 focus:border-[#0c3866]">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Kirim Kritik & Saran
            </button>
        </form>
    </div>

    <!-- USER FEEDBACK HISTORY (If user is logged in or has feedbacks) -->
    @auth
        <div>
            <div class="mb-3 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                <div class="text-[10px] font-bold text-[#0c3866] uppercase">Akun Pengirim</div>
                <div class="text-xs font-semibold text-slate-800 mt-1">{{ Auth::user()->name }}</div>
                <div class="text-[11px] text-slate-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
                    Riwayat Kritik & Balasan Anda ({{ $userFeedbacks->count() }})
                </h3>
            </div>

            @if($userFeedbacks->isEmpty())
                <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl text-center">
                    <p class="text-xs text-slate-500">Anda belum pernah mengirimkan kritik atau pertanyaan.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($userFeedbacks as $fb)
                        <div class="p-3.5 bg-white border border-slate-200 rounded-xl space-y-2.5">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-slate-400">
                                    {{ $fb->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                                @if($fb->status === 'replied')
                                    <span class="px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-bold rounded-md flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Sudah Dibalas Admin
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-bold rounded-md flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Menunggu Balasan
                                    </span>
                                @endif
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-800">{{ $fb->category_label }}</h4>
                                <p class="text-[11px] text-slate-600 mt-1 bg-slate-50 p-2.5 rounded-lg leading-relaxed">
                                    "{{ $fb->message }}"
                                </p>
                            </div>

                            @if($fb->status === 'replied' && $fb->admin_reply)
                                <div class="p-3 bg-blue-50/70 border border-blue-100 rounded-lg">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="text-[10px] font-bold text-[#0c3866] uppercase">
                                            Tanggapan Resmi BNN Jaktim:
                                        </div>
                                        <span class="text-[9px] text-slate-400">
                                            {{ $fb->replied_at ? $fb->replied_at->translatedFormat('d M Y, H:i') : '' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-800 font-medium leading-relaxed">
                                        {{ $fb->admin_reply }}
                                    </p>
                                    <div class="text-[9px] text-slate-400 mt-1 italic">
                                        *Salinan balasan ini juga telah dikirim ke email {{ $fb->email }}.
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center">
            <p class="text-xs text-slate-600">
                <a href="{{ route('login') }}" class="font-bold text-[#0c3866] hover:underline">Masuk ke Akun Anda</a> untuk memantau riwayat balasan kritik dan saran Anda dengan mudah.
            </p>
        </div>
    @endauth

</div>
@endsection
