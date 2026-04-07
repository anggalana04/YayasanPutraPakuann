{{--
  Shared SPMB login form — unique code based.
  Variables: $school
--}}

@php
    $schoolLabel = match(strtolower($school)) {
        'sd' => 'SDIT',
        'smp' => 'SMP',
        'smk' => 'SMK',
        default => strtoupper($school),
    };
    $logoPath = strtolower($school) === 'sd' ? 'images/logo-sdit-putrapakuan.png' : 'images/logo-yayasan.png';
@endphp

<!DOCTYPE html>
<html class="light" lang="id" style="margin:0; padding:0; background:#f7f7f4;">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Masuk SPMB {{ $schoolLabel }} Putra Pakuan</title>
<meta name="description" content="Masuk ke portal SPMB {{ $schoolLabel }} Putra Pakuan menggunakan kode unik pendaftaran." />
<meta name="robots" content="index, follow" />
<link rel="canonical" href="{{ url()->current() }}" />
<link rel="icon" type="image/png" href="{{ asset($logoPath) }}" />
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#6c5a00", "primary-dim": "#5f4e00", "primary-container": "#fbd51d",
                "on-primary": "#fff2cd", "on-primary-fixed": "#433700", "on-primary-fixed-variant": "#645300",
                "on-primary-container": "#594a00", "on-surface": "#2d2f2d", "on-surface-variant": "#5a5c5a",
                "surface": "#f7f7f4", "surface-container-lowest": "#ffffff", "surface-container-low": "#f0f1ee",
                "surface-container-high": "#e2e3df", "surface-container-highest": "#dcddda",
                "outline": "#767775", "outline-variant": "#acadab", "background": "#f7f7f4",
                "on-background": "#2d2f2d", "error-container": "#f95630", "on-error": "#ffefec",
            },
            fontFamily: { "headline": ["Lexend"], "body": ["Lexend"] },
            borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
        },
    },
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 24; }
.glass-effect { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); }
</style>
</head>
<body style="margin:0; padding:0;" class="bg-background font-body text-on-surface selection:bg-primary-container selection:text-on-primary-container">

<main class="min-h-screen flex items-center justify-center p-4 md:p-8">
<div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0px_10px_40px_rgba(28,25,13,0.06)] min-h-[720px]">

{{-- Left Side: Editorial --}}
<div class="hidden lg:relative lg:flex flex-col justify-between p-12 overflow-hidden bg-primary-container">
    <div class="absolute inset-0 opacity-40 mix-blend-multiply pointer-events-none">
        <img alt="Kampus {{ $schoolLabel }} Putra Pakuan" class="w-full h-full object-cover"
             src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKdkaLXz_vEAKlO3wCc9sxTZt1OfD9tXutglzPJ7A88GeNnGo969ibDMYOSSEBbSYrDHOfoCt7Cah1cp24q5FEV3mZA3asUQA73QsegQm7aUg685JXM4egFTqDCLurVXAH9Svvbw4VUqXwv66Fl5Ieu-IXTsq5ai-9mus2vkc1SQ9Jgtv349mTajGBzpfujbKoQgv7ojgZfMtBv7_x_b8SHXUQgk5EXlc3Cwq1pC5jylGQ6Q4kKH3s9C0OkCVWnWfGF86uZhHNZxE"/>
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-primary-container/80 via-transparent to-primary-dim/20"></div>
    <div class="relative z-10">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-on-primary-fixed rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-primary-container text-2xl">school</span>
            </div>
            <span class="text-xl font-extrabold tracking-tighter text-on-primary-fixed uppercase">Putra Pakuan</span>
        </div>
    </div>
    <div class="relative z-10 max-w-md">
        <h1 class="font-headline text-5xl font-bold text-on-primary-fixed leading-[1.1] mb-6">
            Masuk dengan Kode Unik Anda.
        </h1>
        <p class="text-lg text-on-primary-fixed-variant leading-relaxed">
            Gunakan kode unik yang Anda terima saat pendaftaran untuk mengakses form biodata, berkas, dan dashboard pendaftaran.
        </p>
    </div>
    <div class="relative z-10 flex gap-4">
        <div class="px-6 py-4 glass-effect rounded-2xl border border-white/20">
            <p class="text-xs font-bold uppercase tracking-widest text-on-primary-fixed mb-1">Portal SPMB</p>
            <p class="text-sm font-medium text-on-primary-fixed-variant">{{ $schoolLabel }} Putra Pakuan</p>
        </div>
    </div>
