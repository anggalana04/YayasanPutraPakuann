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

<div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-3xl rounded-[2rem] overflow-hidden bg-white shadow-[0_30px_80px_rgba(28,25,13,0.08)]">
        <div class="p-8 md:p-10 lg:p-14">
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center gap-2 rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-800 mb-4">
                    <span class="material-symbols-outlined">task_alt</span>
                    Pendaftaran Berhasil
                </div>
                <h1 class="text-3xl font-black text-slate-900 mb-2">Terima kasih, {{ $regData['full_name'] }}!</h1>
                <p class="text-slate-600 max-w-xl mx-auto">
                    @php
                        $paymentMethod = strtolower($regData['payment_method'] ?? '');
                        $isTUPayment = stripos($paymentMethod, 'tu') !== false || stripos($paymentMethod, 'tata usaha') !== false || stripos($paymentMethod, 'kasir') !== false;
                    @endphp
                    @if($isTUPayment)
                    Pendaftaran Anda telah dicatat. Silakan segera lakukan pembayaran ke Tata Usaha (TU) sesuai nominal yang telah ditentukan. Hubungi admin untuk informasi lebih lanjut jika diperlukan.
                @else
                    Bukti pembayaran Anda sudah kami terima. Admin sedang memverifikasi (biasanya 1x24 jam). Simpan ID Pendaftaran Anda dengan baik.
                @endif
            </p>
        </div>

        {{-- PENTING WARNING - Moved to top for prominence --}}
        <div class="rounded-3xl border-2 border-red-400 bg-red-50 p-6 mb-8 shadow-md">
            <div class="flex gap-3 items-start">
                <span class="material-symbols-outlined text-red-600 text-2xl shrink-0" style="font-variation-settings:'FILL' 1;">warning</span>
                <div>
                    <p class="font-black text-red-900 text-base mb-1">PENTING - SIMPAN ID PENDAFTARAN!</p>
                    <p class="text-sm text-red-800 leading-relaxed font-semibold">Simpan ID Pendaftaran <span class="text-lg font-black">{{ $regData['application_id'] }}</span> dengan baik. Gunakan ID ini untuk masuk ke portal dan mengecek status pendaftaran Anda.</p>
                </div>
            </div>
        </div>

        <div class="grid gap-4 mb-8">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500 mb-2">ID Pendaftaran Anda</p>
                <div class="flex items-center justify-between gap-4">
                    <p class="text-2xl font-black tracking-[0.12em] text-slate-600">{{ $regData['application_id'] }}</p>
                    <button type="button" onclick="copyToClipboard('{{ $regData['application_id'] }}', this)" class="inline-flex items-center gap-2 rounded-lg bg-slate-200 hover:bg-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 transition" title="Salin ID">
                        <span class="material-symbols-outlined text-base">content_copy</span>
                        <span class="hidden sm:inline">Salin</span>
                    </button>
                </div>
                <p class="text-xs text-slate-500 mt-2">Gunakan ID ini untuk masuk ke portal dan cek status</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500 mb-2">Nama</p>
                    <p class="font-semibold text-slate-900">{{ $regData['full_name'] }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500 mb-2">WhatsApp</p>
                    <p class="font-semibold text-slate-900">{{ $regData['phone'] }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-3">
            <a href="{{ route('ppdb.cek.kode', ['school' => $school]) }}" class="rounded-2xl bg-primary px-5 py-4 text-center text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-[#5c4800]">Cek Status Pendaftaran</a>
            <a href="{{ route('ppdb.login', ['school' => $school]) }}" class="rounded-2xl border border-slate-200 px-5 py-4 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Masuk dengan ID Pendaftaran</a>
        </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text, button) {
    // Try modern Clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
            showCopySuccess(button);
        }).catch(() => {
            // Fallback to older method
            fallbackCopyToClipboard(text, button);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyToClipboard(text, button);
    }
}

function fallbackCopyToClipboard(text, button) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    textarea.style.pointerEvents = 'none';
    document.body.appendChild(textarea);
    textarea.select();

    try {
        const success = document.execCommand('copy');
        if (success) {
            showCopySuccess(button);
        } else {
            alert('Gagal menyalin ID. Silakan coba lagi.');
        }
    } catch (err) {
        console.error('Copy failed:', err);
        alert('Gagal menyalin ID. Silakan coba lagi.');
    } finally {
        document.body.removeChild(textarea);
    }
}

function showCopySuccess(button) {
    if (!button) return;
    const originalText = button.innerHTML;
    button.innerHTML = '<span class="material-symbols-outlined text-base">check</span><span class="hidden sm:inline">Tersalin</span>';
    button.classList.add('bg-green-200', 'text-green-700');
    button.classList.remove('bg-slate-200', 'hover:bg-slate-300', 'text-slate-700');

    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('bg-green-200', 'text-green-700');
        button.classList.add('bg-slate-200', 'hover:bg-slate-300', 'text-slate-700');
    }, 2000);
}
</script>
</body>
</html>
