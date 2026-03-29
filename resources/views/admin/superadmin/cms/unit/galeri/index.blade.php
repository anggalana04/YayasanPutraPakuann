@extends('layouts.admin.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'CMS Galeri - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Galeri Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Tambahkan atau hapus galeri foto/video per jenjang sekolah.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.galeri.create', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah Item Galeri
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
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Preview</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Judul</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Tanggal</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($galleryItems as $item)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4">
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" alt="Galeri" class="w-16 h-16 object-cover rounded-xl border border-[#1c190d]/10 bg-white">
                            @else
                                <div class="w-16 h-16 rounded-xl bg-[#1c190d]/5 border border-[#1c190d]/10"></div>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-[#1c190d] line-clamp-1">{{ $item->title }}</div>
                            <div class="text-xs text-on-surface-variant">{{ Str::limit($item->description ?? '-', 60) }}</div>
                        </td>
                        <td class="px-4 py-4">
                            @if ($item->status === 'published')
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Diterbitkan</span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Draf</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-on-surface-variant">
                            @if ($item->published_at)
                                {{ $item->published_at->format('d M Y') }}
                            @else
                                {{ $item->created_at->format('d M Y') }}
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2 items-center">
                                <a href="{{ route('admin.cms.galeri.edit', ['schoolType' => $schoolType, 'id' => $item->id]) }}"
                                   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.galeri.destroy', ['schoolType' => $schoolType, 'id' => $item->id]) }}" onsubmit="return confirm('Hapus item galeri ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-[#1c190d] text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada item galeri.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $galleryItems->links() }}
        </div>
    </div>
</div>
@endsection





