@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah' : 'Edit') . ' Gambar Carousel - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-4xl mx-auto space-y-6">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">{{ $mode === 'create' ? 'Tambah' : 'Edit' }} Gambar Carousel</p>
            <h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
        </div>
        <a href="{{ route('admin.cms.carousel.index', ['schoolType' => $schoolType]) }}"
           class="px-5 py-2 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
            Kembali ke List
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

    <form method="POST" action="{{ $mode === 'create' ? route('admin.cms.carousel.store', ['schoolType' => $schoolType]) : route('admin.cms.carousel.update', ['schoolType' => $schoolType, 'carousel' => $item->id]) }}" enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5 space-y-6">
            <div class="space-y-2">
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
                        <label class="text-xs font-bold uppercase">Upload Video (opsional)</label>
                        <input type="file" name="video" accept="video/mp4,video/webm,video/ogg"
                               class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                        <p class="text-xs text-on-surface-variant/70">Bisa diupload file video. Jika terupload, ini akan menggantikan Video URL.</p>
                    </div>
                </div>

                @if ($mode === 'create')
                    <label class="text-xs font-bold uppercase">Upload Gambar (opsional)</label>
                    <input type="file" name="images[]" accept="image/*" multiple
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90" />
                    <p class="text-xs text-on-surface-variant/70">Pilih beberapa gambar sekaligus (Ctrl/cmd + klik). Format: JPG, PNG, GIF. Maksimal 2MB per gambar. Rekomendasi ukuran: 1920x1080px.</p>
                @else
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90" />
                    @if ($item->image_url)
                        <div class="mt-2">
                            <img src="{{ $item->image_url }}" alt="Current image" class="w-32 h-20 object-cover rounded-xl border" />
                            <p class="text-xs text-on-surface-variant/70 mt-1">Gambar saat ini. Upload gambar baru untuk mengganti.</p>
                        </div>
                    @endif
                    <p class="text-xs text-on-surface-variant/70">Format: JPG, PNG, GIF. Maksimal 2MB. Rekomendasi ukuran: 1920x1080px.</p>
                @endif
            </div>
        </div>

        <div class="flex gap-3 pt-6">
            <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all">
                {{ $mode === 'create' ? 'Tambah Gambar' : 'Simpan Perubahan' }}
            </button>
            <a href="{{ route('admin.cms.carousel.index', ['schoolType' => $schoolType]) }}"
               class="px-8 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
