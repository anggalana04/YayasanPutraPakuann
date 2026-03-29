<!DOCTYPE html>
<html class="light" lang="id" style="margin:0; padding:0; background:#1c190d;">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Panel admin Yayasan Putra Pakuan untuk pengelolaan konten, pengguna, dan PPDB." />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <title>@yield('title', 'Putra Pakuan CMS - Admin')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "inverse-primary": "#fbd51d",
                        "outline-variant": "#acadab",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#fbd51d",
                        "on-secondary-container": "#565242",
                        "on-secondary-fixed": "#433f31",
                        "on-tertiary": "#faf2da",
                        "secondary-fixed-dim": "#dbd4c0",
                        "tertiary-fixed-dim": "#eae2ca",
                        "tertiary-dim": "#54503e",
                        "primary": "#6c5a00",
                        "error-container": "#f95630",
                        "error": "#b02500",
                        "tertiary-container": "#f8f1d8",
                        "on-primary-fixed-variant": "#645300",
                        "on-primary-fixed": "#433700",
                        "inverse-on-surface": "#9c9d9b",
                        "background": "#f7f7f4",
                        "on-error-container": "#520c00",
                        "inverse-surface": "#0d0f0d",
                        "on-secondary": "#faf2de",
                        "secondary-dim": "#544f40",
                        "primary-dim": "#5f4e00",
                        "on-tertiary-fixed-variant": "#696451",
                        "surface-bright": "#f7f7f4",
                        "secondary": "#605b4c",
                        "on-primary-container": "#594a00",
                        "primary-fixed-dim": "#ecc700",
                        "surface-container": "#e8e8e5",
                        "tertiary": "#605c49",
                        "error-dim": "#b92902",
                        "outline": "#767775",
                        "on-tertiary-container": "#5f5a47",
                        "surface-container-high": "#e2e3df",
                        "on-secondary-fixed-variant": "#605b4c",
                        "on-surface-variant": "#5a5c5a",
                        "secondary-container": "#eae2ce",
                        "on-background": "#2d2f2d",
                        "surface-variant": "#dcddda",
                        "tertiary-fixed": "#f8f1d8",
                        "surface-dim": "#d3d5d1",
                        "on-tertiary-fixed": "#4c4836",
                        "surface-container-highest": "#dcddda",
                        "surface-tint": "#6c5a00",
                        "on-surface": "#2d2f2d",
                        "secondary-fixed": "#eae2ce",
                        "surface-container-low": "#f0f1ee",
                        "on-primary": "#fff2cd",
                        "on-error": "#ffefec",
                        "surface": "#f7f7f4",
                        "primary-container": "#fbd51d"
                    },
                    fontFamily: {
                        "headline": ["Lexend"],
                        "body": ["Lexend"],
                        "label": ["Lexend"]
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }
    </style>
    @stack('head')
</head>
@php
    $adminUser    = Auth::guard('admin')->user();
    $isSuperAdmin = $adminUser && $adminUser->isSuperAdmin();
    $roleLabel    = $adminUser ? $adminUser->getRoleLabel() : 'Admin';
    $schoolSlug   = (!$isSuperAdmin && $adminUser) ? $adminUser->getSchoolSlug() : null;
    $cmsType      = (!$isSuperAdmin && $adminUser) ? $adminUser->getCmsType()    : null;
    $ppdbLink = $isSuperAdmin
        ? url('/admin/ppdb/schools')
        : ($schoolSlug ? route('admin.ppdb.management', ['school' => $schoolSlug]) : '#');
    $cmsLink  = $isSuperAdmin
        ? url('/admin/cms/schools')
        : ($cmsType ? url('/admin/cms/' . $cmsType) : '#');
    $isPpdbActive = request()->is('admin/ppdb*');
    $isCmsActive  = request()->is('admin/cms*');
