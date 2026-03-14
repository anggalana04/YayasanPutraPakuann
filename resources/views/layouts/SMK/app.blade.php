<!-- resources/views/layouts/SMK/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SMK Putra Pakuan')</title>
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
    <style type="text/tailwindcss">
        body { font-family: 'Lexend', sans-serif; }
    </style>
    @stack('head')
</head>
<body class="bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 w-full bg-charcoal text-white border-b border-primary/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('school.home', ['school'=> 'smk']) }}">
                    <div class="size-10">
                        <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo">
                    </div>
                </a>
                <div>
                    <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMK PUTRA PAKUAN</h1>
                    <p class="text-[10px] text-primary font-medium tracking-widest uppercase">Vocational High School</p>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-6">
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'smk']) }}">PROFIL</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'smk']) }}">VISI DAN MISI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'smk']) }}">BERITA</a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" class="text-xs font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" @click.prevent="open = !open" @focus="open = true" tabindex="0">
                        DIREKTORI
                        <span class="material-symbols-outlined text-xs">expand_more</span>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 mt-2 w-64 bg-white text-charcoal rounded-lg shadow-lg border border-primary/10 z-50">
                        <a href="{{ route('school.direktori.guru', ['school' => 'smk']) }}"
                        class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">
                        Direktori Guru & Tenaga Kependidikan
                        </a>
                        <a href="{{ route('school.direktori.siswa', ['school' => 'smk']) }}" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold border-b border-slate-100">Direktori Peserta Didik</a>
                        <a href="#" class="block px-6 py-3 hover:bg-primary/10 text-sm font-semibold">Tracer Study</a>
                    </div>
                </div>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.galeri', ['school' => 'smk']) }}">GALERI</a>
                <a class="text-xs font-semibold hover:text-primary transition-colors" href="{{ route('school.kontak', ['school' => 'smk']) }}">HUBUNGI KAMI</a>
                <button class="bg-primary hover:bg-primary/90 text-charcoal px-5 py-2.5 rounded-lg text-xs font-bold transition-all ml-4" onclick="window.location.href='{{ route('school.ppdb', ['school' => 'smk']) }}'">
                    PPDB 2024
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
                    <a href="{{ route('school.home', ['school'=> 'smk']) }}">
                        <div class="size-10">
                            <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo">
                        </div>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMK PUTRA PAKUAN</h1>
                    </div>
                </div>
                <button class="text-primary text-2xl" id="mobile-menu-close" aria-label="Close menu">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.profil', ['school' => 'smk']) }}">PROFIL</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.visi', ['school' => 'smk']) }}">VISI DAN MISI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="#">KATEGORI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'smk']) }}">BERITA</a>
            <div class="flex flex-col gap-2">
                <button class="text-base font-semibold hover:text-primary transition-colors flex items-center gap-1 focus:outline-none" id="mobile-direktori-toggle">
                    DIREKTORI
                    <span class="material-symbols-outlined text-xs">expand_more</span>
                </button>
                <div id="mobile-direktori-dropdown" class="ml-4 flex-col gap-1 hidden">
                    <a href="#" class="block py-2 text-sm font-semibold">Direktori Guru & Tenaga Kependidikan</a>
                    <a href="#" class="block py-2 text-sm font-semibold">Direktori Peserta Didik</a>
                    <a href="#" class="block py-2 text-sm font-semibold">Tracer Study</a>
                </div>
            </div>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="#">GALERI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="#">HUBUNGI KAMI</a>
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.ppdb', ['school' => 'smk']) }}">PPDB 2024</a>
        </div>
        <script>
            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.style.display = 'flex';
                setTimeout(() => mobileMenu.style.transform = 'translateX(0)', 10);
            });
            mobileMenuClose.addEventListener('click', () => {
                mobileMenu.style.transform = 'translateX(100%)';
                setTimeout(() => mobileMenu.style.display = 'none', 300);
            });
            // Mobile direktori dropdown
            const mobileDirektoriToggle = document.getElementById('mobile-direktori-toggle');
            const mobileDirektoriDropdown = document.getElementById('mobile-direktori-dropdown');
            mobileDirektoriToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileDirektoriDropdown.classList.toggle('hidden');
            });
            // Close mobile dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileDirektoriToggle.contains(e.target) && !mobileDirektoriDropdown.contains(e.target)) {
                    mobileDirektoriDropdown.classList.add('hidden');
                }
            });
            // Prevent menu from closing when clicking inside dropdown
            mobileDirektoriDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });
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
                        <div class="size-10 bg-primary rounded-lg flex items-center justify-center text-charcoal">
                            <span class="material-symbols-outlined font-bold">school</span>
                        </div>
                        <h2 class="text-xl font-black tracking-tight">SMK PUTRA PAKUAN</h2>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Membangun generasi emas Indonesia yang kompeten, kreatif, dan mandiri melalui pendidikan vokasi yang berkualitas dan relevan.
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
                        <li><a class="hover:text-white transition-colors" href="#">Profil Sekolah</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Visi & Misi</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Direktori Guru</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Galeri Foto</a></li>
                        <li><a class="hover:text-white transition-colors" href="{{ route('school.ppdb', ['school' => 'smk']) }}">PPDB Online</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-primary">Jurusan</h4>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a class="hover:text-white transition-colors" href="#">Rekayasa Perangkat Lunak</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Teknik Komputer & Jaringan</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Multimedia & Desain Grafis</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Akuntansi Keuangan</a></li>
                        <li><a class="hover:text-white transition-colors" href="#">Perkantoran Digital</a></li>
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
                            <p class="text-slate-400 text-sm">info@smkputrapakuan.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs font-medium">
                <p>© 2024 SMK Putra Pakuan. All rights reserved.</p>
                <div class="flex gap-6">
                    <a class="hover:text-white" href="#">Privacy Policy</a>
                    <a class="hover:text-white" href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    @stack('scripts')
</body>
</html>
