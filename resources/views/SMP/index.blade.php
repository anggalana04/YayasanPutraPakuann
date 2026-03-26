@extends('layouts.SMP.app')

@section('title', 'SMP Putra Pakuan - Unggul, Berkarakter, Berdaya Saing')

@push('head')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#f2cc0d",
                    "background-light": "#f8f8f5",
                    "background-dark": "#221f10",
                    "charcoal": "#1c190d",
                },
                fontFamily: {
                    "display": ["Lexend", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.5rem",
                    "lg": "1rem",
                    "xl": "1.5rem",
                    "full": "9999px"
                },
            },
        },
    }
</script>
<script id="tailwind-config-override">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#3b82f6", // SMP blue
                    "background-light": "#f8f8f5",
                    "background-dark": "#1e293b",
                    "charcoal": "#1e293b",
                },
                fontFamily: {
                    display: ["Lexend", "sans-serif"]
                },
                borderRadius: {
                    DEFAULT: "0.5rem",
                    lg: "1rem",
                    xl: "1.5rem",
                    full: "9999px"
                },
            },
        },
    }
</script>
<style type="text/tailwindcss">
    body { font-family: 'Lexend', sans-serif; }
    .hero-slider {
        height: calc(100vh - 72px);
        position: relative;
        overflow: hidden;
    }
    .slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        pointer-events: none;
    }
    .slide.active {
        opacity: 1;
        pointer-events: auto;
    }
    .glass-card {
        background: rgba(28, 25, 13, 0.4);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(242, 204, 13, 0.2);
    }
</style>
@endpush

@section('content')
<section class="hero-slider bg-charcoal">
<div class="slide active">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCXpMjqgfiuKKSUoRdYNiimPNmi33yGSv3H1SaO224yREfseZpcO58hsaQNLTW26k-6h_ReeWKPSDwfwkCeRL47KVJ2OZ7_07xCQIUf_yjDCQTcuI0StKSRBoKdWJ_g40oTEJdFkwC33UMvSCyoruiBd_VRAxai80IG1XSnml39DK0QKzEQefEAJkEs2c6oRqRjrVPzsHQV8CNWeS5RNQQAyen_XVhX3q_tGFyatat2H16LqQ97VODQMhJMqZCeKy2Oa27diTKrcw')">
<div class="absolute inset-0 bg-gradient-to-r from-charcoal/80 via-charcoal/40 to-transparent"></div>
</div>
<div class="relative h-full max-w-7xl mx-auto px-6 flex items-center">
<div class="glass-card p-8 lg:p-12 rounded-3xl max-w-2xl" data-aos="fade-left" data-aos-duration="1000">
<img src="{{ asset('images/logo-putrapakuan.png') }}" alt="SMP Putra Pakuan Logo" class="w-20 md:w-32 h-20 md:h-32 mb-4 md:mb-6 rounded-lg mx-auto block">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 text-primary text-sm font-medium mb-6">
<span class="relative flex h-2 w-2">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
</span>
                    Tahun Ajaran 2024/2025
                </div>
<h2 class="text-3xl md:text-4xl lg:text-7xl font-black text-white leading-tight mb-6">
                    SMP PUTRA <span class="text-primary">PAKUAN</span>
</h2>
<p class="text-lg md:text-xl text-slate-200 leading-relaxed mb-8">
                    Membentuk tenaga kerja profesional, berkarakter, dan siap bersaing di kancah industri global melalui inovasi pendidikan.
                </p>
<div class="flex flex-col sm:flex-row flex-wrap gap-4">
<button class="bg-primary text-charcoal px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                        Pendaftaran Siswa Baru
                    </button>
<button class="flex items-center gap-2 px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg border border-white/30 text-white hover:bg-white/10 transition-all backdrop-blur-md">
<span class="material-symbols-outlined">play_circle</span>
                        Video Kampus
                    </button>
</div>
</div>
</div>
</div>
<div class="slide">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA9jN6K-M6TXiwVtRwKGwC1bXraVK356kE3rvjNLRaWlRHC0rPZsfFchCr2rEWvkBekVrQDT72KGx33ecs172NKHB8RRAZQ5lK2ZGpsF70BkIJ77V2qv3GnQo4l35Eis7Z8YU3edbqX5lZclu3bQ6Htt5GSMAGHg0gGq_dYsJyqa6unEfhxVW9Ug4APEhI5zYLInlFVsa2DhRmrwH6m62_RscLRki4_d7_hLTzdC4WRh3noySWdy-i7gF7KMzWRKIgLTyOyJwoxdQ')">
<div class="absolute inset-0 bg-charcoal/40"></div>
</div>
<div class="relative h-full max-w-7xl mx-auto px-6 flex items-center">
<div class="glass-card p-8 lg:p-12 rounded-3xl max-w-2xl" data-aos="fade-left" data-aos-duration="1000">
<h2 class="text-3xl md:text-4xl lg:text-6xl font-black text-white leading-tight mb-6">
                    Fasilitas <span class="text-primary">Modern</span>
