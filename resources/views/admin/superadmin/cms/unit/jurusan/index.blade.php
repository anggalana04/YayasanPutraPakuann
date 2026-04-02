@extends('layouts.admin.app')

@section('title', 'Kelola Jurusan - SMK Putra Pakuan')

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div class="space-y-2">
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Superadmin CMS › SMK</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">Kelola Jurusan</h2>
            <p class="text-on-surface-variant max-w-xl">
                Tambah, ubah, dan atur urutan program keahlian (jurusan) yang ditampilkan di halaman publik SMK.
            </p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => 'smk']) }}"
               class="px-5 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-base">arrow_back</span>
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.jurusan.create', ['schoolType' => 'smk']) }}"
               class="px-5 py-3 bg-primary text-[#1c190d] rounded-2xl font-bold text-sm hover:bg-primary/90 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-base">add</span>
                Tambah Jurusan
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-surface-container-lowest rounded-3xl shadow-sm ring-1 ring-[#1c190d]/5 overflow-hidden">

        @if($jurusans->isEmpty())
        <div class="p-16 text-center text-on-surface-variant">
            <span class="material-symbols-outlined text-5xl mb-4 block text-primary/30">school</span>
            <p class="font-bold text-lg">Belum ada jurusan ditambahkan.</p>
            <p class="text-sm mt-1">Klik tombol "Tambah Jurusan" untuk memulai.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#1c190d]/5">
                        <th class="text-left px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jurusan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider w-28">Kode</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider w-20">Urutan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider w-24">Status</th>
                        <th class="text-right px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-wider w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1c190d]/5">
                    @foreach($jurusans as $j)
                    <tr class="hover:bg-[#fafaf6] transition-colors">
                        <td class="px-6 py-4 text-on-surface-variant">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($j->cover_image_url)
                                <div class="w-12 h-10 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                    <img src="{{ $j->cover_image_url }}" class="w-full h-full object-cover" alt="">
                                </div>
                                @else
                                <div class="w-12 h-10 rounded-xl flex items-center justify-center shrink-0"
                                     style="background: {{ $j->accent_color }}22;">
                                    <span class="material-symbols-outlined text-base" style="color: {{ $j->accent_color }}">{{ $j->icon }}</span>
                                </div>
                                @endif
                                <div>
                                    <div class="font-extrabold text-[#1c190d]">{{ $j->name }}</div>
                                    @if($j->tagline)
                                    <div class="text-xs text-on-surface-variant mt-0.5 line-clamp-1">{{ $j->tagline }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($j->short_name)
                            <span class="text-xs font-black px-2.5 py-1 rounded-full"
                                  style="background: {{ $j->accent_color }}22; color: {{ $j->accent_color }}">
                                {{ $j->short_name }}
                            </span>
                            @else
                            <span class="text-on-surface-variant text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant font-mono">{{ $j->order_column }}</td>
                        <td class="px-6 py-4">
                            @if($j->is_active)
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Aktif</span>
                            @else
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('school.jurusan.show', ['school' => 'smk', 'slug' => $j->slug]) }}"
                                   target="_blank"
                                   class="p-2 rounded-xl hover:bg-slate-100 transition-colors text-on-surface-variant"
                                   title="Lihat Halaman Publik">
                                    <span class="material-symbols-outlined text-base">open_in_new</span>
                                </a>
                                <a href="{{ route('admin.cms.jurusan.edit', ['schoolType' => 'smk', 'jurusan' => $j->id]) }}"
                                   class="p-2 rounded-xl hover:bg-primary/10 transition-colors text-primary"
                                   title="Edit">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.cms.jurusan.destroy', ['schoolType' => 'smk', 'jurusan' => $j->id]) }}"
                                      onsubmit="return confirm('Hapus jurusan {{ addslashes($j->name) }}? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-xl hover:bg-red-50 transition-colors text-red-500"
                                            title="Hapus">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Tip --}}
    <p class="text-xs text-on-surface-variant">
        <span class="font-bold">Tips:</span> Atur kolom "Urutan" (angka lebih kecil tampil lebih awal) untuk mengubah posisi jurusan di halaman publik.
    </p>
</div>
@endsection
