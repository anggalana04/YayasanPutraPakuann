<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Yayasan Putra Pakuan')</title>
    <!-- Google Fonts: Lexend -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Theme Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13a4ec", // Blue
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "text-main": "#334155",
                        "text-muted": "#64748b",
                         "secondary": "#D12D16", // Red
                         "accent": "#0f172a", // Dark Slate for contrast elements
                         "background-subtle": "#fffbeb", // Very light yellow tint
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
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main dark:text-slate-100 transition-colors duration-200">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden group/design-root">
        <!-- Top Navigation -->
        <header class="sticky top-0 z-50 bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-slate-200 dark:border-white/10 w-full" style="position:sticky;top:0;z-index:50;">
            <div class="layout-container flex justify-center w-full">
                <div class="flex max-w-[1280px] w-full px-4 md:px-10 py-3 items-center justify-between">

                    <div class="flex items-center gap-4 text-text-main dark:text-white">
                        <a href="{{ route('home') }}">
                        <div class="size-10 text-primary">
                            <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo">
                        </div>
                    </a>
                            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Yayasan Putra Pakuan</h2>
                    </div>
                    <div class="hidden md:flex items-center gap-8">
                        <nav class="flex items-center gap-6">
                            <a class="text-sm font-medium {{ Request::is('/') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ url('/') }}">Beranda</a>
                            <a class="text-sm font-medium {{ Request::is('about') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('about') }}">Tentang Kami</a>
                            <a class="text-sm font-medium {{ Request::is('fasilitas') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('fasilitas') }}">Fasilitas</a>
                            <a class="text-sm font-medium {{ Request::is('akreditasi') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('akreditasi') }}">Prestasi</a>
                            <a class="text-sm font-medium {{ Request::is('berita') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('berita') }}">Berita</a>
                            <a class="text-sm font-medium {{ Request::is('kontak') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('kontak') }}">Kontak</a>
                        </nav>
                        {{-- <button class="flex items-center justify-center rounded-xl h-10 px-6 bg-secondary hover:bg-red-700 text-white text-sm font-bold transition-all shadow-lg shadow-secondary/20">
                            Masuk
                        </button> --}}
                    </div>
                    <!-- Mobile Menu Icon -->
                    <button id="mobile-menu-btn" class="md:hidden text-primary dark:text-white">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu hidden -->
            <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white dark:bg-background-dark border-b border-slate-200 dark:border-white/10 p-4 flex flex-col gap-4 shadow-lg">
                <nav class="flex flex-col gap-4">
                    <a class="text-sm font-medium {{ Request::is('/') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ url('/') }}">Beranda</a>
                    <a class="text-sm font-medium {{ Request::is('about') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('about') }}">Tentang Kami</a>
                    <a class="text-sm font-medium {{ Request::is('fasilitas') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('fasilitas') }}">Fasilitas</a>
                    <a class="text-sm font-medium {{ Request::is('akreditasi') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ url('/akreditasi') }}">Prestasi</a>
                    <a class="text-sm font-medium {{ Request::is('berita') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ url('/berita') }}">Berita</a>
                    <a class="text-sm font-medium {{ Request::is('kontak') ? 'text-secondary font-bold' : 'hover:text-primary transition-colors' }}" href="{{ route('kontak') }}">Kontak</a>

                </nav>
                {{-- <button class="flex items-center justify-center rounded-xl h-10 px-6 bg-secondary hover:bg-red-700 text-white text-sm font-bold transition-all shadow-lg shadow-secondary/20 w-full">
                    Masuk
                </button> --}}
            </div>
        </header>

        <!-- Floating Action Button (FAB) -->
        <div id="fab-overlay" class="fixed inset-0 z-[98] bg-black/40 hidden transition-opacity"></div>
        <div id="fab" class="fixed z-[99] bottom-6 right-6 flex flex-col items-end gap-3">
            <!-- Expanded Buttons -->
            <div id="fab-actions" class="flex flex-col items-end gap-3 mb-2 hidden">
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-green-500 text-white shadow-lg hover:bg-green-600 transition-all">
                    <span class="material-symbols-outlined">chat</span> WhatsApp
                </a>
                <a href="mailto:info@putrapakuan.sch.id" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500 text-white shadow-lg hover:bg-red-600 transition-all">
                    <span class="material-symbols-outlined">mail</span> Gmail
                </a>
                <a href="/brochure.pdf" download class="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white shadow-lg hover:bg-sky-600 transition-all">
                    <span class="material-symbols-outlined">download</span> Download Brochure
                </a>
                <a href="{{ route('kontak') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary text-white shadow-lg hover:bg-red-700 transition-all">
                    <span class="material-symbols-outlined">call</span> Kontak Sekolah
                </a>
                <a href="{{ route('fasilitas') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white text-primary shadow-lg border border-primary hover:bg-primary hover:text-white transition-all">
                    <span class="material-symbols-outlined">school</span> Lihat Fasilitas
                </a>
            </div>
            <!-- Main FAB Button -->
            <button id="fab-main" class="flex items-center justify-center w-14 h-14 rounded-full bg-primary text-white shadow-2xl text-3xl hover:bg-sky-600 transition-all focus:outline-none">
                <span id="fab-icon" class="material-symbols-outlined">menu</span>
            </button>
        </div>

        <!-- Main Content Wrapper -->
        <main class="flex flex-col items-center w-full">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="w-full bg-white dark:bg-[#0b1317] border-t border-slate-200 dark:border-white/10 pt-16 pb-8">
            <div class="layout-container flex flex-col items-center w-full px-4 md:px-10">
                <div class="max-w-[1280px] w-full grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                    <div class="md:col-span-1 flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-text-main dark:text-white">
                            <div class="size-6 text-primary">
                                                            <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo">

                            </div>
                            <h2 class="text-base font-bold">Yayasan Putra Pakuan</h2>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Jalan Pendidikan No. 123, Kota Bogor<br/>
                            Jawa Barat, Indonesia
                        </p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h4 class="text-text-main dark:text-white font-bold text-sm">Tentang Kami</h4>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Sejarah</a>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Visi &amp; Misi</a>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Struktur Organisasi</a>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h4 class="text-text-main dark:text-white font-bold text-sm">Informasi</h4>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Berita Sekolah</a>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Karir</a>
                        <a class="text-slate-500 hover:text-primary text-sm transition-colors" href="#">Alumni</a>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h4 class="text-text-main dark:text-white font-bold text-sm">Hubungi Kami</h4>
                        <a class="flex items-center gap-2 text-slate-500 hover:text-primary text-sm transition-colors" href="#">
                            <span class="material-symbols-outlined text-[18px]">call</span> (0251) 832-1234
                        </a>
                        <a class="flex items-center gap-2 text-slate-500 hover:text-primary text-sm transition-colors" href="#">
                            <span class="material-symbols-outlined text-[18px]">mail</span> info@putrapakuan.sch.id
                        </a>
                    </div>
                </div>
                <div class="max-w-[1280px] w-full border-t border-slate-100 dark:border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-slate-400 text-xs text-center md:text-left">© 2024 Yayasan Putra Pakuan. All rights reserved.</p>
                    <div class="flex gap-4">
                        <a class="text-slate-400 hover:text-primary transition-colors" href="#">
                            <svg class="w-4 h-4 fill-current" viewbox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                        </a>
                        <a class="text-slate-400 hover:text-primary transition-colors" href="#">
                            <svg class="w-4 h-4 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });

        // Floating Action Button logic
        document.addEventListener('DOMContentLoaded', () => {
            const fabMain = document.getElementById('fab-main');
            const fabActions = document.getElementById('fab-actions');
            const fabOverlay = document.getElementById('fab-overlay');
            const fabIcon = document.getElementById('fab-icon');
            let expanded = false;

            function openFab() {
                fabActions.classList.remove('hidden');
                fabOverlay.classList.remove('hidden');
                fabIcon.textContent = 'close';
                expanded = true;
            }
            function closeFab() {
                fabActions.classList.add('hidden');
                fabOverlay.classList.add('hidden');
                fabIcon.textContent = 'menu';
                expanded = false;
            }
            fabMain.addEventListener('click', () => {
                if (expanded) {
                    closeFab();
                } else {
                    openFab();
                }
            });
            fabOverlay.addEventListener('click', closeFab);
        });
    </script>

    <!-- AOS Animation Library JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>
</html>
