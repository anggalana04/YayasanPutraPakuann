@extends('layouts.SMK.app')

@section('title', 'Visi dan Misi - SMK Putra Pakuan')

@push('head')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#f2cc0d", // Yellow for SMK
                    "secondary": "#fbbf24", // Yellow accent
                    "charcoal": "#101c22",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101c22",
                },
                fontFamily: {
                    "display": ["Lexend", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.5rem",
                    "lg": "1rem",
                    "xl": "1.5rem",
                    "full": "9999px"
                },
            },
        },
    }
</script>
<style>
    body {
        font-family: 'Lexend', sans-serif;
    }
    .vision-gradient {
        background: linear-gradient(135deg, #101c22 0%, #1a2e38 100%);
    }
</style>
@endpush

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-sm font-medium text-slate-400 mb-8">
        <a class="hover:text-primary" href="#">Beranda</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a class="hover:text-primary" href="#">Profil</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-charcoal">Visi &amp; Misi</span>
    </nav>
    <!-- Page Intro -->
    <div class="mb-16">
        <h2 class="text-4xl md:text-5xl font-black text-charcoal mb-4 tracking-tight">Visi dan Misi SMK Putra Pakuan</h2>
        <div class="w-20 h-2 bg-primary rounded-full mb-6"></div>
        <!-- Removed duplicate Visi & Misi content here -->
    </div>
    <!-- Vision Section (Visi) -->
    <section class="mb-24">
        <div class="vision-gradient rounded-xl p-8 md:p-16 relative overflow-hidden shadow-2xl">
            <!-- Abstract decorative element -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
            <div class="relative z-10 flex flex-col items-center text-center">
                <span class="text-secondary font-bold tracking-[0.2em] uppercase mb-6 flex items-center gap-2">
                    <span class="w-8 h-px bg-secondary"></span>
                    Visi Utama
                    <span class="w-8 h-px bg-secondary"></span>
                </span>
                <blockquote class="max-w-4xl">
                    <p class="text-white text-3xl md:text-5xl font-bold leading-tight md:leading-snug italic">
                        Membentuk manusia terampil, profesional, unggul dalam ilmu pengetahuan dan teknologi mampu menciptakan lapangan kerja sendiri dan siap terjun di dunia usaha/kerja yang didasari iman dan taqwa
                    </p>
                </blockquote>
                <div class="mt-12 flex gap-4">
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-full text-white/80 text-sm font-medium">
                        #Unggul
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-full text-white/80 text-sm font-medium">
                        #Berkarakter
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-full text-white/80 text-sm font-medium">
                        #Mandiri
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission Section (Misi) -->
    <section class="mb-16">
        <h3 class="text-2xl font-bold text-primary mb-6">Misi</h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Mempertinggi keimanan dan ketaqwaan kepada Tuhan Yang Maha Esa</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Melaksanakan pengembangan diri sejalan dengan pengembangan ilmu pengetahuan dan teknologi</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Melaksanakan pembelajaran yang efektif, efesien, dan menyenangkan</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Meningkatkan keterampilan seni dan budaya</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Menciptakan suasana lingkungan sekolah yang nyaman</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Meningkatkan rasa kekeluargaan diantara warga sekolah dan lingkungan sekolah</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Meningkatkan sarana dan prasarana belajar serta ekstrakulikuler</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Meningkatkan prilaku dan akhlak yang mulia bagi peserta didik</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Meningkatkan semangat prestasi bagi seluruh warga sekolah</span>
            </div>
            <div class="bg-white border-l-4 border-primary shadow p-6 rounded-xl flex gap-4 items-start">
                <span class="material-symbols-outlined text-primary text-3xl shrink-0">star</span>
                <span class="text-slate-700 font-medium">Mendorong murid untuk memahami potensi diri</span>
            </div>
        </div>
    </section>
    <!-- Values/Motto Section -->
    <section class="mt-32 mb-16 text-center">
        <h3 class="text-2xl font-bold text-charcoal mb-12">Nilai-Nilai Utama Kami</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">verified</span>
                <p class="font-bold text-charcoal">Integritas</p>
            </div>
            <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">bolt</span>
                <p class="font-bold text-charcoal">Inovatif</p>
            </div>
            <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">groups</span>
                <p class="font-bold text-charcoal">Kolaborasi</p>
            </div>
            <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">psychology</span>
                <p class="font-bold text-charcoal">Kreatif</p>
            </div>
        </div>
    </section>
</main>
@endsection