</h2>
<p class="text-lg md:text-xl text-slate-200 leading-relaxed mb-8">
                    Laboratorium lengkap, workshop industri, dan teknologi terkini untuk mendukung pembelajaran praktis.
                </p>
<button class="bg-primary text-charcoal px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    Lihat Fasilitas
                </button>
</div>
</div>
</div>
<div class="slide">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80')">
<div class="absolute inset-0 bg-gradient-to-l from-charcoal/80 via-charcoal/40 to-transparent"></div>
</div>
<div class="relative h-full max-w-7xl mx-auto px-6 flex items-center justify-end">
<div class="glass-card p-8 lg:p-12 rounded-3xl max-w-2xl" data-aos="fade-right" data-aos-duration="1000">
<h2 class="text-3xl md:text-4xl lg:text-6xl font-black text-white leading-tight mb-6">
                    Prestasi <span class="text-primary">Gemilang</span>
</h2>
<p class="text-lg md:text-xl text-slate-200 leading-relaxed mb-8">
                    Ratusan penghargaan di tingkat regional dan nasional membuktikan kualitas pendidikan kami.
                </p>
<button class="bg-primary text-charcoal px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    Lihat Prestasi
                </button>
</div>
</div>
</div>
<div class="absolute inset-x-0 bottom-10 z-20 flex justify-center items-center gap-8">
<button id="slider-prev" class="text-white/50 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-4xl">chevron_left</span>
</button>
<div class="flex gap-3">
<div class="slider-dot w-12 h-1.5 rounded-full bg-primary shadow-sm cursor-pointer transition-all"></div>
<div class="slider-dot w-12 h-1.5 rounded-full bg-white/20 hover:bg-white/40 cursor-pointer transition-all"></div>
<div class="slider-dot w-12 h-1.5 rounded-full bg-white/20 hover:bg-white/40 cursor-pointer transition-all"></div>
</div>
<button id="slider-next" class="text-white/50 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-4xl">chevron_right</span>
</button>
</div>
</section>
<section class="bg-primary py-12 md:py-16">
<div class="max-w-7xl mx-auto px-6">
<div class="bg-charcoal rounded-3xl p-6 md:p-8 lg:p-12 flex flex-col lg:flex-row items-center justify-between gap-8 md:gap-10 shadow-2xl overflow-hidden relative">
<div class="absolute top-0 right-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[300px]">edit_note</span>
</div>
<div class="relative z-10 flex-1 text-center lg:text-left">
<div class="inline-block px-4 py-1 rounded-full bg-primary text-charcoal text-sm font-bold mb-6">REGISTRATION OPEN</div>
<h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">PPDB 2024 TELAH DIBUKA</h2>
<p class="text-slate-400 text-base md:text-lg max-w-lg mb-8">
                    Segera daftarkan diri Anda dan menjadi bagian dari keluarga besar SMP Putra Pakuan. Kuota terbatas untuk setiap jurusan!
                </p>
<button class="bg-primary text-charcoal px-8 md:px-10 py-3 md:py-4 rounded-xl font-black text-lg md:text-xl hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    DAFTAR SEKARANG
                </button>
</div>
<div class="relative z-10 w-full lg:w-auto">
<div class="flex flex-col gap-4">
<p class="text-white/60 font-bold text-center mb-2 uppercase tracking-widest text-sm">Pendaftaran Ditutup Dalam:</p>
<div class="flex flex-wrap justify-center lg:justify-start gap-4">
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-4 md:p-6 min-w-[80px] md:min-w-[100px] backdrop-blur-sm">
<span class="text-3xl md:text-4xl font-black text-primary">12</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Hari</span>
</div>
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-4 md:p-6 min-w-[80px] md:min-w-[100px] backdrop-blur-sm">
<span class="text-3xl md:text-4xl font-black text-primary">08</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Jam</span>
</div>
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-4 md:p-6 min-w-[80px] md:min-w-[100px] backdrop-blur-sm">
<span class="text-3xl md:text-4xl font-black text-primary">45</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Menit</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="py-16 md:py-24 bg-white dark:bg-charcoal/30">
<div class="max-w-7xl mx-auto px-6">
<div class="flex flex-col lg:flex-row gap-8 md:gap-16 items-center">
<div class="w-full lg:w-5/12 relative">
<div class="absolute -top-6 -left-6 w-32 h-32 bg-primary rounded-2xl -z-10"></div>
<div class="rounded-3xl overflow-hidden shadow-2xl">
<img alt="Principal Portrait" class="w-full h-auto object-cover" src="{{ $homepage->kepsek_photo_url }}"/>
</div>
<div class="absolute -bottom-6 -right-6 bg-primary p-6 rounded-2xl shadow-xl">
<p class="text-charcoal font-black text-xl leading-none">{{ $homepage->kepsek_name }}</p>
<p class="text-charcoal/70 text-sm font-bold mt-1">{{ $homepage->kepsek_title }}</p>
</div>
</div>
<div class="w-full lg:w-7/12 space-y-6">
<span class="material-symbols-outlined text-primary text-4xl md:text-6xl">format_quote</span>
<h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Sambutan Kepala Sekolah</h2>
<p class="text-lg md:text-xl italic text-slate-600 dark:text-slate-300 leading-relaxed">
                    {!! nl2br(e($homepage->kepsek_sambutan)) !!}
                </p>