@endphp
<body style="margin:0; padding:0;" class="bg-background font-body text-on-background antialiased overflow-x-hidden">
<div x-data="{ open: true }" :class="open ? 'ml-64' : 'ml-20'" class="transition-all duration-300">
    <!-- SideNavBar -->
    <aside x-cloak x-show="true" x-data="{ open: true }" :class="open ? 'w-64' : 'w-20'" class="fixed left-0 top-0 flex flex-col h-screen transition-all duration-300 border-r-0 bg-[#1c190d] dark:bg-[#0a0905] shadow-2xl z-50">
        <div class="px-6 py-8 flex flex-col items-center">
            <button @click="open = !open" :class="open ? 'mb-0' : 'mb-8'" class="absolute top-4 right-4 bg-white/10 hover:bg-white/20 text-[#f2cc0d] p-2 rounded-full transition-all" title="Tampilkan/Sembunyikan Menu">
                <span class="material-symbols-outlined">menu_open</span>
            </button>
            <img :class="open ? 'w-14 h-14 mt-8 mb-6 ml-0' : 'w-10 h-10 mt-8 mb-2 ml-4'" src="/images/yayasan-logo.jfif" alt="Logo Yayasan Putra Pakuan" />
            <div x-show="open" class="flex flex-col items-center mb-10">
                <h1 class="text-xl font-bold text-[#f2cc0d] tracking-tight">Putra Pakuan</h1>
                <p class="text-[10px] text-white/50 font-medium tracking-[0.2em] uppercase">{{ $roleLabel }}</p>
            </div>
            <nav class="space-y-2 w-full" :class="open ? '' : 'items-center'">
                @if($isSuperAdmin)
                <a class="flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium justify-center {{ request()->is('admin') && !request()->is('admin/*') ? 'bg-[#f2cc0d] text-[#1c190d]' : 'text-white/70 hover:text-[#f2cc0d] hover:bg-white/5' }}" href="{{ url('/admin') }}">
                    <span class="material-symbols-outlined active-icon" data-icon="dashboard">Dasbor</span>
                    <span x-show="open">Dasbor</span>
                </a>
                @endif
                <a class="flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium justify-center {{ $isPpdbActive ? 'bg-[#f2cc0d] text-[#1c190d]' : 'text-white/70 hover:text-[#f2cc0d] hover:bg-white/5' }}" href="{{ $ppdbLink }}">
                    <span class="material-symbols-outlined" data-icon="how_to_reg">how_to_reg</span>
                    <span x-show="open">Manajemen PPDB</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium justify-center {{ $isCmsActive ? 'bg-[#f2cc0d] text-[#1c190d]' : 'text-white/70 hover:text-[#f2cc0d] hover:bg-white/5' }}" href="{{ $cmsLink }}">
                    <span class="material-symbols-outlined" data-icon="edit_note">edit_note</span>
                    <span x-show="open">Manajemen Konten</span>
                </a>
                @if($isSuperAdmin)
                <a class="flex items-center gap-3 px-4 py-3 text-white/70 hover:text-[#f2cc0d] transition-colors mx-2 my-1 font-medium hover:bg-white/5 rounded-3xl justify-center {{ request()->is('admin/user-management') ? 'bg-[#f2cc0d] text-[#1c190d]' : '' }}" href="{{ url('/admin/user-management') }}">
                    <span class="material-symbols-outlined" data-icon="group">group</span>
                    <span x-show="open">Manajemen Pengguna</span>
                </a>
                @endif

            </nav>
        </div>
        <div class="mt-auto p-6">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-[#f2cc0d] py-4 rounded-2xl flex items-center justify-center gap-2 transition-all active:scale-95">
                    <span class="material-symbols-outlined" data-icon="logout">Keluar</span>
                    <span class="font-semibold text-sm" x-show="open">Keluar</span>
                </button>
            </form>
        </div>
    </aside>
    <!-- Main Content Area -->
    <main class="min-h-screen">
        <!-- TopNavBar -->
        <header class="flex justify-between items-center w-full px-8 py-4 sticky top-0 bg-[#f7f7f4]/70 dark:bg-[#1c190d]/70 backdrop-blur-xl z-40">
            <div class="flex items-center gap-8">


            </div>
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors text-on-surface">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors text-on-surface">
                    <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                </button>
                <div class="h-8 w-px bg-outline-variant/30 mx-2"></div>
                <div class="flex items-center gap-3 pl-2">
                    <div class="text-right">
                        <p class="text-xs font-bold text-on-surface">{{ $adminUser?->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-on-surface-variant">{{ $roleLabel }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-primary-container flex items-center justify-center bg-primary-container text-[#1c190d] font-bold text-sm">
                        {{ strtoupper(substr($adminUser?->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <div class="p-8 max-w-7xl mx-auto">
            @yield('content')
        </div>
        <footer class="mt-12 p-8 border-t-0 bg-surface-container-low/30 text-center">
            <p class="text-xs text-outline font-medium tracking-wide">© 2024 SMK PUTRA PAKUAN BOGOR • VERSI SISTEM 2.4.0</p>
        </footer>
    </main>
</div>
@stack('scripts')
</body>
</html>







