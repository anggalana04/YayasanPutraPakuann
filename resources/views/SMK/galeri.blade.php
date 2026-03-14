@extends('layouts.SMK.app')

@section('content')
<!-- Hero Section -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto">
<nav class="flex mb-8 text-sm font-medium text-slate-400 gap-2">
<a class="hover:text-primary" href="{{ route('school.home', ['school' => 'smk']) }}">Beranda</a>
<span>/</span>
<span class="text-charcoal dark:text-white font-semibold">Galeri</span>
</nav>
<div class="flex flex-col md:flex-row md:items-end justify-between gap-10">
<div class="max-w-2xl">
<h1 class="text-5xl md:text-7xl font-black tracking-tight text-charcoal dark:text-white mb-6">
Lensa <span class="text-primary">Eksplorasi</span> Kami
</h1>
<p class="text-lg text-slate-500 dark:text-slate-300 leading-relaxed">
Dokumentasi momen berharga, prestasi gemilang, dan inovasi siswa SMK Putra Pakuan dalam menggapai masa depan yang cerah.
</p>
</div>
<div class="flex gap-4">
<button class="flex items-center gap-2 px-8 py-4 bg-white dark:bg-white/10 border border-primary/20 rounded-xl font-bold hover:bg-primary/10 dark:hover:bg-primary/10 transition-colors shadow-lg">
<span class="material-symbols-outlined">upload</span>
<span>Kirim Karya</span>
</button>
</div>
</div>
</section>
<!-- Categories Filter -->
<section class="py-8 px-6 lg:px-12 border-y border-primary/10 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm">
<div class="max-w-7xl mx-auto flex items-center gap-4 overflow-x-auto hide-scrollbar">
<button class="px-8 py-3 bg-primary text-charcoal rounded-full font-bold whitespace-nowrap shadow-md">Semua Media</button>
<button class="px-8 py-3 bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent rounded-full font-semibold transition-all whitespace-nowrap">Acara Sekolah</button>
<button class="px-8 py-3 bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent rounded-full font-semibold transition-all whitespace-nowrap">Laboratorium</button>
<button class="px-8 py-3 bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent rounded-full font-semibold transition-all whitespace-nowrap">Prestasi Siswa</button>
<button class="px-8 py-3 bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent rounded-full font-semibold transition-all whitespace-nowrap">Ekstrakurikuler</button>
<button class="px-8 py-3 bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent rounded-full font-semibold transition-all whitespace-nowrap">Kunjungan Industri</button>
</div>
</section>
<!-- Foto Terbaru Section -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto">
<div class="flex items-center justify-between mb-10">
<h2 class="text-3xl font-bold flex items-center gap-3">
<span class="material-symbols-outlined text-primary">photo_library</span>
Foto Terbaru
</h2>
<a class="text-primary font-bold flex items-center gap-1 group text-lg" href="#">
Lihat Semua <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
<div class="masonry-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <!-- Photo Card 1 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Siswa sedang berdiskusi di kelas modern" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOuVkZrDs6-i_CUM3uNxyvS22O2SSkz3b4DCxZzTCwtFk_645SqnVYkplO9USnPMR-xWI1FkKRVTSE2whKHx_f-0OkvBdGzMHgjUIaOqdYTHVJyRXqdzan_V2p90AU0NlfREmJiCHRurDPC5dz7v8Y5F0EH7POZjdJafcjegA6mQq3-t_vEorakMleo832LGUx2dtiUj3imLMzNEGspNi4eKfWh3eDev14LIbiK2LCe_tq5ZMkMPuCoQ0JO5kg9uztGZ0aVhf-bw"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Akademik</span>
            <h3 class="text-white font-bold leading-tight text-base">Diskusi Proyek Akhir Semester</h3>
        </div>
    </div>
    <!-- Photo Card 2 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Siswa bekerja dengan peralatan laboratorium komputer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDGZB90Np5jV-tWCTpqoMEZD-qISmlxfZ-9erceA4vAvumceBegK_uhQhJ20sz5v-cxnHQpCsiBWTNpEK99Pcv1wkKP6gs0LUm-ZGDB5concgdLiLtJwhzR7TZh4mfpsZRlh8pLkfEhexC-NsHsMzMbIBMtZfL7kgqStd27DsQUrM8NdKKhl9ShWuW3qaa94WnJfZXJgkGzZ7fpu_62WVX9-Z40-p4vY5FLboZxVzJVRF8MC8jOKnTwwDELrZRq-IELr6pPRWKTQ"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Teknik</span>
            <h3 class="text-white font-bold leading-tight text-base">Praktikum Jaringan Fiber Optic</h3>
        </div>
    </div>
    <!-- Photo Card 3 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Kegiatan wisuda kelulusan siswa sekolah" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJKBcluQI4dVqk3cPD3bAZeh6m8Tks2_ZiloDN8emHDvgnYeKv3MoSk6eSWCcVaOBz2P_FagejF9KhMgbH0IEnVs_TW7diDURbt8MtLTq2lr8Zz_AUtNTTbA3FNNQW0lYoEH5bEuV3Y4170OurJEMbY9j94Jm5IT2Kr8fcstse7GDBcJ393JVl-pAQ-nZTrGyT_0ZzwWcYyi6zHkDB0rZgBvnS3y-DNRoEAW5xMb8zluYo9nSwrTb5ufL_atZl4hwkv2TKPlI63w"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Event</span>
            <h3 class="text-white font-bold leading-tight text-base">Pelepasan Siswa Angkatan 2024</h3>
        </div>
    </div>
    <!-- Photo Card 4 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Siswa berlatih bola basket di lapangan sekolah" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMVQYk-m5B3dFCIJeeR1-BmQj2TVr8eVZxS9i4_q8hc1ECzTHWOEyWurSgCjRaXraYNppOI-MLpBW9gGuAIjInRM6oTzEm6sv-WUHqITmZh0WcYATIIVwVIsrqiX51L5qxfEBBkHAJIEmRKFuaa4x1Ovo2UzEPrylGXEFjWTh4aKSI2CbFrhNEmhnLJd341zIJ3nznQXc6LAdXdQW4kZtzNNRVWvI1QWWEJcoCq8OnbF_1un6Q4zSsaY6sRuPGMbek5s-iZz96Yw"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Ekskul</span>
            <h3 class="text-white font-bold leading-tight text-base">Latihan Rutin Tim Basket</h3>
        </div>
    </div>
    <!-- Photo Card 5 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Siswa mempresentasikan hasil karyanya di depan kelas" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6BhZzuFyoP3rq5qpkbgT_xbzdNmlajxy8MdSlqeDS4u94eVuFMHsKhOZIyd17sNr1FpoHg_j64taN_g_gxDhQrzIT14dNDcTeFb8G-Kp1gtqtRi5crSRrbpT-6YLAsh6tl5UvR4Rjyxv4NM-oqmXcANiBJpw3mIc1VW_nnAckitGQlhUYSisqj0HAnr2mrfNB_SqUiwaEW2TT5ov_yG5hJ-BrxHlm5SFfWanebjGQQidQkY20DDuewhDaFY7CFpvDB48ucxyjGg"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Presentasi</span>
            <h3 class="text-white font-bold leading-tight text-base">Final Pitching Business Plan</h3>
        </div>
    </div>
    <!-- Photo Card 6 -->
    <div class="group relative cursor-zoom-in overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md flex flex-col">
        <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Siswa bersantai di area komunal sekolah yang hijau" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1eJDe3dCni32ACldM4XEinMaTuNOlWhK2tMIjsEnYINdc5oyf82eBiMZ7W13vITs8LPomGscNfuVLLpv2Plm9MZtmk10TMAZ3vVl09q2eCepBKfApZSS9p5XVfbGba9Y3BJOV0rsBw39OxHQlCS7W_huirC1BsS6SEBX2UgOMM4n0JCJE8D4v1Tk2XtLRiG4QPcfUJes8jko_eE_9rYClMOqplwJmB95GWb0ie-J21Pxi7mCAsMOlHrcxaZ4o8dG8eRHdki6mug"/>
        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
            <span class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Fasilitas</span>
            <h3 class="text-white font-bold leading-tight text-base">Area Collaborative Space</h3>
        </div>
    </div>
