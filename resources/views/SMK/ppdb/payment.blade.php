@extends('layouts.SMK.ppdb')

@section('ppdb-content')


<div class="pb-20 px-4 md:px-8 max-w-4xl mx-auto">
<!-- Stepper Signature Component -->
<section class="pt-12 mb-12">
<div class="flex flex-row items-center justify-between w-full">
<!-- Step 1 (Done) -->
<div class="flex flex-col items-center flex-1">
<div class="w-14 h-14 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-green-500 font-bold">Langkah 1</p>
<h3 class="text-lg font-bold text-on-surface">Informasi Pribadi</h3>
</div>
</div>
<!-- Connecting Line -->
<div class="flex-1 mx-2">
<div class="h-0.5 bg-surface-container-highest w-full md:block"></div>
</div>
<!-- Step 2 (Done) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-green-500 font-bold">Langkah 2</p>
<h3 class="text-lg font-bold text-on-surface">Pilihan Jurusan & Berkas</h3>
</div>
</div>
<!-- Connecting Line -->
<div class="flex-1 mx-2">
<div class="h-0.5 bg-surface-container-highest w-full md:block"></div>
</div>
<!-- Step 3 (Active) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg shadow-md">
03
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-primary font-bold">Langkah 3</p>
<h3 class="text-lg font-bold text-on-surface">Pembayaran</h3>
</div>
</div>
</div>
</section>
<!-- Header Editorial -->
<div class="mb-10 text-center">
<h1 class="font-headline text-4xl md:text-5xl font-bold tracking-tighter text-on-background mb-4">Finalisasi Pendaftaran</h1>
<p class="text-on-surface-variant max-w-lg mx-auto">Silakan melakukan pembayaran via transfer bank dan upload bukti transaksi untuk menyelesaikan proses registrasi.</p>
</div>
<!-- Asymmetric Bento Grid for Payment Info -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<!-- Bank Details Card -->
<div class="md:col-span-7 bg-white rounded-xl p-8 shadow-[0_4px_20px_rgba(28,25,13,0.04)] flex flex-col justify-between">
<div>
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 bg-surface-container-low rounded-lg flex items-center justify-center text-primary">
<span class="material-symbols-outlined">account_balance</span>
</div>
<h2 class="text-xl font-bold tracking-tight">Informasi Rekening</h2>
</div>
<div class="space-y-6">
<div class="group">
<p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nama Bank</p>
<p class="text-2xl font-bold text-on-background">Bank Mandiri</p>
</div>
<div class="group">
<p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nomor Rekening</p>
<div class="flex items-center justify-between">
<p class="text-2xl font-bold text-primary tracking-wider">1330012345678</p>
<button class="text-primary hover:bg-primary-container/20 p-2 rounded-full transition-colors">
<span class="material-symbols-outlined">content_copy</span>
</button>
</div>
</div>
<div class="group">
<p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Nama Pemilik</p>
<p class="text-xl font-medium text-on-background">SMK PUTRA PAKUAN BOGOR</p>
</div>
</div>
</div>
<div class="mt-8 p-4 bg-tertiary-container rounded-2xl flex gap-4 items-center">
<span class="material-symbols-outlined text-tertiary">info</span>
<p class="text-xs leading-relaxed text-on-tertiary-container">Pastikan nominal yang ditransfer sesuai dengan biaya pendaftaran yang tertera pada brosur.</p>
</div>
</div>
<!-- Upload Component -->
<div class="md:col-span-5 bg-surface-container-low rounded-xl p-8 flex flex-col">
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-primary">
<span class="material-symbols-outlined">cloud_upload</span>
</div>
<h2 class="text-xl font-bold tracking-tight">Bukti Pembayaran</h2>
</div>
<div class="flex-1 border-2 border-dashed border-outline-variant/30 rounded-2xl flex flex-col items-center justify-center p-6 text-center bg-white/50 hover:bg-white transition-all cursor-pointer group">
<div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-primary text-3xl">image</span>
</div>
<p class="font-bold text-on-background mb-1">Upload File</p>
<p class="text-[10px] text-on-surface-variant uppercase tracking-widest">JPG, PNG atau PDF (Max 2MB)</p>
</div>
<button class="mt-6 w-full bg-primary text-primary-fixed py-4 rounded-full font-bold shadow-lg shadow-primary/20 hover:opacity-90 active:scale-[0.98] transition-all">
                    Konfirmasi Pembayaran
                </button>
</div>
</div>
<!-- Confirmation Message (Appears after upload/action - shown here as state) -->
<div class="mt-12 bg-white rounded-xl p-8 text-center shadow-[0_10px_40px_rgba(28,25,13,0.06)] border border-primary/10">
<div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-6">
<span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<h3 class="text-2xl font-bold mb-3">Terima kasih telah mendaftar!</h3>
<p class="text-on-surface-variant max-w-md mx-auto mb-8">Admin kami akan segera memverifikasi data dan pembayaran Anda. Status pendaftaran dapat dipantau melalui dashboard siswa.</p>
<a class="inline-flex items-center gap-2 px-8 py-3 bg-on-surface text-white rounded-full font-bold hover:bg-on-surface/90 transition-all active:scale-95" href="#">
                Go to Dashboard
                <span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
@endsection

@section('ppdb-footer')

@endsection
