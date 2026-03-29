@extends('layouts.SD.ppdb')

@section('ppdb-content')
<div class="pt-28 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
<!-- Header Section -->
<div class="mb-12">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<p class="text-brand-yellow font-bold text-lg mb-1">Selamat Datang,</p>
<h1 class="text-4xl md:text-5xl font-extrabold text-brand-charcoal tracking-tighter leading-none">{{ $application->full_name ?? '-' }}</h1>
</div>
<div class="bg-surface-container-low px-6 py-4 rounded-2xl border-l-4 border-brand-yellow">
<p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">ID Pendaftaran</p>
<p class="text-2xl font-black text-brand-charcoal font-headline">#{{ $application->application_id ?? '-' }}</p>
</div>
</div>
</div>
<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Left Column: Status Tracking -->
<div class="lg:col-span-2 space-y-8">
<!-- Status Card -->
<section class="glass-card p-8 rounded-xl shadow-[0_10px_40px_rgba(28,25,13,0.06)] overflow-hidden relative">
<div class="absolute top-0 right-0 w-32 h-32 bg-brand-yellow/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="text-2xl font-bold text-brand-charcoal">Status Pendaftaran</h2>
<p class="text-on-surface-variant">Update terakhir: {{ $application->updated_at ? $application->updated_at->format('d M Y') : '-' }}</p>
</div>
<span class="bg-brand-yellow/20 text-brand-charcoal px-4 py-2 rounded-full text-sm font-bold animate-pulse">
    {{ $application->status === 'payment_uploaded' ? 'Menunggu Verifikasi Pembayaran' : ($application->status ?? '-') }}
</span>
</div>
<!-- Step Tracker (Vertical Editorial Style) -->
@php
    $status = $application->status;
    $isAccepted = $status === 'accepted';
    $isRejected = $status === 'rejected';
    $isVerified = $status === 'verified';
    $isPaymentUploaded = $status === 'payment_uploaded';
    $step1Done = true;
    $step2Done = $isVerified || $isAccepted || $isRejected;
    $step3Done = $isPaymentUploaded || $isAccepted || $isRejected;
    $stepFinal = $isAccepted || $isRejected;
@endphp
<div class="space-y-0 relative">
<div class="absolute left-6 top-0 bottom-0 w-0.5 bg-surface-container-high"></div>
<!-- Step 1: Done -->
<div class="relative flex gap-6 pb-10 items-start">
    <div class="z-10 bg-brand-yellow text-brand-charcoal w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
        <span class="material-symbols-outlined" data-icon="check" style="font-variation-settings: 'FILL' 0; font-weight: 700;">check</span>
    </div>
    <div class="flex-1">
        <h3 class="font-bold text-lg text-brand-charcoal">Pendaftaran Terkirim</h3>
        <p class="text-sm text-on-surface-variant">Dokumen telah kami terima secara digital pada 20 Mei 2024.</p>
        <span class="text-xs text-on-surface-variant">Selesai: 20 Mei 2024</span>
    </div>

</div>
<!-- Step 2: Verifikasi Berkas -->
<div class="relative flex gap-6 pb-10 items-start">
    <div class="z-10 {{ $step2Done ? 'bg-brand-yellow text-brand-charcoal' : 'bg-white border-4 border-brand-yellow text-brand-yellow' }} w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
        <span class="material-symbols-outlined" data-icon="{{ $step2Done ? 'check' : 'pending' }}" style="font-variation-settings: 'FILL' {{ $step2Done ? '1' : '0' }}; font-weight: 700;">{{ $step2Done ? 'check' : 'pending' }}</span>
    </div>
    <div>
        <h3 class="font-bold text-lg text-brand-charcoal">Verifikasi Berkas</h3>
        <p class="text-sm text-on-surface-variant">Tim administrasi sedang meninjau keaslian dokumen pendukung Anda.</p>
        <span class="text-xs text-on-surface-variant">{{ $step2Done ? 'Selesai: 24 Mei 2024' : 'Menunggu verifikasi' }}</span>
    </div>
