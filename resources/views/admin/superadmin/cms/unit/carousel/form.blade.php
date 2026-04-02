@extends('layouts.admin.app')

@php
    $isFacilityMode = $isFacilityMode ?? false;
@endphp

@section('title', ($mode === 'create' ? 'Tambah' : 'Ubah') . ' ' . ($isFacilityMode ? 'Fasilitas' : 'Gambar Carousel') . ' - ' . strtoupper($schoolType))

@section('content')
<x-admin.cms-form-shell
    :eyebrow="$isFacilityMode ? 'Fasilitas' : 'Carousel'"
    :title="$mode === 'create' ? ($isFacilityMode ? 'Tambah Fasilitas' : 'Tambah Gambar Carousel') : ($isFacilityMode ? 'Ubah Fasilitas' : 'Ubah Gambar Carousel')"
    :subtitle="$school->name . ' (' . strtoupper($schoolType) . ')'"
    :back-url="route('admin.cms.carousel.index', ['schoolType' => $schoolType])"
    back-label="Kembali ke daftar"
>
    <form method="POST" action="{{ $mode === 'create' ? route('admin.cms.carousel.store', ['schoolType' => $schoolType]) : route('admin.cms.carousel.update', ['schoolType' => $schoolType, 'carousel' => $item->id]) }}" enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="space-y-6">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase">{{ $isFacilityMode ? 'Nama Fasilitas' : 'Judul Slide (opsional)' }}</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="{{ $isFacilityMode ? 'Contoh: Mushola, Toilet, Kolam Renang' : 'Contoh: Selamat Datang' }}" maxlength="100" {{ $isFacilityMode ? 'required' : '' }} />

                <label class="text-xs font-bold uppercase">{{ $isFacilityMode ? 'Deskripsi Fasilitas' : 'Deskripsi Slide (opsional)' }}</label>
                <textarea name="description" rows="2" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" maxlength="350" placeholder="{{ $isFacilityMode ? 'Contoh: Area ibadah yang nyaman untuk siswa dan staf.' : 'Contoh: Pilih program keahlian terbaik di SMK Putra Pakuan' }}">{{ old('description', $item->description ?? '') }}</textarea>

                @if (! $isFacilityMode)
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Gambar atau Video Carousel *</label>
                <p class="text-xs text-on-surface-variant/70">Anda bisa menggunakan gambar (jpg/png/gif) atau video (mp4/webm/ogg) per slide.</p>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-xs font-bold uppercase">Video URL (opsional)</label>
                        <input type="url" name="video_url" value="{{ old('video_url', $item->video_url ?? '') }}"
                               class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="https://example.com/video.mp4" />
                        <p class="text-xs text-on-surface-variant/70">Link ke file video online. Jika terisi, video akan diprioritaskan.</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase">Unggah Video (opsional)</label>
                        <input type="file" name="video" accept="video/mp4,video/webm,video/ogg"
                               class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                               onchange="validateFileSize(this, 20)" />
                        <p class="text-xs text-on-surface-variant/70">Bisa diupload file video. Jika terupload, ini akan menggantikan Video URL. <strong>Maksimal 20 MB.</strong></p>
                    </div>
                </div>
                      @endif

                @if ($mode === 'create')
                          <label class="text-xs font-bold uppercase">Unggah Gambar {{ $isFacilityMode ? 'Fasilitas' : '(opsional)' }}</label>
                          <input type="file" name="{{ $isFacilityMode ? 'image' : 'images[]' }}" accept="image/*" {{ $isFacilityMode ? '' : 'multiple' }}
                              class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90"
                              onchange="{{ $isFacilityMode ? 'validateFileSize(this, 2)' : 'Array.from(this.files).forEach(f => { if(f.size > 2*1048576){ alert(\'File \' + f.name + \' terlalu besar. Maksimal 2 MB per gambar.\'); this.value=\'\'; } })' }}" />
                          <p class="text-xs text-on-surface-variant/70">{{ $isFacilityMode ? 'Format: JPG, PNG, GIF. Maksimal 2 MB. Gunakan foto fasilitas yang jelas.' : 'Pilih beberapa gambar sekaligus (Ctrl/cmd + klik). Format: JPG, PNG, GIF. Maksimal 2 MB per gambar. Rekomendasi ukuran: 1920x1080px.' }}</p>
                @else
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90"
                           onchange="validateFileSize(this, 2)" />
                    @if ($item->image_url)
                        <div class="mt-2">
                            <img src="{{ $item->image_url }}" alt="Current image" class="w-32 h-20 object-cover rounded-xl border" />
                            <p class="text-xs text-on-surface-variant/70 mt-1">Gambar saat ini. Unggah gambar baru untuk mengganti.</p>
                        </div>
                    @endif
                    <p class="text-xs text-on-surface-variant/70">{{ $isFacilityMode ? 'Format: JPG, PNG, GIF. Maksimal 2 MB.' : 'Format: JPG, PNG, GIF. Maksimal 2 MB. Rekomendasi ukuran: 1920x1080px.' }}</p>
                @endif
            </div>
        </div>

        <div class="flex gap-3 pt-6">
            <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all">
                {{ $mode === 'create' ? ($isFacilityMode ? 'Tambah Fasilitas' : 'Tambah Gambar') : 'Simpan Perubahan' }}
            </button>
            <a href="{{ route('admin.cms.carousel.index', ['schoolType' => $schoolType]) }}"
               class="px-8 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm">
                Batal
            </a>
        </div>
    </form>
</x-admin.cms-form-shell>
@endsection