</div>

{{-- Right Side: Login Form --}}
<div class="flex flex-col justify-center px-8 py-12 md:px-16 lg:px-20 bg-surface-container-lowest">
    <div class="mb-10 lg:hidden flex justify-center">
        <div class="flex flex-col items-center">
            <div class="w-14 h-14 bg-primary-container rounded-2xl flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-on-primary-container text-3xl">school</span>
            </div>
            <h2 class="text-lg font-extrabold tracking-tighter text-on-surface">{{ $schoolLabel }} Putra Pakuan</h2>
        </div>
    </div>

    <div class="max-w-md mx-auto w-full">
        <header class="mb-10 text-center lg:text-left">
            <h2 class="font-headline text-3xl font-bold text-on-surface mb-2 tracking-tight">Masuk ke Portal SPMB</h2>
            <p class="text-on-surface-variant">Masukkan kode unik yang Anda terima saat pendaftaran</p>
        </header>

        <form class="space-y-6" method="POST" action="{{ route('ppdb.login.post', ['school' => $school]) }}">
            @csrf
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-error-container text-on-error text-sm font-bold">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Unique Code Input --}}
            <div class="space-y-2 group">
                <label class="text-sm font-bold text-on-surface tracking-tight block ml-1" for="unique_code">Kode Unik</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline text-xl">key</span>
                    </div>
                    <input class="block w-full pl-11 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-0 rounded-t-xl transition-all font-bold text-on-surface placeholder:text-outline-variant placeholder:font-normal tracking-[0.15em] text-lg uppercase"
                           id="unique_code" name="unique_code"
                           placeholder="XXXX-XXXX"
                           type="text"
                           maxlength="9"
                           autocomplete="off"
                           value="{{ old('unique_code') }}"
                           oninput="formatCode(this)"/>
                </div>
                <p class="text-xs text-on-surface-variant ml-1">Format: XXXX-XXXX (8 karakter)</p>
            </div>

            {{-- Login Button --}}
            <button class="w-full bg-primary-container text-on-primary-fixed font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
                <span>Masuk ke Dashboard</span>
                <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1">arrow_forward</span>
            </button>
        </form>

        {{-- Footer Links --}}
        <div class="text-center mt-8 space-y-3">
            <p class="text-on-surface-variant text-sm">
                Belum punya kode unik?
                <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('ppdb.register', ['school' => $school]) }}">Daftar Sekarang</a>
            </p>
            <p class="text-on-surface-variant text-sm">
                Sudah daftar tapi belum dapat kode?
                <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('ppdb.cek.kode', ['school' => $school]) }}">Cek Status Pendaftaran</a>
            </p>
        </div>

        <div class="mt-12 flex justify-center gap-8 text-outline-variant">
            <a class="hover:text-primary transition-colors flex items-center gap-1" href="{{ route('school.ppdb', ['school' => $school]) }}">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                <span class="text-xs font-medium">Kembali ke Info SPMB</span>
            </a>
            <a class="hover:text-primary transition-colors flex items-center gap-1" href="{{ route('school.kontak', ['school' => $school]) }}">
                <span class="material-symbols-outlined text-lg">help</span>
                <span class="text-xs font-medium">Bantuan</span>
            </a>
        </div>
    </div>
</div>

</div>
</main>

<script>
function formatCode(input) {
    // Auto-format: insert dash after 4th character
    let val = input.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
    if (val.length > 4) {
        val = val.substring(0, 4) + '-' + val.substring(4, 8);
    }
    input.value = val;
}
</script>
</body>
</html>