</div>
<!-- Step 4: Hasil Akhir -->
<div class="relative flex gap-6 items-start {{ $stepFinal ? '' : 'opacity-40' }}">
    <div class="z-10 w-12 h-12 rounded-full flex items-center justify-center {{ $isAccepted ? 'bg-green-500 text-white' : ($isRejected ? 'bg-red-500 text-white' : 'bg-surface-container-high text-on-surface-variant') }}">
        <span class="material-symbols-outlined text-3xl">
            {{ $isAccepted ? 'check_circle' : ($isRejected ? 'cancel' : 'school') }}
        </span>
    </div>
    <div>
        <h3 class="font-bold text-2xl {{ $isAccepted ? 'text-green-600' : ($isRejected ? 'text-red-600' : 'text-brand-charcoal') }}">Hasil Akhir</h3>
        @if($isAccepted)
            <p class="text-lg font-bold text-green-700">Selamat! Anda <span class="uppercase">DITERIMA</span> di SDIT Putra Pakuan.</p>
        @elseif($isRejected)
            <p class="text-lg font-bold text-red-700">Mohon maaf, Anda <span class="uppercase">TIDAK DITERIMA</span>.</p>
        @else
            <p class="text-sm text-on-surface-variant">Pengumuman kelulusan dan prosedur daftar ulang.</p>
        @endif
    </div>
</div>
</div>
</section>
<!-- Right Column: Sidebar Info & Contact -->
<div class="space-y-8">

<!-- Contact Info Card (From Image 1 context) -->
<div class="bg-brand-yellow/5 p-8 rounded-xl border border-brand-yellow/20">
<h3 class="text-lg font-bold text-brand-charcoal mb-6">Bantuan &amp; Informasi</h3>
<div class="space-y-6">
<div class="flex gap-4">
<div class="bg-brand-yellow text-brand-charcoal w-10 h-10 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-sm" data-icon="call">call</span>
</div>
<div>
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Hotline PPDB</p>
<p class="text-sm font-bold text-brand-charcoal">(0251) 123 4567</p>
<p class="text-xs text-on-surface-variant">Senin - Jumat (08:00 - 15:00)</p>
</div>
</div>
<div class="flex gap-4">
<div class="bg-brand-yellow text-brand-charcoal w-10 h-10 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-sm" data-icon="chat">chat</span>
</div>
<div>
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">WhatsApp Admin</p>
<p class="text-sm font-bold text-brand-charcoal">+62 812 3456 7890</p>
<p class="text-xs text-on-surface-variant">Respon cepat chat via WA</p>
</div>
</div>
<div class="flex gap-4">
<div class="bg-brand-yellow text-brand-charcoal w-10 h-10 rounded-full flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-sm" data-icon="location_on">location_on</span>
</div>
<div>
<p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Lokasi Kampus</p>
<p class="text-sm font-bold text-brand-charcoal">Jl. Raya Pajajaran No. 123</p>
<p class="text-xs text-on-surface-variant">Bogor Timur, Kota Bogor</p>
</div>
</div>
</div>
<button class="w-full mt-8 py-4 bg-brand-charcoal text-brand-yellow rounded-xl font-bold flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined" data-icon="support_agent">support_agent</span>
                        Hubungi Petugas
                    </button>
</div>
<!-- Quick Links -->
<div class="grid grid-cols-2 gap-4">
<a class="p-4 bg-surface-container-low rounded-xl text-center hover:bg-brand-yellow/10 transition-colors" href="{{ route('school.ppdb', ['school' => $school]) }}">
<span class="material-symbols-outlined block mb-2 text-brand-charcoal" data-icon="menu_book">menu_book</span>
<span class="text-[10px] font-bold uppercase">Panduan</span>
</a>
<a class="p-4 bg-surface-container-low rounded-xl text-center hover:bg-brand-yellow/10 transition-colors" href="{{ route('school.kontak', ['school' => $school]) }}">
<span class="material-symbols-outlined block mb-2 text-brand-charcoal" data-icon="question_answer">question_answer</span>
<span class="text-[10px] font-bold uppercase">FAQ</span>
</a>
</div>
</div>
</div>
</div>
@endsection

@section('ppdb-footer')

@endsection





