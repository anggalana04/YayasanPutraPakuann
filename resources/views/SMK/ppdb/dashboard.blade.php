@extends('layouts.SMK.ppdb')

@section('ppdb-content')
<div class="pt-28 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
<!-- Header Section -->
<div class="mb-12">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<p class="text-brand-yellow font-bold text-lg mb-1">Selamat Datang,</p>
<h1 class="text-4xl md:text-5xl font-extrabold text-brand-charcoal tracking-tighter leading-none">Ahmad Syarifuddin</h1>
</div>
<div class="bg-surface-container-low px-6 py-4 rounded-2xl border-l-4 border-brand-yellow">
<p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Application ID</p>
<p class="text-2xl font-black text-brand-charcoal font-headline">#PPDB-2024-0892</p>
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
<p class="text-on-surface-variant">Update terakhir: 24 Mei 2024</p>
</div>
<span class="bg-brand-yellow/20 text-brand-charcoal px-4 py-2 rounded-full text-sm font-bold animate-pulse">
                            Sedang Diverifikasi
                        </span>
</div>
<!-- Progress Bar Visual -->
<div class="relative pt-8 pb-12">
<div class="flex mb-2 items-center justify-between">
<div>
<span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-brand-charcoal bg-brand-yellow">
                                    Progress Verifikasi
                                </span>
</div>
<div class="text-right">
<span class="text-xs font-semibold inline-block text-brand-charcoal">
                                    45%
                                </span>
</div>
</div>
<div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-surface-container-high">
<div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-brand-yellow transition-all duration-1000" style="width:45%"></div>
</div>
</div>
<!-- Step Tracker (Vertical Editorial Style) -->
<div class="space-y-0 relative">
<div class="absolute left-6 top-0 bottom-0 w-0.5 bg-surface-container-high"></div>
<!-- Step 1: Done -->
<div class="relative flex gap-6 pb-10 items-start">
<div class="z-10 bg-brand-yellow text-brand-charcoal w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
<span class="material-symbols-outlined" data-icon="check" style="font-variation-settings: 'FILL' 0; font-weight: 700;">check</span>
</div>
<div>
<h3 class="font-bold text-lg text-brand-charcoal">Pendaftaran Terkirim</h3>
<p class="text-sm text-on-surface-variant">Dokumen telah kami terima secara digital pada 20 Mei 2024.</p>
</div>
</div>
<!-- Step 2: Active -->
<div class="relative flex gap-6 pb-10 items-start">
<div class="z-10 bg-white border-4 border-brand-yellow text-brand-yellow w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
<span class="material-symbols-outlined" data-icon="pending" style="font-variation-settings: 'FILL' 1;">pending</span>
</div>
<div>
<h3 class="font-bold text-lg text-brand-charcoal">Verifikasi Berkas</h3>
<p class="text-sm text-on-surface-variant">Tim administrasi sedang meninjau keaslian dokumen pendukung Anda.</p>
</div>
</div>
<!-- Step 3: Pending -->
<div class="relative flex gap-6 pb-10 items-start opacity-40">
<div class="z-10 bg-surface-container-high text-on-surface-variant w-12 h-12 rounded-full flex items-center justify-center">
<span class="material-symbols-outlined" data-icon="groups">groups</span>
</div>
<div>
<h3 class="font-bold text-lg text-brand-charcoal">Jadwal Wawancara</h3>
<p class="text-sm text-on-surface-variant">Undangan wawancara akan dikirimkan melalui WhatsApp &amp; Email.</p>
</div>
</div>
<!-- Step 4: Pending -->
<div class="relative flex gap-6 items-start opacity-40">
<div class="z-10 bg-surface-container-high text-on-surface-variant w-12 h-12 rounded-full flex items-center justify-center">
<span class="material-symbols-outlined" data-icon="school">school</span>
</div>
<div>
<h3 class="font-bold text-lg text-brand-charcoal">Hasil Akhir</h3>
<p class="text-sm text-on-surface-variant">Pengumuman kelulusan dan prosedur daftar ulang.</p>
</div>
</div>
</div>
</section>
<!-- Program Selection Summary (Bento Style) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="bg-brand-charcoal p-8 rounded-xl text-white flex flex-col justify-between min-h-[180px]">
<div>
<span class="text-brand-yellow text-xs font-bold tracking-widest uppercase mb-2 block">Pilihan Pertama</span>
<h3 class="text-2xl font-bold">Teknik Komputer & Jaringan</h3>
</div>
<div class="flex items-center gap-2 text-white/60 text-sm">
<span class="material-symbols-outlined text-sm" data-icon="info">info</span>
                            Kuota Tersisa: 12 Kursi
                        </div>
