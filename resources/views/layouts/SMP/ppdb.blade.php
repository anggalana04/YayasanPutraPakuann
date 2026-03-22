<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>PPDB {{ ucfirst($school) }} Putra Pakuan</title>
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
                        "brand-yellow": "#f2cc0d",
                        "brand-charcoal": "#1c190d",
                        "error": "#b02500",
                        "surface-dim": "#d3d5d1",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed": "#4c4836",
                        "on-secondary": "#faf2de",
                        "on-primary-fixed-variant": "#645300",
                        "on-secondary-container": "#565242",
                        "outline-variant": "#acadab",
                        "primary-dim": "#5f4e00",
                        "secondary-dim": "#544f40",
                        "on-error": "#ffefec",
                        "secondary-fixed": "#eae2ce",
                        "inverse-primary": "#fbd51d",
                        "error-dim": "#b92902",
                        "secondary-fixed-dim": "#dbd4c0",
                        "inverse-on-surface": "#9c9d9b",
                        "surface-container-low": "#f0f1ee",
                        "tertiary-fixed-dim": "#eae2ca",
                        "surface": "#f7f7f4",
                        "on-surface": "#2d2f2d",
                        "tertiary-container": "#f8f1d8",
                        "surface-container": "#e8e8e5",
                        "background": "#f7f7f4",
                        "primary-fixed": "#fbd51d",
                        "on-primary-container": "#594a00",
                        "on-tertiary": "#faf2da",
                        "surface-variant": "#dcddda",
                        "on-surface-variant": "#5a5c5a",
                        "on-primary-fixed": "#433700",
                        "tertiary-dim": "#54503e",
                        "on-primary": "#fff2cd",
                        "surface-container-highest": "#dcddda",
                        "surface-container-high": "#e2e3df",
                        "on-background": "#2d2f2d",
                        "primary-container": "#fbd51d",
                        "tertiary-fixed": "#f8f1d8",
                        "secondary": "#605b4c",
                        "surface-bright": "#f7f7f4",
                        "inverse-surface": "#0d0f0d",
                        "primary-fixed-dim": "#ecc700",
                        "on-secondary-fixed": "#433f31",
                        "error-container": "#f95630",
                        "surface-tint": "#6c5a00",
                        "tertiary": "#605c49",
                        "on-error-container": "#520c00",
                        "on-secondary-fixed-variant": "#605b4c",
                        "on-tertiary-container": "#5f5a47",
                        "on-tertiary-fixed-variant": "#696451",
                        "outline": "#767775",
                        "secondary-container": "#eae2ce"
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "headline": ["Lexend"],
                        "body": ["Lexend"],
                        "label": ["Lexend"]
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
        .ppdb-navbar {
            background: linear-gradient(135deg, #1c190d 0%, #221f10 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .ppdb-nav-link {
            color: #f8f8f5;
            transition: all 0.3s ease;
        }
        .ppdb-nav-link:hover {
            color: #f2cc0d;
            background-color: rgba(242, 204, 13, 0.1);
        }
        .ppdb-nav-link.active {
            color: #f2cc0d;
            background-color: rgba(242, 204, 13, 0.2);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100">
<nav class="ppdb-navbar sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="SMK Putra Pakuan" class="h-8 w-8">
                    <span class="font-bold text-lg text-primary">PPDB SMK Putra Pakuan</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="ppdb-nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('ppdb.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('ppdb.biodata', ['school' => $school]) }}" class="ppdb-nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('ppdb.biodata') ? 'active' : '' }}">
                    Biodata
                </a>
                <a href="{{ route('ppdb.berkas', ['school' => $school]) }}" class="ppdb-nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('ppdb.berkas') ? 'active' : '' }}">
                    Berkas
                </a>
                <a href="{{ route('ppdb.payment', ['school' => $school]) }}" class="ppdb-nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('ppdb.payment') ? 'active' : '' }}">
                    Pembayaran
                </a>
            </div>
            <div class="md:hidden flex items-center">
                <button type="button" class="ppdb-nav-link p-2 rounded-md" id="mobile-menu-button">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </div>
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-charcoal/95">
            <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="ppdb-nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ppdb.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('ppdb.biodata', ['school' => $school]) }}" class="ppdb-nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ppdb.biodata') ? 'active' : '' }}">
                Biodata
            </a>
            <a href="{{ route('ppdb.berkas', ['school' => $school]) }}" class="ppdb-nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ppdb.berkas') ? 'active' : '' }}">
                Berkas
            </a>
            <a href="{{ route('ppdb.payment', ['school' => $school]) }}" class="ppdb-nav-link block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ppdb.payment') ? 'active' : '' }}">
                Pembayaran
            </a>
        </div>
    </div>
</nav>

<main class="min-h-screen bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('ppdb-content')
    </div>
</main>

@yield('ppdb-footer')

<!-- BottomNavBar (Mobile) -->
<nav class="fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-4 pt-2 md:hidden bg-white/60 dark:bg-[#1c190d]/60 backdrop-blur-2xl z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(28,25,13,0.06)]">
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-lexend text-[10px] font-medium">Home</span>
</div>
<div class="flex flex-col items-center justify-center bg-[#f2cc0d] text-[#1c190d] rounded-2xl p-2 min-w-16">
<span class="material-symbols-outlined" data-icon="track_changes" style="font-variation-settings: 'FILL' 1;">track_changes</span>
<span class="font-lexend text-[10px] font-medium">Status</span>
</div>
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-lexend text-[10px] font-medium">Bantuan</span>
</div>
<div class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-lexend text-[10px] font-medium">Profil</span>
</div>
</nav>
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
</body>
</html>
