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
            <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Konten</label>
            <textarea name="content" id="prestasi-content-input"
                      class="w-full">{{ old('content', $prestasiItem->content ?? '') }}</textarea>
            @error('content') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Gambar Utama <span class="font-normal text-slate-400">(opsional)</span></label>
                @if(!empty($prestasiItem->image_url))
                <div class="mt-2 mb-3">
                    <img src="{{ $prestasiItem->image_url }}" alt="Gambar prestasi" class="w-32 h-24 object-cover rounded-xl border border-slate-200">
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]" onchange="validateFileSize(this, 2)" />
                <p class="text-xs text-slate-400 mt-1"><strong>Maksimal 2 MB.</strong> Kosongkan jika tidak ingin mengganti.</p>
                @error('image') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500">Status</label>
                <select name="status" class="mt-2 w-full border rounded-xl px-3 py-2" required>
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
                <input type="hidden" name="featured" value="0" />
                <input type="checkbox" name="featured" value="1" {{ old('featured', $prestasiItem->featured ?? false) ? 'checked' : '' }} class="accent-primary" />
                <span class="text-sm font-medium">Tandai sebagai unggulan</span>
            </label>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
            {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Buat Prestasi' }}
        </button>
    </form>

    {{-- ═══════════════ Jodit WYSIWYG Editor ════════════════ --}}
    {{-- CSS: inject once, safe to repeat --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.css">

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

        function initJodit() {
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

        const editor = Jodit.make('#prestasi-content-input', {
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
            placeholder: 'Tulis konten prestasi di sini… Sisipkan teks, gambar, video, atau media lainnya.',
            allowResizeX: false,
            allowResizeY: true,
            showCharsCounter: true,
            showWordsCounter: false,
            toolbarAdaptive: true,
            toolbarSticky: false,
            disablePlugins: 'about',
        });
        } // end initJodit

        // Load Jodit JS dynamically so HTMX navigation works correctly.
        // On refresh Jodit is already cached; on first HTMX swap window.Jodit
        // would be undefined because dynamic <script src> injection is async.
        if (window.Jodit) {
            initJodit();
        } else {
            var joditScript = document.createElement('script');
            joditScript.src = 'https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.js';
            joditScript.onload = initJodit;
            document.head.appendChild(joditScript);
        }
    })();
    </script>

</x-admin.cms-form-shell>
@endsection

