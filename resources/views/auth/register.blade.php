<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Daftar Akun PPDB - SMK Putra Pakuan</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-container selection:text-on-primary-container overflow-x-hidden">
<!-- Top Navigation Bar (Shared Component Strategy) -->
<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl transition-all">
<div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
<div class="flex items-center gap-2">
<span class="text-xl font-bold text-[#1c190d] tracking-tighter">SMK Putra Pakuan</span>
</div>
<div class="flex items-center gap-6">
<a class="font-lexend text-sm font-medium tracking-tight text-[#1c190d]/60 hover:opacity-80 transition-opacity" href="#">Bantuan</a>
<a class="px-5 py-2 rounded-full bg-primary-container text-on-primary-fixed font-semibold text-sm hover:scale-95 duration-200 transition-transform" href="{{route('login')}}">
                    Masuk
                </a>
</div>
</div>
</nav>
<main class="min-h-screen pt-24 pb-12 flex items-center justify-center px-4 relative">
<!-- Decorative Background Elements -->
<div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-primary-container/20 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
<div class="absolute bottom-0 left-0 -z-10 w-[400px] h-[400px] bg-secondary-container/30 blur-[100px] rounded-full -translate-x-1/2 translate-y-1/2"></div>
<div class="w-full max-w-5xl grid md:grid-cols-2 gap-12 items-center">
<!-- Left Side: Editorial Content -->
<div class="hidden md:block space-y-8 pr-8">
<div>
<span class="text-primary font-bold tracking-[0.2em] uppercase text-xs mb-4 block">Portal Pendaftaran 2024/2025</span>
<h1 class="text-5xl font-bold text-on-background leading-[1.1] tracking-tight mb-6">
                        Langkah awal menuju <span class="text-primary">masa depan</span> cemerlang.
                    </h1>
<p class="text-on-surface-variant text-lg leading-relaxed max-w-md">
                        Daftarkan akun Anda untuk memulai proses seleksi, memantau status aplikasi, dan mendapatkan pembaruan terkini seputar PPDB SMK Putra Pakuan.
                    </p>
</div>
<div class="space-y-6">
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-xl">description</span>
</div>
<div>
<h3 class="font-semibold text-on-surface">Kelola Dokumen</h3>
<p class="text-sm text-on-surface-variant">Unggah dan simpan berkas digital dengan aman dalam satu portal terpusat.</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-xl">notifications_active</span>
</div>
<div>
<h3 class="font-semibold text-on-surface">Notifikasi Real-time</h3>
<p class="text-sm text-on-surface-variant">Dapatkan kabar kelulusan dan jadwal wawancara langsung melalui email dan WhatsApp.</p>
</div>
</div>
</div>
</div>
<!-- Right Side: Registration Form Card -->
<div class="w-full">
<div class="glass-panel rounded-xl p-8 md:p-10 shadow-[0px_10px_40px_rgba(28,25,13,0.06)]">
<div class="mb-8">
<h2 class="text-2xl font-bold text-[#1c190d] mb-2">Buat Akun Baru</h2>
<p class="text-sm text-on-surface-variant">Lengkapi data di bawah ini untuk memulai pendaftaran Anda.</p>
</div>
<form class="space-y-5">
<div class="space-y-1.5">
<label class="text-xs font-semibold text-on-surface/70 ml-2 uppercase tracking-wider">Nama Lengkap</label>
<div class="relative group">
<input class="w-full bg-surface-container-low border-none rounded-2xl px-5 py-4 text-sm focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant" placeholder="Masukkan nama sesuai ijazah" type="text"/>
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-primary transition-all group-focus-within:w-full"></div>
</div>
</div>
<div class="space-y-1.5">
<label class="text-xs font-semibold text-on-surface/70 ml-2 uppercase tracking-wider">Alamat Email</label>
<div class="relative group">
<input class="w-full bg-surface-container-low border-none rounded-2xl px-5 py-4 text-sm focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant" placeholder="contoh@email.com" type="email"/>
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-primary transition-all group-focus-within:w-full"></div>
</div>
</div>
<div class="space-y-1.5">
<label class="text-xs font-semibold text-on-surface/70 ml-2 uppercase tracking-wider">Nomor WhatsApp</label>
<div class="relative group">
<input class="w-full bg-surface-container-low border-none rounded-2xl px-5 py-4 text-sm focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant" placeholder="08xx xxxx xxxx" type="tel"/>
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-primary transition-all group-focus-within:w-full"></div>
</div>
</div>
<div class="space-y-1.5">
<label class="text-xs font-semibold text-on-surface/70 ml-2 uppercase tracking-wider">Password</label>
<div class="relative group">
<input class="w-full bg-surface-container-low border-none rounded-2xl px-5 py-4 text-sm focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant" placeholder="Min. 8 karakter" type="password"/>
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-primary transition-all group-focus-within:w-full"></div>
</div>
</div>
<div class="pt-4">
<button class="w-full py-4 bg-primary-container text-on-primary-fixed font-bold rounded-2xl hover:scale-[0.98] active:scale-95 transition-all shadow-lg shadow-primary-container/20" type="submit">
                                Buat Akun
                            </button>
<div class="relative py-4">
<div aria-hidden="true" class="absolute inset-0 flex items-center">
<div class="w-full border-t border-surface-container-high"></div>
</div>
<div class="relative flex justify-center text-xs uppercase font-bold tracking-widest">
<span class="bg-surface-container-lowest px-2 text-on-surface-variant">atau</span>
</div>
</div>
<button class="w-full flex items-center justify-center gap-3 py-4 bg-white border border-surface-container-high text-on-surface font-bold rounded-2xl hover:bg-surface-container-low transition-all shadow-sm" type="button">
<svg height="20" viewbox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
</svg>
<span>Daftar dengan Google</span>
</button>
</div>
<div class="text-center pt-4">
<p class="text-sm text-on-surface-variant">
                                Sudah punya akun?
                                <a class="text-primary font-bold hover:underline" href="#">Masuk</a>
</p>
</div>
</form>
</div>
<!-- Floating Editorial Badge -->
<div class="mt-8 flex items-center justify-center gap-2">
<span class="w-2 h-2 rounded-full bg-green-500"></span>
<span class="text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface/40">Sistem Pendaftaran Terenkripsi &amp; Aman</span>
</div>
</div>
</div>
</main>
<!-- Suppressed Mobile Nav (BottomNavBar logic for main destinations only) -->
<!-- Not rendered here as this is a focused transactional registration page -->
<footer class="py-12 px-6 border-t border-surface-container-high/30">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
<div class="flex flex-col items-center md:items-start">
<p class="text-xs text-on-surface-variant font-medium">© 2024 SMK Putra Pakuan Bogor. Seluruh Hak Cipta Dilindungi.</p>
</div>
<div class="flex gap-8">
<a class="text-xs font-bold uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
<a class="text-xs font-bold uppercase tracking-widest text-on-surface-variant hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
</div>
</div>
</footer>
</body></html>
