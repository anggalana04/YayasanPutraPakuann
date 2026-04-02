@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah' : 'Edit') . ' Jurusan - SMK Putra Pakuan')

@section('content')
<div class="p-10 max-w-5xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.cms.jurusan.index', ['schoolType' => 'smk']) }}"
           class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white border border-primary/20 hover:bg-primary/10 transition-colors">
            <span class="material-symbols-outlined text-primary text-base">arrow_back</span>
        </a>
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Superadmin CMS › SMK › Jurusan</p>
            <h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">
                {{ $mode === 'create' ? 'Tambah Jurusan Baru' : 'Edit Jurusan: ' . $jurusan->name }}
            </h2>
        </div>
    </div>

    {{-- Alerts --}}
    @if($errors->any())
    <div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    @php
        $actionUrl = $mode === 'create'
            ? route('admin.cms.jurusan.store', ['schoolType' => 'smk'])
            : route('admin.cms.jurusan.update', ['schoolType' => 'smk', 'jurusan' => $jurusan->id]);
    @endphp

    <form method="POST" action="{{ $actionUrl }}" enctype="multipart/form-data" id="jurusan-form">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="space-y-6">

            {{-- ── BASIC INFO ── --}}
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5 space-y-5">
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">info</span>
                    <h3 class="text-lg font-extrabold text-[#1c190d]">Informasi Dasar</h3>
                </div>

                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-12 md:col-span-8">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nama Jurusan <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required
                               value="{{ old('name', $jurusan?->name) }}"
                               placeholder="Contoh: Teknik Komputer dan Jaringan"
                               class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>

                    <div class="col-span-12 md:col-span-4">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Kode / Singkatan</label>
                        <input type="text" name="short_name" maxlength="50"
                               value="{{ old('short_name', $jurusan?->short_name) }}"
                               placeholder="Contoh: TKJ"
                               class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>

                    <div class="col-span-12">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Tagline</label>
                        <input type="text" name="tagline" maxlength="500"
                               value="{{ old('tagline', $jurusan?->tagline) }}"
                               placeholder="Contoh: Mencetak Teknisi Komputer dan Jaringan yang Kompeten"
                               class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>

                    <div class="col-span-12">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Deskripsi Singkat <span class="text-on-surface-variant font-normal">(untuk kartu di halaman daftar)</span></label>
                        <textarea name="description" rows="3" maxlength="2000"
                                  placeholder="Deskripsi singkat tentang program keahlian ini..."
                                  class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description', $jurusan?->description) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- ── APPEARANCE ── --}}
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5 space-y-5">
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">palette</span>
                    <h3 class="text-lg font-extrabold text-[#1c190d]">Tampilan</h3>
                </div>

                <div class="grid grid-cols-12 gap-6">

                    {{-- Cover Image --}}
                    <div class="col-span-12 md:col-span-6 space-y-3">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Foto / Cover Jurusan</label>
                        <div class="relative w-full h-44 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl overflow-hidden" id="cover-preview-wrap">
                            @if($mode === 'edit' && $jurusan->cover_image_url)
                            <img id="cover-preview" src="{{ $jurusan->cover_image_url }}" alt="Cover" class="w-full h-full object-cover">
                            @else
                            <div id="cover-preview-placeholder" class="w-full h-full flex flex-col items-center justify-center text-slate-400 text-sm gap-2">
                                <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                                <span>Klik untuk memilih gambar</span>
                            </div>
                            <img id="cover-preview" src="" alt="" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <input type="file" name="cover_image" accept="image/*" id="cover-input"
                               class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]"
                               onchange="previewCover(this)">
                        <p class="text-xs text-on-surface-variant">Maks 2 MB. Format: JPG, PNG, WebP.</p>
                    </div>

                    {{-- Icon & Color --}}
                    <div class="col-span-12 md:col-span-6 space-y-4">
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ikon Material Symbols</label>
                            <div class="mt-2 flex items-center gap-3">
                                <span id="icon-preview" class="material-symbols-outlined text-3xl" style="color: {{ old('accent_color', $jurusan?->accent_color ?? '#f2cc0d') }}">{{ old('icon', $jurusan?->icon ?? 'school') }}</span>
                                <input type="text" name="icon" id="icon-input"
                                       value="{{ old('icon', $jurusan?->icon ?? 'school') }}"
                                       placeholder="Contoh: computer, engineering, science"
                                       class="flex-1 bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                                       oninput="document.getElementById('icon-preview').textContent = this.value || 'school'">
                            </div>
                            <p class="mt-1 text-xs text-on-surface-variant">
                                Cari ikon di <a href="https://fonts.google.com/icons" target="_blank" class="text-primary underline">fonts.google.com/icons</a>
                            </p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Warna Aksen</label>
                            <div class="mt-2 flex items-center gap-3">
                                <input type="color" name="accent_color" id="accent-color-input"
                                       value="{{ old('accent_color', $jurusan?->accent_color ?? '#f2cc0d') }}"
                                       class="w-12 h-12 p-1 bg-white border rounded-xl cursor-pointer"
                                       oninput="updateAccentPreview(this.value)">
                                <input type="text" id="accent-color-text"
                                       value="{{ old('accent_color', $jurusan?->accent_color ?? '#f2cc0d') }}"
                                       class="flex-1 bg-white border rounded-xl p-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-primary/30"
                                       oninput="document.getElementById('accent-color-input').value = this.value; updateAccentPreview(this.value)">
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Urutan Tampil</label>
                            <input type="number" name="order_column" min="0"
                                   value="{{ old('order_column', $jurusan?->order_column ?? 0) }}"
                                   class="mt-2 w-32 bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <p class="mt-1 text-xs text-on-surface-variant">Angka lebih kecil = tampil lebih awal.</p>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                       {{ old('is_active', $jurusan?->is_active ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                            <span class="text-sm font-bold text-[#1c190d]">Tampilkan di halaman publik</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── RICH CONTENT (Jodit) ── --}}
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
                <div class="flex items-center gap-3 mb-5">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">edit_note</span>
                    <div>
                        <h3 class="text-lg font-extrabold text-[#1c190d]">Konten Detail Halaman</h3>
                        <p class="text-xs text-on-surface-variant mt-0.5">Isi konten lengkap halaman jurusan. Sisipkan teks, gambar, video, audio, atau tabel di mana saja.</p>
                    </div>
                </div>

                {{-- Jodit Editor mounts on this textarea --}}
                <textarea name="content" id="content-input" class="w-full">{{ old('content', $jurusan?->content) }}</textarea>
            </div>

            {{-- Submit --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="px-8 py-3 bg-primary text-[#1c190d] font-black rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                    {{ $mode === 'create' ? 'Simpan Jurusan' : 'Perbarui Jurusan' }}
                </button>
                <a href="{{ route('admin.cms.jurusan.index', ['schoolType' => 'smk']) }}"
                   class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                    Batal
                </a>
            </div>

        </div>
    </form>
</div>

{{-- ═══════════════ Jodit WYSIWYG Editor ════════════════ --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.css">
<script src="https://cdn.jsdelivr.net/npm/jodit@3/build/jodit.min.js"></script>

<style>
/* Jodit design system overrides */
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
.jodit-workplace {
    background: #ffffff !important;
}
.jodit-wysiwyg {
    font-family: 'Lexend', sans-serif !important;
    font-size: 0.95rem !important;
    line-height: 1.75 !important;
    padding: 1.25rem 1.5rem !important;
    min-height: 380px !important;
}
.jodit-wysiwyg h1, .jodit-wysiwyg h2, .jodit-wysiwyg h3 {
    font-weight: 800;
    color: #1c190d;
    margin: 1rem 0 0.5rem;
}
.jodit-wysiwyg img {
    max-width: 100%;
    border-radius: 0.5rem;
}
.jodit-toolbar-button__button:hover {
    background: #f2cc0d22 !important;
}
</style>

<script>
const CSRF        = '{{ csrf_token() }}';
const UPLOAD_URL  = '{{ route("admin.cms.jurusan.media.upload") }}';

// ── Jodit: register custom audio button ──────────────────────────
Jodit.defaultOptions.controls.insertAudio = {
    tooltip: 'Sisipkan Audio',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>',
    exec: async function (editor) {
        const inp = document.createElement('input');
        inp.type   = 'file';
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
                } else {
                    alert('Gagal mengunggah audio.');
                }
            } catch (e) {
                alert('Gagal mengunggah audio. Coba lagi.');
            }
        };
        inp.click();
    }
};

// ── Initialize Jodit ──────────────────────────────────────────────
let joditEditor;

joditEditor = Jodit.make('#content-input', {
    height: 560,
    minHeight: 400,
    language: 'en',
    uploader: {
        url: UPLOAD_URL,
        format: 'json',
        method: 'POST',
        filesVariableName: function () { return 'file'; },
        headers: { 'X-CSRF-TOKEN': CSRF },
        prepareData: function (formData) {
            formData.append('_token', CSRF);
        },
        isSuccess: function (resp) {
            return !!(resp && resp.url);
        },
        getMessage: function (resp) {
            return resp.error || 'Upload gagal';
        },
        process: function (resp) {
            return {
                files:   resp.url ? [resp.url] : [],
                baseurl: '',
                path:    '',
                error:   resp.url ? 0 : 1,
                msg:     resp.error || '',
            };
        },
        defaultHandlerSuccess: function (data) {
            if (data.files && data.files.length) {
                data.files.forEach(function (url) {
                    joditEditor.s.insertImage(url);
                });
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
    buttonsMD: [
        'bold', 'italic', 'underline', '|',
        'ul', 'ol', '|',
        'font', 'fontsize', 'paragraph', '|',
        'image', 'video', 'table', 'link', '|',
        'undo', 'redo', '|',
        'fullsize', 'source', 'insertAudio',
    ],
    buttonsSM: [
        'bold', 'italic', '|',
        'ul', 'ol', '|',
        'image', 'video', 'link', '|',
        'undo', 'redo', '|',
        'fullsize', 'insertAudio',
    ],
    placeholder: 'Tulis konten jurusan di sini… Sisipkan teks, gambar, video, tabel, atau audio.',
    allowResizeX: false,
    allowResizeY: true,
    showCharsCounter: true,
    showWordsCounter: false,
    toolbarAdaptive: true,
    toolbarSticky: false,
    disablePlugins: 'about',
});

// Safety net: sync on form submit (Jodit already auto-syncs, this is extra)
document.getElementById('jurusan-form').addEventListener('submit', function () {
    document.getElementById('content-input').value = joditEditor.value;
});

// ── Helper: preview cover ──
function previewCover(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('cover-preview');
        const ph  = document.getElementById('cover-preview-placeholder');
        img.src = e.target.result;
        img.classList.remove('hidden');
        if (ph) ph.classList.add('hidden');
    };
    reader.readAsDataURL(input.files[0]);
}

// ── Helper: update accent color preview ──
function updateAccentPreview(val) {
    document.getElementById('icon-preview').style.color = val;
    document.getElementById('accent-color-text').value  = val;
    document.getElementById('accent-color-input').value = val;
}
</script>
@endsection
