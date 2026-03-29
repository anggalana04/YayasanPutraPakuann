@extends('layouts.admin.app')

@section('title', 'CMS Carousel - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Carousel Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Kelola gambar carousel pada homepage sekolah ini.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm">
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.carousel.create', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah Gambar Carousel
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
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($carouselImages as $item)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4 space-y-2">
                            <div class="text-xs font-bold text-slate-600">{{ $item->title ?? 'No title' }}</div>
                            <div class="text-xs text-slate-500 line-clamp-2">{{ $item->description ?? 'No description' }}</div>
                            @if ($item->video_url)
                                <video controls width="200" class="rounded-xl border border-[#1c190d]/10 bg-black">
                                    <source src="{{ $item->video_url }}" type="video/mp4" />
                                    Your browser does not support the video tag.
                                </video>
                                <p class="text-[10px] text-slate-400">Pratinjau Video</p>
                            @elseif($item->image_url)
                                <img src="{{ $item->image_url }}" alt="Carousel" class="w-32 h-20 object-cover rounded-xl border border-[#1c190d]/10 bg-white" />
                            @else
                                <span class="text-xs text-slate-400">Tidak ada media</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2 items-center">
                                <a href="{{ route('admin.cms.carousel.edit', ['schoolType' => $schoolType, 'carousel' => $item->id]) }}"
                                   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.carousel.destroy', ['schoolType' => $schoolType, 'carousel' => $item->id]) }}" onsubmit="return confirm('Hapus gambar carousel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-[#1c190d] text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada gambar carousel. Tambahkan lewat tombol atas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $carouselImages->links() }}
        </div>
    </div>
</div>
@endsection







