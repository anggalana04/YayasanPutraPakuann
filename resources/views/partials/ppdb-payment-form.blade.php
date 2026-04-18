{{--
  Shared SPMB payment form.
  Variables expected from the parent view:
    $school      — lowercase school slug (smk / smp / sd)
    $application — authenticated PpdbApplication model
    $homepage    — SchoolHomepageSetting for this school (may be null)
    $step2Label  — label for the stepper step 2 text
--}}

@php
    $homepage = $homepage ?? null;

    // Bank details (fallback to sensible defaults so the page never breaks)
    $bankName    = $homepage?->payment_bank_name    ?: 'Bank Mandiri';
    $bankAccount = $homepage?->payment_bank_account ?: '-';
    $bankHolder  = $homepage?->payment_bank_holder  ?: strtoupper($school) . ' Putra Pakuan';
    $gopay       = $homepage?->payment_ewallet_gopay  ?: null;
    $dana        = $homepage?->payment_ewallet_dana   ?: null;
    $ovo         = $homepage?->payment_ewallet_ovo    ?: null;
    $shopee      = $homepage?->payment_ewallet_shopee ?: null;
    $regFee      = $homepage?->payment_registration_fee ?: null;
    $hasEwallet  = $gopay || $dana || $ovo || $shopee;
    $step2Label  = $step2Label ?? 'Berkas Dokumen';
@endphp

<div class="pb-20 px-4 md:px-8 max-w-4xl mx-auto">

{{-- ── Stepper ─────────────────────────────────────────────────────── --}}
<section class="pt-12 mb-12">
<div class="flex flex-row items-center justify-between w-full">
    <div class="flex flex-col items-center flex-1">
        <div class="w-14 h-14 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
        </div>
        <div class="mt-2">
            <p class="text-xs uppercase tracking-widest text-green-500 font-bold">Langkah 1</p>
            <h3 class="text-lg font-bold text-on-surface">Informasi Pribadi</h3>
        </div>
    </div>
    <div class="flex-1 mx-2"><div class="h-0.5 bg-surface-container-highest w-full"></div></div>
    <div class="flex flex-col items-center flex-1">
        <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
        </div>
        <div class="mt-2">
            <p class="text-xs uppercase tracking-widest text-green-500 font-bold">Langkah 2</p>
            <h3 class="text-lg font-bold text-on-surface">{{ $step2Label }}</h3>
        </div>
    </div>
    <div class="flex-1 mx-2"><div class="h-0.5 bg-surface-container-highest w-full"></div></div>
    <div class="flex flex-col items-center flex-1">
        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg shadow-md">03</div>
        <div class="mt-2">
            <p class="text-xs uppercase tracking-widest text-primary font-bold">Langkah 3</p>
            <h3 class="text-lg font-bold text-on-surface">Pembayaran</h3>
        </div>
    </div>
</div>
</section>

{{-- ── Header ──────────────────────────────────────────────────────── --}}
<div class="mb-10 text-center">
    <h1 class="font-headline text-4xl md:text-5xl font-bold tracking-tighter text-on-background mb-4">Pembayaran Pendaftaran</h1>
    <p class="text-on-surface-variant max-w-lg mx-auto">
        Pilih metode pembayaran yang tersedia, lalu unggah bukti transaksi atau datang ke TU sekolah.
    </p>
    @if ($regFee)
        <div class="mt-4 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 border border-primary/20">
            <span class="material-symbols-outlined text-primary text-sm">payments</span>
            <span class="font-bold text-primary text-sm">Biaya Pendaftaran: Rp {{ number_format($regFee, 0, ',', '.') }}</span>
        </div>
    @endif
</div>

{{-- ── Alerts ──────────────────────────────────────────────────────── --}}
@if ($errors->any())
<div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
    <strong class="font-bold">Terjadi kesalahan:</strong>
    <ul class="mt-2 list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif
@if (session('success'))
<div class="mb-6 bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
    <strong class="font-bold">Berhasil!</strong>
    <span class="block text-sm mt-1">{{ session('success') }}</span>
</div>
@endif

