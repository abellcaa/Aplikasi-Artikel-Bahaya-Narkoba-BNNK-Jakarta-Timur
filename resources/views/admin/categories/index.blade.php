@extends('layouts.admin')

@section('title', 'Kelola Kelompok / Kategori Artikel')
@section('page_title', 'Kelompok Artikel Narkoba')
@section('page_subtitle', 'Klasifikasi kelompok materi bahaya narkotika, psikotropika & regulasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ADD CATEGORY FORM -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs h-fit">
        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#0c3866]"></span>
            Tambah Kelompok Baru
        </h2>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kelompok / Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Zat Adiktif Lainnya" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                @error('name')
                    <p class="text-[10px] text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="3" placeholder="Penjelasan singkat mengenai materi dalam kelompok ini..." class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors">
                Tambah Kelompok
            </button>
        </form>
    </div>

    <!-- CATEGORIES TABLE -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold text-slate-800">Daftar Kelompok Artikel</h2>
                <p class="text-[11px] text-slate-400">Kelompok kategori yang aktif digunakan pada artikel.</p>
            </div>
            <span class="px-2.5 py-1 bg-blue-50 text-[#0c3866] font-bold text-xs rounded-lg">
                {{ $categories->total() }} Kelompok
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Nama Kelompok</th>
                        <th class="px-4 py-3">Slug URL</th>
                        <th class="px-4 py-3">Jumlah Artikel</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-3">
                                <div class="font-bold text-slate-900">{{ $cat->name }}</div>
                                <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $cat->description }}</div>
                            </td>
                            <td class="px-4 py-3 text-slate-500 font-mono text-[11px]">
                                {{ $cat->slug }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-700 font-bold rounded-md">
                                    {{ $cat->articles_count }} Artikel
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Edit Modal Trigger -->
                                    <button type="button" onclick="openEditModal('{{ $cat->id }}', '{{ addslashes($cat->name) }}', '{{ addslashes($cat->description) }}')" class="p-1.5 text-[#0c3866] bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Edit Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    @if($cat->articles_count == 0)
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors" title="Hapus Kategori">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-xs text-slate-400">
                                Belum ada kelompok kategori artikel.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $categories->links() }}
        </div>
    </div>

</div>

<!-- EDIT CATEGORY MODAL -->
<div id="editModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-5 shadow-xl">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Edit Kelompok Artikel</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kelompok <span class="text-rose-500">*</span></label>
                <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea id="edit_description" name="description" rows="3" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]"></textarea>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-3.5 py-2 bg-slate-100 text-slate-600 text-xs font-semibold rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-xl shadow-sm hover:bg-[#1a467a] transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openEditModal(id, name, description) {
        const form = document.getElementById('editForm');
        form.action = '{{ url("admin/categories") }}/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
