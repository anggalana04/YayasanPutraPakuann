@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah Berita' : 'Edit Berita') . ' - ' . strtoupper($schoolType))

@section('content')
<x-admin.cms-form-shell
    eyebrow="Berita"
    :title="$mode === 'create' ? 'Tambah Berita' : 'Edit Berita'"
    :subtitle="$school->name . ' (' . strtoupper($schoolType) . ')'"
    :back-url="route('admin.cms.berita.index', ['schoolType' => $schoolType])"
>
    @php
        $isEdit = $mode === 'edit';
        $item = $newsItem;
    @endphp

    <form method="POST"
          action="{{ $isEdit ? route('admin.cms.berita.update', ['schoolType' => $schoolType, 'news' => $item->id]) : route('admin.cms.berita.store', ['schoolType' => $schoolType]) }}"
          enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="space-y-5">
            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Judul</label>
                <input type="text" name="title" value="{{ old('title', $item?->title) }}"
                       class="w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                       required>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $item?->category) }}"
                           class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status</label>
                    <select name="status"
                            class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                            required>
                        <option value="draft" @selected(old('status', $item?->status) === 'draft')>Draf</option>
                        <option value="published" @selected(old('status', $item?->status) === 'published')>Diterbitkan</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 flex items-center gap-2 pt-1">
                    <input type="hidden" name="featured" value="0" />
                    <input type="checkbox" id="featured" name="featured" value="1"
                           @checked(old('featured', $item?->featured ?? false))
                           class="accent-primary" />
                    <label for="featured" class="text-sm font-medium">Unggulan / Sematkan</label>
                </div>
            </div>

            <div class="px-4 py-3 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm">
                Tanggal publish diisi otomatis saat status diubah ke <span class="font-bold">Diterbitkan</span>.
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ringkasan</label>
                <textarea name="excerpt" rows="3"
                          class="w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('excerpt', $item?->excerpt) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Konten</label>
                <textarea name="content" rows="8"
                          class="w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                          required>{{ old('content', $item?->content) }}</textarea>
            </div>

            <div class="flex gap-6 items-start">
                <div class="w-32 shrink-0">
                    @if ($item?->image_url)
                        <img src="{{ $item->image_url }}" class="w-32 h-32 object-cover rounded-2xl border border-[#1c190d]/10 bg-white" alt="news image preview">
                    @else
                        <div class="w-32 h-32 rounded-2xl bg-[#1c190d]/5 border border-[#1c190d]/10"></div>
                    @endif
                </div>
                <div class="flex-1 space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ganti/Unggah Gambar</label>
                    <input type="file" name="image" accept="image/*"
                           class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]">
                    <p class="text-xs text-on-surface-variant">Kosongkan jika tidak ingin mengganti gambar.</p>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Buat Berita' }}
                </button>
            </div>
        </div>
    </form>
    </x-admin.cms-form-shell>
@endsection






