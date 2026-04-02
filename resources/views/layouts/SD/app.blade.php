<!-- resources/views/layouts/SD/app.blade.php -->
<!DOCTYPE html>
<html lang="id" style="margin:0; padding:0; background:#f8f8f5;">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    @php
        $seoTitle = trim($__env->yieldContent('title', 'SDIT Putra Pakuan | Sekolah Dasar Islam Terpadu di Bogor'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'SDIT Putra Pakuan menghadirkan pendidikan dasar Islam terpadu yang unggul, berkarakter, dan ramah perkembangan anak.'));
        $seoKeywords = trim($__env->yieldContent('meta_keywords', 'sdit putra pakuan, sd islam terpadu bogor, ppdb sdit, sekolah dasar islam'));
        $seoImage = trim($__env->yieldContent('meta_image', asset('images/logo-sdit-putrapakuan.png')));
        $seoUrl = url()->current();
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}" />
    <meta name="keywords" content="{{ $seoKeywords }}" />
    <meta name="author" content="SDIT Putra Pakuan" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="id-ID" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $seoUrl }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sdit-putrapakuan.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-sdit-putrapakuan.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-sdit-putrapakuan.png') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="SDIT Putra Pakuan" />
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
            '@id' => route('school.home', ['school' => 'sd']) . '#organization',
            'name' => 'SDIT Putra Pakuan',
            'url' => route('school.home', ['school' => 'sd']),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo-sdit-putrapakuan.png'),
            ],
        ];

        $websiteSchema = [
            '@type' => 'WebSite',
            '@id' => route('school.home', ['school' => 'sd']) . '#website',
            'url' => route('school.home', ['school' => 'sd']),
            'name' => 'SDIT Putra Pakuan',
            'inLanguage' => 'id-ID',
            'publisher' => [
                '@id' => route('school.home', ['school' => 'sd']) . '#organization',
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
                '@id' => route('school.home', ['school' => 'sd']) . '#website',
            ],
        ];

        $seoJsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [$orgSchema, $websiteSchema, $webpageSchema],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($seoJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('structured_data')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('fonts/fonts.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <style>
        :root {
            --color-primary: #dc2626;
            --color-secondary: #16a34a;
            --color-primary-soft: #fee2e2;
            --color-secondary-soft: #dcfce7;
            --color-charcoal: #1e293b;
            --color-background-light: #f8f8f5;
            --color-background-dark: #1e293b;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#dc2626",
                        secondary: "#16a34a",
                        "primary-soft": "#fee2e2",
                        "secondary-soft": "#dcfce7",
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
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body { font-family: 'Lexend', sans-serif; }

    </style>
    @stack('head')
    <!-- HTMX -->
    <script src="{{ asset('js/htmx.min.js') }}" defer></script>
</head>
<body class="m-0 p-0 bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100"
    hx-boost="true"
    hx-target="#main-content"
    hx-select="#main-content"
    hx-swap="outerHTML transition:true"
    hx-push-url="true">
    <!-- Navbar -->
    <nav id="school-nav" class="fixed top-0 z-50 w-full bg-charcoal text-white border-b border-primary/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('school.home', ['school'=> 'sd']) }}">
                    <div class="size-10">
                        <img src="{{ asset('images/logo-sdit-putrapakuan.png') }}" alt="Logo SDIT Putra Pakuan">
                    </div>
                </a>
                <div>
                    <h1 class="text-lg font-bold leading-none tracking-tight text-white">SDIT PUTRA PAKUAN</h1>
                    <p class="text-[10px] text-primary font-medium tracking-widest uppercase">Sekolah Dasar Islam Terpadu</p>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-6">
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.home', ['school' => 'sd']) }}">BERANDA</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'sd']) }}">PROFIL</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'sd']) }}">BERITA</a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" class="text-xs font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" @click.prevent="open = !open" @focus="open = true" tabindex="0">
                        DIREKTORI
                        <span class="material-symbols-outlined text-xs">expand_more</span>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 mt-2 w-64 bg-white text-charcoal rounded-lg shadow-lg border border-primary/10 z-50">
                        <a href="{{ route('school.direktori.guru', ['school' => 'sd']) }}" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">Direktori Guru & Tenaga Kependidikan</a>
                        {{-- <a href="{{ route('school.direktori.siswa', ['school' => 'sd']) }}" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">Direktori Peserta Didik</a> --}}
                        {{-- <a href="#" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold">Tracer Study</a> --}}
                    </div>
                </div>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.galeri', ['school' => 'sd']) }}">GALERI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.kontak', ['school' => 'sd']) }}">HUBUNGI KAMI</a>
                @php
                    $ppdbLive = $ppdbLive ?? false;
                    $ppdbLabel = ($ppdbPeriod ?? null) ? 'PPDB ' . $ppdbPeriod : 'PPDB';
                @endphp
                @if($ppdbLive)
                <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all ml-4" onclick="window.location.href='{{ route('school.ppdb', ['school' => 'sd']) }}'">
                    {{ $ppdbLabel }}
                </button>
                @endif
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
                    <a href="{{ route('school.home', ['school'=> 'sd']) }}">
                        <div class="size-10">
                            <img src="{{ asset('images/logo-sdit-putrapakuan.png') }}" alt="Logo SDIT Putra Pakuan">
                        </div>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold leading-none tracking-tight text-white">SDIT PUTRA PAKUAN</h1>
                    </div>
                </div>
                <button class="text-primary text-2xl" id="mobile-menu-close" aria-label="Close menu">
                    <span class="material-symbols-outlined" aria-hidden="true">close</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.home', ['school' => 'sd']) }}">BERANDA</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'sd']) }}">PROFIL</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'sd']) }}">BERITA</a>
            <div class="flex flex-col gap-2">
                <button class="text-base font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" id="mobile-direktori-toggle">
                    DIREKTORI
                    <span class="material-symbols-outlined text-xs">expand_more</span>
                </button>
                <div id="mobile-direktori-dropdown" class="ml-4 flex-col gap-1 hidden">
                    <a href="{{ route('school.direktori.guru', ['school' => 'sd']) }}" class="block py-2 text-sm font-semibold">Direktori Guru & Tenaga Kependidikan</a>
                    {{-- <a href="{{ route('school.direktori.siswa', ['school' => 'sd']) }}" class="block py-2 text-sm font-semibold">Direktori Peserta Didik</a> --}}
                    {{-- <a href="#" class="block py-2 text-sm font-semibold">Tracer Study</a> --}}
                </div>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.galeri', ['school' => 'sd']) }}">GALERI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.kontak', ['school' => 'sd']) }}">HUBUNGI KAMI</a>
            @if($ppdbLive ?? false)
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.ppdb', ['school' => 'sd']) }}">{{ $ppdbLabel }}</a>
            @endif
        </div>
        <script>
            // HTMX-safe mobile menu handlers
            function initSdMobileMenu() {
                const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileMenuClose = document.getElementById('mobile-menu-close');
                const mobileDirektoriToggle = document.getElementById('mobile-direktori-toggle');
                const mobileDirektoriDropdown = document.getElementById('mobile-direktori-dropdown');

                if (!mobileMenu) return;

                const openMobileMenu = () => {
                    mobileMenu.style.display = 'flex';
                    requestAnimationFrame(() => {
                        mobileMenu.style.translate = '0';
                    });
                };

                const closeMobileMenu = () => {
                    mobileMenu.style.translate = '100%';
                    mobileMenu.addEventListener('transitionend', function hideMenu() {
                        mobileMenu.style.display = 'none';
                        mobileMenu.style.translate = '';
                        mobileMenu.removeEventListener('transitionend', hideMenu);
                    });
                };

                if (mobileMenuToggle && !mobileMenuToggle._htmxInit) {
                    mobileMenuToggle._htmxInit = true;
                    mobileMenuToggle.addEventListener('click', (e) => {
                        e.preventDefault();
                        openMobileMenu();
                    });
                }

                if (mobileMenuClose && !mobileMenuClose._htmxInit) {
                    mobileMenuClose._htmxInit = true;
                    mobileMenuClose.addEventListener('click', (e) => {
                        e.preventDefault();
                        closeMobileMenu();
                    });
                }

                if (mobileDirektoriToggle && mobileDirektoriDropdown && !mobileDirektoriToggle._htmxInit) {
                    mobileDirektoriToggle._htmxInit = true;
                    mobileDirektoriToggle.addEventListener('click', (e) => {
                        e.stopPropagation();
                        mobileDirektoriDropdown.classList.toggle('hidden');
                    });

                    if (!mobileDirektoriDropdown._htmxInit) {
                        mobileDirektoriDropdown._htmxInit = true;
                        mobileDirektoriDropdown.addEventListener('click', (e) => {
                            e.stopPropagation();
                        });
                    }

                    if (!document._sdDirektoriOutsideInit) {
                        document._sdDirektoriOutsideInit = true;
                        document.addEventListener('click', (e) => {
                            if (!mobileDirektoriToggle.contains(e.target) && !mobileDirektoriDropdown.contains(e.target)) {
                                mobileDirektoriDropdown.classList.add('hidden');
                            }
                        });
                    }
                }

                mobileMenu.querySelectorAll('a[href]').forEach((link) => {
                    if (link._htmxInit) return;
                    link._htmxInit = true;
                    link.addEventListener('click', () => {
                        closeMobileMenu();
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initSdMobileMenu);
            } else {
                initSdMobileMenu();
            }

            document.addEventListener('htmx:afterSettle', initSdMobileMenu);
        </script>
    </nav>
    <!-- End Navbar -->
    <script>
    (function() {
        var _navScrollListener = null;
        function updateNavLayout() {
            var nav = document.getElementById('school-nav');
            var mainContent = document.getElementById('main-content');
            if (!nav) return;
            if (_navScrollListener) {
                window.removeEventListener('scroll', _navScrollListener);
                _navScrollListener = null;
            }
            var hasHero = mainContent && mainContent.querySelector('[data-hero-section]');
            if (hasHero) {
                if (mainContent) mainContent.style.paddingTop = '0';
                var onScroll = function() {
                    if (window.scrollY > 80) {
                        nav.classList.add('bg-charcoal');
                        nav.style.borderColor = '';
                        nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4)';
                    } else {
                        nav.classList.remove('bg-charcoal');
                        nav.style.borderColor = 'transparent';
                        nav.style.boxShadow = 'none';
                    }
                };
                _navScrollListener = onScroll;
                window.addEventListener('scroll', _navScrollListener, { passive: true });
                onScroll();
            } else {
                nav.classList.add('bg-charcoal');
                nav.style.borderColor = '';
                nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.3)';
                if (mainContent) {
                    mainContent.style.paddingTop = nav.offsetHeight + 'px';
                }
            }
        }
        document.addEventListener('DOMContentLoaded', updateNavLayout);
        document.addEventListener('htmx:afterSettle', updateNavLayout);
    })();
    </script>
    <main id="main-content">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-charcoal text-white pt-20 pb-10 border-t-4 border-primary">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="relative w-10 h-10 rounded-lg overflow-hidden border border-white/30">
                            <img src="{{ asset('images/logo-yayasan.png') }}" alt="SDIT Putra Pakuan" class="w-full h-full object-cover" />
                        </div>
                        <h2 class="text-xl font-black tracking-tight">SDIT PUTRA PAKUAN</h2>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Membangun generasi emas Indonesia yang beriman, berilmu, dan berakhlak mulia melalui pendidikan dasar Islam terpadu yang berkualitas.
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
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.profil', ['school' => 'sd']) }}">Profil Sekolah</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.visi', ['school' => 'sd']) }}">Visi &amp; Misi</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.direktori.guru', ['school' => 'sd']) }}">Direktori Guru</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.galeri', ['school' => 'sd']) }}">Galeri Foto</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.ppdb', ['school' => 'sd']) }}">PPDB Online</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-primary">Program</h4>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a class="hover:text-white transition-colors" href="#">Kurikulum Merdeka</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Tahfidz Al-Qur'an</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Bahasa Arab &amp; Inggris</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Ekstrakurikuler</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Bimbingan Belajar</a></li>
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
                            <p class="text-slate-400 text-sm">info@sditputrapakuan.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs font-medium">
                <p>&copy; {{ date('Y') }} SDIT Putra Pakuan. All rights reserved.</p>
                <div class="flex gap-6">
                    <a class="hover:text-white" href="#">Kebijakan Privasi</a>
                    <a class="hover:text-white" href="#">Syarat Layanan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Quick Info FAB -->
    <div id="sd-fab-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
        <button id="sd-fab" class="flex items-center justify-center w-14 h-14 rounded-full bg-primary text-charcoal shadow-2xl hover:bg-primary/90 focus:outline-none" aria-label="Quick Info">
            <span class="material-symbols-outlined text-2xl">help</span>
        </button>
        <div id="sd-fab-menu" class="hidden w-64 rounded-xl bg-charcoal/95 text-white shadow-2xl p-3 space-y-2">
            <a href="{{ route('school.ppdb', ['school' => 'sd']) }}" class="block px-3 py-2 rounded-lg bg-primary/20 hover:bg-primary transition-colors">Daftar PPDB</a>
            <a href="{{ route('school.kontak', ['school' => 'sd']) }}" class="block px-3 py-2 rounded-lg bg-primary/20 hover:bg-primary transition-colors">Kontak Sekolah</a>
        </div>
    </div>

    <script>
        if (!window.__sdFabInitialized) {
            window.__sdFabInitialized = true;
            const initSdFab = () => {
                const fabBtn = document.getElementById('sd-fab');
                const fabMenu = document.getElementById('sd-fab-menu');
                if (fabBtn && fabMenu) {
                    fabBtn.addEventListener('click', (e) => { e.stopPropagation(); fabMenu.classList.toggle('hidden'); });
                    document.addEventListener('click', (e) => { if (!fabBtn.contains(e.target) && !fabMenu.contains(e.target)) fabMenu.classList.add('hidden'); });
                }
            };
            document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', initSdFab) : initSdFab();
        }
    </script>
    @stack('scripts')
</body>
</html>






