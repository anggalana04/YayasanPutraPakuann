@extends('layouts.SMK.ppdb')

@section('ppdb-content')
<div class="flex-grow pt-8 pb-12">
<div class="pb-20 px-4 md:px-8 max-w-5xl mx-auto">
<!-- Stepper Signature Component -->
<section class="pt-12 mb-12">
<div class="flex flex-row items-center justify-between w-full">
<!-- Step 1 (Done) -->
<div class="flex flex-col items-center flex-1">
<div class="w-14 h-14 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-green-500 font-bold">Langkah 1</p>
<h3 class="text-lg font-bold text-on-surface">Informasi Pribadi</h3>
</div>
</div>
<div class="hidden md:block h-0.5 bg-surface-container-highest flex-1 mx-2"></div>
<!-- Step 2 (Active) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg shadow-md">
02
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-primary font-bold">Langkah 2</p>
<h3 class="text-lg font-bold text-on-surface">Pilihan Jurusan & Berkas</h3>
</div>
</div>
<div class="hidden md:block h-0.5 bg-surface-container-highest flex-1 mx-2"></div>
<!-- Step 3 (Inactive) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface-variant font-bold text-lg">
03
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-on-surface-variant font-medium">Langkah 3</p>
<h3 class="text-lg font-bold text-on-surface-variant">Pembayaran</h3>
</div>
</div>
</div>
</section>
<!-- Error/Success Notification -->
@if ($errors->any())
    <div class="mb-6">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Terjadi kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if (session('success'))
    <div class="mb-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block text-sm">{{ session('success') }}</span>
        </div>
    </div>
@endif
<!-- Form Content -->
<form method="POST" action="{{ route('ppdb.berkas.update', ['school' => $school]) }}" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar: Tip/Instruction -->
        <aside class="lg:col-span-4 order-2 lg:order-1">
<div class="bg-surface-container-low rounded-xl p-8 sticky top-28">
<div class="text-4xl font-bold text-primary-dim mb-4">02</div>
<h2 class="text-2xl font-bold text-on-surface leading-tight mb-4">Pilihan Jurusan &amp; Berkas</h2>
<p class="text-on-surface-variant text-sm leading-relaxed">
                        Pastikan data yang Anda unggah memiliki format yang jelas. Dokumen yang diunggah harus dalam bentuk file gambar atau PDF maksimal 2MB.
                    </p>
