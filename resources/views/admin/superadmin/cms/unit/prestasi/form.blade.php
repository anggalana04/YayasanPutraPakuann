@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah' : 'Ubah') . ' Prestasi - ' . strtoupper($schoolType))

@section('content')
<x-admin.cms-form-shell
    eyebrow="Prestasi"
    :title="$mode === 'create' ? 'Tambah Prestasi' : 'Ubah Prestasi'"
    :subtitle="$school->name . ' (' . strtoupper($schoolType) . ')'"
    :back-url="route('admin.cms.prestasi.index', ['schoolType' => $schoolType])"
>
    <form action="{{ $mode === 'create' ? route('admin.cms.prestasi.store', ['schoolType' => $schoolType]) : route('admin.cms.prestasi.update', ['schoolType' => $schoolType, 'prestasi' => $prestasiItem->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @if($mode === 'edit')
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Judul</label>
                <input name="title" class="w-full border rounded-xl px-3 py-2" value="{{ old('title', $prestasiItem->title ?? '') }}" required />
                @error('title') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Kategori</label>
                <input name="category" class="w-full border rounded-xl px-3 py-2" value="{{ old('category', $prestasiItem->category ?? '') }}" />
                @error('category') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500">Ringkasan</label>
            <textarea name="excerpt" class="w-full border rounded-xl px-3 py-2 h-24">{{ old('excerpt', $prestasiItem->excerpt ?? '') }}</textarea>
            @error('excerpt') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500">Konten</label>
            <textarea name="content" class="w-full border rounded-xl px-3 py-2 h-40" required>{{ old('content', $prestasiItem->content ?? '') }}</textarea>
            @error('content') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Gambar (opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full" />
                @if(!empty($prestasiItem->image_url))
                <img src="{{ $prestasiItem->image_url }}" alt="Existing" class="w-28 h-20 object-cover mt-2 border" />
                @endif
                @error('image') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Status</label>
                <select name="status" class="w-full border rounded-xl px-3 py-2" required>
                    <option value="draft" {{ old('status', $prestasiItem->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draf</option>
                    <option value="published" {{ old('status', $prestasiItem->status ?? '') === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                </select>
                @error('status') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="px-4 py-3 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm">
            Tanggal publish diisi otomatis saat status diubah ke <span class="font-bold">Diterbitkan</span>.
        </div>

        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $prestasiItem->featured ?? false) ? 'checked' : '' }} />
                <span class="text-sm">Tandai sebagai unggulan</span>
            </label>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary text-charcoal font-bold rounded-xl">Simpan</button>
    </form>
</x-admin.cms-form-shell>
@endsection





