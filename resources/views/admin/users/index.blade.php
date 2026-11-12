@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page_title', 'Kelola Pengguna & Administrator')
@section('page_subtitle', 'Daftar seluruh akun terdaftar pada sistem BNN Jakarta Timur')

@section('page_action')
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg shadow-sm hover:bg-[#1a467a] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
        </svg>
        Tambah Pengguna Baru
    </a>
@endsection

@section('content')
<div class="space-y-4">

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
        <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama pengguna, email, atau telepon..." class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
            </div>

            <div class="flex items-center gap-2">
                <select name="role" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#0c3866]">
                    <option value="">Semua Hak Akses (Role)</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Masyarakat (User)</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-[#0c3866] text-white text-xs font-bold rounded-lg hover:bg-[#1a467a] transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Nama Pengguna</th>
                        <th class="px-4 py-3">Alamat Email</th>
                        <th class="px-4 py-3">Nomor Telepon</th>
                        <th class="px-4 py-3">Hak Akses</th>
                        <th class="px-4 py-3">Terdaftar Sejak</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $usr)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-4 py-3">
                                <div class="font-bold text-slate-900 flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-[#0c3866] text-white flex items-center justify-center text-xs font-bold">
                                        {{ strtoupper(substr($usr->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $usr->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-700 font-medium">{{ $usr->email }}</td>
                            <td class="px-4 py-3 text-slate-500">{{ $usr->phone ?: '-' }}</td>
                            <td class="px-4 py-3">
                                @if($usr->role === 'admin')
                                    <span class="px-2 py-0.5 bg-[#0c3866] text-white font-bold rounded-md text-[10px] uppercase">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-blue-50 text-[#0c3866] font-bold rounded-md text-[10px] uppercase border border-blue-200">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-400">{{ $usr->created_at->translatedFormat('d M Y, H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $usr->id) }}" class="p-1.5 text-[#0c3866] bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Edit Pengguna">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    @if($usr->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $usr->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors" title="Hapus Pengguna">
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
                            <td colspan="6" class="p-8 text-center text-xs text-slate-400">
                                Tidak ada data pengguna yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
