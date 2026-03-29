@extends('layouts.SMK.app')

@section('title', 'SMK Putra Pakuan - Unggul, Berkarakter, Berdaya Saing')

@section('content')
<style>
/* Hero Carousel Styles */
.hero-carousel-container {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 100vh;
    overflow: hidden;
    padding: 0;
    box-sizing: border-box;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
    padding: 0;
    box-sizing: border-box;
}

.hero-slide.active {
    opacity: 1;
    pointer-events: auto;
    z-index: 1;
}

.hero-image,
.hero-media {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 0;
    transform: scale(1);
    transition: transform 0.35s ease-out;
}

.hero-slide.active .hero-image,
.hero-slide.active .hero-media {
    transform: scale(1.02);
}

.hero-carousel-container {
    min-height: 100vh;
    max-height: 100vh;
    width: 100%;
    margin: 0;
    border-radius: 0;
    box-shadow: none;
    overflow: hidden;
}

@media (max-width: 768px) {
    .hero-carousel-container {
        min-height: 100vh;
        max-height: 100vh;
        width: 100%;
        border-radius: 0;
    }
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(28, 25, 13, 0.25) 0%, rgba(28, 25, 13, 0.15) 50%, rgba(242, 204, 13, 0.1) 100%);
    z-index: 2;
}

.hero-text-overlay {
    position: absolute;
    inset: 0;
    z-index: 3;
    pointer-events: none;
}

.hero-overlay-title,
.hero-overlay-description {
    color: #ffffff;
    text-shadow: 0 8px 20px rgba(0, 0, 0, 0.55);
    opacity: 0;
    transform: translateY(16px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.hero-overlay-title {
    position: absolute;
    top: 10%;
    left: 10%;
    transform: translate(0, 0);
    font-size: clamp(1.8rem, 3.6vw, 4rem);
    font-weight: 900;
    max-width: 55%;
    line-height: 1.08;
    text-align: left;
    font-family: 'Playfair Display', 'Georgia', serif;
    letter-spacing: 0.02em;
    text-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
}

.hero-overlay-description {
    position: absolute;
    bottom: 14%;
    left: 50%;
    transform: translate(-50%, 0);
    font-size: clamp(1.05rem, 1.4vw, 1.45rem);
    font-weight: 500;
    max-width: 70%;
    text-align: center;
    line-height: 1.4;
    color: #fefcf7;
}

.hero-slide.active .hero-overlay-title,
.hero-slide.active .hero-overlay-description {
    opacity: 1;
    transform: translateY(0);
}

.hero-content {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    align-items: center;
}

.hero-text-content {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.hero-slide.active .hero-text-content {
    opacity: 1;
    transform: translateY(0);
}

.hero-badge {
    opacity: 0;
    transform: translateX(-20px);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
}

.hero-slide.active .hero-badge {
    opacity: 1;
    transform: translateX(0);
}

.hero-title {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
}

.hero-slide.active .hero-title {
    opacity: 1;
    transform: translateY(0);
}

.hero-description {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.5s;
}

.hero-slide.active .hero-description {
    opacity: 1;
    transform: translateY(0);
}

.hero-buttons {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.7s;
}

.hero-slide.active .hero-buttons {
    opacity: 1;
    transform: translateY(0);
}

.hero-stats {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.9s;
}

.hero-slide.active .hero-stats {
    opacity: 1;
    transform: translateY(0);
}

.carousel-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    opacity: 0;
}

.hero-carousel-container:hover .carousel-nav-btn {
    opacity: 1;
}

.carousel-nav-btn:hover {
    background: rgba(242, 204, 13, 0.3);
    border-color: rgba(242, 204, 13, 0.5);
    transform: translateY(-50%) scale(1.1);
}

.carousel-nav-btn.prev {
    left: 24px;
}

.carousel-nav-btn.next {
    right: 24px;
}

.carousel-dots {
    position: absolute;
    bottom: 32px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 12px;
}

.carousel-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
}

.carousel-dot::before {
    content: '';
    position: absolute;
    inset: -4px;
    border: 2px solid transparent;
    border-radius: 50%;
    transition: all 0.3s;
}

.carousel-dot.active {
    background: #FDB913;
    width: 40px;
    border-radius: 6px;
}

.carousel-dot.active::before {
    border-color: rgba(253, 185, 19, 0.3);
}

.carousel-dot:hover:not(.active) {
    background: rgba(255, 255, 255, 0.6);
    transform: scale(1.2);
}

/* Progress bar for autoplay */
.carousel-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(253, 185, 19, 0.5);
    width: 0;
    z-index: 11;
    transition: width 5s linear;
}

