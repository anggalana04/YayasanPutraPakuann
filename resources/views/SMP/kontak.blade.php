@extends('layouts.SMP.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @php
        $whatsappRaw = data_get($contact ?? [], 'contact_whatsapp', '6282112345678');
        $whatsappNumber = preg_replace('/\D+/', '', (string) $whatsappRaw);
        if ($whatsappNumber === '') {
            $whatsappNumber = '6282112345678';
        }
        $whatsappLink = 'https://wa.me/' . $whatsappNumber;
        $contactEmail = data_get($contact ?? [], 'contact_email', 'info@putrapakuan.sch.id');
        $contactPhone = data_get($contact ?? [], 'contact_phone', '+62 21 1234 5678');
        $contactAddress = data_get($contact ?? [], 'contact_address', 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129');
        $contactMapUrl = data_get($contact ?? [], 'contact_map_url', 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor');
    @endphp
    <!-- Header Section -->
    <div class="mb-12 text-center md:text-left">
        <h1 class="text-4xl font-black tracking-tight text-slate-900 dark:text-white md:text-5xl">
            Hubungi Kami
        </h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600 dark:text-slate-400">
            Silakan hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, fasilitas, atau pertanyaan lainnya.
        </p>
    </div>
    <div class="grid lg:grid-cols-12 gap-10">
        <!-- Left Column: Contact Methods & Map -->
        <div class="lg:col-span-5 flex flex-col gap-8">
            <h2 class="text-2xl font-bold tracking-tight mb-2">Cara Menghubungi Kami</h2>
            <!-- Cards Grid -->
            <div class="grid gap-4">
                <!-- WhatsApp Card -->
                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="flex items-start gap-4 rounded-2xl bg-white dark:bg-slate-800 p-5 shadow-sm border border-slate-200 dark:border-slate-700 hover:border-[#25D366] transition-colors group cursor-pointer">
                    <div class="size-12 rounded-full bg-[#E7F9EE] dark:bg-[#10301d] text-[#25D366] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">chat</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-bold text-lg">WhatsApp Center</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Dukungan instan untuk pertanyaan cepat seputar jadwal atau biaya.</p>
                        <span class="text-[#FDB913] font-semibold text-sm group-hover:underline">Buka Chat -> {{ $whatsappNumber }}</span>
                    </div>
                </a>
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
                        <a class="text-slate-900 dark:text-white font-medium mt-1" href="tel:{{ preg_replace('/\s+/', '', $contactPhone) }}">{{ $contactPhone }}</a>
                    </div>
                </div>
            </div>
            <!-- Map Section -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm h-64 relative bg-white dark:bg-slate-800">
                <div class="w-full h-full bg-cover bg-center" data-alt="Peta lokasi Yayasan Putra Pakuan di Bogor" data-location="Bogor, Indonesia" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTeuw32fvfuhkkNeSqq-LMVX_715T-O5lk_XP3CRdenlUsza9ozHy0b6RE67EBxUMyMTEJeq1eB9ojcIgtC6ObCKYpLh-Vh7wQxN3OEE7C410mBlSNk_nt73rS51LiHYlu11MZUpl_Pz5_oPUrg4G7ljLnZpfluj0k3A7Mwfr3hpxjvevipa6ZtgGJNsBkYsQ-oCAT3PkvOjTtfESeMkdMbKepgil9DXqPi0QQeaJhWxMKU7qtGh0Agz7OvPG4JjDTU1QAU4cd5iw");'>
                    <a href="{{ $contactMapUrl }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 bg-slate-900/10 flex items-center justify-center group cursor-pointer hover:bg-slate-900/20 transition-colors">
                        <div class="bg-white dark:bg-slate-800 px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-500">location_on</span>
                            <span class="font-bold text-sm">Lihat di Google Maps</span>
                        </div>
                    </a>
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
                    <p class="text-slate-600 dark:text-slate-400">Fill out the form below and we'll direct your inquiry to the right department.</p>
                </div>
                <form class="flex flex-col gap-6">
                    <!-- Inquiry Type Dropdown -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-slate-900 dark:text-white" for="inquiry-type">Topic</label>
                        <div class="relative">
                            <select class="w-full appearance-none rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow" id="inquiry-type">
                                <option>Pertanyaan Penerimaan</option>
                                <option>Biaya &amp; Keuangan</option>
                                <option>Pertanyaan Akademis</option>
                                <option>Kehidupan Siswa</option>
                                <option>Informasi Umum</option>
                            </select>
                            <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 material-symbols-outlined">expand_more</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white" for="parent-name">Parent Name</label>
                            <input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="parent-name" placeholder="Enter your full name" type="text"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white" for="student-id">Student ID <span class="font-normal text-slate-600 dark:text-slate-400">(Optional)</span></label>
                            <input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="student-id" placeholder="e.g. 2024-001" type="text"/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-slate-900 dark:text-white" for="email">Alamat Email</label>
                        <input class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow placeholder:text-slate-500/50" id="email" placeholder="name@example.com" type="email"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-slate-900 dark:text-white" for="message">How can we help?</label>
                        <textarea class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-base text-slate-900 dark:text-white focus:border-[#FDB913] focus:outline-none focus:ring-1 focus:ring-[#FDB913] transition-shadow resize-none placeholder:text-slate-500/50" id="message" placeholder="Please describe your question or concern..." rows="5"></textarea>
                    </div>
                    <div class="mt-2">
                        <button class="w-full rounded-xl bg-[#FDB913] hover:bg-[#E5A800] text-slate-900 font-bold py-3.5 px-6 transition-all hover:shadow-lg shadow-md flex items-center justify-center gap-2" type="button">
                            <span>Kirim Pesan</span>
                            <span class="material-symbols-outlined text-[20px]">send</span>
                        </button>
                        <p class="text-center text-xs text-slate-600 dark:text-slate-400 mt-4">
                            Dengan mengirimkan formulir ini, Anda menyetujui kebijakan privasi kami terkait komunikasi data orang tua.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FAQ Teaser -->
    <section class="border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 py-12 px-4 md:px-10 lg:px-40 mt-12">
        <div class="mx-auto max-w-4xl text-center">
            <div class="inline-flex items-center justify-center size-12 rounded-full bg-[#FDB913]/10 text-[#FDB913] mb-4">
                <span class="material-symbols-outlined">help</span>
            </div>
            <h2 class="text-2xl font-bold mb-3 text-slate-900 dark:text-white">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-slate-600 dark:text-slate-400 mb-8">Before you reach out, you might find the answer you're looking for in our curated list of frequently asked questions.</p>
            <a class="inline-flex items-center justify-center gap-2 text-[#FDB913] font-bold hover:underline" href="#">
                Kunjungi Pusat Bantuan
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </section>
</div>
@endsection









