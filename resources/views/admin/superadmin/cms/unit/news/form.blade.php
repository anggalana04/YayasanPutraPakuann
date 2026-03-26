@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah Berita' : 'Edit Berita') . ' - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Berita</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">
                {{ $mode === 'create' ? 'Tambah Berita' : 'Edit Berita' }}
            </h2>
            <p class="text-on-surface-variant">Sekolah: {{ $school->name }} ({{ strtoupper($schoolType) }})</p>
        </div>
        <a href="{{ route('admin.cms.berita.index', ['schoolType' => $schoolType]) }}"
           class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $isEdit = $mode === 'edit';
        $item = $newsItem;
        $publishedAtValue = $item?->published_at ? $item->published_at->format('Y-m-d\TH:i') : '';
    @endphp

    <form method="POST"
          action="{{ $isEdit ? route('admin.cms.berita.update', ['schoolType' => $schoolType, 'news' => $item->id]) : route('admin.cms.berita.store', ['schoolType' => $schoolType]) }}"
          enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="space-y-5 bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
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
                        <option value="draft" @selected(old('status', $item?->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $item?->status) === 'published')>Published</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 flex items-center gap-2 pt-1">
                    <input type="hidden" name="featured" value="0" />
                    <input type="checkbox" id="featured" name="featured" value="1"
                           @checked(old('featured', $item?->featured ?? false))
                           class="accent-primary" />
                    <label for="featured" class="text-sm font-medium">Featured / Pin</label>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Tanggal Publish</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', $publishedAtValue) }}"
                       class="w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                <p class="text-xs text-on-surface-variant">Jika status `published` dan kosong, sistem akan pakai `now()`.</p>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Excerpt</label>
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
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ganti/Upload Gambar</label>
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
</div>
@endsection