.carousel-progress.active {
    width: 100%;
}

@media (max-width: 768px) {
    .carousel-nav-btn {
        width: 44px;
        height: 44px;
        opacity: 1;
    }

    .carousel-nav-btn.prev {
        left: 12px;
    }

    .carousel-nav-btn.next {
        right: 12px;
    }

    .carousel-dots {
        bottom: 20px;
    }
}
</style>

<!-- Modern Hero Carousel -->
<section class="relative min-h-screen">
    @php
        $heroSlides = $carouselImages->map(function ($item) {
            return [
                'image' => $item->image_url ?: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80',
                'video_url' => $item->video_url,
                'badge' => $item->title ? strtoupper($item->title) : 'SEKOLAH UNGGULAN',
                'title' => $item->title ?: 'Membangun Generasi Unggul & Berkarakter',
                'description' => $item->description ?: 'SMK Putra Pakuan memberikan pendidikan berkualitas dengan fasilitas modern dan tenaga pengajar profesional untuk masa depan gemilang.',
                'buttonText' => $item->button_text ?: 'DAFTAR SEKARANG',
                'buttonUrl' => $item->button_url ?: '#',
                'stats' => [
                    ['number' => '500+', 'label' => 'Siswa Aktif'],
                    ['number' => '95%', 'label' => 'Kelulusan'],
                    ['number' => '50+', 'label' => 'Mitra Industri'],
                ],
            ];
        });

        if ($heroSlides->isEmpty()) {
            $heroSlides = collect([
                [
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCXpMjqgfiuKKSUoRdYNiimPNmi33yGSv3H1SaO224yREfseZpcO58hsaQNLTW26k-6h_ReeWKPSDwfwkCeRL47KVJ2OZ7_07xCQIUf_yjDCQTcuI0StKSRBoKdWJ_g40oTEJdFkwC33UMvSCyoruiBd_VRAxai80IG1XSnml39DK0QKzEQefEAJkEs2c6oRqRjrVPzsHQV8CNWeS5RNQQAyen_XVhX3q_tGFyatat2H16LqQ97VODQMhJMqZCeKy2Oa27diTKrcw',
                    'badge' => 'SEKOLAH UNGGULAN',
                    'title' => 'Membangun Generasi Unggul & Berkarakter',
                    'description' => 'SMK Putra Pakuan memberikan pendidikan berkualitas dengan fasilitas modern dan tenaga pengajar profesional untuk masa depan gemilang.',
                    'buttonText' => 'DAFTAR SEKARANG',
                    'buttonUrl' => '#',
                    'stats' => [
                        ['number' => '500+', 'label' => 'Siswa Aktif'],
                        ['number' => '95%', 'label' => 'Kelulusan'],
                        ['number' => '50+', 'label' => 'Mitra Industri'],
                    ],
                ],
                [
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA9jN6K-M6TXiwVtRwKGwC1bXraVK356kE3rvjNLRaWlRHC0rPZsfFchCr2rEWvkBekVrQDT72KGx33ecs172NKHB8RRAZQ5lK2ZGpsF70BkIJ77V2qv3GnQo4l35Eis7Z8YU3edbqX5lZclu3bQ6Htt5GSMAGHg0gGq_dYsJyqa6unEfhxVW9Ug4APEhI5zYLInlFVsa2DhRmrwH6m62_RscLRki4_d7_hLTzdC4WRh3noySWdy-i7gF7KMzWRKIgLTyOyJwoxdQ',
                    'badge' => 'JURUSAN TERLENGKAP',
                    'title' => 'Raih Karir Impianmu Bersama Kami',
                    'description' => 'Berbagai pilihan jurusan dengan kurikulum industri terkini. Praktek langsung dengan peralatan modern dan bimbingan ahli.',
                    'buttonText' => 'DAFTAR SEKARANG',
                    'buttonUrl' => '#',
                    'stats' => [
                        ['number' => '8', 'label' => 'Jurusan'],
                        ['number' => '100+', 'label' => 'Prestasi'],
                        ['number' => '20+', 'label' => 'Guru Ahli'],
                    ],
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80',
                    'badge' => 'FASILITAS MODERN',
                    'title' => 'Belajar dengan Fasilitas Terbaik',
                    'description' => 'Laboratorium lengkap, ruang kelas nyaman, dan workshop modern mendukung proses pembelajaran yang efektif dan menyenangkan.',
                    'buttonText' => 'DAFTAR SEKARANG',
                    'buttonUrl' => '#',
                    'stats' => [
                        ['number' => '15', 'label' => 'Lab & Workshop'],
                        ['number' => '30+', 'label' => 'Ruang Kelas'],
                        ['number' => '5 Ha', 'label' => 'Area Kampus'],
                    ],
                ],
            ]);
        }
    @endphp

    <div class="hero-carousel-container">
        <!-- Progress Bar -->
        <div id="carouselProgress" class="carousel-progress"></div>

        <!-- Slides -->
        @foreach ($heroSlides as $index => $slide)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
            @if (!empty($slide['video_url']))
                <video class="hero-media" autoplay muted loop playsinline>
                    <source src="{{ $slide['video_url'] }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            @else
                <img src="{{ $slide['image'] }}" alt="Hero {{ $index + 1 }}" class="hero-image">
            @endif
            <div class="hero-overlay"></div>
            <div class="hero-text-overlay">
                <h2 class="hero-overlay-title">{{ $slide['title'] }}</h2>
                <p class="hero-overlay-description">{{ $slide['description'] }}</p>
            </div>
        </div>
        @endforeach

        <!-- Navigation Buttons -->
        <button class="carousel-nav-btn prev" id="prevBtn" title="Sebelumnya">
            <span class="material-symbols-outlined text-3xl">chevron_left</span>
        </button>
        <button class="carousel-nav-btn next" id="nextBtn" title="Berikutnya">
            <span class="material-symbols-outlined text-3xl">chevron_right</span>
        </button>

        <!-- Dots Navigation -->
        <div class="carousel-dots">
            @foreach ($heroSlides as $index => $slide)
            <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-dot="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>