{{-- ── Method Tabs ─────────────────────────────────────────────────── --}}
<div class="flex gap-3 mb-6 flex-wrap" role="tablist" aria-label="Metode Pembayaran">
    {{-- E-Wallet tab (only shown when at least one number is configured) --}}
    @if ($hasEwallet)
    <button type="button" role="tab" aria-selected="true" aria-controls="tab-ewallet"
        class="pay-tab active-tab px-5 py-2.5 rounded-full border-2 border-primary bg-primary text-on-primary font-bold text-sm flex items-center gap-1.5 transition-all focus:outline-none"
        onclick="switchTab('ewallet', this)">
        <span class="material-symbols-outlined text-[18px]">wallet</span> E-Wallet
    </button>
    @endif
    <button type="button" role="tab" aria-selected="{{ $hasEwallet ? 'false' : 'true' }}" aria-controls="tab-bank"
        class="pay-tab {{ $hasEwallet ? '' : 'active-tab' }} px-5 py-2.5 rounded-full border-2 {{ $hasEwallet ? 'border-outline-variant text-on-surface-variant' : 'border-primary bg-primary text-on-primary' }} font-bold text-sm flex items-center gap-1.5 transition-all focus:outline-none"
        onclick="switchTab('bank', this)">
        <span class="material-symbols-outlined text-[18px]">account_balance</span> Transfer Bank
    </button>
    <button type="button" role="tab" aria-selected="false" aria-controls="tab-tu"
        class="pay-tab px-5 py-2.5 rounded-full border-2 border-outline-variant text-on-surface-variant font-bold text-sm flex items-center gap-1.5 transition-all focus:outline-none"
        onclick="switchTab('tu', this)">
        <span class="material-symbols-outlined text-[18px]">store</span> Bayar di TU
    </button>
</div>

<form method="POST" action="{{ route('ppdb.payment.update', ['school' => $school]) }}" enctype="multipart/form-data" id="paymentForm">
@csrf
<input type="hidden" name="payment_method" id="paymentMethodInput" value="{{ $hasEwallet ? 'ewallet' : 'bank' }}">

