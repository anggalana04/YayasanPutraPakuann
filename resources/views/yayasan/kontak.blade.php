@extends('layouts.app')

@section('content')
@php
    $contactInfo = $contactInfo ?? [];
    $contactWhatsapp = preg_replace('/\D+/', '', (string)($contactInfo['contact_whatsapp'] ?? '6282112345678'));
    $contactEmail = (string)($contactInfo['contact_email'] ?? 'info@putrapakuan.sch.id');
    $contactPhone = (string)($contactInfo['contact_phone'] ?? '+62 21 1234 5678');
    $contactPhoneLink = preg_replace('/[^\d+]/', '', $contactPhone) ?: '+622112345678';
    $contactAddress = (string)($contactInfo['contact_address'] ?? 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129');
    $contactMapUrl = (string)($contactInfo['contact_map_url'] ?? 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor');
@endphp

@if (!empty($pageContent))
    {!! $pageContent !!}
@else
<!-- Breadcrumb -->
<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white">Kontak</span>
    </div>
</div>

<main class="flex-grow flex flex-col">
<!-- Hero Section -->
<section class="relative px-4 py-12 md:px-10 lg:px-40 bg-white dark:bg-slate-800 transition-colors">
<div class="mx-auto max-w-7xl">
<div class="@container">
<div class="flex flex-col gap-10 md:gap-16 lg:flex-row items-center">
<div class="flex-1 flex flex-col gap-6 text-left">
<div class="flex flex-col gap-4">
<h1 class="text-4xl font-black leading-tight tracking-[-0.033em] mb-3 text-slate-900 dark:text-white">
    Hubungi Kami
</h1>
<p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
    Silakan hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, fasilitas, atau pertanyaan lainnya.
</p>
</div>
<div class="flex flex-col sm:flex-row gap-4">
<a href="https://wa.me/{{ $contactWhatsapp }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 rounded-xl h-12 px-6 bg-[#25D366] hover:bg-[#20bd5a] text-white text-base font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.938 3.659 1.432 5.63 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
<span>Mulai Chat WhatsApp</span>
</a>
<button class="flex items-center justify-center gap-2 rounded-xl h-12 px-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white hover:bg-slate-50 dark:hover:bg-slate-700 text-base font-bold transition-colors">
<span>Baca FAQ</span>
</button>
</div>
<p class="text-sm text-slate-500 dark:text-slate-400 flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">bolt</span>
                                    Waktu respons: Di bawah 2 jam
                                </p>
</div>
<div class="w-full lg:w-1/2 aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl relative group">
<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10"></div>
<div class="w-full h-full bg-center bg-cover transition-transform duration-700 group-hover:scale-105" data-alt="Area resepsionis sekolah modern dengan staf ramah" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCPlVWAUB2dSyNYiATNSwv_C4f3-ozw5BceSeRE4-EtgUHseXFWtnlELxqRliKwYXp7BHb38gZfwbYkf-FC8a4J8lpB4kv-nP50TRxeQlFPqdRBPY75MlMQcqoY-CbttUfbBeJo3jhaUwYJVbjmnhAMuu4zb0b17TVYvBE13GOcxIwHz3GvCki4fngTSgs9Dxau2sGgSMZOzYGy3PVXH_6rVrjTuuPnRhi5EvRyWwNmo4PGSTQSa10zwp451KY8zDsaQosEe9nzUFo");'>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Main Content Area: Contact Info & Form -->
<section class="px-4 py-16 md:px-10 lg:px-40 bg-slate-50 dark:bg-slate-900">
<div class="mx-auto max-w-7xl">
<div class="grid lg:grid-cols-12 gap-10">
<!-- Left Column: Contact Methods & Map -->
<div class="lg:col-span-5 flex flex-col gap-8">
<h2 class="text-2xl font-bold tracking-tight mb-2">Cara Menghubungi Kami</h2>
<!-- Cards Grid -->
<div class="grid gap-4">
<!-- WhatsApp Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-slate-800 p-5 shadow-sm border border-slate-200 dark:border-slate-700 hover:border-[#25D366] transition-colors group cursor-pointer">
<div class="size-12 rounded-full bg-[#E7F9EE] dark:bg-[#10301d] text-[#25D366] flex items-center justify-center shrink-0">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.938 3.659 1.432 5.63 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">WhatsApp Center</h3>
<p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Dukungan instan untuk pertanyaan cepat seputar jadwal atau biaya.</p>
<span class="text-[#FDB913] font-semibold text-sm group-hover:underline">Buka Chat ?</span>
</div>
</div>
<!-- Email Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-slate-800 p-5 shadow-sm border border-slate-200 dark:border-slate-700">
<div class="size-12 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined">mail</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">Pertanyaan Umum</h3>
<p class="text-sm text-slate-600 dark:text-slate-400">Kirim email untuk paket pendaftaran atau permintaan detail.</p>
<a class="text-slate-900 dark:text-white font-medium mt-1" href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
</div>
</div>
<!-- Phone Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-slate-800 p-5 shadow-sm border border-slate-200 dark:border-slate-700">
<div class="size-12 rounded-full bg-orange-50 dark:bg-orange-900/20 text-orange-500 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined">call</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">Telepon Kami</h3>
<p class="text-sm text-slate-600 dark:text-slate-400">Senin-Jumat: 07:00 - 16:00</p>
<a class="text-slate-900 dark:text-white font-medium mt-1" href="tel:{{ $contactPhoneLink }}">{{ $contactPhone }}</a>
</div>
</div>
</div>
<!-- Map Section -->
<div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm h-64 relative bg-white dark:bg-slate-800">
<div class="w-full h-full bg-cover bg-center" data-alt="Peta lokasi Yayasan Putra Pakuan di Bogor" data-location="Bogor, Indonesia" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTeuw32fvfuhkkNeSqq-LMVX_715T-O5lk_XP3CRdenlUsza9ozHy0b6RE67EBxUMyMTEJeq1eB9ojcIgtC6ObCKYpLh-Vh7wQxN3OEE7C410mBlSNk_nt73rS51LiHYlu11MZUpl_Pz5_oPUrg4G7ljLnZpfluj0k3A7Mwfr3hpxjvevipa6ZtgGJNsBkYsQ-oCAT3PkvOjTtfESeMkdMbKepgil9DXqPi0QQeaJhWxMKU7qtGh0Agz7OvPG4JjDTU1QAU4cd5iw");'>
<!-- Overlay for map feel -->
<div class="absolute inset-0 bg-slate-900/10 flex items-center justify-center group cursor-pointer hover:bg-slate-900/20 transition-colors">
<a href="{{ $contactMapUrl }}" target="_blank" rel="noopener noreferrer" class="bg-white dark:bg-slate-800 px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
<span class="material-symbols-outlined text-red-500">location_on</span>
<span class="font-bold text-sm">Lihat di Google Maps</span>
</a>
</div>
</div>
</div>
<div class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-400 px-2">
<span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5">pin_drop</span>
<p>{{ $contactAddress }}</p>
</div>
</div>
<!-- Right Column: Inquiry Form -->
<div class="lg:col-span-7">
<div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-md border border-slate-200 dark:border-slate-700 h-full">
<div class="mb-8">
<h2 class="text-2xl font-bold mb-2">Kirim Pesan</h2>
<p class="text-slate-600 dark:text-slate-400">Isi formulir di bawah dan kami akan mengarahkan pertanyaan Anda ke departemen yang tepat.</p>
</div>
<form class="flex flex-col gap-6">
<!-- Inquiry Type Dropdown -->
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-slate-900 dark:text-white" for="inquiry-type">Topik</label>
<div class="relative">
<select class="w-full appearance-none rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow" id="inquiry-type">
<option>Pertanyaan Pendaftaran</option>
<option>Biaya &amp; Keuangan</option>
<option>Pertanyaan Akademik</option>
<option>Kehidupan Siswa</option>
<option>Informasi Umum</option>
</select>
<span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 material-symbols-outlined">expand_more</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-slate-900 dark:text-white" for="parent-name">Nama Orang Tua</label>
<input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="parent-name" placeholder="Masukkan nama lengkap Anda" type="text"/>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-slate-900 dark:text-white" for="student-id">ID Siswa <span class="font-normal text-slate-600 dark:text-slate-400">(Opsional)</span></label>
<input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="student-id" placeholder="e.g. 2024-001" type="text"/>
</div>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-slate-900 dark:text-white" for="email">Alamat Email</label>
<input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="email" placeholder="name@example.com" type="email"/>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-slate-900 dark:text-white" for="message">Bagaimana kami bisa membantu?</label>
<textarea class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow resize-none placeholder:text-slate-500/50" id="message" placeholder="Deskripsikan pertanyaan atau keluhan Anda..." rows="5"></textarea>
</div>
<div class="mt-2">
<button class="w-full rounded-xl bg-[#FDB913] hover:bg-[#E5A800] text-slate-900 font-bold py-3.5 px-6 transition-all hover:shadow-lg shadow-md flex items-center justify-center gap-2" type="button">
<span>Kirim Pesan</span>
<span class="material-symbols-outlined text-[20px]">send</span>
</button>
<p class="text-center text-xs text-slate-600 dark:text-slate-400 mt-4">
                                            Dengan mengirim formulir ini, Anda menyetujui kebijakan privasi kami mengenai komunikasi data orang tua.
                                        </p>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- FAQ Teaser -->
<section class="border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 py-12 px-4 md:px-10 lg:px-40">
<div class="mx-auto max-w-4xl text-center">
<div class="inline-flex items-center justify-center size-12 rounded-full bg-[#FDB913]/10 text-[#FDB913] mb-4">
<span class="material-symbols-outlined">help</span>
</div>
<h2 class="text-2xl font-bold mb-3 text-slate-900 dark:text-white">Pertanyaan yang Sering Diajukan</h2>
<p class="text-slate-600 dark:text-slate-400 mb-8">Sebelum menghubungi kami, mungkin Anda akan menemukan jawaban yang Anda cari dalam daftar pertanyaan umum kami.</p>
<a class="inline-flex items-center justify-center gap-2 text-[#FDB913] font-bold hover:underline" href="#">
                        Kunjungi Pusat Bantuan
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
</div>
</section>
</main>

</body>
@endif
@endsection





