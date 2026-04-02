@extends('layouts.admin.app')

@section('title', 'CMS Prestasi - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Prestasi Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Buat, ubah, dan hapus prestasi siswa per sekolah.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.prestasi.create', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah Prestasi
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-3xl p-5 shadow-sm ring-1 ring-[#1c190d]/5 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Judul</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Kategori</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Tanggal</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($prestasi as $item)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4">{{
                            Str::limit($item->title, 80)
                        }}</td>
                        <td class="px-4 py-4">{{ $item->category ?? '-' }}</td>
                        <td class="px-4 py-4">
                            @if ($item->status === 'published')
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Diterbitkan</span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Draf</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-on-surface-variant">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2 items-center">
                                <a href="{{ route('admin.cms.prestasi.edit', ['schoolType' => $schoolType, 'prestasi' => $item->id]) }}"
                                   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.prestasi.destroy', ['schoolType' => $schoolType, 'prestasi' => $item->id]) }}" onsubmit="return confirm('Hapus prestasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-[#1c190d] text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada data prestasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $prestasi->links() }}
        </div>
    </div>
</div>
@endsection





