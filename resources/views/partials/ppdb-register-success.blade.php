{{--
  Registration success page — payment submitted, waiting for admin verification.
  Variables: $school, $regData (array from session with application_id, full_name, phone, payment_method)
--}}
<!DOCTYPE html>
<html class="light" lang="id" style="margin:0; padding:0; background:#f7f7f4;">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Pendaftaran Diterima — SPMB {{ strtoupper($school) }} Putra Pakuan</title>
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
                "primary": "#6c5a00",
                "primary-container": "#fbd51d",
                "on-primary-fixed": "#433700",
                "on-primary-container": "#594a00",
                "on-surface": "#2d2f2d",
                "on-surface-variant": "#5a5c5a",
                "surface": "#f7f7f4",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#f0f1ee",
                "surface-container-high": "#e2e3df",
                "outline-variant": "#acadab",
                "background": "#f7f7f4",
                "on-background": "#2d2f2d",
            },
            fontFamily: { "headline": ["Lexend"], "body": ["Lexend"] },
            borderRadius: {"DEFAULT": "1rem"},
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

    {{-- Left: Decorative panel (desktop only) --}}
    <div class="hidden lg:flex flex-col justify-between bg-primary-container p-16 overflow-hidden relative">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 70% 20%, #6c5a00 0%, transparent 60%), radial-gradient(circle at 30% 80%, #433700 0%, transparent 50%);"></div>
        <div class="relative z-10">
            <a href="{{ route('school.ppdb', ['school' => $school]) }}" class="inline-flex items-center gap-2 text-on-primary-fixed/60 hover:text-on-primary-fixed text-xs font-bold uppercase tracking-widest mb-16 transition-colors">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Halaman SPMB
            </a>
            <div class="mb-8">
                <div class="w-16 h-16 bg-on-primary-fixed/10 rounded-2xl flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-3xl text-on-primary-fixed" style="font-variation-settings:'FILL' 1">task_alt</span>
                </div>
                <h2 class="font-headline text-4xl font-black text-on-primary-fixed tracking-tighter leading-tight mb-4">Pendaftaran<br>Diterima!</h2>
                <p class="text-on-primary-fixed/70 text-base leading-relaxed max-w-xs">
                    Bukti pembayaran Anda sudah kami terima. Tunggu verifikasi admin untuk mendapat kode unik login Anda.
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
                <span class="w-7 h-7 rounded-full bg-on-primary-fixed/20 text-on-primary-fixed flex items-center justify-center text-xs font-bold shrink-0">2</span>
                <span class="text-on-primary-fixed/60 text-sm">Verifikasi pembayaran oleh admin</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-full bg-on-primary-fixed/20 text-on-primary-fixed flex items-center justify-center text-xs font-bold shrink-0">3</span>
                <span class="text-on-primary-fixed/60 text-sm">Login dengan kode unik & isi formulir</span>
            </div>
        </div>
    </div>

    {{-- Right: Content --}}
    <div class="flex flex-col justify-center p-6 md:p-10 lg:p-16 overflow-y-auto">

        {{-- Mobile back link --}}
        <a href="{{ route('school.ppdb', ['school' => $school]) }}" class="lg:hidden inline-flex items-center gap-1 text-xs text-on-surface-variant hover:text-on-surface mb-8 transition-colors">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke Halaman SPMB
        </a>

        {{-- Mobile header --}}
        <div class="lg:hidden flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">task_alt</span>
            </div>
            <div>
                <h1 class="font-headline text-2xl font-bold tracking-tight">Pendaftaran Diterima!</h1>
                <p class="text-xs text-on-surface-variant">Bukti pembayaran berhasil dikirim</p>
            </div>
        </div>

        <div class="max-w-md w-full mx-auto lg:mx-0">

        <h1 class="hidden lg:block font-headline text-3xl font-bold tracking-tighter text-on-background mb-2">
            Pembayaran Dikirim
        </h1>
        <p class="hidden lg:block text-on-surface-variant mb-8 text-sm leading-relaxed">
            Admin akan memverifikasi dalam <strong>1×24 jam</strong>. Setelah terverifikasi, kode unik login Anda akan tersedia.
        </p>

        {{-- Status Card --}}
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-5 flex gap-3 items-start">
            <span class="material-symbols-outlined text-amber-500 mt-0.5 shrink-0 text-xl" style="font-variation-settings:'FILL' 1;">pending</span>
            <div class="text-sm text-amber-800">
                <p class="font-bold mb-1">Menunggu Verifikasi Pembayaran</p>
                <p>Setelah admin mengkonfirmasi, gunakan tombol <em>"Cek Kode Unik"</em> di bawah untuk mengambil kode Anda.</p>
            </div>
        </div>

        {{-- Next Steps (mobile only) --}}
        <div class="lg:hidden bg-surface-container-low rounded-xl p-4 mb-5">
            <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-3">Langkah Selanjutnya</p>
            <ol class="space-y-2 text-sm">
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">✓</span>
                    <span>Daftar & unggah bukti pembayaran <span class="text-green-600 font-semibold">(selesai)</span></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                    <span>Tunggu verifikasi pembayaran oleh admin</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 bg-surface-container-high rounded-full flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 text-on-surface-variant">3</span>
                    <span>Cek kode unik lalu login untuk isi biodata &amp; berkas</span>
                </li>
            </ol>
        </div>

        {{-- Info Summary --}}
        <div class="bg-surface-container-low rounded-xl p-4 mb-6 space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-on-surface-variant">ID Pendaftaran</span>
                <span class="font-bold">{{ $regData['application_id'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-on-surface-variant">Nama</span>
                <span class="font-bold">{{ $regData['full_name'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-on-surface-variant">WhatsApp</span>
                <span class="font-bold">{{ $regData['phone'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-on-surface-variant">Metode Pembayaran</span>
                <span class="font-bold text-amber-600">
                    {{ $regData['payment_method'] === 'tu' ? 'Bayar di TU' : ucfirst($regData['payment_method']) }}
                </span>
            </div>
        </div>

        {{-- CTA Buttons --}}
        <div class="space-y-3">
            <a href="{{ route('ppdb.cek.kode', ['school' => $school]) }}"
               class="w-full bg-primary-container text-on-primary-fixed font-bold py-4 px-6 rounded-xl shadow-md hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">key</span>
                <span>Cek Kode Unik Saya</span>
            </a>
            <a href="{{ route('ppdb.login', ['school' => $school]) }}"
               class="w-full bg-surface-container-low text-on-surface font-bold py-3 px-6 rounded-xl hover:bg-surface-container-high transition-all flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-base">login</span>
                <span>Sudah Punya Kode? Masuk</span>
            </a>
        </div>

        <p class="text-center text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface/30 mt-10">
            &copy; {{ date('Y') }} {{ strtoupper($school) }} Putra Pakuan Bogor
        </p>

        </div>
    </div>
</div>

</body>
</html>
