{{--
  Cek Kode Unik page — applicant enters phone number to retrieve their unique code.
  Variables:
    $school      — lowercase school slug
    $status      — null | 'pending' | 'found'  (on result)
    $unique_code — string (when status=found)
    $application_id — string (when status=pending|found)
    $full_name   — string (when status=pending|found)
--}}

@php
    $schoolLabel = match(strtolower($school)) {
        'sd' => 'SDIT',
        'smp' => 'SMP',
        'smk' => 'SMK',
        default => strtoupper($school),
    };
    $status      = $status ?? null;
    $unique_code = $unique_code ?? null;
    $application_id = $application_id ?? null;
    $full_name   = $full_name ?? null;
@endphp

<!DOCTYPE html>
<html class="light" lang="id" style="margin:0; padding:0; background:#f7f7f4;">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cek Kode Unik — SPMB {{ $schoolLabel }} Putra Pakuan</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo-yayasan.png') }}" />
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#6c5a00", "primary-container": "#fbd51d",
                "on-primary-fixed": "#433700", "on-primary-container": "#594a00",
                "on-surface": "#2d2f2d", "on-surface-variant": "#5a5c5a",
                "surface": "#f7f7f4", "surface-container-lowest": "#ffffff",
                "surface-container-low": "#f0f1ee", "surface-container-high": "#e2e3df",
                "outline-variant": "#acadab", "background": "#f7f7f4", "on-background": "#2d2f2d",
            },
            fontFamily: { "headline": ["Lexend"], "body": ["Lexend"] },
            borderRadius: { "DEFAULT": "1rem" },
        },
    },
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body style="margin:0; padding:0;" class="bg-background font-body text-on-surface min-h-screen">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- Left decorative panel (desktop only) --}}
    <div class="hidden lg:flex flex-col justify-between bg-primary-container p-16 overflow-hidden relative">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 70% 20%, #6c5a00 0%, transparent 60%), radial-gradient(circle at 30% 80%, #433700 0%, transparent 50%);"></div>
        <div class="relative z-10">
            <a href="{{ route('ppdb.register', ['school' => $school]) }}" class="inline-flex items-center gap-2 text-on-primary-fixed/60 hover:text-on-primary-fixed text-xs font-bold uppercase tracking-widest mb-16 transition-colors">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Halaman Daftar
            </a>
            <div class="mb-8">
                <div class="w-16 h-16 bg-on-primary-fixed/10 rounded-2xl flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-3xl text-on-primary-fixed" style="font-variation-settings:'FILL' 1">key</span>
                </div>
                <h2 class="font-headline text-4xl font-black text-on-primary-fixed tracking-tighter leading-tight mb-4">Cek Kode<br>Unik Anda</h2>
                <p class="text-on-primary-fixed/70 text-base leading-relaxed max-w-xs">
                    Masukkan nomor WhatsApp untuk mengambil kode unik login setelah pembayaran diverifikasi admin.
                </p>
            </div>
        </div>
        {{-- Steps --}}
        <div class="relative z-10 space-y-4">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full bg-green-500 text-white flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                <span class="text-on-primary-fixed text-sm font-medium">Daftar & unggah bukti pembayaran</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full {{ $status ? 'bg-green-500 text-white' : 'bg-on-primary-fixed/20 text-on-primary-fixed' }} flex items-center justify-center text-xs font-bold shrink-0">{{ $status ? '✓' : '2' }}</span>
                <span class="text-on-primary-fixed{{ $status ? '' : '/60' }} text-sm">Verifikasi pembayaran oleh admin</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full {{ $status === 'found' ? 'bg-green-500 text-white' : 'bg-on-primary-fixed/20 text-on-primary-fixed' }} flex items-center justify-center text-xs font-bold shrink-0">{{ $status === 'found' ? '✓' : '3' }}</span>
                <span class="text-on-primary-fixed{{ $status === 'found' ? '' : '/60' }} text-sm">Ambil kode unik &amp; login</span>
            </div>
        </div>
    </div>

    {{-- Right: Content --}}
    <div class="flex flex-col justify-center p-6 md:p-10 lg:p-16 overflow-y-auto">

        {{-- Mobile back link --}}
        <a href="{{ route('ppdb.register', ['school' => $school]) }}" class="lg:hidden inline-flex items-center gap-1 text-xs text-on-surface-variant hover:text-on-surface mb-8 transition-colors">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke Halaman Daftar
        </a>

        <div class="max-w-md w-full mx-auto lg:mx-0">

        @if ($status === 'found')
        {{-- ── CODE FOUND ────────────────────────────────────────── --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1;">verified</span>
            </div>
            <div>
                <h1 class="font-headline text-2xl font-bold tracking-tight">Pembayaran Terverifikasi!</h1>
                <p class="text-xs text-on-surface-variant">Halo, <strong>{{ $full_name }}</strong></p>
            </div>
        </div>

        {{-- Unique Code Display --}}
        <div class="bg-primary-container/20 border-2 border-primary/30 rounded-2xl p-6 mb-5">
            <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-3">Kode Unik Anda</p>
            <div class="flex items-center gap-3">
                <p class="text-4xl md:text-5xl font-black text-primary font-headline tracking-[0.15em]" id="uniqueCode">
                    {{ $unique_code }}
                </p>
                <button type="button" onclick="copyCode()" class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors" title="Salin kode">
                    <span class="material-symbols-outlined text-2xl">content_copy</span>
                </button>
            </div>
        </div>

        {{-- Warning --}}
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-5 flex gap-3 items-start">
            <span class="material-symbols-outlined text-amber-500 mt-0.5 shrink-0">warning</span>
            <div class="text-sm text-amber-800">
                <p class="font-bold mb-1">Simpan kode ini!</p>
                <p>Gunakan kode ini untuk masuk ke form biodata dan berkas. Screenshot halaman ini agar tidak lupa.</p>
            </div>
        </div>

        {{-- Info --}}
        <div class="bg-surface-container-low rounded-xl p-4 mb-6 space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-on-surface-variant">ID Pendaftaran</span>
                <span class="font-bold">{{ $application_id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-on-surface-variant">Nama</span>
                <span class="font-bold">{{ $full_name }}</span>
            </div>
        </div>

        <a href="{{ route('ppdb.login', ['school' => $school]) }}"
           class="w-full bg-primary-container text-on-primary-fixed font-bold py-4 px-6 rounded-xl shadow-md hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">login</span>
            Masuk dengan Kode Unik
        </a>

        @elseif ($status === 'pending')
        {{-- ── PENDING VERIFICATION ──────────────────────────────── --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1;">pending</span>
            </div>
            <div>
                <h1 class="font-headline text-2xl font-bold tracking-tight">Sedang Diproses</h1>
                <p class="text-xs text-on-surface-variant">Halo, <strong>{{ $full_name }}</strong></p>
            </div>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-5 text-sm text-amber-800">
            <p class="font-bold mb-1">ID Pendaftaran: {{ $application_id }}</p>
            <p>Bukti pembayaran Anda sedang dalam proses verifikasi oleh admin. Silakan cek kembali nanti.</p>
        </div>

        <div class="bg-surface-container-low rounded-xl p-4 mb-6 text-sm space-y-2">
            <p class="font-bold text-xs uppercase tracking-widest text-on-surface-variant mb-2">Langkah selanjutnya</p>
            <ol class="list-decimal list-inside space-y-1 text-on-surface-variant">
                <li>Tunggu hingga admin memverifikasi bukti pembayaran.</li>
                <li>Kembali ke halaman ini dan masukkan nomor WhatsApp.</li>
                <li>Setelah terverifikasi, kode unik akan muncul di sini.</li>
            </ol>
        </div>

        <button onclick="window.location.reload()" class="w-full bg-surface-container-low text-on-surface font-bold py-3 px-6 rounded-xl hover:bg-surface-container-high transition-all flex items-center justify-center gap-2 text-sm">
            <span class="material-symbols-outlined text-base">refresh</span>
            Cek Lagi
        </button>

        @else
        {{-- ── PHONE LOOKUP FORM ─────────────────────────────────── --}}
        <h1 class="font-headline text-3xl font-bold tracking-tighter text-on-background mb-2">Cek Kode Unik</h1>
        <p class="text-on-surface-variant text-sm mb-8 leading-relaxed">
            Masukkan nomor WhatsApp yang Anda daftarkan untuk melihat kode unik setelah pembayaran diverifikasi.
        </p>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('ppdb.cek.kode.post', ['school' => $school]) }}" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-on-surface/70 ml-2 uppercase tracking-wider" for="cek_phone">
                    Nomor WhatsApp
                </label>
                <input name="phone" id="cek_phone" type="tel" required
                    class="w-full bg-surface-container-low border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant"
                    placeholder="08xx xxxx xxxx" value="{{ old('phone') }}" autocomplete="tel"/>
            </div>
            <button type="submit"
                class="w-full bg-primary-container text-on-primary-fixed py-4 rounded-full font-bold shadow-md hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">search</span>
                Cek Status & Kode
            </button>
        </form>
        @endif

        {{-- Footer links --}}
        <div class="mt-8 pt-6 border-t border-outline-variant/20 flex flex-col gap-2 text-center text-sm text-on-surface-variant">
            <a class="hover:text-primary transition-colors" href="{{ route('ppdb.login', ['school' => $school]) }}">
                Sudah punya kode? <span class="font-bold text-primary">Masuk sekarang</span>
            </a>
            <a class="hover:text-primary transition-colors" href="{{ route('ppdb.register', ['school' => $school]) }}">
                Belum daftar? <span class="font-bold text-primary">Daftar di sini</span>
            </a>
        </div>

        <p class="text-center text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface/30 mt-8">
            &copy; {{ date('Y') }} {{ strtoupper($school) }} Putra Pakuan Bogor
        </p>

        </div>
    </div>
</div>

    <div class="mt-6 text-center">
        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface/40">
            &copy; {{ date('Y') }} {{ strtoupper($school) }} Putra Pakuan Bogor
        </span>
    </div>
</div>

@if ($status === 'found')
<script>
function copyCode() {
    const code = document.getElementById('uniqueCode').textContent.trim();
    navigator.clipboard?.writeText(code).then(() => {
        const el = document.createElement('div');
        el.textContent = 'Kode disalin!';
        el.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 bg-green-700 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg z-50';
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 2000);
    }).catch(() => {
        prompt('Salin kode ini:', code);
    });
}
</script>
@endif
</body>
</html>
