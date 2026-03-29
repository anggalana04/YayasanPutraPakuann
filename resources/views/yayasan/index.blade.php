@extends('layouts.app')

@push('styles')
    <style type="text/tailwindcss">
        @layer utilities {
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            .text-shadow-lg {
                text-shadow: 0 4px 8px rgba(0,0,0,0.5);
            }
        }
    </style>
@endpush

@section('content')
@if (!empty($pageContent))
    {!! $pageContent !!}
@else
@php
    $yayasanPrincipals = collect($yayasanPrincipals ?? [])->filter(function ($item) {
        return is_array($item) && !empty($item['unit']);
    })->values()->all();

    $featuredPrincipal = $yayasanPrincipals[0] ?? null;

    $heroTitle = $featuredPrincipal['unit']
        ? "Selamat Datang di Yayasan Putra Pakuan - " . $featuredPrincipal['unit']
        : 'Selamat Datang di Yayasan Putra Pakuan';

    $heroSubtitle = $featuredPrincipal['description']
        ?? 'Membangun generasi unggul melalui pendidikan berkualitas dan karakter Islami.';

    $heroCta = $homepage?->cta_text ?: 'Daftar Sekarang';
    $heroCtaSecondary = $homepage?->cta_secondary_text ?: 'Tonton Video';

    $coreValues = is_array($homepage?->core_values)
        ? $homepage->core_values
        : [
            ['title' => 'Unggul', 'description' => 'Mencapai standar tertinggi dalam prestasi akademik dan karakter.'],
            ['title' => 'Intelektual', 'description' => 'Mengembangkan kemampuan berpikir kritis dan kreatif.'],
            ['title' => 'Bakat Sekolah', 'description' => 'Memupuk potensi dan keahlian unik setiap siswa.'],
        ];

    $unitSchools = $unitSchools ?? collect();
    $achievementItems = $achievementItems ?? collect();
    $newsItems = $newsItems ?? collect();
