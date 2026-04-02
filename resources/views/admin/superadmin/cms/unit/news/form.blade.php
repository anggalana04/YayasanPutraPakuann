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
                <textarea name="content" id="news-content-input"
                          class="w-full"
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
                           class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]"
                           onchange="validateFileSize(this, 2)">
                    <p class="text-xs text-on-surface-variant">Format: JPG, PNG, GIF. <strong>Maksimal 2 MB.</strong> Kosongkan jika tidak ingin mengganti gambar.</p>
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

    {{-- ═══════════════ Jodit WYSIWYG Editor ════════════════ --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.js"></script>

    <style>
    .jodit-container {
        border-radius: 0.875rem !important;
        border: 1px solid #e5e7eb !important;
        overflow: hidden;
        font-family: 'Lexend', sans-serif !important;
    }
    .jodit-toolbar__box {
        background: #fafaf7 !important;
        border-bottom: 1px solid #e5e7eb !important;
    }
    .jodit-status-bar {
        background: #fafaf7 !important;
        border-top: 1px solid #e5e7eb !important;
        color: #6b7280 !important;
        font-size: 0.75rem !important;
    }
    .jodit-workplace { background: #ffffff !important; }
    .jodit-wysiwyg {
        font-family: 'Lexend', sans-serif !important;
        font-size: 0.95rem !important;
        line-height: 1.75 !important;
        padding: 1.25rem 1.5rem !important;
        min-height: 380px !important;
    }
    .jodit-wysiwyg img { max-width: 100%; border-radius: 0.5rem; }
    .jodit-toolbar-button__button:hover { background: #f2cc0d22 !important; }
    </style>

    <script>
    (function () {
        const CSRF       = '{{ csrf_token() }}';
        const UPLOAD_URL = '{{ route("admin.cms.jurusan.media.upload") }}';

        Jodit.defaultOptions.controls.insertAudio = {
            tooltip: 'Sisipkan Audio',
            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>',
            exec: async function (editor) {
                const inp = document.createElement('input');
                inp.type = 'file';
                inp.accept = 'audio/*';
                inp.onchange = async function () {
                    if (!inp.files[0]) return;
                    const fd = new FormData();
                    fd.append('file', inp.files[0]);
                    fd.append('_token', CSRF);
                    try {
                        const res  = await fetch(UPLOAD_URL, { method: 'POST', body: fd });
                        const json = await res.json();
                        if (json.url) {
                            editor.s.insertHTML('<p><audio controls src="' + json.url + '" style="width:100%;border-radius:8px;display:block;"></audio></p>');
                        }
                    } catch (e) {
                        alert('Gagal mengunggah audio. Coba lagi.');
                    }
                };
                inp.click();
            }
        };

        const editor = Jodit.make('#news-content-input', {
            height: 560,
            minHeight: 400,
            language: 'en',
            uploader: {
                url: UPLOAD_URL,
                format: 'json',
                method: 'POST',
                filesVariableName: function () { return 'file'; },
                headers: { 'X-CSRF-TOKEN': CSRF },
                prepareData: function (fd) { fd.append('_token', CSRF); },
                isSuccess: function (resp) { return !!(resp && resp.url); },
                getMessage: function (resp) { return resp.error || 'Upload gagal'; },
                process: function (resp) {
                    return {
                        files:   resp.url ? [resp.url] : [],
                        baseurl: '', path: '',
                        error:   resp.url ? 0 : 1,
                        msg:     resp.error || '',
                    };
                },
                defaultHandlerSuccess: function (data) {
                    if (data.files && data.files.length) {
                        data.files.forEach(function (url) { editor.s.insertImage(url); });
                    }
                },
            },
            buttons: [
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'superscript', 'subscript', '|',
                'ul', 'ol', 'indent', 'outdent', '|',
                'font', 'fontsize', 'brush', 'paragraph', '|',
                'image', 'video', 'table', 'link', '|',
                '\n',
                'align', '|',
                'undo', 'redo', '|',
                'hr', 'eraser', 'copyformat', '|',
                'fullsize', 'source', 'insertAudio',
            ],
            placeholder: 'Tulis konten berita di sini… Sisipkan teks, gambar, video, tabel, atau audio.',
            allowResizeX: false,
            allowResizeY: true,
            showCharsCounter: true,
            showWordsCounter: false,
            toolbarAdaptive: true,
            toolbarSticky: false,
            disablePlugins: 'about',
        });
    })();
    </script>
</x-admin.cms-form-shell>
@endsection



