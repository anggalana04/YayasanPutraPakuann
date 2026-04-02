@extends('layouts.SMP.app')

@section('title', 'SMP Putra Pakuan - Unggul, Berkarakter, Berdaya Saing')

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
    background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, transparent 18%),
                linear-gradient(135deg, rgba(28, 25, 13, 0.25) 0%, rgba(28, 25, 13, 0.15) 50%, rgba(242, 204, 13, 0.1) 100%);
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
<section class="relative min-h-screen" data-hero-section>
    @php
        $heroSlides = $carouselImages->map(function ($item) {
            return [
                'image' => $item->image_url ?: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80',
                'video_url' => $item->video_url,
                'badge' => $item->title ? strtoupper($item->title) : 'SEKOLAH UNGGULAN',
                'title' => $item->title ?: null,
                'description' => $item->description ?: null,
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
                    'description' => 'SMP Putra Pakuan memberikan pendidikan berkualitas dengan fasilitas modern dan tenaga pengajar profesional untuk masa depan gemilang.',
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
                    'badge' => 'KURIKULUM MERDEKA',
                    'title' => 'Raih Prestasi Terbaikmu Bersama Kami',
                    'description' => 'Berbagai program unggulan dengan kurikulum terkini. Bimbingan guru berpengalaman dan lingkungan belajar yang inspiratif.',
                    'buttonText' => 'DAFTAR SEKARANG',
                    'buttonUrl' => '#',
                    'stats' => [
                        ['number' => '15+', 'label' => 'Ekstrakurikuler'],
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
                <video class="hero-media" muted loop playsinline preload="none" poster="{{ $slide['image'] }}">
                    <source src="{{ $slide['video_url'] }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            @else
                <img src="{{ $slide['image'] }}" alt="Hero {{ $index + 1 }}" class="hero-image">
            @endif
            <div class="hero-overlay"></div>
            <div class="hero-text-overlay">
                @if(!empty($slide['title']))<h2 class="hero-overlay-title">{{ $slide['title'] }}</h2>@endif
                @if(!empty($slide['description']))<p class="hero-overlay-description">{{ $slide['description'] }}</p>@endif
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

@include('partials.school-homepage', [
    'schoolConfig' => [
        'name'       => 'SMP Putra Pakuan',
        'short_name' => 'SMP',
        'stats' => [
            ['number' => 15,  'suffix' => '+', 'label' => 'Tahun Berdiri'],
            ['number' => 450, 'suffix' => '+', 'label' => 'Siswa Aktif'],
            ['number' => 80,  'suffix' => '+', 'label' => 'Prestasi'],
            ['number' => 15,  'suffix' => '+', 'label' => 'Ekstrakurikuler'],
        ],
        'keunggulan' => [
            [
                'icon'       => 'menu_book',
                'title'      => 'Tahfidz Al-Quran',
                'desc'       => 'Target hafalan 5 juz selama 3 tahun belajar dengan bimbingan ustadz berpengalaman.',
                'bg_from'    => '#064e3b',
                'bg_to'      => '#065f46',
                'glow'       => '#10b981',
                'icon_color' => '#6ee7b7',
            ],
            [
                'icon'       => 'science',
                'title'      => 'Lab Sains Modern',
                'desc'       => 'Laboratorium fisika, kimia dan biologi berstandar nasional untuk eksplorasi ilmu.',
                'bg_from'    => '#1e3a5f',
                'bg_to'      => '#1d4ed8',
                'glow'       => '#3b82f6',
                'icon_color' => '#93c5fd',
            ],
            [
                'icon'       => 'emoji_events',
                'title'      => 'Juara Olimpiade',
                'desc'       => 'Konsisten berprestasi di tingkat kota, provinsi dan nasional setiap tahunnya.',
                'bg_from'    => '#78350f',
                'bg_to'      => '#92400e',
                'glow'       => '#f59e0b',
                'icon_color' => '#fcd34d',
            ],
            [
                'icon'       => 'sports',
                'title'      => 'Olahraga Berprestasi',
                'desc'       => 'Program atletik dan olahraga unggulan dengan bimbingan pelatih profesional bersertifikat.',
                'bg_from'    => '#7f1d1d',
                'bg_to'      => '#991b1b',
                'glow'       => '#ef4444',
                'icon_color' => '#fca5a5',
            ],
        ],
        'kurikulum' => [
            [
                'icon'      => 'menu_book',
                'title'     => 'Program Tahfidz Intensif',
                'desc'      => 'Target hafalan 5 juz selama 3 tahun dengan bimbingan ustadz berpengalaman dan setoran rutin harian.',
                'color_hex' => '#10b981',
                'bg_hex'    => 'rgba(16,185,129,0.08)',
            ],
            [
                'icon'      => 'emoji_events',
                'title'     => 'Olimpiade & Riset Sains',
                'desc'      => 'Kelas persiapan olimpiade matematika, IPA, dan bahasa tingkat kota hingga nasional.',
                'color_hex' => '#f59e0b',
                'bg_hex'    => 'rgba(245,158,11,0.08)',
            ],
            [
                'icon'      => 'computer',
                'title'     => 'Coding & Digital Literacy',
                'desc'      => 'Pemrograman dasar, desain grafis, dan literasi digital untuk generasi yang melek teknologi.',
                'color_hex' => '#3b82f6',
                'bg_hex'    => 'rgba(59,130,246,0.08)',
            ],
            [
                'icon'      => 'groups',
                'title'     => 'Kepemimpinan & Karakter',
                'desc'      => 'Program OSIS, pramuka, public speaking, dan pengembangan soft skills kepemimpinan.',
                'color_hex' => '#8b5cf6',
                'bg_hex'    => 'rgba(139,92,246,0.08)',
            ],
        ],
        'ppdb_offline_text' => 'Pendaftaran pelajar baru untuk SMP Putra Pakuan belum dibuka. Mohon menunggu pengumuman resmi.',
        'galeri_desc'       => 'Dokumentasi kegiatan dan momen spesial terbaru dari SMP Putra Pakuan.',
    ],
])
<script>
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

            // Hint browser to preload metadata for next slide (small � just duration/dimensions)
            const nextIdx = (index + 1) % slides.length;
            const nextVideo = slides[nextIdx]?.querySelector('video');
            if (nextVideo && nextVideo.readyState === 0) {
                nextVideo.preload = 'metadata';
            }

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

                // Set preload so browser can stream on play() � do NOT call load()
                // which would eagerly download the entire video file.
                if (video.readyState === 0) {
                    video.preload = 'auto';
                }

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

        // Hint metadata only for first video � do NOT call load() here as it
        // triggers a full download of the video file at page load time.
        const firstVideo = slides[0]?.querySelector('video');
        if (firstVideo && firstVideo.readyState === 0) {
            firstVideo.preload = 'metadata';
        }

        // Start autoplay (no hover pause)
        startAutoplay();
    }

    initHeroCarousel(document);
    document.addEventListener('htmx:load', (event) => {
        initHeroCarousel(event.detail?.elt || document);
    });

</script>
@endsection
