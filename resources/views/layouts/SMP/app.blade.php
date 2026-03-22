<!-- resources/views/layouts/SMP/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SMP Putra Pakuan')</title>
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
        body { font-family: 'Lexend', sans-serif; }
    </style>
    @stack('head')
</head>
<body class="bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 w-full bg-charcoal text-white border-b border-primary/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('school.home', ['school'=> 'smp']) }}">
                    <div class="size-10">
                        <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo">
                    </div>
                </a>
                <div>
                    <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMP PUTRA PAKUAN</h1>
                    <p class="text-[10px] text-primary font-medium tracking-widest uppercase">Junior High School</p>
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
                <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all ml-4" onclick="window.location.href='{{ route('school.ppdb', ['school' => 'smp']) }}'">
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
                    <a href="{{ route('school.home', ['school'=> 'smp']) }}">
                        <div class="size-10">
                        </div>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold leading-none tracking-tight text-white">SMP PUTRA PAKUAN</h1>
                    </div>
                </div>
                <button class="text-primary text-2xl" id="mobile-menu-close" aria-label="Close menu">
                    <span class="material-symbols-outlined">close</span>
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
            <a class="text-base font-semibold hover:text-primary transition-colors" href="{{ route('school.ppdb', ['school' => 'smp']) }}">PPDB 2024</a>
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
    <footer class="mt-16 py-8 bg-charcoal text-white text-center">
        <div class="max-w-7xl mx-auto px-6">
            <span class="font-semibold">&copy; {{ date('Y') }} SMP Putra Pakuan. All rights reserved.</span>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
