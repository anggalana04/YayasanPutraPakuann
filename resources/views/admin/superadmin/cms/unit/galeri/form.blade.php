@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah' : 'Edit') . ' Galeri - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-3xl mx-auto space-y-6">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">{{ $mode === 'create' ? 'Tambah' : 'Edit' }} Item Galeri</p>
            <h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
        </div>
        <a href="{{ route('admin.cms.galeri.index', ['schoolType' => $schoolType]) }}"
           class="px-5 py-2 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
            Kembali ke List
        </a>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ $mode === 'create' ? route('admin.cms.galeri.store', ['schoolType' => $schoolType]) : route('admin.cms.galeri.update', ['schoolType' => $schoolType, 'id' => $item->id]) }}" enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5 space-y-5">
            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Judul</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required
                       class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Deskripsi (opsional)</label>
                <textarea name="description" rows="4" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('description', $item->description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status</label>
                    <select name="status" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="published" {{ old('status', $item->status ?? 'published') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $item->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Tanggal Publikasi</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $item?->published_at?->format('Y-m-d') ?? '') }}"
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Unggah Foto Galeri</label>
                <input type="file" name="image" accept="image/*" class="block w-full text-sm" />
                @if ($mode === 'edit' && !empty($item->image_url))
                    <div class="mt-2">
                        <span class="text-xs text-on-surface-variant">Foto Saat Ini:</span>
                        <img src="{{ $item->image_url }}" alt="Current galeri" class="mt-2 w-36 h-24 object-cover rounded-xl border" />
                    </div>
                @endif
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                    {{ $mode === 'create' ? 'Tambah' : 'Simpan Perubahan' }}
                </button>
                <a href="{{ route('admin.cms.galeri.index', ['schoolType' => $schoolType]) }}" class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
