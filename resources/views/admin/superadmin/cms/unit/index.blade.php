@extends('layouts.admin.app')

@section('title', 'CMS - ' . strtoupper($schoolType) . ' Putra Pakuan')

@section('content')
@php
    $isYayasan = strtolower($schoolType) === 'yayasan';
    $leaderTitle = $isYayasan ? 'Pimpinan Yayasan' : 'Kepala Sekolah';
    $welcomeTitle = $isYayasan ? 'Sambutan Pimpinan Yayasan' : 'Sambutan Kepala Sekolah';
@endphp
<div class="p-10 max-w-7xl mx-auto space-y-8">
    <div class="flex justify-between items-end gap-6">
        <div class="space-y-2">
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Superadmin CMS</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">
                @if ($isYayasan)
                    Ubah konten khusus Yayasan agar sesuai tampilan beranda (daftar pimpinan unit) beserta menu konten lainnya.
                @else
                    Ubah konten per sekolah: Kepala Sekolah (foto/nama/jabatan/sambutan) dan manajemen berita (CRUD).
                @endif
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.berita.index', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">newspaper</span>
                Kelola Berita
            </a>
            <a href="{{ route('admin.cms.prestasi.index', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">emoji_events</span>
                Kelola Prestasi
            </a>
            <a href="{{ route('admin.cms.galeri.index', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">photo_library</span>
                Kelola Galeri
            </a>
            <a href="{{ route('admin.cms.carousel.index', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">slideshow</span>
                Kelola Karousel
            </a>
            <a href="{{ route('admin.cms.guru.index', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 rounded-2xl font-bold text-sm hover:bg-primary/10 transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">people</span>
                Kelola Guru & Staf
            </a>
        </div>
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

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-7 space-y-6">
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
                <div class="mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">format_quote</span>
                    <h3 class="text-2xl font-extrabold text-[#1c190d]">
                        {{ $isYayasan ? 'Daftar Pimpinan Unit Yayasan' : $welcomeTitle }}
                    </h3>
                </div>

                @if ($isYayasan)
                    <form method="POST" action="{{ route('admin.cms.yayasan.principals.update', ['schoolType' => $schoolType]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            @foreach (($yayasanPrincipals ?? []) as $index => $principal)
                                @php
                                    $currentPhoto = old('principals.' . $index . '.photo_existing', $principal['photo_url'] ?? '');
                                    $currentVideo = old('principals.' . $index . '.video_existing', $principal['video_url'] ?? '');
                                    $currentPhotoPreview = $currentPhoto ?: asset('images/logo-putrapakuan.png');
                                @endphp
                                <div class="rounded-2xl border border-[#1c190d]/10 p-4 bg-white/70 space-y-4">
                                    <h4 class="text-sm font-extrabold text-[#1c190d] uppercase tracking-wider">Kartu {{ $index + 1 }}</h4>

                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Unit</label>
                                            <input type="text" name="principals[{{ $index }}][unit]"
                                                   value="{{ old('principals.' . $index . '.unit', $principal['unit'] ?? '') }}"
                                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                                   required>
                                        </div>
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nama Pimpinan</label>
                                            <input type="text" name="principals[{{ $index }}][name]"
                                                   value="{{ old('principals.' . $index . '.name', $principal['name'] ?? '') }}"
                                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                                   required>
                                        </div>
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jabatan</label>
                                            <input type="text" name="principals[{{ $index }}][title]"
                                                   value="{{ old('principals.' . $index . '.title', $principal['title'] ?? '') }}"
                                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                                   required>
                                        </div>

                                        <div class="col-span-12">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Deskripsi Singkat</label>
                                            <input type="text" name="principals[{{ $index }}][description]"
                                                   value="{{ old('principals.' . $index . '.description', $principal['description'] ?? '') }}"
                                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                                   required>
                                        </div>

                                        <div class="col-span-12 md:col-span-6 space-y-3">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Foto Pimpinan</label>
                                            <div class="w-24 h-24 rounded-xl border border-[#1c190d]/10 overflow-hidden bg-white">
                                                <img src="{{ $currentPhotoPreview }}"
                                                     alt="Preview foto pimpinan"
                                                     class="w-full h-full object-cover">
                                            </div>
                                            <input type="hidden" name="principals[{{ $index }}][photo_existing]" value="{{ $currentPhoto }}">
                                            <input type="file" name="principals[{{ $index }}][photo]" accept="image/*"
                                                   class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]">
                                            <p class="text-xs text-on-surface-variant">Kosongkan jika tidak ingin mengganti foto saat ini.</p>
                                        </div>
                                        <div class="col-span-12 md:col-span-6 space-y-3">
                                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Video Profil (opsional)</label>
                                            @if (!empty($currentVideo))
                                                <video class="w-full h-24 rounded-xl border border-[#1c190d]/10 bg-black/80 object-cover" muted controls playsinline>
                                                    <source src="{{ $currentVideo }}" type="video/mp4">
                                                </video>
                                            @else
                                                <div class="w-full h-24 rounded-xl border border-dashed border-[#1c190d]/20 bg-white flex items-center justify-center text-xs text-on-surface-variant">
                                                    Belum ada video
                                                </div>
                                            @endif
                                            <input type="hidden" name="principals[{{ $index }}][video_existing]" value="{{ $currentVideo }}">
                                            <input type="file" name="principals[{{ $index }}][video]" accept="video/mp4,video/webm,video/ogg,video/quicktime"
                                                   class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]">
                                            <p class="text-xs text-on-surface-variant">Kosongkan jika tidak ingin mengganti video saat ini.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                        class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                                    Simpan Daftar Pimpinan Yayasan
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                <form method="POST" action="{{ route('admin.cms.kepsek.update', ['schoolType' => $schoolType]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-5">
                        <div class="flex gap-6 items-start">
                            <div class="w-40 shrink-0">
                                <img
                                    src="{{ $homepage->kepsek_photo_url }}"
                                    alt="Kepsek photo preview"
                                    class="w-40 h-40 object-cover rounded-2xl border border-[#1c190d]/10 shadow-sm bg-white"
                                />
                            </div>

                            <div class="flex-1 space-y-2">
                                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Unggah Foto {{ $leaderTitle }}</label>
                                <input type="file" name="kepsek_photo" accept="image/*"
                                       class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#f2cc0d] file:text-[#1c190d]">
                                <p class="text-xs text-on-surface-variant">Kosongkan jika tidak ingin mengganti foto.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nama {{ $leaderTitle }}</label>
                                <input type="text" name="kepsek_name" value="{{ old('kepsek_name', $homepage->kepsek_name) }}"
                                       class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                       required>
                            </div>
                            <div class="col-span-12">
                                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jabatan</label>
                                <input type="text" name="kepsek_title" value="{{ old('kepsek_title', $homepage->kepsek_title) }}"
                                       class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                       required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Teks Sambutan</label>
                            <textarea name="kepsek_sambutan" rows="8"
                                      class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                      required>{{ old('kepsek_sambutan', $homepage->kepsek_sambutan) }}</textarea>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                    class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.cms.berita.index', ['schoolType' => $schoolType]) }}"
                               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                                Lanjut ke Berita
                            </a>
                        </div>
                    </div>
                </form>
                @endif
            </div>

            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
                <div class="mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">contact_phone</span>
                    <h3 class="text-2xl font-extrabold text-[#1c190d]">Informasi Kontak Hubungi Kami</h3>
                </div>

                <form method="POST" action="{{ route('admin.cms.contact.update', ['schoolType' => $schoolType]) }}">
                    @csrf

                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nomor WhatsApp</label>
                            <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $homepage->contact_whatsapp) }}"
                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                   placeholder="Contoh: 6282112345678">
                            <p class="mt-1 text-xs text-on-surface-variant">Gunakan format angka saja agar tombol chat otomatis berjalan.</p>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Email Kontak</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email', $homepage->contact_email) }}"
                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                   placeholder="info@sekolah.sch.id">
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nomor Telepon</label>
                            <input type="text" name="contact_phone" value="{{ old('contact_phone', $homepage->contact_phone) }}"
                                   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                                   placeholder="Contoh: +62 21 1234 5678">
                        </div>

                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                            Simpan Informasi Kontak
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-5 space-y-4">
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">feed</span>
                    <h3 class="text-2xl font-extrabold text-[#1c190d]">Snapshot Berita</h3>
                </div>

                @if ($latestNews->isEmpty())
                    <p class="text-on-surface-variant text-sm">Belum ada berita yang dipublikasikan. Tambahkan lewat menu “Kelola Berita”.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($latestNews as $item)
                            <a href="{{ route('admin.cms.berita.edit', ['schoolType' => $schoolType, 'news' => $item->id]) }}"
                               class="block p-4 rounded-2xl border border-[#1c190d]/10 hover:border-primary/30 transition-colors bg-white">
                                <div class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                    {{ $item->category ?? 'Uncategorized' }}
                                </div>
                                <div class="font-extrabold text-[#1c190d] mt-1 line-clamp-1">{{ $item->title }}</div>
                                <div class="text-xs text-on-surface-variant mt-1">
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection






