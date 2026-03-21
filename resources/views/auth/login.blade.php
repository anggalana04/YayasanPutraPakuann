<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login  -  Putra Pakuan</title>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "secondary-fixed": "#eae2ce",
              "on-tertiary-fixed": "#4c4836",
              "inverse-primary": "#fbd51d",
              "error-container": "#f95630",
              "primary-dim": "#5f4e00",
              "surface-container-high": "#e2e3df",
              "surface-container": "#e8e8e5",
              "on-surface": "#2d2f2d",
              "error-dim": "#b92902",
              "surface-variant": "#dcddda",
              "primary-fixed": "#fbd51d",
              "on-secondary-fixed-variant": "#605b4c",
              "on-secondary-container": "#565242",
              "secondary": "#605b4c",
              "on-secondary": "#faf2de",
              "on-primary-fixed-variant": "#645300",
              "on-tertiary-container": "#5f5a47",
              "tertiary-dim": "#54503e",
              "outline": "#767775",
              "secondary-dim": "#544f40",
              "inverse-surface": "#0d0f0d",
              "surface-dim": "#d3d5d1",
              "surface-bright": "#f7f7f4",
              "background": "#f7f7f4",
              "secondary-container": "#eae2ce",
              "secondary-fixed-dim": "#dbd4c0",
              "on-primary-container": "#594a00",
              "error": "#b02500",
              "surface-container-low": "#f0f1ee",
              "surface-container-lowest": "#ffffff",
              "surface": "#f7f7f4",
              "primary": "#6c5a00",
              "on-error-container": "#520c00",
              "tertiary-fixed-dim": "#eae2ca",
              "tertiary": "#605c49",
              "surface-container-highest": "#dcddda",
              "on-surface-variant": "#5a5c5a",
              "tertiary-fixed": "#f8f1d8",
              "on-error": "#ffefec",
              "primary-fixed-dim": "#ecc700",
              "outline-variant": "#acadab",
              "on-primary": "#fff2cd",
              "on-primary-fixed": "#433700",
              "on-tertiary": "#faf2da",
              "on-tertiary-fixed-variant": "#696451",
              "on-secondary-fixed": "#433f31",
              "surface-tint": "#6c5a00",
              "tertiary-container": "#f8f1d8",
              "on-background": "#2d2f2d",
              "inverse-on-surface": "#9c9d9b",
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
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 24;
      }
      .glass-effect {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
      }
      .tonal-transition {
        transition: background-color 0.3s ease;
      }
    </style>
</head>
<body class="bg-background font-body text-on-surface selection:bg-primary-container selection:text-on-primary-container">
<main class="min-h-screen flex items-center justify-center p-4 md:p-8">
<!-- Main Layout Container -->
<div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0px_10px_40px_rgba(28,25,13,0.06)] min-h-[720px]">
<!-- Left Side: Editorial Content & Image -->
<div class="hidden lg:relative lg:flex flex-col justify-between p-12 overflow-hidden bg-primary-container">
<!-- Background Pattern/Image -->
<div class="absolute inset-0 opacity-40 mix-blend-multiply pointer-events-none">
<img alt="Kampus SMK Putra Pakuan" class="w-full h-full object-cover" data-alt="Modern high school building architecture with students" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKdkaLXz_vEAKlO3wCc9sxTZt1OfD9tXutglzPJ7A88GeNnGo969ibDMYOSSEBbSYrDHOfoCt7Cah1cp24q5FEV3mZA3asUQA73QsegQm7aUg685JXM4egFTqDCLurVXAH9Svvbw4VUqXwv66Fl5Ieu-IXTsq5ai-9mus2vkc1SQ9Jgtv349mTajGBzpfujbKoQgv7ojgZfMtBv7_x_b8SHXUQgk5EXlc3Cwq1pC5jylGQ6Q4kKH3s9C0OkCVWnWfGF86uZhHNZxE"/>
</div>
<!-- Gradient Overlay -->
<div class="absolute inset-0 bg-gradient-to-br from-primary-container/80 via-transparent to-primary-dim/20"></div>
<div class="relative z-10">
<div class="flex items-center gap-3">
<div class="w-12 h-12 bg-on-primary-fixed rounded-xl flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container text-2xl" data-icon="school">school</span>
</div>
<span class="text-xl font-extrabold tracking-tighter text-on-primary-fixed uppercase">Putra Pakuan</span>
</div>
</div>
<div class="relative z-10 max-w-md">
<h1 class="font-headline text-5xl font-bold text-on-primary-fixed leading-[1.1] mb-6">
                        Gerbang Masa Depan Dimulai di Sini.
                    </h1>
<p class="text-lg text-on-primary-fixed-variant leading-relaxed">
                        Bergabunglah dengan komunitas akademik terbaik. Daftarkan diri Anda dan mulailah perjalanan prestasi bersama SMK Putra Pakuan Bogor.
                    </p>
</div>
<div class="relative z-10 flex gap-4">
<div class="px-6 py-4 glass-effect rounded-2xl border border-white/20">
<p class="text-xs font-bold uppercase tracking-widest text-on-primary-fixed mb-1">Status PPDB</p>
<p class="text-sm font-medium text-on-primary-fixed-variant">Gelombang 1 : Terbuka</p>
</div>
<div class="px-6 py-4 glass-effect rounded-2xl border border-white/20">
<p class="text-xs font-bold uppercase tracking-widest text-on-primary-fixed mb-1">Kuota Terisi</p>
<p class="text-sm font-medium text-on-primary-fixed-variant">65% Kapasitas</p>
</div>
</div>
</div>
<!-- Right Side: Login Form -->
<div class="flex flex-col justify-center px-8 py-12 md:px-16 lg:px-20 bg-surface-container-lowest">
<div class="mb-10 lg:hidden flex justify-center">
<div class="flex flex-col items-center">
<div class="w-14 h-14 bg-primary-container rounded-2xl flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-on-primary-container text-3xl" data-icon="school">school</span>
</div>
<h2 class="text-lg font-extrabold tracking-tighter text-on-surface">SMK Putra Pakuan</h2>
</div>
</div>
<div class="max-w-md mx-auto w-full">
<header class="mb-10 text-center lg:text-left">
<h2 class="font-headline text-3xl font-bold text-on-surface mb-2 tracking-tight">Selamat Datang di Portal PPDB</h2>
<p class="text-on-surface-variant">Silakan masuk menggunakan akun pendaftaran Anda</p>
</header>
<form class="space-y-6">
<!-- Email/NISN Input -->
<div class="space-y-2 group">
<label class="text-sm font-bold text-on-surface tracking-tight block ml-1" for="identifier">Email atau NISN</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline text-xl" data-icon="person">person</span>
</div>
<input class="block w-full pl-11 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-0 rounded-t-xl transition-all font-medium text-on-surface placeholder:text-outline-variant" id="identifier" name="identifier" placeholder="nama@email.com / 10293xxxx" type="text"/>
</div>
</div>
<!-- Password Input -->
<div class="space-y-2 group">
<div class="flex justify-between items-center ml-1">
<label class="text-sm font-bold text-on-surface tracking-tight" for="password">Kata Sandi</label>
<a class="text-xs font-bold text-primary hover:text-primary-dim transition-colors uppercase tracking-wider" href="#">Lupa Password?</a>
</div>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline text-xl" data-icon="lock">lock</span>
</div>
<input class="block w-full pl-11 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-0 rounded-t-xl transition-all font-medium text-on-surface placeholder:text-outline-variant" id="password" name="password" placeholder="••••••••••••" type="password"/>
</div>
</div>
<!-- Login Button -->
<button class="w-full bg-primary-container text-on-primary-fixed font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
<span>Masuk ke Dashboard</span>
<span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
</button>
</form>
<!-- Divider -->
<div class="relative my-10">
<div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline-variant/30"></div></div>
<div class="relative flex justify-center text-xs uppercase"><span class="bg-surface-container-lowest px-4 text-outline-variant font-bold tracking-widest">Atau</span></div>
</div><div class="mt-4 mb-8">
<button class="w-full bg-white border border-outline-variant/30 text-on-surface font-bold py-4 px-6 rounded-xl shadow-sm hover:bg-surface-container-low hover:scale-[1.01] active:scale-95 transition-all flex items-center justify-center gap-3 group" type="button">
<svg class="w-5 h-5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
</svg>
<span class="font-body">Masuk dengan Google</span>
</button>
</div>
<!-- Footer Links -->
<div class="text-center">
<p class="text-on-surface-variant text-sm">
                            Belum punya akun?
                            <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{route('daftar')}}">Daftar Sekarang</a>
</p>
</div>
<div class="mt-12 flex justify-center gap-8 text-outline-variant">
<a class="hover:text-primary transition-colors flex items-center gap-1" href="#">
<span class="material-symbols-outlined text-lg" data-icon="help">help</span>
<span class="text-xs font-medium">Bantuan</span>
</a>
<a class="hover:text-primary transition-colors flex items-center gap-1" href="#">
<span class="material-symbols-outlined text-lg" data-icon="policy">policy</span>
<span class="text-xs font-medium">Privasi</span>
</a>
</div>
</div>
</div>
</div>
</main>
<!-- Floating Help Button (FAB Style) -->
<div class="fixed bottom-8 right-8 z-50 md:hidden">
<button class="w-14 h-14 bg-on-surface text-surface rounded-full flex items-center justify-center shadow-2xl active:scale-90 transition-transform">
<span class="material-symbols-outlined" data-icon="support_agent">support_agent</span>
</button>
</div>
</body></html>
