<!-- resources/views/layouts/SD/app.blade.php -->
<!DOCTYPE html>
<html lang="id" style="margin:0; padding:0; background:#1e293b;">
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

        .site-loading-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(2px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease;
        }

        .site-loading-overlay.is-active {
            opacity: 1;
            pointer-events: auto;
        }

        .site-loading-spinner {
            width: 52px;
            height: 52px;
            border-radius: 9999px;
            border: 4px solid rgba(255, 255, 255, 0.35);
            border-top-color: #dc2626;
            animation: site-loading-spin 0.85s linear infinite;
        }

        @keyframes site-loading-spin {
            to { transform: rotate(360deg); }
        }
    </style>
    @stack('head')
    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@2.0.4" defer></script>
</head>
<body class="m-0 p-0 bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100"
    hx-boost="true"
    hx-target="#main-content"
    hx-select="#main-content"
    hx-swap="outerHTML transition:true"
    hx-push-url="true">
    <div id="site-loading-overlay" class="site-loading-overlay" aria-hidden="true">
        <div class="site-loading-spinner" role="status" aria-label="Memuat halaman"></div>
    </div>
    <!-- Navbar -->
    <nav style="box-shadow: 0 -24px 0 #1e293b;" class="sticky top-0 z-50 w-full bg-charcoal text-white border-b border-primary/20">
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
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'sd']) }}">PROFIL</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'sd']) }}">VISI DAN MISI</a>
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
                <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all ml-4" onclick="window.location.href='{{ route('school.ppdb', ['school' => 'sd']) }}'">
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
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'sd']) }}">PROFIL</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'sd']) }}">VISI DAN MISI</a>
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
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.ppdb', ['school' => 'sd']) }}">{{ $ppdbLabel }} @if(!($ppdbLive ?? false)) (Segera Hadir) @endif</a>
        </div>
        <script>
            function setSiteLoadingState(isLoading) {
                const overlay = document.getElementById('site-loading-overlay');
                if (!overlay) return;
                overlay.classList.toggle('is-active', isLoading);
                overlay.setAttribute('aria-hidden', isLoading ? 'false' : 'true');
            }

            document.addEventListener('click', (event) => {
                const link = event.target.closest('a[href]');
                if (!link) return;
                const href = link.getAttribute('href') || '';
                if (!href || href.startsWith('#') || link.target === '_blank' || event.ctrlKey || event.metaKey) {
                    return;
                }
                setSiteLoadingState(true);
            });

            document.addEventListener('submit', () => setSiteLoadingState(true));
            document.addEventListener('htmx:beforeRequest', () => setSiteLoadingState(true));
            document.addEventListener('htmx:beforeHistorySave', () => setSiteLoadingState(false));
            document.addEventListener('htmx:historyRestore', () => setSiteLoadingState(false));
            document.addEventListener('htmx:afterSettle', () => {
                setSiteLoadingState(false);
                closeMobileMenuInstant();
            });
            document.addEventListener('htmx:responseError', () => setSiteLoadingState(false));
            document.addEventListener('htmx:sendError', () => setSiteLoadingState(false));
            window.addEventListener('pagehide', () => setSiteLoadingState(false));
            window.addEventListener('pageshow', () => setSiteLoadingState(false));

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

            const closeMobileMenuInstant = () => {
                if (!mobileMenu) return;
                mobileMenu.style.display = 'none';
                mobileMenu.style.transform = 'translateX(100%)';
                if (mobileDirektoriDropdown) {
                    mobileDirektoriDropdown.classList.add('hidden');
                }
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

            if (mobileMenu) {
                mobileMenu.querySelectorAll('a[href]').forEach((link) => {
                    link.addEventListener('click', () => {
                        closeMobileMenu();
                    });
                });
            }
        </script>
    </nav>
    <!-- End Navbar -->
    <main id="main-content">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="mt-16 py-8 bg-charcoal text-white text-center">
        <div class="max-w-7xl mx-auto px-6">
            <span class="font-semibold">&copy; {{ date('Y') }} SDIT Putra Pakuan. All rights reserved.</span>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>