</div>
</div>
</div>
</section>
<section class="py-16 md:py-24 bg-background-light dark:bg-background-dark">
<div class="max-w-7xl mx-auto px-6">
<div class="flex justify-between items-end mb-8 md:mb-12">
<div>
<h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Tulisan Terbaru</h2>
<p class="text-slate-500 mt-2">Update terkini kegiatan dan berita dari kampus kami.</p>
</div>
<a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-primary font-bold hover:gap-4 transition-all" href="{{ route('school.berita', ['school' => $school]) }}">
                Lihat Semua Berita <span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
<div class="grid md:grid-cols-3 gap-6 md:gap-8">
    @if ($latestNews->isEmpty())
        <div class="md:col-span-3 text-center py-10">
            <p class="text-slate-500 dark:text-slate-400">Belum ada berita untuk saat ini.</p>
        </div>
    @else
        @foreach ($latestNews as $item)
            <article class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div
                    class="h-56 bg-cover bg-center overflow-hidden"
                    @if ($item->image_url)
                        style="background-image: url('{{ $item->image_url }}')"
                    @endif
                >
                    <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">calendar_month</span>
                            {{ $item->published_at ? $item->published_at->format('d M Y') : ($item->created_at?->format('d M Y') ?? '-') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">person</span>
                            {{ $item->created_by ?? 'Admin' }}
                        </span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">
                        {{ $item->title }}
                    </h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($item->excerpt ?? strip_tags($item->content ?? ''), 140) }}
                    </p>
                    <a href="{{ route('school.berita.detail', ['school' => $school, 'news' => $item->id]) }}"
                       class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Selengkapnya
                    </a>
                </div>
            </article>
        @endforeach
    @endif
</div>
</div>
</section>
<!-- Foto & Video Terbaru Section -->
<section class="py-16 md:py-24 bg-white dark:bg-charcoal/30">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-8 md:mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Foto & Video Terbaru</h2>
                <p class="text-slate-500 mt-2">Dokumentasi kegiatan dan momen spesial terbaru dari SMP Putra Pakuan.</p>
            </div>
            <a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-primary font-bold hover:gap-4 transition-all" href="#">
                Lihat Semua Galeri <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid md:grid-cols-3 gap-6 md:gap-8">
            <!-- Foto 1 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80')">
                    <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 10 Mar 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">photo_camera</span> Dokumentasi</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Kegiatan Praktek Industri Siswa</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Siswa kelas VII sedang melakukan praktek kerja industri di perusahaan mitra untuk meningkatkan kompetensi...
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Lihat Foto
                    </button>
                </div>
            </div>
            <!-- Video 1 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="aspect-video bg-black flex items-center justify-center">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/1Q8fG0TtVAY" title="Video Kegiatan" allowfullscreen></iframe>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 05 Mar 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">videocam</span> Video</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Liputan Kegiatan Expo SMP</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Saksikan keseruan Expo SMP Putra Pakuan yang menampilkan karya dan inovasi siswa dari berbagai jurusan.
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Tonton Video
                    </button>
                </div>
            </div>
            <!-- Foto 2 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80')">
                    <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 28 Feb 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">photo_camera</span> Dokumentasi</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Juara Lomba Desain Grafis Nasional</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Tim SMP Putra Pakuan berhasil meraih juara 1 dalam lomba desain grafis tingkat nasional.
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Lihat Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });

    document.addEventListener('DOMContentLoaded', () => {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');

        function showSlide(index) {
            // Remove active class from all slides
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });

            // Add active class to current slide
            slides[index].classList.add('active');

            // Update dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-white/20');
                    dot.classList.add('bg-primary');
                } else {
                    dot.classList.remove('bg-primary');
                    dot.classList.add('bg-white/20');
                }
            });

            currentSlide = index;
        }

        // Previous button
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                const newIndex = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(newIndex);
            });
        }

        // Next button
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const newIndex = (currentSlide + 1) % slides.length;
                showSlide(newIndex);
            });
        }

        // Dot navigation
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                showSlide(i);
            });
        });

        // Auto slide every 5 seconds
        setInterval(() => {
            const newIndex = (currentSlide + 1) % slides.length;
            showSlide(newIndex);
        }, 5000);

        // Initialize first slide
        showSlide(0);
    });
</script>