<!-- PPDB CTA Section -->
@if($ppdbLive)
<section class="bg-white dark:bg-charcoal py-16 md:py-20 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-charcoal/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="bg-charcoal rounded-3xl p-8 md:p-12 lg:p-16 flex flex-col lg:flex-row items-center justify-between gap-10 shadow-2xl overflow-hidden relative">
            <!-- Decorative Icon -->
            <div class="absolute top-0 right-0 opacity-5 pointer-events-none">
                <span class="material-symbols-outlined text-[400px]">school</span>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex-1 text-center lg:text-left">
                {{-- <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FDB913] text-charcoal text-sm font-black mb-6 shadow-lg">
                    <span class="material-symbols-outlined animate-pulse">campaign</span>
                    PPDB DINAMIS READY
                </div> --}}
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 leading-tight">
                    PPDB {{ $ppdbPeriod ?? '2024/2025' }} <br class="hidden md:block"/>
                    <span class="text-[#FDB913]">{{ $ppdbCurrentPhase ?? 'TBA' }}</span>
                </h2>
                <p class="text-slate-300 text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
                    Pendaftaran masih dibuka ! Segera Daftar & Perhatikan batas waktu dan siapkan berkas.
                </p>
                <a href="{{ route('school.ppdb', ['school' => $school]) }}" class="bg-[#FDB913] text-charcoal px-10 py-4 rounded-xl font-black text-xl hover:bg-white hover:scale-105 transition-all duration-300 shadow-xl shadow-[#FDB913]/30 inline-flex items-center gap-3">
                    <span class="material-symbols-outlined">edit_note</span>
                    DAFTAR ONLINE SEKARANG
                </a>
            </div>

            <!-- Countdown Timer -->
            <div class="relative z-10 w-full lg:w-auto">
                <div class="flex flex-col gap-4">
                    <p class="text-white/70 font-bold text-center uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[#FDB913]">schedule</span>
                        Fase Ini Berakhir Dalam:
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="flex flex-col items-center bg-white/10 border border-white/20 rounded-2xl p-6 min-w-[100px] backdrop-blur-lg hover:bg-white/20 transition-all">
                            <span class="text-5xl font-black text-[#FDB913] mb-2" id="countdownDays">--</span>
                            <span class="text-white/70 text-xs font-bold uppercase tracking-wider">Hari</span>
                        </div>
                        <div class="flex flex-col items-center bg-white/10 border border-white/20 rounded-2xl p-6 min-w-[100px] backdrop-blur-lg hover:bg-white/20 transition-all">
                            <span class="text-5xl font-black text-[#FDB913] mb-2" id="countdownHours">--</span>
                            <span class="text-white/70 text-xs font-bold uppercase tracking-wider">Jam</span>
                        </div>
                        <div class="flex flex-col items-center bg-white/10 border border-white/20 rounded-2xl p-6 min-w-[100px] backdrop-blur-lg hover:bg-white/20 transition-all">
                            <span class="text-5xl font-black text-[#FDB913] mb-2" id="countdownMinutes">--</span>
                            <span class="text-white/70 text-xs font-bold uppercase tracking-wider">Menit</span>
                        </div>
                        <div class="flex flex-col items-center bg-white/10 border border-white/20 rounded-2xl p-6 min-w-[100px] backdrop-blur-lg hover:bg-white/20 transition-all">
                            <span class="text-5xl font-black text-[#FDB913] mb-2" id="countdownSeconds">--</span>
                            <span class="text-white/70 text-xs font-bold uppercase tracking-wider">Detik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- PPDB Offline Message -->
