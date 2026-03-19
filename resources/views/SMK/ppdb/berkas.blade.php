@extends('layouts.SMK.ppdb')

@section('ppdb-content')
<div class="flex-grow pt-24 pb-12 px-4 md:px-8 max-w-5xl mx-auto w-full">
<!-- Process Stepper -->
<section class="mb-12">
<div class="flex items-center justify-between relative max-w-2xl mx-auto">
<div class="absolute top-1/2 left-0 w-full h-0.5 bg-surface-container-high -translate-y-1/2 -z-10"></div>
<!-- Step 1: Done -->
<div class="flex flex-col items-center gap-2">
<div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center shadow-lg border-4 border-white">
<span class="material-symbols-outlined text-on-primary-fixed" data-icon="check" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<span class="text-[10px] md:text-xs font-medium text-on-surface-variant">Step 1: Bio</span>
</div>
<!-- Step 2: Active -->
<div class="flex flex-col items-center gap-2">
<div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center shadow-xl border-4 border-white">
<span class="material-symbols-outlined text-white" data-icon="description">description</span>
</div>
<span class="text-xs md:text-sm font-bold text-on-surface">Step 2: Jurusan &amp; Dokumen</span>
</div>
<!-- Step 3: Future -->
<div class="flex flex-col items-center gap-2">
<div class="w-12 h-12 rounded-full bg-white/60 backdrop-blur-md flex items-center justify-center shadow-sm border-2 border-surface-container-high">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="payments">payments</span>
</div>
<span class="text-[10px] md:text-xs font-medium text-on-surface-variant">Step 3: Pembayaran</span>
</div>
</div>
</section>
<!-- Form Content -->
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
<div class="relative group">
<select class="w-full bg-surface-container-low border-none rounded-xl px-4 py-4 appearance-none focus:ring-0 focus:bg-white transition-all text-on-surface font-medium">
<option disabled="" selected="" value="">Pilih Jurusan Utama Anda</option>
<option>Teknik Kendaraan Ringan</option>
<option>Teknik Sepeda Motor</option>
<option>Teknik Jaringan Komputer</option>
<option>Multimedia/DKV</option>
<option>Manajemen Perkantoran</option>
<option>Akuntansi</option>
</select>
<div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="expand_more">expand_more</span>
</div>
<div class="w-full h-0.5 bg-primary transform scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300 origin-left mt-[-2px]"></div>
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
<span class="text-xs font-bold text-on-surface mb-2">Upload Kartu Keluarga</span>
<span class="text-[10px] text-on-surface-variant">Klik untuk cari file</span>
</div>
<input class="hidden" type="file"/>
</label>
</div>
<!-- Upload Card 2 -->
<div class="flex flex-col">
<label class="group cursor-pointer">
<div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="article">article</span>
<span class="text-xs font-bold text-on-surface mb-2">Upload Ijazah/SKL</span>
<span class="text-[10px] text-on-surface-variant">Klik untuk cari file</span>
</div>
<input class="hidden" type="file"/>
</label>
</div>
<!-- Upload Card 3 -->
<div class="flex flex-col">
<label class="group cursor-pointer">
<div class="aspect-[4/5] bg-surface-container-low rounded-xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-6 text-center group-hover:bg-primary-container/10 group-hover:border-primary transition-all duration-300">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-4 text-3xl" data-icon="account_circle">account_circle</span>
<span class="text-xs font-bold text-on-surface mb-2">Upload Pas Foto</span>
<span class="text-[10px] text-on-surface-variant">Format 3x4 (Latar Merah)</span>
</div>
<input class="hidden" type="file"/>
</label>
</div>
</div>
</section>
<!-- Navigation Actions -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
<button class="w-full sm:w-auto px-8 py-4 text-primary font-bold hover:bg-primary/5 rounded-3xl transition-colors order-2 sm:order-1">
                        Kembali ke Step 1
                    </button>
<button class="w-full sm:w-auto bg-primary text-on-primary-fixed px-12 py-4 rounded-3xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all duration-300 order-1 sm:order-2 flex items-center justify-center gap-2">
                        Next to Payment
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</div>
</div>
</div>
@endsection

@section('ppdb-footer')
<!-- BottomNavBar (Mobile) -->
<nav class="fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-4 pt-2 md:hidden bg-white/60 dark:bg-[#1c190d]/60 backdrop-blur-2xl z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(28,25,13,0.06)]">
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-lexend text-[10px] font-medium">Home</span>
</div>
<div class="flex flex-col items-center justify-center bg-[#f2cc0d] text-[#1c190d] rounded-2xl p-2 min-w-[64px]">
<span class="material-symbols-outlined" data-icon="track_changes" style="font-variation-settings: 'FILL' 1;">track_changes</span>
<span class="font-lexend text-[10px] font-medium">Status</span>
</div>
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-lexend text-[10px] font-medium">Bantuan</span>
</div>
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-lexend text-[10px] font-medium">Profil</span>
</div>
</nav>
@endsection