<div class="mt-8 space-y-4">
<div class="flex items-center gap-3 text-sm text-on-surface">
<span class="material-symbols-outlined text-primary" data-icon="info">info</span>
<span>Format: JPG, PNG, atau PDF</span>
</div>
<div class="flex items-center gap-3 text-sm text-on-surface">
<span class="material-symbols-outlined text-primary" data-icon="verified">verified</span>
<span>Dokumen asli / legalisir</span>
</div>
</div>
</div>
</aside>
        <!-- Main Form Column -->
        <div class="lg:col-span-8 order-1 lg:order-2 space-y-8">
            <!-- Major Selection -->
            <section class="bg-white rounded-xl p-8 shadow-[0_4px_20px_rgba(28,25,13,0.02)] border border-surface-container-high/20">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary" data-icon="school">school</span>
                    <h3 class="text-lg font-bold">Pilih Program Keahlian</h3>
                </div>
                <div class="relative group mb-4">
                    <select name="major_1" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-4 appearance-none focus:ring-0 focus:bg-white transition-all text-on-surface font-medium" required>
                        <option disabled selected value="">Pilih Jurusan Utama Anda</option>
                        <option value="Teknik Kendaraan Ringan" {{ old('major_1', $application->major_1 ?? '') == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                        <option value="Teknik Sepeda Motor" {{ old('major_1', $application->major_1 ?? '') == 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                        <option value="Teknik Jaringan Komputer" {{ old('major_1', $application->major_1 ?? '') == 'Teknik Jaringan Komputer' ? 'selected' : '' }}>Teknik Jaringan Komputer</option>
                        <option value="Multimedia/DKV" {{ old('major_1', $application->major_1 ?? '') == 'Multimedia/DKV' ? 'selected' : '' }}>Multimedia/DKV</option>
                        <option value="Manajemen Perkantoran" {{ old('major_1', $application->major_1 ?? '') == 'Manajemen Perkantoran' ? 'selected' : '' }}>Manajemen Perkantoran</option>
                        <option value="Akuntansi" {{ old('major_1', $application->major_1 ?? '') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="expand_more">expand_more</span>
</div>
<div class="w-full h-0.5 bg-primary transform scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300 origin-left -mt-0.5"></div>
                </div>
                <!-- Pilihan Jurusan Kedua -->
                <div class="relative group">
                    <select name="major_2" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-4 appearance-none focus:ring-0 focus:bg-white transition-all text-on-surface font-medium">
                        <option disabled selected value="">Pilih Jurusan Kedua Anda</option>
                        <option value="Teknik Kendaraan Ringan" {{ old('major_2', $application->major_2 ?? '') == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                        <option value="Teknik Sepeda Motor" {{ old('major_2', $application->major_2 ?? '') == 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                        <option value="Teknik Jaringan Komputer" {{ old('major_2', $application->major_2 ?? '') == 'Teknik Jaringan Komputer' ? 'selected' : '' }}>Teknik Jaringan Komputer</option>
                        <option value="Multimedia/DKV" {{ old('major_2', $application->major_2 ?? '') == 'Multimedia/DKV' ? 'selected' : '' }}>Multimedia/DKV</option>
                        <option value="Manajemen Perkantoran" {{ old('major_2', $application->major_2 ?? '') == 'Manajemen Perkantoran' ? 'selected' : '' }}>Manajemen Perkantoran</option>
                        <option value="Akuntansi" {{ old('major_2', $application->major_2 ?? '') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="expand_more">expand_more</span>
</div>
<div class="w-full h-0.5 bg-primary transform scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300 origin-left -mt-0.5"></div>
                </div>
            </section>
            <!-- Document Upload Grid -->
            <section class="bg-white rounded-xl p-8 shadow-[0_4px_20px_rgba(28,25,13,0.02)] border border-surface-container-high/20">
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-primary" data-icon="cloud_upload">cloud_upload</span>
                    <h3 class="text-lg font-bold">Unggah Dokumen Pendukung</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Upload Card 1 -->
                    <div class="flex flex-col">
                        <label class="group cursor-pointer">
                            <div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="family_history">family_history</span>
                                <span class="text-xs font-bold text-on-surface mb-2">Unggah Kartu Keluarga</span>
                                <span class="text-[10px] text-on-surface-variant">Klik untuk cari file</span>
                                @if(isset($application->kk_file) && $application->kk_file)
                                    <span class="block mt-2 text-xs text-green-600">{{ basename($application->kk_file) }}</span>
                                @endif
                                <span id="kk_file_name" class="block mt-2 text-xs text-blue-600"></span>
                            </div>
                            <input class="hidden" type="file" name="kk_file" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this, 2, 'kk_file_name')">
                        </label>
                    </div>
                    <!-- Upload Card 2 -->
                    <div class="flex flex-col">
                        <label class="group cursor-pointer">
                            <div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="article">article</span>
                                <span class="text-xs font-bold text-on-surface mb-2">Unggah Ijazah/SKL</span>
                                <span class="text-[10px] text-on-surface-variant">Klik untuk cari file</span>
                                @if(isset($application->ijazah_file) && $application->ijazah_file)
                                    <span class="block mt-2 text-xs text-green-600">{{ basename($application->ijazah_file) }}</span>
                                @endif
                                <span id="ijazah_file_name" class="block mt-2 text-xs text-blue-600"></span>
                            </div>
                            <input class="hidden" type="file" name="ijazah_file" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this, 2, 'ijazah_file_name')">
                        </label>
                    </div>
                    <!-- Upload Card 3 -->
                    <div class="flex flex-col">
                        <label class="group cursor-pointer">
                            <div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="account_circle">account_circle</span>
                                <span class="text-xs font-bold text-on-surface mb-2">Unggah Pas Foto</span>
                                <span class="text-[10px] text-on-surface-variant">Format 3x4 (Latar Merah)</span>
                                @if(isset($application->photo_file) && $application->photo_file)
                                    <span class="block mt-2 text-xs text-green-600">{{ basename($application->photo_file) }}</span>
                                @endif
                                <span id="photo_file_name" class="block mt-2 text-xs text-blue-600"></span>
                            </div>
                            <input class="hidden" type="file" name="photo_file" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this, 2, 'photo_file_name')">
                        </label>
                    </div>
                    <!-- Upload Card 4: Raport Semester -->
                    <div class="flex flex-col">
                        <label class="group cursor-pointer">
                            <div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="folder_open">folder_open</span>
                                <span class="text-xs font-bold text-on-surface mb-2">Unggah Raport Semester</span>
                                <span class="text-[10px] text-on-surface-variant">Klik untuk cari file</span>
                                @if(isset($application->raport_file) && $application->raport_file)
                                    <span class="block mt-2 text-xs text-green-600">{{ basename($application->raport_file) }}</span>
                                @endif
                                <span id="raport_file_name" class="block mt-2 text-xs text-blue-600"></span>
                            </div>
                            <input class="hidden" type="file" name="raport_file" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this, 2, 'raport_file_name')">
                        </label>
                    </div>
                    <!-- Upload Card 5: Prestasi / Sertifikat -->
                    <div class="flex flex-col">
                        <label class="group cursor-pointer">
                            <div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="workspace_premium">workspace_premium</span>
                                <span class="text-xs font-bold text-on-surface mb-2">Unggah Dokumen Prestasi</span>
                                <span class="text-[10px] text-on-surface-variant">Sertifikat / piagam (opsional)</span>
                                @if(isset($application->prestasi_file) && $application->prestasi_file)
                                    <span class="block mt-2 text-xs text-green-600">{{ basename($application->prestasi_file) }}</span>
                                @endif
                                <span id="prestasi_file_name" class="block mt-2 text-xs text-blue-600"></span>
                            </div>
                            <input class="hidden" type="file" name="prestasi_file" accept=".jpg,.jpeg,.png,.pdf" onchange="validateFileSize(this, 2, 'prestasi_file_name')">
                        </label>
                    </div>
                </div>
            </section>
            <!-- Navigation Actions -->

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                <a href="{{ route('ppdb.biodata', ['school' => $school]) }}" class="w-full sm:w-auto px-8 py-4 text-primary font-bold hover:bg-primary/5 rounded-3xl transition-colors order-2 sm:order-1 text-center">Kembali ke Step 1</a>
                <button type="submit" class="w-full sm:w-auto bg-primary text-on-primary-fixed px-12 py-4 rounded-3xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all duration-300 order-1 sm:order-2 flex items-center justify-center gap-2">
                    Next to Payment
                    <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
</form>
</div>
</div>
@endsection

@section('ppdb-footer')

@endsection




