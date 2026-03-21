@extends('layouts.SMK.ppdb')

@section('ppdb-content')
<div class="pt-8 pb-20 px-4 md:px-8 max-w-5xl mx-auto">
<!-- Stepper Signature Component -->
<section class="pt-12 mb-12">
<div class="flex flex-row items-center justify-between w-full">
<!-- Step 1 (Active) -->
<div class="flex flex-col items-center flex-1">
<div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xl shadow-md">
01
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-primary font-bold">Langkah 1</p>
<h3 class="text-lg font-bold text-on-surface">Informasi Pribadi</h3>
</div>
</div>
<div class="hidden md:block h-0.5 bg-surface-container-highest flex-1 mx-2"></div>
<!-- Step 2 (Inactive) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface-variant font-bold text-lg">
02
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-on-surface-variant font-medium">Langkah 2</p>
<h3 class="text-lg font-bold text-on-surface-variant">Pilihan Jurusan</h3>
</div>
</div>
<div class="hidden md:block h-0.5 bg-surface-container-highest flex-1 mx-2"></div>
<!-- Step 3 (Inactive) -->
<div class="flex flex-col items-center flex-1">
<div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface-variant font-bold text-lg">
03
</div>
<div class="mt-2">
<p class="text-xs uppercase tracking-widest text-on-surface-variant font-medium">Langkah 3</p>
<h3 class="text-lg font-bold text-on-surface-variant">Pembayaran</h3>
</div>
</div>
</div>
</section>
<!-- Form Content Canvas -->
<section class="bg-surface-container-lowest rounded-xl p-8 md:p-12 shadow-[0_10px_40px_rgba(28,25,13,0.06)]">
<div class="mb-10">
<h2 class="text-2xl md:text-3xl font-bold tracking-tight text-[#1c190d] mb-2">Lengkapi Data Diri</h2>
<p class="text-on-surface-variant">Pastikan data yang Anda masukkan sesuai dengan dokumen resmi (KK/Ijazah).</p>
</div>
<form class="space-y-8">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Full Name -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Nama Lengkap</label>
<input class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-on-surface-variant/50 transition-all form-input-focus" placeholder="Masukkan nama sesuai ijazah" type="text"/>
</div>
<!-- NISN -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">NISN</label>
<input class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-on-surface-variant/50 transition-all form-input-focus" placeholder="10 Digit Nomor Induk Siswa Nasional" type="number"/>
</div>
<!-- Place of Birth -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Tempat Lahir</label>
<input class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-on-surface-variant/50 transition-all form-input-focus" placeholder="Kota/Kabupaten" type="text"/>
</div>
<!-- Date of Birth -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Tanggal Lahir</label>
<input class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface transition-all form-input-focus" type="date"/>
</div>
<!-- Gender -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Jenis Kelamin</label>
<div class="flex gap-4">
<label class="flex-1 cursor-pointer group">
<input class="hidden peer" name="gender" type="radio"/>
<div class="bg-surface-container-low p-4 rounded-xl flex items-center justify-center gap-2 border-2 border-transparent peer-checked:border-primary peer-checked:bg-white transition-all group-hover:bg-surface-container">
<span class="material-symbols-outlined text-lg">male</span>
<span class="font-medium">Laki-laki</span>
</div>
</label>
<label class="flex-1 cursor-pointer group">
<input class="hidden peer" name="gender" type="radio"/>
<div class="bg-surface-container-low p-4 rounded-xl flex items-center justify-center gap-2 border-2 border-transparent peer-checked:border-primary peer-checked:bg-white transition-all group-hover:bg-surface-container">
<span class="material-symbols-outlined text-lg">female</span>
<span class="font-medium">Perempuan</span>
</div>
</label>
</div>
</div>
<!-- Placeholder/Helper -->
<div class="hidden md:flex items-center px-4 py-3 bg-tertiary-container/30 rounded-xl border border-tertiary-container/20">
<span class="material-symbols-outlined text-tertiary mr-3">info</span>
<p class="text-xs text-on-tertiary-container font-medium">Pastikan semua data terisi dengan benar untuk mempermudah proses verifikasi.</p>
</div>
</div>
<!-- Address -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Alamat Lengkap</label>
<textarea class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-on-surface-variant/50 transition-all form-input-focus" placeholder="Jl. Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan" rows="4"></textarea>
</div>
<!-- School Origin -->
<div class="flex flex-col gap-2">
<label class="text-sm font-semibold text-on-surface px-1">Asal Sekolah</label>
<input class="bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-on-surface-variant/50 transition-all form-input-focus" placeholder="Nama Sekolah Asal" type="text"/>
</div>
<!-- Action Button -->
<div class="pt-6 flex flex-col md:flex-row justify-end items-center gap-4">
<button class="w-full md:w-auto px-10 py-4 bg-primary text-on-primary-fixed font-bold rounded-3xl shadow-[0_10px_30px_rgba(108,90,0,0.15)] hover:opacity-90 active:scale-95 transition-all flex items-center justify-center gap-3" type="button">
                        Lanjut ke Langkah 2
                        <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</form>
</section>
</div>
@endsection

@section('ppdb-footer')

@endsection