{{-- ── E-WALLET PANEL ──────────────────────────────────────────────── --}}
@if ($hasEwallet)
<div id="tab-ewallet" class="pay-panel">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
    {{-- Ewallet numbers --}}
    <div class="md:col-span-7 bg-white rounded-xl p-8 shadow-sm flex flex-col gap-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-surface-container-low rounded-lg flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">wallet</span>
            </div>
            <h2 class="text-xl font-bold tracking-tight">Nomor E-Wallet</h2>
        </div>

        @if ($gopay)
        <div class="flex items-center justify-between rounded-xl border border-outline-variant/40 px-4 py-3 bg-surface-container-low/30 hover:bg-surface-container-low transition">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo_Gopay.svg.png') }}" alt="GoPay" class="flex-shrink-0 h-7 object-contain align-middle" style="display: block; max-width: 80px;">
                <span class="text-on-surface font-bold tracking-wider text-lg">{{ $gopay }}</span>
            </div>
            <button type="button" onclick="copyText('{{ $gopay }}')"
                class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors"
                title="Salin nomor">
                <span class="material-symbols-outlined">content_copy</span>
            </button>
        </div>
        @endif

        @if ($dana)
        <div class="flex items-center justify-between rounded-xl border border-outline-variant/40 px-4 py-3 bg-surface-container-low/30 hover:bg-surface-container-low transition">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo_dana_blue.svg.png') }}" alt="DANA" class="flex-shrink-0 h-7 object-contain align-middle" style="display: block; max-width: 120px;">
                <span class="text-on-surface font-bold tracking-wider text-lg">{{ $dana }}</span>
            </div>
            <button type="button" onclick="copyText('{{ $dana }}')"
                class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors"
                title="Salin nomor">
                <span class="material-symbols-outlined">content_copy</span>
            </button>
        </div>
        @endif

        @if ($ovo)
        <div class="flex items-center justify-between rounded-xl border border-outline-variant/40 px-4 py-3 bg-surface-container-low/30 hover:bg-surface-container-low transition">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo_ovo_purple.svg.png') }}" alt="OVO" class="flex-shrink-0 h-7 object-contain align-middle" style="display: block; max-width: 80px;">
                <span class="text-on-surface font-bold tracking-wider text-lg">{{ $ovo }}</span>
            </div>
            <button type="button" onclick="copyText('{{ $ovo }}')"
                class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors"
                title="Salin nomor">
                <span class="material-symbols-outlined">content_copy</span>
            </button>
        </div>
        @endif

        @if ($shopee)
        <div class="flex items-center justify-between rounded-xl border border-outline-variant/40 px-4 py-3 bg-surface-container-low/30 hover:bg-surface-container-low transition">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/2-shopeepay-rectangle-orange2-1208029004.png') }}" alt="ShopeePay" class="flex-shrink-0 h-7 object-contain align-middle" style="display: block; max-width: 100px;">
                <span class="text-on-surface font-bold tracking-wider text-lg">{{ $shopee }}</span>
            </div>
            <button type="button" onclick="copyText('{{ $shopee }}')"
                class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors"
                title="Salin nomor">
                <span class="material-symbols-outlined">content_copy</span>
            </button>
        </div>
        @endif

        <div class="mt-2 p-4 bg-amber-50 border border-amber-200 rounded-2xl flex gap-3 items-start">
            <span class="material-symbols-outlined text-amber-500 mt-0.5">info</span>
            <p class="text-xs leading-relaxed text-amber-800">
                Transfer ke salah satu e-wallet di atas, lalu unggah screenshot bukti pembayaran.
                @if ($regFee) Pastikan nominal sesuai: <strong>Rp {{ number_format($regFee, 0, ',', '.') }}</strong>. @endif
            </p>
        </div>
    </div>

    {{-- Upload panel for ewallet --}}
    <div class="md:col-span-5 bg-surface-container-low rounded-xl p-8 flex flex-col gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">cloud_upload</span>
            </div>
            <h2 class="text-xl font-bold tracking-tight">Bukti Pembayaran</h2>
        </div>
        <label for="ewallet_proof_file" class="flex-1 border-2 border-dashed border-outline-variant/30 rounded-2xl flex flex-col items-center justify-center p-6 text-center bg-white/50 hover:bg-white transition-all cursor-pointer group min-h-[180px]">
            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-primary text-3xl">image</span>
            </div>
            <p class="font-bold text-on-background mb-1">Unggah Screenshot Bukti</p>
            <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Klik di sini atau drag file (JPG, PNG, PDF - Maks 2MB)</p>
            <input class="hidden" type="file" name="payment_proof" id="ewallet_proof_file"
                accept=".jpg,.jpeg,.png,.pdf"
                onchange="showFileName(this, 'ewallet_file_name')">
            <span id="ewallet_file_name" class="block mt-2 text-xs text-blue-600 font-semibold"></span>
        </label>
        <select name="ewallet_type" id="ewalletType"
            class="w-full bg-white border border-outline-variant rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
            @if ($gopay) <option value="GoPay">GoPay</option> @endif
            @if ($dana)  <option value="DANA">DANA</option> @endif
            @if ($ovo)   <option value="OVO">OVO</option> @endif
            @if ($shopee)<option value="ShopeePay">ShopeePay</option> @endif
        </select>
        <button type="submit" onclick="setMethod('ewallet')"
            class="w-full bg-primary text-on-primary py-4 rounded-full font-bold shadow-lg hover:opacity-90 active:scale-[0.98] transition-all">
            Konfirmasi Pembayaran E-Wallet
        </button>
    </div>
</div>
</div>
@endif