<section class="bg-gradient-to-r from-slate-100 to-slate-50 dark:from-charcoal/50 dark:to-charcoal/30 py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="material-symbols-outlined text-6xl text-slate-400 inline-block mb-4">pause_circle</span>
        <h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white mb-2">PPDB Belum Dibuka</h2>
        <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl mx-auto">Pendaftaran pelajar baru untuk SMK Putra Pakuan belum dibuka. Mohon menunggu pengumuman lebih lanjut.</p>
    </div>
</section>
@endif





<!-- Sambutan Kepala Sekolah -->
<section class="py-16 md:py-24 bg-white dark:bg-charcoal/30"> <div class="max-w-7xl mx-auto px-6"> <div class="flex flex-col lg:flex-row gap-8 md:gap-16 items-center"> <div class="w-full lg:w-5/12 relative"> <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary rounded-2xl -z-10"></div> <div class="rounded-3xl overflow-hidden shadow-2xl"> <img alt="Potret Kepala Sekolah" class="w-full h-auto object-cover" src="{{ $homepage->kepsek_photo_url }}"/> </div> <div class="absolute -bottom-6 -right-6 bg-primary p-6 rounded-2xl shadow-xl"> <p class="text-charcoal font-black text-xl leading-none">{{ $homepage->kepsek_name }}</p> <p class="text-charcoal/70 text-sm font-bold mt-1">{{ $homepage->kepsek_title }}</p> </div> </div> <div class="w-full lg:w-7/12 space-y-6"> <span class="material-symbols-outlined text-primary text-4xl md:text-6xl">format_quote</span> <h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Sambutan Kepala Sekolah</h2> <p class="text-lg md:text-xl italic text-slate-600 dark:text-slate-300 leading-relaxed"> {!! nl2br(e($homepage->kepsek_sambutan)) !!} </p> </div> </div> </div> </section> <section class="py-16 md:py-24 bg-background-light dark:bg-background-dark"> <div class="max-w-7xl mx-auto px-6"> <div class="flex justify-between items-end mb-8 md:mb-12"> <div> <h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Tulisan Terbaru</h2> <p class="text-slate-500 mt-2">Update terkini kegiatan dan berita dari kampus kami.</p> </div> <a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-primary font-bold hover:gap-4 transition-all" href="{{ route('school.berita', ['school' => $school]) }}"> Lihat Semua Berita <span class="material-symbols-outlined">arrow_forward</span> </a> </div> <div class="grid md:grid-cols-3 gap-6 md:gap-8"> @if ($latestNews->isEmpty()) <div class="md:col-span-3 text-center py-10"> <p class="text-slate-500 dark:text-slate-400">Belum ada berita untuk saat ini.</p> </div> @else @foreach ($latestNews as $item) <article class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group"> <div class="h-56 bg-cover bg-center overflow-hidden" @if ($item->image_url) style="background-image: url('{{ $item->image_url }}')" @endif > <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div> </div> <div class="p-4 md:p-6 space-y-4"> <div class="flex gap-4 text-xs font-bold text-slate-400"> <span class="flex items-center gap-1"> <span class="material-symbols-outlined text-sm">calendar_month</span> {{ $item->published_at ? $item->published_at->format('d M Y') : ($item->created_at?->format('d M Y') ?? '-') }} </span> <span class="flex items-center gap-1"> <span class="material-symbols-outlined text-sm">person</span> {{ $item->created_by ?? 'Admin' }} </span> </div> <h3 class="text-lg md:text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2"> {{ $item->title }} </h3> <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3"> {{ \Illuminate\Support\Str::limit($item->excerpt ?? strip_tags($item->content ?? ''), 140) }} </p> <a href="{{ route('school.berita.detail', ['school' => $school, 'news' => $item->id]) }}" class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4"> Selengkapnya </a> </div> </article> @endforeach @endif </div> </div> </section>

