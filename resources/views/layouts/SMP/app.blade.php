<!-- resources/views/layouts/SMP/app.blade.php -->
<!DOCTYPE html>
<html lang="id" style="margin:0; padding:0; background:#1e293b;">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    @php
        $seoTitle = trim($__env->yieldContent('title', 'SMP Putra Pakuan | Sekolah Menengah Pertama di Bogor'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'SMP Putra Pakuan membina siswa berprestasi, berkarakter, dan siap melanjutkan ke jenjang pendidikan yang lebih tinggi.'));
        $seoKeywords = trim($__env->yieldContent('meta_keywords', 'smp putra pakuan, smp bogor, ppdb smp, sekolah menengah pertama'));
        $seoImage = trim($__env->yieldContent('meta_image', asset('images/yayasan-logo.jfif')));
        $seoUrl = url()->current();
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}" />
    <meta name="keywords" content="{{ $seoKeywords }}" />
    <meta name="author" content="SMP Putra Pakuan" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="id-ID" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $seoUrl }}" />
    <link rel="icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="SMP Putra Pakuan" />
    <meta property="og:title" content="{{ $seoTitle }}" />
    <meta property="og:description" content="{{ $seoDescription }}" />
    <meta property="og:url" content="{{ $seoUrl }}" />
    <meta property="og:image" content="{{ $seoImage }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDescription }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />
    @php
        $orgSchema = [
            '@type' => 'EducationalOrganization',
            '@id' => route('school.home', ['school' => 'smp']) . '#organization',
            'name' => 'SMP Putra Pakuan',
            'url' => route('school.home', ['school' => 'smp']),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/yayasan-logo.jfif'),
            ],
        ];

        $websiteSchema = [
            '@type' => 'WebSite',
            '@id' => route('school.home', ['school' => 'smp']) . '#website',
            'url' => route('school.home', ['school' => 'smp']),
            'name' => 'SMP Putra Pakuan',
            'inLanguage' => 'id-ID',
            'publisher' => [
                '@id' => route('school.home', ['school' => 'smp']) . '#organization',
            ],
        ];

        $webpageSchema = [
            '@type' => 'WebPage',
            '@id' => $seoUrl . '#webpage',
            'url' => $seoUrl,
            'name' => $seoTitle,
            'description' => $seoDescription,
            'inLanguage' => 'id-ID',
            'isPartOf' => [
                '@id' => route('school.home', ['school' => 'smp']) . '#website',
            ],
        ];

        $seoJsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [$orgSchema, $websiteSchema, $webpageSchema],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($seoJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('structured_data')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3b82f6", // SMP blue
                        "background-light": "#f8f8f5",
                        "background-dark": "#1e293b",
                        "charcoal": "#1e293b",
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
    <style type="text/tailwindcss">
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body { font-family: 'Lexend', sans-serif; }
    </style>
    @stack('head')
</head>
<body class="m-0 p-0 bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100">
    <!-- Navbar -->
    <nav style="box-shadow: 0 -24px 0 #1e293b;" class="sticky top-0 z-50 w-full bg-charcoal text-white border-b border-primary/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('school.home', ['school'=> 'smp']) }}">
                    <div class="size-10">
                        <img src="{{ asset('images/yayasan-logo.jfif') }}" alt="Logo Yayasan Putra Pakuan">
                    </div>
                </a>
                <div>
                    <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMP PUTRA PAKUAN</h1>
                    <p class="text-[10px] text-primary font-medium tracking-widest uppercase">Sekolah Menengah Pertama</p>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-6">
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'smp']) }}">PROFIL</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'smp']) }}">VISI DAN MISI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'smp']) }}">BERITA</a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" class="text-xs font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" @click.prevent="open = !open" @focus="open = true" tabindex="0">
                        DIREKTORI
                        <span class="material-symbols-outlined text-xs">expand_more</span>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 mt-2 w-64 bg-white text-charcoal rounded-lg shadow-lg border border-primary/10 z-50">
                        <a href="{{ route('school.direktori.guru', ['school' => 'smp']) }}" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">Direktori Guru & Tenaga Kependidikan</a>
                        <a href="{{ route('school.direktori.siswa', ['school' => 'smp']) }}" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">Direktori Peserta Didik</a>
                        <a href="#" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold">Tracer Study</a>
                    </div>
                </div>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.galeri', ['school' => 'smp']) }}">GALERI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.kontak', ['school' => 'smp']) }}">HUBUNGI KAMI</a>
                @php
                    $ppdbLive = $ppdbLive ?? false;
                    $ppdbLabel = ($ppdbPeriod ?? null) ? 'PPDB ' . $ppdbPeriod : 'PPDB';
                @endphp
                <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all ml-4" onclick="window.location.href='{{ route('school.ppdb', ['school' => 'smp']) }}'">
                    {{ $ppdbLabel }} @if(!$ppdbLive) (Segera Hadir) @endif
                </button>
            </div>
            <!-- Mobile menu button -->
            <button class="lg:hidden text-primary" id="mobile-menu-toggle" aria-label="Open menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
        <!-- Mobile Navbar -->
        <div id="mobile-menu" class="fixed inset-0 z-50 bg-charcoal/95 text-white flex flex-col gap-6 px-8 py-10 transition-all duration-300 translate-x-full lg:hidden" style="display:none;">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <a href="{{ route('school.home', ['school'=> 'smp']) }}">
                        <div class="size-10">
                        </div>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMP PUTRA PAKUAN</h1>
                    </div>
                </div>
                <button class="text-primary text-2xl" id="mobile-menu-close" aria-label="Close menu">
                    <span class="material-symbols-outlined" aria-hidden="true">close</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'smp']) }}">PROFIL</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'smp']) }}">VISI DAN MISI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'smp']) }}">BERITA</a>
            <div class="flex flex-col gap-2">
                <button class="text-base font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" id="mobile-direktori-toggle">
                    DIREKTORI
                    <span class="material-symbols-outlined text-xs">expand_more</span>
                </button>
                <div id="mobile-direktori-dropdown" class="ml-4 flex-col gap-1 hidden">
                    <a href="{{ route('school.direktori.guru', ['school' => 'smp']) }}" class="block py-2 text-sm font-semibold">Direktori Guru & Tenaga Kependidikan</a>
                    <a href="{{ route('school.direktori.siswa', ['school' => 'smp']) }}" class="block py-2 text-sm font-semibold">Direktori Peserta Didik</a>
                    <a href="#" class="block py-2 text-sm font-semibold">Tracer Study</a>
                </div>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.galeri', ['school' => 'smp']) }}">GALERI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.kontak', ['school' => 'smp']) }}">HUBUNGI KAMI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.ppdb', ['school' => 'smp']) }}">{{ $ppdbLabel }} @if(!($ppdbLive ?? false)) (Segera Hadir) @endif</a>
        </div>
        <script>
            // Mobile menu toggle with robust guards
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileDirektoriToggle = document.getElementById('mobile-direktori-toggle');
            const mobileDirektoriDropdown = document.getElementById('mobile-direktori-dropdown');

            const openMobileMenu = () => {
                if (!mobileMenu) return;
                mobileMenu.style.display = 'flex';
                requestAnimationFrame(() => {
                    mobileMenu.style.transform = 'translateX(0)';
                });
            };

            const closeMobileMenu = () => {
                if (!mobileMenu) return;
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.addEventListener('transitionend', function hideMenu() {
                    mobileMenu.style.display = 'none';
                    mobileMenu.removeEventListener('transitionend', hideMenu);
                });
            };

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    openMobileMenu();
                });
            }
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeMobileMenu();
                });
            }

            if (mobileDirektoriToggle && mobileDirektoriDropdown) {
                mobileDirektoriToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileDirektoriDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!mobileDirektoriToggle.contains(e.target) && !mobileDirektoriDropdown.contains(e.target)) {
                        mobileDirektoriDropdown.classList.add('hidden');
                    }
                });

                mobileDirektoriDropdown.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }
        </script>
    </nav>
    <!-- End Navbar -->
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-charcoal text-white pt-20 pb-10 border-t-4 border-primary">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="relative w-10 h-10 rounded-lg overflow-hidden border border-white/30">
                            <img src="{{ asset('images/yayasan-logo.jfif') }}" alt="Logo Yayasan Putra Pakuan" class="w-full h-full object-cover" />
                            <span class="absolute -top-2 -right-2 bg-white text-charcoal rounded-full w-5 h-5 grid place-items-center text-xs font-bold border border-charcoal">x</span>
                        </div>
                        <h2 class="text-xl font-black tracking-tight">SMP PUTRA PAKUAN</h2>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Membangun generasi emas Indonesia yang berkarakter, berprestasi, dan siap melanjutkan ke jenjang pendidikan lebih tinggi.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-primary hover:text-charcoal transition-all" href="#">
                            <span class="material-symbols-outlined text-xl">social_leaderboard</span>
                        </a>
                        <a class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-primary hover:text-charcoal transition-all" href="#">
                            <span class="material-symbols-outlined text-xl">language</span>
                        </a>
                        <a class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-primary hover:text-charcoal transition-all" href="#">
                            <span class="material-symbols-outlined text-xl">alternate_email</span>
                        </a>
                    </div>
                </div>
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-primary">Navigasi</h4>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.profil', ['school' => 'smp']) }}">Profil Sekolah</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.visi', ['school' => 'smp']) }}">Visi & Misi</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.direktori.guru', ['school' => 'smp']) }}">Direktori Guru</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.galeri', ['school' => 'smp']) }}">Galeri Foto</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.ppdb', ['school' => 'smp']) }}">PPDB Online</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-primary">Program</h4>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a class="hover:text-white transition-colors" href="#">Kurikulum Merdeka</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Penguatan Karakter</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Literasi & Numerasi</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Ekstrakurikuler</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Bimbingan Konseling</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-primary">Hubungi Kami</h4>
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start">
                            <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                            <p class="text-slate-400 text-sm">Jl. Raya Pakuan No. 123, Bogor, Jawa Barat, Indonesia</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <span class="material-symbols-outlined text-primary">call</span>
                            <p class="text-slate-400 text-sm">(0251) 1234567</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <span class="material-symbols-outlined text-primary">mail</span>
                            <p class="text-slate-400 text-sm">info@smpputrapakuan.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs font-medium">
                <p>© {{ date('Y') }} SMP Putra Pakuan. All rights reserved.</p>
                <div class="flex gap-6">
                    <a class="hover:text-white" href="#">Kebijakan Privasi</a>
                    <a class="hover:text-white" href="#">Syarat Layanan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Quick Info FAB -->
    <div id="smp-fab-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
        <button id="smp-fab" class="flex items-center justify-center w-14 h-14 rounded-full bg-primary text-charcoal shadow-2xl hover:bg-primary/90 focus:outline-none" aria-label="Quick Info">
            <span class="material-symbols-outlined text-2xl">help</span>
        </button>
        <div id="smp-fab-menu" class="hidden w-64 rounded-xl bg-charcoal/95 text-white shadow-2xl p-3 space-y-2">
            <a href="{{ route('school.ppdb', ['school' => 'smp']) }}" class="block px-3 py-2 rounded-lg bg-primary/20 hover:bg-primary transition-colors">Daftar PPDB</a>
            <a href="{{ route('school.prestasi', ['school' => 'smp']) }}" class="block px-3 py-2 rounded-lg bg-primary/20 hover:bg-primary transition-colors">Lihat Prestasi</a>
            <a href="{{ route('school.kontak', ['school' => 'smp']) }}" class="block px-3 py-2 rounded-lg bg-primary/20 hover:bg-primary transition-colors">Kontak Sekolah</a>
        </div>
    </div>

    <script>
        const smpFabButton = document.getElementById('smp-fab');
        const smpFabMenu = document.getElementById('smp-fab-menu');

        if (smpFabButton && smpFabMenu) {
            smpFabButton.addEventListener('click', function () {
                smpFabMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!smpFabButton.contains(event.target) && !smpFabMenu.contains(event.target)) {
                    smpFabMenu.classList.add('hidden');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>






