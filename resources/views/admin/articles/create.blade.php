@extends('layouts.admin')

@section('title', 'Tambah Artikel Edukasi')
@section('page_title', 'Tulis Artikel Baru')
@section('page_subtitle', 'Publikasikan materi edukasi bahaya narkoba baru')

@section('page_action')
    <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-600 font-semibold hover:text-[#0c3866]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar
    </a>
@endsection

@section('content')
<div class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Artikel <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Mengenal Bahaya Sabu dan Kerusakan Saraf Otak" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kelompok / Kategori <span class="text-rose-500">*</span></label>
                <select name="category_id" required class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                    <option value="">Pilih Kelompok</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Ringkasan Artikel (Summary) <span class="text-rose-500">*</span></label>
            <textarea name="summary" rows="2" required placeholder="Tuliskan 1-2 kalimat ringkasan penting untuk ditampilkan pada kartu artikel..." class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">{{ old('summary') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Konten Lengkap Artikel <span class="text-rose-500">*</span></label>
            <textarea name="content" rows="12" required placeholder="Tuliskan materi edukasi secara lengkap, terperinci, dan mudah dipahami oleh pembaca..." class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">{{ old('content') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 border-t border-slate-100">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Unggah Thumbnail / Gambar (Opsional)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#0c3866] hover:file:bg-blue-100">
                <span class="text-[10px] text-slate-400 mt-1 block">Format: JPG, PNG, WEBP. Maks. 2MB</span>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Estimasi Waktu Baca (Menit)</label>
                <input type="number" name="reading_time" value="{{ old('reading_time', 3) }}" min="1" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <div class="flex items-center pt-5">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-700">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }} class="rounded border-slate-300 text-[#0c3866] focus:ring-[#0c3866]">
                    <span>Publikasikan Sekarang (Status Publik)</span>
                </label>
            </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-2 border-t border-slate-100">
            <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 text-xs font-semibold rounded-xl hover:bg-slate-200 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors">
                Simpan & Terbitkan Artikel
            </button>
        </div>
    </form>
</div>
@endsection
