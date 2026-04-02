@extends('layouts.admin.app')

@section('title', 'CMS Berita - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Berita Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Buat, ubah, dan hapus berita per sekolah.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.berita.create', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah Berita
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
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Disematkan</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Tanggal</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($news as $item)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="news image" class="w-12 h-12 object-cover rounded-xl border border-[#1c190d]/10 bg-white">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-[#1c190d]/5 border border-[#1c190d]/10"></div>
                                @endif
                                <div class="max-w-[320px]">
                                    <div class="font-extrabold text-[#1c190d] line-clamp-1">{{ $item->title }}</div>
                                    <div class="text-xs text-on-surface-variant">ID: {{ $item->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-on-surface-variant">{{ $item->category ?? '-' }}</td>
                        <td class="px-4 py-4">
                            @if ($item->featured)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Disematkan</span>
                            @else
                                <span class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant text-[10px] font-bold uppercase tracking-wider rounded-full">Tidak</span>
                            @endif
                        </td>
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
                                <form method="POST" action="{{ route('admin.cms.berita.toggle_featured', ['schoolType' => $schoolType, 'news' => $item->id]) }}">
                                    @csrf
                                    <button type="submit"
                                            class="px-3 py-2 {{ $item->featured ? 'bg-blue-600 text-white' : 'bg-[#1c190d] text-white' }} rounded-xl text-xs font-bold hover:opacity-90 transition-all">
                                        {{ $item->featured ? 'Unpin' : 'Pin' }}
                                    </button>
                                </form>
                                <a href="{{ route('admin.cms.berita.edit', ['schoolType' => $schoolType, 'news' => $item->id]) }}"
                                   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.berita.destroy', ['schoolType' => $schoolType, 'news' => $item->id]) }}"
                                      onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-2 bg-[#1c190d] text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection






