@extends('layouts.SMK.app')

@section('content')
<!-- Breadcrumb -->
<div class="w-full max-w-7xl mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.home', ['school' => request()->route('school')]) }}">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white">Berita</span>
    </div>
</div>

<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-8 py-6 lg:py-12">
<div class="w-full max-w-7xl flex flex-col gap-10">

<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div class="flex flex-col gap-3">
        <div class="max-w-2xl">
            <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-3 text-charcoal dark:text-white">
                Berita & Pengumuman SMK
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">Informasi terbaru untuk siswa, guru, dan orang tua SMK Putra Pakuan.</p>
        </div>
    </div>
    <div class="w-full lg:w-auto lg:min-w-[360px]">
        <label class="flex w-full items-center h-12 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all shadow-sm">
            <div class="pl-4 flex items-center justify-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input class="w-full bg-transparent border-none text-charcoal dark:text-white placeholder:text-slate-500 dark:placeholder:text-slate-400 focus:ring-0 px-3 text-sm font-medium" placeholder="Cari berita, acara, pengumuman..."/>
        </label>
    </div>
</div>

<section class="@container">
<div class="relative rounded-2xl overflow-hidden shadow-lg shadow-primary/10 dark:shadow-none group">
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
<div class="w-full aspect-[16/9] lg:aspect-[21/9] bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="SMK students working together on a project" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBXTr5_nf4YDXijJkEYlyCT8Y7n_CVHM4HFqpNz36YAVMFWFTkE67d0k_wJf7PgIW1ENUFJ8UbLPP3oR7sF-kGzmMcaQB0pArYm_OJ5o81LtwTMnX8lry8v9_jzEHvySKUx69jpxcqUu1PR8vWnc6-Kb90yQIvO8FJfxJzXKkMRgnhSJsl3niiD75xhJ3Id8N4c9kWWDXL3fXtmyqCSilQr__Fnw1MJD4xDkSfSjCrsyGCHN0dM8CpyltuSpX-DMHVlMFEIb6McG9M");'>
</div>
<div class="absolute bottom-0 left-0 w-full p-6 lg:p-10 z-20 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
<div class="max-w-3xl">
<div class="flex items-center gap-3 mb-3">
<span class="px-3 py-1 rounded bg-primary text-charcoal text-xs font-bold uppercase tracking-wider shadow-sm">Featured Event</span>
<span class="text-white/90 text-xs font-medium flex items-center gap-1 bg-black/30 px-2 py-1 rounded backdrop-blur-sm">
<span class="material-symbols-outlined text-[16px]">calendar_today</span> Oct 12, 2026
                            </span>
</div>
<h3 class="text-3xl lg:text-4xl font-bold leading-tight text-white mb-2">SMK Science Fair Registration Now Open</h3>
<p class="text-white/80 text-base lg:text-lg leading-relaxed line-clamp-2 max-w-2xl">
                                Siswa SMK diundang untuk menampilkan proyek inovatif. Tema tahun ini berfokus pada solusi energi terbarukan. Formulir pendaftaran tersedia mulai hari ini.
                            </p>
</div>
<button class="flex-shrink-0 flex items-center gap-2 bg-white text-charcoal px-6 py-3 rounded-lg font-bold hover:bg-primary transition-colors shadow-lg">
                            Baca Selengkapnya <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
</button>
</div>
</div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
<div class="lg:col-span-8 flex flex-col gap-10">
<div class="border-b border-slate-200 dark:border-slate-800">
<div class="flex overflow-x-auto pb-4 gap-6 scrollbar-hide">
<button class="text-charcoal dark:text-white font-bold border-b-2 border-primary pb-1 text-sm whitespace-nowrap">Semua Berita</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Akademik</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Event</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Kebijakan</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Kehidupan Siswa</button>
</div>
</div>

<div class="flex flex-col gap-8">
<!-- Example Article Card -->
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-slate-800 rounded-xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all hover:border-primary/20 cursor-pointer"
    onclick="window.location.href='{{ route('school.berita.detail', ['school' => request()->route('school')]) }}'">
    <div class="w-full md:w-1/3 aspect-video md:aspect-4/3 rounded-lg overflow-hidden relative">
        <div class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500" data-alt="SMK teacher helping students" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTyPsZB5w1LUk7djUDa91BJSOF4ndR7HXwKID8V_PicCKctO3A1ofuVd23fYLSJUUAwe60TUuByvW75N0eA2h_GNHYS2BJnpshQATTJGQdoaKhBw_iZoV47NuEWPP4BplM8jRdAsIDWeiVHCC0fgqeIgzL5m0U87nRj4cOSwO8_FVqQxHnEESytitQSxvGRwD726rWA0keEiAjl3KQU7EL8DEMBA_FaimBUxyjJ01yauYcdB6k9SihvZIlL-Nu27D5q7iRz5jztqs");'>
        </div>
        <div class="absolute top-2 left-2">
            <span class="px-2 py-1 rounded bg-primary text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">Kebijakan</span>
        </div>
    </div>
    <div class="flex-1 flex flex-col">
        <div class="flex items-center gap-2 mb-2 text-xs font-medium text-slate-500">
            <span class="material-symbols-outlined text-[16px]">schedule</span> Oct 10, 2026
        </div>
        <h3 class="text-xl font-bold leading-tight text-charcoal dark:text-white mb-2 group-hover:text-primary transition-colors">Protokol Baru Drop-off Siswa SMK</h3>
        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2 mb-4">
            Demi keamanan siswa, regulasi lalu lintas baru akan diterapkan di gerbang SMK mulai minggu depan. Silakan cek peta terbaru.
        </p>
        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-[#E5A800]" href="{{ route('school.berita.detail', ['school' => request()->route('school')]) }}">
                Baca Update <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
            </a>
            <button class="text-slate-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">share</span>
            </button>
        </div>
    </div>
</article>
<!-- Add more article cards as needed -->
</div>

<div class="flex justify-center pt-4">
<button class="px-8 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-charcoal dark:text-white rounded-lg font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-2 shadow-sm">
                            Muat Lebih Banyak
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
</button>
</div>
</div>

<aside class="lg:col-span-4 flex flex-col gap-6">
<div class="bg-charcoal dark:bg-slate-800 rounded-xl p-6 shadow-lg text-white relative overflow-hidden border border-primary">
<div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
<div class="absolute -left-10 -bottom-10 w-32 h-32 bg-primary/20 rounded-full blur-2xl"></div>
<div class="relative z-10">
<div class="flex items-center justify-between mb-6">
<h3 class="text-lg font-bold">Pengumuman Cepat</h3>
<span class="material-symbols-outlined text-primary">campaign</span>
</div>
<div class="flex flex-col gap-4">
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-12 bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Oct</span>
<span class="text-lg font-bold text-primary">24</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-primary transition-colors">Rapat Komite SMK</h4>
<p class="text-xs text-white/70 mt-1">Terbuka untuk semua perwakilan orang tua.</p>
</div>
</div>
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-12 bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Nov</span>
<span class="text-lg font-bold text-primary">01</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-primary transition-colors">Libur Hari Pahlawan</h4>
<p class="text-xs text-white/70 mt-1">SMK tutup untuk Hari Pahlawan.</p>
</div>
</div>
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-12 bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Nov</span>
<span class="text-lg font-bold text-primary">05</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-primary transition-colors">Diskon Toko Seragam</h4>
<p class="text-xs text-white/70 mt-1">Diskon 20% untuk perlengkapan musim dingin.</p>
</div>
</div>
</div>
<button class="w-full mt-4 text-xs font-bold uppercase tracking-wider text-primary hover:text-white transition-colors flex items-center justify-center gap-1">
                        Lihat Semua Pengumuman <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</button>
</div>
</div>

<div class="grid grid-cols-2 gap-4">
<a class="flex flex-col items-center justify-center p-6 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-xl hover:shadow-lg transition-all group hover:-translate-y-1 hover:border-primary/30" href="#">
<div class="w-12 h-12 rounded-full bg-red-600/10 flex items-center justify-center mb-3 group-hover:bg-red-600 group-hover:text-white transition-colors text-red-600">
<span class="material-symbols-outlined text-2xl">calendar_month</span>
</div>
<span class="text-sm font-bold text-charcoal dark:text-white">Kalender</span>
</a>
<a class="flex flex-col items-center justify-center p-6 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-xl hover:shadow-lg transition-all group hover:-translate-y-1 hover:border-primary/30" href="#">
<div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-charcoal transition-colors text-primary">
<span class="material-symbols-outlined text-2xl">menu_book</span>
</div>
<span class="text-sm font-bold text-charcoal dark:text-white">Buku Panduan</span>
</a>
</div>

<div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-6 border border-slate-100 dark:border-slate-700">
<h3 class="text-lg font-bold mb-1 text-charcoal dark:text-white">Langganan Berita</h3>
<p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Ringkasan mingguan, tanpa spam.</p>
<div class="flex gap-2">
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-sm px-3 py-2 focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="Alamat email" type="email"/>
<button class="bg-primary hover:bg-[#E5A800] text-charcoal rounded-lg px-4 py-2 text-sm font-bold transition-colors">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</aside>
</div>
</div>
</main>
@endsection