@endphp

    <!-- Hero Section -->
    <div class="w-full relative overflow-hidden">
        <div class="w-full min-h-[700px] md:min-h-[600px] relative flex items-center">
            <!-- Background Video with Overlay -->
            <div class="absolute inset-0 overflow-hidden">
                <video class="absolute inset-0 w-full h-full object-cover scale-[1.45]" autoplay muted loop playsinline>
                    <source src="{{ asset('video/intro.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
                <div class="absolute inset-0 bg-slate-900/70"></div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-20 right-10 w-72 h-72 bg-[#FDB913]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-[#FDB913]/5 rounded-full blur-3xl"></div>

            <!-- Content Container -->
            <div class="relative z-10 w-full max-w-[1280px] mx-auto px-4 md:px-10 py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Main Content -->
                    <div class="flex flex-col gap-8 text-center lg:text-left" data-aos="fade-right">
                        <div class="flex flex-col gap-4">
                            <h1 class="text-white text-4xl md:text-6xl lg:text-7xl font-black leading-tight tracking-tight text-shadow-lg">
                                {{ $heroTitle }}
                            </h1>

                            <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl font-medium">
                                {{ $heroSubtitle }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4 justify-center lg:justify-start items-center">
                            <a href="{{ route('daftar') }}" class="group flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-[#FDB913] hover:bg-[#E5A800] text-white text-base font-bold transition-all transform hover:scale-105 shadow-xl shadow-[#FDB913]/30">
                                <span>{{ $heroCta }}</span>
                                <span class="material-symbols-outlined text-xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                            <button class="flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:bg-white hover:text-slate-900 text-white text-base font-bold transition-all shadow-lg">
                                <span class="material-symbols-outlined text-xl">play_circle</span>
                                <span>{{ $heroCtaSecondary }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- Right Column - PAXIST Card -->
                    <div class="flex items-center justify-center lg:justify-end" data-aos="fade-left">
                        <div class="relative">
                            <!-- Decorative Background -->
                            <div class="absolute inset-0 bg-[#FDB913]/10 rounded-3xl blur-xl transform rotate-6"></div>

                            <!-- Main Card -->
                            <div class="relative bg-white/95 backdrop-blur-md border border-slate-200 p-8 md:p-12 rounded-3xl shadow-2xl max-w-md">
                                <div class="flex flex-col gap-6 items-center text-center">

                                    <div class="w-40 h-40 rounded-2xl flex items-center justify-center">
                                        <img src="{{ asset('images/yayasan-logo.jfif') }}" alt="Logo Yayasan Putra Pakuan" class="w-full h-full object-contain">
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <h2 class="text-slate-900 font-black text-3xl md:text-4xl tracking-wider">
                                            PAXIST
                                        </h2>
                                        <div class="w-16 h-1 bg-[#FDB913] rounded-full mx-auto"></div>
                                        <p class="text-slate-700 text-lg md:text-xl font-semibold leading-relaxed">
                                            Putra Pakuan Unggul, Intelektual, Bertalenta
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-3 w-full mt-4">
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Keunggulan dalam Pendidikan</span>
                                        </div>
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Pengembangan Karakter</span>
                                        </div>
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Pengembangan Bakat</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave SVG -->
            <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px] md:h-[100px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-white dark:fill-slate-900" d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Principals Section -->
    <div class="w-full bg-white dark:bg-background-dark py-20 flex justify-center">
        <div class="max-w-[1920px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                    Kepala Sekolah & Program
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl">
                    Para pemimpin yang berdedikasi membimbing setiap jenjang pendidikan di Yayasan Putra Pakuan.
                </p>
            </div>

            <!-- Grid of Principals -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-0 shadow-2xl rounded-xl overflow-hidden">
                @foreach ($yayasanPrincipals as $principal)
                    @php
                        $photoRaw = trim((string)($principal['photo_url'] ?? ''));
                        $videoRaw = trim((string)($principal['video_url'] ?? ''));
                        $photoUrl = \Illuminate\Support\Str::startsWith($photoRaw, ['http://', 'https://'])
                            ? $photoRaw
                            : asset(ltrim($photoRaw, '/'));
                    @endphp
                    <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="const v=this.querySelector('video'); if(v){v.play();}" onmouseleave="const v=this.querySelector('video'); if(v){v.pause(); v.currentTime = 0;}">
                        <img
                            src="{{ $photoUrl }}"
                            alt="Pimpinan {{ $principal['unit'] ?? 'Yayasan' }}"
                            class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 {{ $videoRaw !== '' ? 'group-hover:opacity-0' : '' }}"
                        />
                        @if ($videoRaw !== '')
                            <video
                                class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                muted
                                loop
                                playsinline
                            >
                                <source src="{{ $videoRaw }}" type="video/mp4">
                            </video>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                            <h3 class="text-3xl md:text-4xl font-black mb-2">{{ $principal['unit'] ?? '-' }}</h3>
                            <p class="text-base md:text-lg font-semibold mb-1 opacity-90">{{ $principal['name'] ?? '-' }}</p>
                            <p class="text-xs md:text-sm font-semibold mb-4 opacity-75 uppercase tracking-wide">{{ $principal['title'] ?? '-' }}</p>
                            <p class="text-sm md:text-base leading-relaxed opacity-90">{{ $principal['description'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Educational Units Section -->
    <div class="w-full bg-slate-50 dark:bg-background-dark py-20 flex justify-center">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                    Unit Pendidikan Kami
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl">
                    Jalur pendidikan lengkap yang menumbuhkan rasa ingin tahu dan karakter dari usia dini hingga kesiapan profesional.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                @forelse ($unitSchools as $unit)
                    <a href="{{ url('/'.($unit->slug ?? '#')) }}" class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                        <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style="background-image: url('{{ $unit->image_url ?? '/images/default-school.jpg' }}');">
                            <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="text-white font-bold tracking-widest uppercase text-sm">Jelajahi</span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow gap-2">
                            <h3 class="text-slate-900 dark:text-white text-lg font-bold">{{ $unit->name }}</h3>
                            <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">{{ strtoupper($unit->type) }}</p>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Kunjungi halaman {{ $unit->name }} untuk informasi lengkap dan pendaftaran.</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-slate-500">Data unit pendidikan belum tersedia saat ini.</div>
                @endforelse
            </div>
            <div class="flex justify-center mt-4">
                <button class="flex items-center justify-center rounded-xl h-12 px-8 border-2 border-[#FDB913] text-[#FDB913] hover:bg-[#FDB913] hover:text-white text-base font-bold transition-all shadow-sm hover:shadow-md">
                    Lihat Info Penerimaan
                </button>
            </div>
        </div>
    </div>

    <!-- Core Values Section -->
    <div class="w-full py-20 flex justify-center bg-white dark:bg-slate-900">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col gap-4 text-center items-center">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black leading-tight">
                    Nilai Inti Kami
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($coreValues as $coreValue)
                    <div class="group flex flex-col gap-6 rounded-2xl bg-slate-50 dark:bg-slate-800 p-8 hover:shadow-xl transition-all border border-slate-200 dark:border-slate-700 hover:border-[#FDB913]/40">
                        <div class="w-14 h-14 rounded-xl bg-[#FDB913]/10 flex items-center justify-center mb-2 group-hover:bg-[#FDB913]/20 transition-colors">
                            <span class="material-symbols-outlined text-[#FDB913] text-4xl">star</span>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h3 class="text-slate-900 dark:text-white text-2xl font-bold">{{ $coreValue['title'] }}</h3>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                                {{ $coreValue['description'] }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-slate-500">Nilai inti belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Achievements Section -->
    <section class="w-full flex justify-center px-4 md:px-10 py-20 bg-slate-50 dark:bg-background-dark">
        <div class="max-w-[1300px] w-full">
            <div class="flex flex-col gap-2 mb-8">
                <h2 class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Jejak Langkah Prestasi</h2>
                <p class="text-slate-600 dark:text-slate-400">Raihan gemilang siswa-siswi kami di tingkat regional, nasional, hingga internasional.</p>
            </div>

            <!-- Unit Filters -->
            <div class="flex overflow-x-auto pb-4 gap-2 mb-8 no-scrollbar">
                <button class="px-5 py-2.5 rounded-lg bg-[#FDB913] text-white font-bold text-sm shadow-lg shadow-[#FDB913]/25 whitespace-nowrap">
                    Semua Unit
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    TK
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SD
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SMP
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SMA
                </button>
            </div>

            <!-- Achievement Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($achievementItems as $achievement)
                    <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="relative h-48 w-full overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('{{ $achievement->image_url ?? '/images/default-achievement.jpg' }}');"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="bg-indigo-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">{{ Str::limit($achievement->category ?: 'Prestasi', 20) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col flex-1 p-5">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-[#FDB913] tracking-wide">{{ $achievement->school?->name ?? 'Yayasan' }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-500">{{ optional($achievement->published_at)->format('Y') ?? date('Y') }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2">{{ $achievement->title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-4 flex-1">{{ $achievement->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($achievement->content), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-slate-500">Belum ada prestasi yang dipublikasikan.</div>
                @endforelse
            </div>

            <div class="flex justify-center mt-10">
                <button class="px-6 py-3 rounded-xl border-2 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white font-bold text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Lihat Arsip Prestasi
                </button>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru Section -->
    <div class="w-full py-20 flex justify-center bg-white dark:bg-background-dark">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-10">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                <h2 class="text-slate-900 dark:text-white text-2xl md:text-3xl font-black tracking-tight">Berita Terbaru</h2>
                <a class="text-[#FDB913] font-bold hover:text-[#E5A800] text-sm flex items-center gap-2 transition-colors" href="#">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($newsItems as $news)
                    <a class="group flex flex-col gap-4" href="{{ route('yayasan.berita.show', ['slug' => $news->slug]) }}">
                        <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                            <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ $news->image_url ?? '/images/default-news.jpg' }}');"></div>
                            <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">{{ $news->category ?? 'Berita' }}</div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">{{ $news->title }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ optional($news->published_at)->format('d M Y') ?? '-' }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-slate-500">Berita terbaru belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </div>
@endif
@endsection