<!-- Rest of content... -->


<!-- Foto Terbaru Section -->
<section class="py-16 md:py-24 bg-white dark:bg-charcoal/30">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12" data-aos="fade-up">
            <div>
                <h2 class="text-4xl md:text-5xl font-black text-charcoal dark:text-white mb-3">
                    Foto <span class="text-[#FDB913]">Terbaru</span>
                </h2>
                <p class="text-slate-500 text-lg">Dokumentasi kegiatan dan momen spesial terbaru dari SMK Putra Pakuan.</p>
            </div>
            <a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-[#FDB913] font-bold hover:gap-4 transition-all group" href="{{ route('school.galeri', ['school' => $school]) }}">
                Lihat Semua Galeri
                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @if ($latestGallery->isEmpty())
                <div class="md:col-span-3 text-center py-10">
                    <p class="text-slate-500 dark:text-slate-400">Belum ada foto untuk saat ini.</p>
                </div>
            @else
                @foreach ($latestGallery as $item)
                    <article class="bg-white dark:bg-charcoal/40 rounded-3xl overflow-hidden shadow-lg border border-charcoal/5 dark:border-white/5 hover:shadow-lg hover:-translate-y-1 transition-transform duration-200 group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ $item->image_url ?? 'https://via.placeholder.com/640x480?text=Tanpa+Gambar' }}" alt="{{ $item->title ?? 'Foto Terbaru' }}" class="w-full h-full object-cover transition-transform duration-300 ease-out transform group-hover:scale-105" />
                            <div class="absolute inset-0 bg-black/20 transition-opacity duration-300 ease-out group-hover:bg-black/30"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/70 to-transparent opacity-70 transition-opacity duration-300 ease-out group-hover:opacity-90"></div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex gap-4 text-xs font-bold text-slate-400">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : ($item->created_at?->format('d M Y') ?? '-') }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold leading-tight group-hover:text-[#FDB913] transition-colors line-clamp-2">
                                {{ $item->title ?? 'Galeri SMK Putra Pakuan' }}
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 line-clamp-3">{{ $item->description ?? 'Lihat kumpulan foto terbaru kegiatan kami.' }}</p>
                            <a href="{{ route('school.galeri', ['school' => $school]) }}" class="text-charcoal dark:text-white font-bold flex items-center gap-2 group/link">
                                Lihat Galeri
                                <span class="material-symbols-outlined transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out'
    });

    // Hero Carousel
    function initHeroCarousel(root = document) {
        const carouselRoot = root.querySelector('.hero-carousel-container');
        if (!carouselRoot || carouselRoot.dataset.carouselInitialized === 'true') {
            return;
        }

        carouselRoot.dataset.carouselInitialized = 'true';

        const slides = carouselRoot.querySelectorAll('.hero-slide');
        const dots = carouselRoot.querySelectorAll('.carousel-dot');
        const prevBtn = carouselRoot.querySelector('#prevBtn');
        const nextBtn = carouselRoot.querySelector('#nextBtn');
        const progress = carouselRoot.querySelector('#carouselProgress');

        if (!slides.length || !dots.length || !prevBtn || !nextBtn) {
            return;
        }

        let currentIndex = 0;
        let autoplayTimeout;
        let progressInterval;
        let activeVideo = null;

        function stopVideoPlayback() {
            if (activeVideo) {
                activeVideo.pause();
                activeVideo.currentTime = 0;
                activeVideo.removeEventListener('ended', onVideoEnded);
                activeVideo = null;
            }
        }

        function onVideoEnded() {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        }

        function setActiveSlide(index) {
            // Remove active from all
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active to current
            slides[index].classList.add('active');
            dots[index].classList.add('active');

            currentIndex = index;

            // Reset progress
            resetProgress();
        }

        function nextSlide() {
            const next = (currentIndex + 1) % slides.length;
            setActiveSlide(next);
        }

        function prevSlide() {
            const prev = (currentIndex - 1 + slides.length) % slides.length;
            setActiveSlide(prev);
        }

        function resetProgress() {
            if (!progress) {
                return;
            }
            progress.classList.remove('active');
            void progress.offsetWidth; // Trigger reflow
            progress.classList.add('active');
        }

        function startAutoplay() {
            stopAutoplay();

            const activeSlide = slides[currentIndex];
            const video = activeSlide.querySelector('video');

            if (video) {
                stopVideoPlayback();
                activeVideo = video;

                video.play().catch(() => {
                    // Autoplay may be blocked in some browsers.
                });

                video.addEventListener('ended', onVideoEnded);

                // If duration isn't known immediately, fallback to 12s.
                const durationMs = video.duration && !isNaN(video.duration) && isFinite(video.duration)
                    ? Math.ceil(video.duration * 1000) + 500
                    : 12000;

                autoplayTimeout = setTimeout(() => {
                    if (video && !video.ended) {
                        video.pause();
                        onVideoEnded();
                    }
                }, durationMs);

                if (progress) {
                    progress.classList.remove('active');
                }
            } else {
                stopVideoPlayback();
                resetProgress();
                autoplayTimeout = setTimeout(() => {
                    nextSlide();
                    startAutoplay();
                }, 5000);
            }
        }

        function pauseAutoplay() {
            if (autoplayTimeout) {
                clearTimeout(autoplayTimeout);
                autoplayTimeout = null;
            }

            if (activeVideo) {
                activeVideo.pause();
            }

            if (progress) {
                progress.classList.remove('active');
            }
        }

        function resumeAutoplay() {
            const activeSlide = slides[currentIndex];
            const video = activeSlide.querySelector('video');

            if (video) {
                activeVideo = video;
                video.play().catch(() => {
                    // autoplay may be blocked; continue with fallback
                });

                video.removeEventListener('ended', onVideoEnded);
                video.addEventListener('ended', onVideoEnded);

                const remainingMs = (video.duration && !isNaN(video.duration) && isFinite(video.duration))
                    ? Math.max(300, Math.ceil((video.duration - video.currentTime) * 1000) + 500)
                    : 12000;

                autoplayTimeout = setTimeout(() => {
                    if (video && !video.ended) {
                        video.pause();
                        onVideoEnded();
                    }
                }, remainingMs);

                if (progress) {
                    progress.classList.remove('active');
                }
            } else {
                startAutoplay();
            }
        }

        function stopAutoplay() {
            if (autoplayTimeout) {
                clearTimeout(autoplayTimeout);
                autoplayTimeout = null;
            }
            stopVideoPlayback();
            if (progress) {
                progress.classList.remove('active');
            }
        }

        // Event listeners
        prevBtn.addEventListener('click', () => {
            prevSlide();
            startAutoplay();
        });

        nextBtn.addEventListener('click', () => {
            nextSlide();
            startAutoplay();
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                setActiveSlide(index);
                startAutoplay();
            });
        });

        // Start autoplay (no hover pause)
        startAutoplay();
    }

    initHeroCarousel(document);
    document.addEventListener('htmx:load', (event) => {
        initHeroCarousel(event.detail?.elt || document);
    });

    // Countdown Timer
    function updateCountdown() {
        @if($ppdbLive && $ppdbCountdownDate)
            const endDate = new Date('{{ $ppdbCountdownDate->format('Y-m-d H:i:s') }}');
        @else
            const endDate = null;
        @endif

        if (!endDate) {
            document.getElementById('countdownDays').textContent = '00';
            document.getElementById('countdownHours').textContent = '00';
            document.getElementById('countdownMinutes').textContent = '00';
            document.getElementById('countdownSeconds').textContent = '00';
            return;
        }

        const now = new Date();
        const diff = endDate - now;

        if (diff <= 0) {
            document.getElementById('countdownDays').textContent = '00';
            document.getElementById('countdownHours').textContent = '00';
            document.getElementById('countdownMinutes').textContent = '00';
            document.getElementById('countdownSeconds').textContent = '00';
            return;
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById('countdownDays').textContent = String(days).padStart(2, '0');
        document.getElementById('countdownHours').textContent = String(hours).padStart(2, '0');
        document.getElementById('countdownMinutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('countdownSeconds').textContent = String(seconds).padStart(2, '0');
    }

    // Update countdown every second
    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endsection






