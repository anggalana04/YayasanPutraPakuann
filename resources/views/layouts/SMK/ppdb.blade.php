<!DOCTYPE html>
<html lang="id" style="margin:0; padding:0; background:#f8f8f5;">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    @php
        $seoTitle = trim($__env->yieldContent('title', 'SPMB SMK Putra Pakuan | Pendaftaran Peserta Didik Baru'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Daftar SPMB SMK Putra Pakuan secara online. Lengkapi biodata, unggah berkas, dan pantau status seleksi dengan mudah.'));
        $seoKeywords = trim($__env->yieldContent('meta_keywords', 'spmb smk putra pakuan, pendaftaran smk bogor, spmb online smk'));
        $seoImage = trim($__env->yieldContent('meta_image', asset('images/logo-yayasan.png')));
        $seoUrl = url()->current();
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}" />
    <meta name="keywords" content="{{ $seoKeywords }}" />
    <meta name="author" content="SPMB SMK Putra Pakuan" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="id-ID" href="{{ $seoUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $seoUrl }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo-yayasan.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-yayasan.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-yayasan.png') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="SPMB SMK Putra Pakuan" />
    <meta property="og:title" content="{{ $seoTitle }}" />
    <meta property="og:description" content="{{ $seoDescription }}" />
    <meta property="og:url" content="{{ $seoUrl }}" />
    <meta property="og:image" content="{{ $seoImage }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDescription }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />
    @php
        $schoolBaseUrl = route('school.home', ['school' => 'smk']);
        $orgSchema = [
            '@type' => 'EducationalOrganization',
            '@id' => $schoolBaseUrl . '#organization',
            'name' => 'SMK Putra Pakuan',
            'url' => $schoolBaseUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo-yayasan.png'),
            ],
        ];
        $webpageSchema = [
            '@type' => 'WebPage',
            '@id' => $seoUrl . '#webpage',
            'url' => $seoUrl,
            'name' => $seoTitle,
            'description' => $seoDescription,
            'inLanguage' => 'id-ID',
            'about' => [
                '@id' => $schoolBaseUrl . '#organization',
            ],
        ];
        $seoJsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [$orgSchema, $webpageSchema],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($seoJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('structured_data')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        :root {
            --color-primary: #f2cc0d;
            --color-secondary: #605b4c;
            --color-charcoal: #1c190d;
            --color-background-light: #f8f8f5;
            --color-background-dark: #221f10;
        }
    </style>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

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
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px) saturate(1.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body class="m-0 p-0 bg-background-light dark:bg-background-dark text-charcoal dark:text-slate-100">
<nav style="box-shadow: 0 -24px 0 #1c190d;" class="ppdb-navbar sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo-yayasan.png') }}" alt="SMK Putra Pakuan" class="h-8 w-8">
                    <span class="font-bold text-lg text-primary">SPMB SMK Putra Pakuan</span>
                </a>
            </div>
            @php
                $user = Auth::guard('ppdb_applications')->user();
                $showProfile = $user && request()->routeIs('ppdb.dashboard', 'ppdb.profil');
                $displayName = $user?->full_name ?: ($user?->email ?: 'Pengguna');
            @endphp
            @if ($showProfile)
            <div class="hidden md:flex items-center space-x-8">
                <!-- Profile Dropdown (Frontend Only) -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ $user->profile_photo_url ?? asset('images/default-profile.png') }}" alt="Profile" class="h-8 w-8 rounded-full border-2 border-primary object-cover">
                        <span class="text-sm font-medium text-white">{{ $displayName }}</span>
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white dark:bg-charcoal rounded-lg shadow-lg py-2 z-50" x-cloak>
                        <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="block w-full text-left px-4 py-2 text-sm text-charcoal dark:text-white hover:bg-primary/10">Dasbor</a>
                        <a href="{{ route('ppdb.profil', ['school' => $school]) }}" class="block w-full text-left px-4 py-2 text-sm text-charcoal dark:text-white hover:bg-primary/10">Profil</a>
                        <form method="POST" action="{{ route('ppdb.logout', ['school' => $school]) }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @if ($showProfile)
            <div class="md:hidden flex items-center">
                <button type="button" class="ppdb-nav-link p-2 rounded-md" id="mobile-menu-button">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- Mobile menu: only show profile dropdown -->
    @if ($showProfile)
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-charcoal/95">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 w-full focus:outline-none px-3 py-2 rounded-md">
                    <img src="{{ $user->profile_photo_url ?? asset('images/default-profile.png') }}" alt="Profile" class="h-8 w-8 rounded-full border-2 border-primary object-cover">
                    <span class="text-base font-medium text-white">{{ $displayName }}</span>
                    <span class="material-symbols-outlined text-primary">expand_more</span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white dark:bg-charcoal rounded-lg shadow-lg py-2 z-50" x-cloak>
                    <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="block w-full text-left px-4 py-2 text-sm text-charcoal dark:text-white hover:bg-primary/10">Dasbor</a>
                    <a href="{{ route('ppdb.profil', ['school' => $school]) }}" class="block w-full text-left px-4 py-2 text-sm text-charcoal dark:text-white hover:bg-primary/10">Profil</a>
                    <form method="POST" action="{{ route('ppdb.logout', ['school' => $school]) }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</nav>

<main class="min-h-screen bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('ppdb-content')
    </div>
</main>

@yield('ppdb-footer')

<!-- BottomNavBar (Mobile) -->
@if (!request()->routeIs('ppdb.register', 'ppdb.register.post'))
<nav class="fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-4 pt-2 md:hidden bg-white/60 dark:bg-[#1c190d]/60 backdrop-blur-2xl z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(28,25,13,0.06)]">
    <a href="{{ route('ppdb.dashboard', ['school' => $school]) }}" class="flex flex-col items-center justify-center {{ request()->routeIs('ppdb.dashboard') ? 'bg-[#f2cc0d] text-[#1c190d]' : 'text-[#1c190d]/50 dark:text-white/50' }} rounded-2xl p-2 min-w-16">
        <span class="material-symbols-outlined" data-icon="dashboard" style="font-variation-settings: 'FILL' 1;">dashboard</span>
        <span class="font-lexend text-[10px] font-medium">Dasbor</span>
    </a>
    <a href="{{ route('ppdb.profil', ['school' => $school]) }}" class="flex flex-col items-center justify-center text-[#1c190d]/50 dark:text-white/50 p-2 hover:bg-[#f2cc0d]/10 rounded-2xl {{ request()->routeIs('ppdb.profil') ? 'bg-[#f2cc0d] text-[#1c190d]' : '' }}">
        <span class="material-symbols-outlined" data-icon="person">person</span>
        <span class="font-lexend text-[10px] font-medium">Profil</span>
    </a>
    <form method="POST" action="{{ route('ppdb.logout', ['school' => $school]) }}" class="inline">
        @csrf
        <button type="submit" class="flex flex-col items-center justify-center text-red-500 p-2 hover:bg-red-100 rounded-2xl">
            <span class="material-symbols-outlined" data-icon="logout">logout</span>
            <span class="font-lexend text-[10px] font-medium">Keluar</span>
        </button>
    </form>
</nav>
@endif

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
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
        fb.className = 'text-xs mt-1 text-red-600 font-bold';
        input.value = '';
    } else {
        fb.textContent = file.name + ' (' + (file.size/1048576).toFixed(1) + ' MB)';
        fb.className = 'text-xs mt-1 text-blue-600';
    }
}
</script>
</body>