</div>
<div class="bg-surface-container-high p-8 rounded-xl flex flex-col justify-between min-h-[180px]">
<div>
<span class="text-brand-charcoal/50 text-xs font-bold tracking-widest uppercase mb-2 block">Pilihan Kedua</span>
<h3 class="text-2xl font-bold text-brand-charcoal">Multimedia (DKV)</h3>
</div>
<button class="text-brand-yellow font-bold text-sm flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Ubah Pilihan <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</div>
</div>
<!-- Right Column: Sidebar Info & Contact -->
<div class="space-y-8">
<!-- Profile Action Card -->
<div class="bg-white p-6 rounded-xl shadow-[0_4px_20px_rgba(28,25,13,0.04)]">
<div class="flex items-center gap-4 mb-6">
<div class="w-16 h-16 rounded-full bg-brand-yellow/10 flex items-center justify-center overflow-hidden">
<img alt="Profile Picture" class="w-full h-full object-cover" data-alt="Student profile portrait picture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCix3S2dGwgPpGn8Z6mm9KUNBjFnZoEk-bL-0OCQxfc2Fp_OTyXrL2sevXNvsuDFoyrzU-Tp3arjp-K6NKKbbmdU6Zhss5HCge909XfJ0D5jDEDNFhJwHpRE9TcS8zA9RnDpCF1UZ7g5wwXLIb6WYikj8RKMB8aNiZ2Fs4JxC21fjcfcaz2RA0e1YMnasKABQkioci-ySScbs6KjfB6uwrZvpCGhPJ5UpU1V478cZ6YRlSujotZQaAvsld2Ltk692diqCDsdJKO20"/>
</div>
<div>
<h4 class="font-bold text-brand-charcoal">Ahmad Syarifuddin</h4>
<p class="text-xs text-on-surface-variant">Calon Peserta Didik</p>
</div>
</div>
<div class="space-y-3">
<button class="w-full flex items-center justify-between p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-brand-charcoal/60 group-hover:text-brand-yellow" data-icon="person_edit">person_edit</span>
<span class="text-sm font-medium">Lengkapi Profil</span>
</div>
<span class="material-symbols-outlined text-sm text-on-surface-variant" data-icon="chevron_right">chevron_right</span>
</button>
<button class="w-full flex items-center justify-between p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-brand-charcoal/60 group-hover:text-brand-yellow" data-icon="cloud_download">cloud_download</span>
<span class="text-sm font-medium">Unduh Kartu Peserta</span>
</div>
<span class="material-symbols-outlined text-sm text-on-surface-variant" data-icon="chevron_right">chevron_right</span>
</button>
<form method="POST" action="{{ route('ppdb.logout', ['school' => $school]) }}" class="w-full">
    @csrf
    <button type="submit" class="w-full flex items-center justify-between p-4 rounded-xl bg-red-50 hover:bg-red-100 transition-colors group">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-red-500" data-icon="logout">logout</span>
            <span class="text-sm font-medium text-red-700">Keluar</span>
        </div>
        <span class="material-symbols-outlined text-sm text-red-500" data-icon="chevron_right">chevron_right</span>
    </button>
</form>
</div>
</div>
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
<a class="p-4 bg-surface-container-low rounded-xl text-center hover:bg-brand-yellow/10 transition-colors" href="#">
<span class="material-symbols-outlined block mb-2 text-brand-charcoal" data-icon="menu_book">menu_book</span>
<span class="text-[10px] font-bold uppercase">Panduan</span>
</a>
<a class="p-4 bg-surface-container-low rounded-xl text-center hover:bg-brand-yellow/10 transition-colors" href="#">
<span class="material-symbols-outlined block mb-2 text-brand-charcoal" data-icon="question_answer">question_answer</span>
<span class="text-[10px] font-bold uppercase">FAQ</span>
</a>
</div>
</div>
</div>
</div>
@endsection

@section('ppdb-footer')
<!-- BottomNavBar (Mobile Only) -->
<nav class="fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-4 pt-2 md:hidden bg-white/60 backdrop-blur-2xl z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(28,25,13,0.06)]">
<a class="flex flex-col items-center justify-center text-brand-charcoal/50 p-2" href="#">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-lexend text-[10px] font-medium">Home</span>
</a>
<a class="flex flex-col items-center justify-center bg-brand-yellow text-brand-charcoal rounded-2xl p-2 min-w-[64px] active:scale-90 duration-200" href="#">
<span class="material-symbols-outlined" data-icon="track_changes" style="font-variation-settings: 'FILL' 1;">track_changes</span>
<span class="font-lexend text-[10px] font-medium">Status</span>
</a>
<a class="flex flex-col items-center justify-center text-brand-charcoal/50 p-2" href="#">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-lexend text-[10px] font-medium">Bantuan</span>
</a>
<a class="flex flex-col items-center justify-center text-brand-charcoal/50 p-2" href="#">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-lexend text-[10px] font-medium">Profil</span>
</a>
</nav>
@endsection
