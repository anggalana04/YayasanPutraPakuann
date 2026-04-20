<!DOCTYPE html>
<html class="light" lang="id" style="margin:0; padding:0; background:#f7f7f4;">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Panel admin Yayasan Putra Pakuan untuk pengelolaan konten, pengguna, dan SPMB." />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo-yayasan.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-yayasan.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-yayasan.png') }}" />
    <title>@yield('title', 'Putra Pakuan CMS - Admin')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="{{ asset('fonts/fonts.css') }}" rel="stylesheet"/>
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
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

        .site-loading-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(28, 25, 13, 0.32);
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
            width: 50px;
            height: 50px;
            border-radius: 9999px;
            border: 4px solid rgba(255, 255, 255, 0.4);
            border-top-color: #f2cc0d;
            animation: site-loading-spin 0.85s linear infinite;
        }

        .admin-nav-link {
            color: rgba(255, 255, 255, 0.7);
        }

        .admin-nav-link:hover {
            color: #f2cc0d;
            background: rgba(255, 255, 255, 0.05);
        }

        .admin-nav-link.is-active {
            background: #f2cc0d;
            color: #1c190d;
        }

        @keyframes site-loading-spin {
            to { transform: rotate(360deg); }
        }

        /* Admin responsive sidebar layout */
        .admin-sidebar {
            width: 18rem;
            transform: translateX(-100%);
            transition: width 300ms ease, transform 300ms ease;
        }
        .admin-sidebar.is-mobile-open {
            transform: translateX(0);
        }
        .admin-content {
            margin-left: 0;
            transition: margin-left 300ms ease;
        }
        @media (min-width: 1024px) {
            .admin-sidebar {
                width: 16rem;
                transform: translateX(0);
            }
            .admin-sidebar.is-collapsed {
                width: 5rem;
            }
            .admin-content {
                margin-left: 16rem;
            }
            .admin-content.is-collapsed {
                margin-left: 5rem;
            }
        }
    </style>
    @stack('head')
    <!-- HTMX -->
    <script src="{{ asset('js/htmx.min.js') }}" defer></script>
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
<div id="site-loading-overlay" class="site-loading-overlay" aria-hidden="true">
    <div class="site-loading-spinner" role="status" aria-label="Memuat halaman"></div>
</div>
<div id="admin-shell"
    x-data="{ sideOpen: true, mobileOpen: false }"
    x-init="
        $watch('mobileOpen', v => { document.body.style.overflow = v ? 'hidden' : ''; });
        window.addEventListener('resize', () => { if (window.innerWidth >= 1024 && mobileOpen) mobileOpen = false; });
    ">
    <!-- Mobile sidebar backdrop -->
    <div
        x-show="mobileOpen"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="fixed inset-0 bg-black/60 z-40 lg:hidden"
        aria-hidden="true"
        style="display:none;"
    ></div>
    <!-- SideNavBar -->
    <aside
        :class="{ 'is-collapsed': !sideOpen, 'is-mobile-open': mobileOpen }"
        class="admin-sidebar fixed left-0 top-0 flex flex-col h-screen bg-[#1c190d] dark:bg-[#0a0905] shadow-2xl z-50 overflow-hidden">
        <div class="px-6 py-8 flex flex-col items-center">
            <!-- Desktop collapse toggle -->
            <button @click="sideOpen = !sideOpen"
                class="hidden lg:flex absolute top-4 right-4 bg-white/10 hover:bg-white/20 text-[#f2cc0d] p-2 rounded-full transition-all shrink-0"
                title="Tampilkan/Sembunyikan Menu">
                <span class="material-symbols-outlined" x-text="sideOpen ? 'menu_open' : 'menu'">menu_open</span>
            </button>
            <!-- Mobile close button -->
            <button @click="mobileOpen = false"
                class="lg:hidden absolute top-4 right-4 bg-white/10 hover:bg-white/20 text-[#f2cc0d] p-2 rounded-full transition-all shrink-0"
                title="Tutup Menu">
                <span class="material-symbols-outlined">close</span>
            </button>
            <img :class="(sideOpen || mobileOpen) ? 'w-14 h-14 mt-8 mb-6' : 'w-10 h-10 mt-8 mb-2'"
                class="rounded-xl transition-all duration-300 shrink-0"
                src="/images/logo-yayasan.png" alt="Logo Yayasan Putra Pakuan" />
            <div x-show="sideOpen || mobileOpen"
                x-transition:enter="transition-opacity ease-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-100"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="flex flex-col items-center mb-10">
                <h1 class="text-xl font-bold text-[#f2cc0d] tracking-tight whitespace-nowrap">Putra Pakuan</h1>
                <p class="text-[10px] text-white/50 font-medium tracking-[0.2em] uppercase whitespace-nowrap">{{ $roleLabel }}</p>
            </div>
            <nav class="space-y-2 w-full">
                @if($isSuperAdmin)
                <a data-admin-nav data-admin-section="dashboard"
                    class="admin-nav-link {{ request()->is('admin') && !request()->is('admin/*') ? 'is-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium"
                    :class="(sideOpen || mobileOpen) ? '' : 'justify-center'"
                    href="{{ url('/admin') }}">
                    <span class="material-symbols-outlined active-icon shrink-0" data-icon="dashboard">dashboard</span>
                    <span x-show="sideOpen || mobileOpen" class="whitespace-nowrap overflow-hidden">Dasbor</span>
                </a>
                @endif
                <a data-admin-nav data-admin-section="ppdb"
                    class="admin-nav-link {{ $isPpdbActive ? 'is-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium"
                    :class="(sideOpen || mobileOpen) ? '' : 'justify-center'"
                    href="{{ $ppdbLink }}">
                    <span class="material-symbols-outlined shrink-0" data-icon="how_to_reg">how_to_reg</span>
                    <span x-show="sideOpen || mobileOpen" class="whitespace-nowrap overflow-hidden"> SPMB</span>
                </a>
                <a data-admin-nav data-admin-section="cms"
                    class="admin-nav-link {{ $isCmsActive ? 'is-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium"
                    :class="(sideOpen || mobileOpen) ? '' : 'justify-center'"
                    href="{{ $cmsLink }}">
                    <span class="material-symbols-outlined shrink-0" data-icon="edit_note">edit_note</span>
                    <span x-show="sideOpen || mobileOpen" class="whitespace-nowrap overflow-hidden"> Konten</span>
                </a>
                <a data-admin-nav data-admin-section="archive"
                    class="admin-nav-link {{ request()->is('admin/archive*') || request()->is('admin/students*') ? 'is-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-3xl mx-2 my-1 transition-all duration-300 font-medium"
                    :class="(sideOpen || mobileOpen) ? '' : 'justify-center'"
                    href="{{ url('/admin/archive') }}">
                    <span class="material-symbols-outlined shrink-0" data-icon="folder_open">folder_open</span>
                    <span x-show="sideOpen || mobileOpen" class="whitespace-nowrap overflow-hidden">Arsip Digital</span>
                </a>
                @if($isSuperAdmin)
                <a data-admin-nav data-admin-section="users"
                    class="admin-nav-link {{ request()->is('admin/user-management') ? 'is-active' : '' }} flex items-center gap-3 px-4 py-3 transition-colors mx-2 my-1 font-medium rounded-3xl"
                    :class="(sideOpen || mobileOpen) ? '' : 'justify-center'"
                    href="{{ url('/admin/user-management') }}">
                    <span class="material-symbols-outlined shrink-0" data-icon="group">group</span>
                    <span x-show="sideOpen || mobileOpen" class="whitespace-nowrap overflow-hidden"> Pengguna</span>
                </a>
                @endif
            </nav>
        </div>
        <div class="mt-auto p-6">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-[#f2cc0d] py-4 rounded-2xl flex items-center justify-center gap-2 transition-all active:scale-95">
                    <span class="material-symbols-outlined shrink-0" data-icon="logout">logout</span>
                    <span class="font-semibold text-sm whitespace-nowrap overflow-hidden" x-show="sideOpen || mobileOpen">Keluar</span>
                </button>
            </form>
        </div>
    </aside>
    <!-- Main Content Area -->
    <div class="admin-content min-h-screen" :class="{ 'is-collapsed': !sideOpen }">
        <!-- TopNavBar -->
        <header class="flex justify-between items-center w-full px-4 md:px-8 py-4 sticky top-0 bg-[#f7f7f4]/70 dark:bg-[#1c190d]/70 backdrop-blur-xl z-40">
            <div class="flex items-center gap-4">
                <!-- Mobile hamburger -->
                <button @click="mobileOpen = true"
                    class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-surface-container-high transition-colors text-on-surface"
                    aria-label="Buka Sidebar" title="Buka Menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors text-on-surface">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>
                <button class="hidden sm:flex w-10 h-10 items-center justify-center rounded-full hover:bg-surface-container-high transition-colors text-on-surface">
                    <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                </button>
                <div class="hidden sm:block h-8 w-px bg-outline-variant/30 mx-2"></div>
                <div class="flex items-center gap-2 md:gap-3 pl-1 md:pl-2">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">{{ $adminUser?->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-on-surface-variant">{{ $roleLabel }}</p>
                    </div>
                    <div class="w-9 h-9 md:w-10 md:h-10 rounded-full border-2 border-primary-container flex items-center justify-center bg-primary-container text-[#1c190d] font-bold text-sm shrink-0">
                        {{ strtoupper(substr($adminUser?->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <div id="admin-page-shell" class="p-4 md:p-8 max-w-7xl mx-auto">
            @include('layouts.admin.partials.navigation-strip')

            {{-- Flash message toast --}}
            @if (session('success') || session('error') || session('info'))
            <div id="admin-flash-toast"
                 x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="mb-6 flex items-start gap-3 px-5 py-4 rounded-2xl shadow-md border
                        {{ session('success') ? 'bg-green-50 border-green-200 text-green-800' : (session('error') ? 'bg-red-50 border-red-200 text-red-800' : 'bg-blue-50 border-blue-200 text-blue-800') }}">
                <span class="material-symbols-outlined mt-0.5 shrink-0 text-xl"
                      style="font-variation-settings:'FILL' 1">
                    {{ session('success') ? 'check_circle' : (session('error') ? 'error' : 'info') }}
                </span>
                <p class="text-sm font-medium flex-1">{{ session('success') ?? session('error') ?? session('info') }}</p>
                <button @click="show = false" class="shrink-0 hover:opacity-60 transition-opacity ml-2">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
            @endif

            <div id="admin-page-content">
                @yield('content')
            </div>
            @yield('page_scripts')
        </div>
        <footer class="mt-12 p-4 md:p-8 border-t-0 bg-surface-container-low/30 text-center">
            <p class="text-xs text-outline font-medium tracking-wide">© 2024 SMK PUTRA PAKUAN BOGOR • VERSI SISTEM 2.4.0</p>
        </footer>
    </div>
</div>
<script>
    function setSiteLoadingState(isLoading) {
        const overlay = document.getElementById('site-loading-overlay');
        if (!overlay) return;
        overlay.classList.toggle('is-active', isLoading);
        overlay.setAttribute('aria-hidden', isLoading ? 'false' : 'true');
    }

    function processAdminNavigation(root = document) {
        if (typeof htmx === 'undefined') {
            return;
        }

        root.querySelectorAll('a[href]').forEach((link) => {
            const href = link.getAttribute('href') || '';
            const isAdminPath = href.startsWith('/admin') || href.startsWith(window.location.origin + '/admin');

            if (!isAdminPath || link.target === '_blank' || link.closest('[data-admin-nav-disabled]') || link.hasAttribute('download')) {
                return;
            }

            link.setAttribute('hx-boost', 'true');
            link.setAttribute('hx-target', '#admin-page-shell');
            link.setAttribute('hx-select', '#admin-page-shell');
            link.setAttribute('hx-swap', 'outerHTML transition:true');
            link.setAttribute('hx-push-url', 'true');
        });

        htmx.process(root.body || root);
        syncAdminNavState();
    }

    function syncAdminNavState() {
        const path = window.location.pathname;
        const currentSection = path.startsWith('/admin/cms')
            ? 'cms'
            : path.startsWith('/admin/ppdb')
                ? 'ppdb'
                : path.startsWith('/admin/archive') || path.startsWith('/admin/students')
                    ? 'archive'
                    : path.startsWith('/admin/user-management') || path.startsWith('/admin/users')
                        ? 'users'
                        : 'dashboard';

        document.querySelectorAll('[data-admin-section]').forEach((link) => {
            const isActive = link.dataset.adminSection === currentSection;
            link.classList.toggle('is-active', isActive);
            link.setAttribute('aria-current', isActive ? 'page' : 'false');
        });
    }

    function clearSiteLoadingState() {
        setSiteLoadingState(false);
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');
        if (!link) return;
        const href = link.getAttribute('href') || '';
        if (!href || href.startsWith('#') || link.target === '_blank' || event.ctrlKey || event.metaKey) {
            return;
        }

        if (link.hasAttribute('download') || href.startsWith('mailto:') || href.startsWith('tel:')) {
            return;
        }

        setSiteLoadingState(true);
    });

    document.addEventListener('submit', () => setSiteLoadingState(true));
    document.addEventListener('DOMContentLoaded', () => {
        clearSiteLoadingState();
        processAdminNavigation(document);
        syncAdminNavState();
    });
    document.addEventListener('htmx:beforeRequest', () => setSiteLoadingState(true));
    document.addEventListener('htmx:beforeHistorySave', () => clearSiteLoadingState());
    document.addEventListener('htmx:historyRestore', () => clearSiteLoadingState());
    document.addEventListener('htmx:afterSwap', (event) => {
        clearSiteLoadingState();
        processAdminNavigation(event.target || document);
    });
    document.addEventListener('htmx:afterSettle', () => setSiteLoadingState(false));
    document.addEventListener('htmx:responseError', () => setSiteLoadingState(false));
    document.addEventListener('htmx:sendError', () => setSiteLoadingState(false));
    window.addEventListener('load', clearSiteLoadingState);
    window.addEventListener('pagehide', clearSiteLoadingState);
    window.addEventListener('pageshow', clearSiteLoadingState);
    window.addEventListener('popstate', clearSiteLoadingState);
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            clearSiteLoadingState();
        }
    });
</script>
<script>
function validateFileSize(input, maxMB, feedbackId) {
    const file = input.files[0];
    let fb = feedbackId ? document.getElementById(feedbackId) : null;
    if (!fb) {
        fb = input.parentElement.querySelector('.file-size-msg');
        if (!fb) {
            fb = document.createElement('p');
            fb.className = 'file-size-msg text-xs mt-1';
            input.insertAdjacentElement('afterend', fb);
        }
    }
    if (!file) { fb.textContent = ''; return; }
    if (file.size > maxMB * 1048576) {
        fb.textContent = '\u274C File terlalu besar (' + (file.size/1048576).toFixed(1) + ' MB). Maksimal ' + maxMB + ' MB.';
        fb.className = (feedbackId ? '' : 'file-size-msg ') + 'text-xs mt-1 text-red-600 font-bold';
        input.value = '';
    } else {
        fb.textContent = '\u2713 ' + file.name + ' (' + (file.size/1048576).toFixed(1) + ' MB)';
        fb.className = (feedbackId ? '' : 'file-size-msg ') + 'text-xs mt-1 text-green-600';
    }
}
</script>
@stack('scripts')
</body>
</html>