{{-- ── BANK TRANSFER PANEL ─────────────────────────────────────────── --}}
<div id="tab-bank" class="pay-panel {{ $hasEwallet ? 'hidden' : '' }}">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
    <div class="md:col-span-7 bg-white rounded-xl p-8 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-surface-container-low rounded-lg flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">account_balance</span>
                </div>
                <h2 class="text-xl font-bold tracking-tight">Informasi Rekening</h2>
            </div>
            <div class="space-y-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nama Bank</p>
                    <p class="text-2xl font-bold text-on-background">{{ $bankName }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nomor Rekening</p>
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-primary tracking-wider">{{ $bankAccount }}</p>
                        <button type="button" onclick="copyText('{{ $bankAccount }}')"
                            class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors"
                            title="Salin rekening">
                            <span class="material-symbols-outlined">content_copy</span>
                        </button>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nama Pemilik</p>
                    <p class="text-xl font-medium text-on-background">{{ $bankHolder }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 p-4 bg-amber-50 border border-amber-200 rounded-2xl flex gap-3 items-start">
            <span class="material-symbols-outlined text-amber-500 mt-0.5">info</span>
            <p class="text-xs leading-relaxed text-amber-800">
                Pastikan nominal yang ditransfer sesuai dengan biaya pendaftaran.
                @if ($regFee) Jumlah: <strong>Rp {{ number_format($regFee, 0, ',', '.') }}</strong>. @endif
            </p>
        </div>
    </div>
    <div class="md:col-span-5 bg-surface-container-low rounded-xl p-8 flex flex-col gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">cloud_upload</span>
            </div>
            <h2 class="text-xl font-bold tracking-tight">Bukti Pembayaran</h2>
        </div>
        <label for="bank_proof_file" class="flex-1 border-2 border-dashed border-outline-variant/30 rounded-2xl flex flex-col items-center justify-center p-6 text-center bg-white/50 hover:bg-white transition-all cursor-pointer group min-h-[180px]">
            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-primary text-3xl">image</span>
            </div>
            <p class="font-bold text-on-background mb-1">Unggah Bukti Transfer</p>
            <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Klik di sini atau drag file (JPG, PNG, PDF - Maks 2MB)</p>
            <input class="hidden" type="file" name="payment_proof" id="bank_proof_file"
                accept=".jpg,.jpeg,.png,.pdf"
                onchange="showFileName(this, 'bank_file_name')">
            <span id="bank_file_name" class="block mt-2 text-xs text-blue-600 font-semibold"></span>
        </label>
        <button type="submit" onclick="setMethod('bank')"
            class="w-full bg-on-surface text-white py-4 rounded-full font-bold shadow-lg hover:opacity-90 active:scale-[0.98] transition-all">
            Konfirmasi Pembayaran Bank
        </button>
    </div>
</div>
</div>

{{-- ── TU MANUAL PANEL ─────────────────────────────────────────────── --}}
<div id="tab-tu" class="pay-panel hidden">
<div class="bg-white rounded-xl p-8 shadow-sm">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center">
            <span class="material-symbols-outlined text-amber-600 text-3xl" style="font-variation-settings:'FILL' 1;">store</span>
        </div>
        <div>
            <h2 class="text-2xl font-bold">Bayar Langsung di TU</h2>
            <p class="text-on-surface-variant text-sm">Tata Usaha {{ strtoupper($school) }} Putra Pakuan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="rounded-2xl bg-amber-50 border border-amber-200 p-5 space-y-2">
            <div class="flex items-center gap-2 text-amber-700 font-bold mb-3">
                <span class="material-symbols-outlined text-sm">info</span>
                Cara Pembayaran di TU
            </div>
            <ol class="text-sm text-amber-800 space-y-2 list-decimal list-inside">
                <li>Klik tombol <strong>"Daftar untuk Bayar di TU"</strong> di bawah.</li>
                <li>Datang ke kantor TU sekolah pada jam kerja.</li>
                <li>Tunjukkan <strong>ID Pendaftaran: {{ $application->application_id ?? '-' }}</strong> kepada petugas.</li>
                <li>Lakukan pembayaran sesuai biaya yang berlaku.</li>
                <li>Admin akan mengkonfirmasi pembayaran Anda.</li>
            </ol>
        </div>
        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5 space-y-3">
            <div class="flex items-center gap-2 text-slate-700 font-bold mb-3">
                <span class="material-symbols-outlined text-sm">schedule</span>
                Jam Operasional TU
            </div>
            <div class="text-sm text-slate-600 space-y-1">
                <div class="flex justify-between"><span>Senin – Jumat</span><span class="font-bold">07.30 – 15.00 WIB</span></div>
                <div class="flex justify-between"><span>Sabtu</span><span class="font-bold">07.30 – 12.00 WIB</span></div>
                <div class="flex justify-between text-red-500"><span>Minggu / Libur</span><span class="font-bold">Tutup</span></div>
            </div>
            <div class="pt-2 border-t border-slate-200 text-xs text-slate-500">
                Lokasi: Gedung {{ strtoupper($school) }} Putra Pakuan, Ruang Tata Usaha
            </div>
        </div>
    </div>

    <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl mb-6 flex gap-3 items-start">
        <span class="material-symbols-outlined text-blue-500 mt-0.5">pending</span>
        <p class="text-sm text-blue-700">
            Setelah mengklik tombol di bawah, status pendaftaran Anda akan berubah menjadi
            <strong>"Menunggu Konfirmasi TU"</strong>. Admin akan memverifikasi setelah pembayaran diterima di TU.
        </p>
    </div>

    <button type="submit" onclick="setMethod('tu')"
        class="w-full md:w-auto px-10 py-4 rounded-full bg-amber-500 hover:bg-amber-600 text-white font-bold shadow-lg active:scale-[0.98] transition-all flex items-center gap-2 justify-center">
        <span class="material-symbols-outlined">how_to_reg</span>
        Daftar untuk Bayar di TU
    </button>
</div>
</div>

</form>

{{-- ── Confirmation banner (shown once payment is uploaded) ───────── --}}
@if (in_array($application->status ?? '', ['payment_uploaded', 'payment_completed', 'verified', 'accepted']))
<div class="mt-12 bg-white rounded-xl p-8 text-center shadow border border-primary/10">
    <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-6">
        <span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">verified</span>
    </div>
    <h3 class="text-2xl font-bold mb-3">
        @if (($application->payment_method ?? '') === 'tu')
            Menunggu Konfirmasi TU
        @else
            Pembayaran Sedang Diverifikasi
        @endif
    </h3>
    <p class="text-on-surface-variant max-w-md mx-auto mb-8">
        @if (($application->payment_method ?? '') === 'tu')
            Datangi TU sekolah dengan menyebutkan ID Pendaftaran Anda.
            Admin akan mengkonfirmasi pembayaran dan melanjutkan proses seleksi.
        @else
            Admin kami akan segera memverifikasi bukti pembayaran Anda.
            Status dapat dipantau melalui dashboard siswa.
        @endif
    </p>
    <a class="inline-flex items-center gap-2 px-8 py-3 bg-on-surface text-white rounded-full font-bold hover:opacity-90 transition-all"
       href="{{ route('ppdb.dashboard', ['school' => $school]) }}">
        Ke Dasbor
        <span class="material-symbols-outlined">arrow_forward</span>
    </a>
</div>
@endif

</div>{{-- /container --}}

<script>
function switchTab(name, btn) {
    document.querySelectorAll('.pay-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.pay-tab').forEach(t => {
        t.classList.remove('active-tab', 'border-primary', 'bg-primary', 'text-on-primary');
        t.classList.add('border-outline-variant', 'text-on-surface-variant');
        t.setAttribute('aria-selected', 'false');
    });
    document.getElementById('tab-' + name)?.classList.remove('hidden');
    btn.classList.add('active-tab', 'border-primary', 'bg-primary', 'text-on-primary');
    btn.classList.remove('border-outline-variant', 'text-on-surface-variant');
    btn.setAttribute('aria-selected', 'true');
    document.getElementById('paymentMethodInput').value = name;
}

function setMethod(method) {
    document.getElementById('paymentMethodInput').value = method;
}

function showFileName(input, spanId) {
    const span = document.getElementById(spanId);
    if (span) span.textContent = input.files[0]?.name ?? '';
    // enforce 2MB
    if (input.files[0] && input.files[0].size > 2 * 1024 * 1024) {
        alert('Ukuran file maksimal 2MB. Silakan pilih file yang lebih kecil.');
        input.value = '';
        if (span) span.textContent = '';
    }
}

function copyText(text) {
    navigator.clipboard?.writeText(text).then(() => {
        const el = document.createElement('div');
        el.textContent = 'Disalin!';
        el.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 bg-on-surface text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg z-50';
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 1800);
    }).catch(() => {
        prompt('Salin nomor ini:', text);
    });
}
</script>