</div>
</section>
<!-- Video Terbaru Section -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto bg-slate-100 dark:bg-white/2 rounded-xl my-16">
<div class="flex items-center justify-between mb-10">
<h2 class="text-3xl font-bold flex items-center gap-3">
<span class="material-symbols-outlined text-primary">videocam</span>
Video Pilihan
</h2>
<a class="text-primary font-bold flex items-center gap-1 group text-lg" href="#">
Kanal YouTube <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">open_in_new</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
<!-- Video Card 1 -->
<div class="group flex flex-col gap-4">
<div class="relative aspect-video overflow-hidden rounded-2xl cursor-pointer">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Thumbnail video profil sekolah" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbMfx1EEGYcwniasmc5x4uKwEebHeotULwcC5W1pogK-EUWK9--ndNVqBRbE3bH2690DxU_ebgMX_-NPPEUSa994xaEpcceswqGGKyF2qN09sv9UjWuzTxNIq7aWja0bw-Ke5jKWoW7QD9S9IfoXoomtEBcbGoyrDB1oDpLZ7e7r6k2-MqRUYR0AQ7xjTdJDFeaLjr1AhaQHicyEbGhu9LgJQPiilb69xI82RNgZSNPuYwj4ucUjLBf4mZD368geiD6jJ9-FZXHQ"/>
<div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-colors">
<div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-background-dark text-3xl fill-1">play_arrow</span>
</div>
</div>
<div class="absolute bottom-3 right-3 px-2 py-1 bg-black/80 text-white text-[10px] font-bold rounded">05:24</div>
</div>
<div>
<h3 class="font-bold text-lg mb-1 group-hover:text-primary transition-colors">Profil SMK Putra Pakuan 2024</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">Eksplorasi fasilitas dan program unggulan kami.</p>
</div>
</div>
<!-- Video Card 2 -->
<div class="group flex flex-col gap-4">
<div class="relative aspect-video overflow-hidden rounded-2xl cursor-pointer">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Thumbnail video dokumenter kegiatan industri" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsU5xbTD9TjTddRLTVwvbFlORYRRe8OJ3yjlmd6zBySQYQhmjiBotTu9nSx3f8s8ocDDiGdz3ykbzDnUXmzgf4zB2PG7HOC0TLDHKXRqO1gKOAQ9WOc548A4Mu42RmUiOrbzDH5tgUBswCEMzJoXx2z9Tkm4J2c-a9JhIYFblD-Q3uRn3oHhksmSL766oxEM4EGQDZ-JT5sQQxU-ur9XcXvXHmirch5eEjmqkCAoF2NB2q2W6l7XjzakvXAU4cAS_-d-lut83O1A"/>
<div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-colors">
<div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-background-dark text-3xl fill-1">play_arrow</span>
</div>
</div>
<div class="absolute bottom-3 right-3 px-2 py-1 bg-black/80 text-white text-[10px] font-bold rounded">12:40</div>
</div>
<div>
<h3 class="font-bold text-lg mb-1 group-hover:text-primary transition-colors">Kunjungan Industri PT. Inovasi</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">Wawasan langsung dari dunia kerja untuk siswa.</p>
</div>
</div>
<!-- Video Card 3 -->
<div class="group flex flex-col gap-4">
<div class="relative aspect-video overflow-hidden rounded-2xl cursor-pointer">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Thumbnail video seminar pendidikan" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtdWShTKDQ8Wg90KYgU8KWRo3TUm27cuJUqtUFtmR7zyCO_-qEOHm1pI0hEweOS6nWW_Fn9GxBR_ZcYY1YbHjF7989zRVUmDFOsvnSnZYDHhgVe1ZI86hVWHqBXfW1Rh4UdL2Dpz-yItwpfWhQCFnqWAujSTTEAs1tG1IZMUjkc6bD_HT1BvxlnsybU5PIwPhBDeTjQEmL3v4sZenPKe4VGWElEKvbcUCovytQaPowj_Cp2PgJ0f3uJQUUmt0ix2oN50OubSYrrw"/>
<div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-colors">
<div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-background-dark text-3xl fill-1">play_arrow</span>
</div>
</div>
<div class="absolute bottom-3 right-3 px-2 py-1 bg-black/80 text-white text-[10px] font-bold rounded">08:15</div>
</div>
<div>
<h3 class="font-bold text-lg mb-1 group-hover:text-primary transition-colors">Talkshow: Karir di Era Digital</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">Tips sukses membangun karir sejak bangku sekolah.</p>
</div>
</div>
</div>
</section>
<!-- Load More & Call to Action -->
<section class="py-24 px-6 text-center">
<button class="px-16 py-5 bg-primary text-charcoal font-black text-xl rounded-full shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all mb-16">
MUAT LEBIH BANYAK
</button>
<div class="max-w-4xl mx-auto p-16 bg-primary rounded-xl flex flex-col md:flex-row items-center justify-between gap-10 text-charcoal">
<div class="text-left">
<h2 class="text-4xl font-black mb-2 leading-tight">Ingin menjadi bagian dari kami?</h2>
<p class="font-medium opacity-80">Segera daftarkan dirimu dan raih masa depan gemilang di SMK Putra Pakuan.</p>
</div>
<button class="bg-charcoal text-white px-12 py-5 rounded-full font-bold hover:bg-slate-800 transition-colors whitespace-nowrap text-lg">
Daftar Online Sekarang
</button>
</div>
</section>
<!-- Simple Lightbox Mockup (Hidden by Default) -->
<div class="fixed inset-0 z-100 bg-background-light/95 backdrop-blur-xl hidden flex-col items-center justify-center p-8">
<button class="absolute top-8 right-8 w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center hover:bg-primary hover:text-background-dark transition-all">
<span class="material-symbols-outlined">close</span>
</button>
<div class="relative max-w-5xl w-full h-full flex items-center justify-center">
<button class="absolute left-0 w-12 h-12 bg-primary/5 rounded-full flex items-center justify-center hover:bg-primary/10 transition-all">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<img class="max-h-[80vh] rounded-2xl shadow-2xl" data-alt="Tampilan detail foto dalam lightbox" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxO8gk4xLbAPqB0h69ZU8bcdt_YIIcmBBH0TKVbW8IjFx8NxkbtObHHSX1Rym8bHG9W5-Hk9QK0HrUVN6QP9VNrfAJLGBi1uZTUCPTV0ub4vgrMekyAWF8yiHmpfdgubd5asdc6pd5GdaFmLdoPvDI13nlhOuAAJpNk1RQJItDW9-ASlU2TImIj_d0yP6qUzq8N3iKtfhLcLjMRcqnCUb4Ytg5J4tS7lDEBxk7KjIGr4uOTsPzyH7lZthCfgf1kTq4AdN41G3Qfg"/>
<button class="absolute right-0 w-12 h-12 bg-primary/5 rounded-full flex items-center justify-center hover:bg-primary/10 transition-all">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
<div class="mt-8 text-center">
<h4 class="text-xl font-bold text-charcoal">Diskusi Proyek Akhir Semester</h4>
<p class="text-slate-500">Dipublikasikan pada 24 Oktober 2023</p>
</div>
</div>
@endsection
