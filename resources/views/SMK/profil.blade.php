@extends('layouts.SMK.app')

@section('title', 'Profil Sekolah | SMK Putra Pakuan')

@push('head')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#f2cc0d",
                    "background-light": "#f8f8f5",
                    "background-dark": "#221f10",
                    "charcoal": "#222222",
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
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>
@endpush

@section('content')

<!-- Main Content Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Column: Main Info -->
        <div class="lg:col-span-8 space-y-16">
            <!-- Tentang Kami -->
            <div id="tentang-kami">
                <h2 class="text-3xl font-black mb-6 flex items-center gap-3">
                    <span class="w-2 h-8 bg-primary rounded-full"></span>
                    Tentang Kami
                </h2>
                <div class="prose prose-lg text-slate-600 space-y-4">
                    <p class="leading-relaxed">
                        Sekolah Menengah Kejuruan (SMK) Putra Pakuan berdiri tahun 2008 dan berlokasi di Provinsi Jawa Barat, Kabupaten Bogor, tepatnya di kota Bogor dengan alamat <span class="font-semibold text-charcoal">Jl. Ruko Megapolitan Kebon Kelapa No.5, Desa, RT.03/RW.04, Cimandala, Kec. Sukaraja, Bogor, Jawa Barat 16710</span>.
                    </p>
                    <p class="leading-relaxed mt-4">
                        SMK Putra Pakuan didukung oleh tenaga pendidik profesional yang sangat memahami kebutuhan dan potensi setiap peserta didik. Dengan lingkungan belajar yang inspiratif dan fasilitas lengkap, kami berkomitmen mencetak lulusan yang siap bersaing di dunia kerja maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.
                    </p>
                </div>
            </div>
            <!-- Jurusan Section -->
            <section id="jurusan" class="mb-12">
                <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">school</span>
                    Jurusan Unggulan
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">business_center</span>
                        <span class="font-semibold text-charcoal">Manajemen Perkantoran dan Layanan Bisnis (MPLB)</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">account_balance</span>
                        <span class="font-semibold text-charcoal">Akuntansi dan Keuangan Lembaga (AKL)</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">router</span>
                        <span class="font-semibold text-charcoal">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">palette</span>
                        <span class="font-semibold text-charcoal">Desain Komunikasi Visual (DKV)</span>
                        <span class="inline-block bg-primary/20 text-primary text-xs font-bold px-2 py-0.5 rounded ml-2">SMK Pusat Keunggulan Nasional</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">directions_car</span>
                        <span class="font-semibold text-charcoal">Teknik Kendaraan Ringan (TKR)</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">two_wheeler</span>
                        <span class="font-semibold text-charcoal">Teknik Sepeda Motor (TSM)</span>
                    </div>
                </div>
            </section>
            <!-- Fasilitas Section -->
            <section id="fasilitas" class="mb-12">
                <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">apartment</span>
                    Fasilitas Sekolah
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">pool</span> Kolam Renang
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">stadium</span> Stadion Mini
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">computer</span> Lab Komputer
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">build</span> Bengkel TSM
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">car_repair</span> Bengkel TKR
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">ac_unit</span> AC di setiap ruang kelas
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">meeting_room</span> Aula
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">mosque</span> Musholla
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">restaurant</span> Kantin Sekolah
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">menu_book</span> Perpustakaan
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">local_parking</span> Lapangan Parkir
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">videocam</span> CCTV & LCD TV
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">devices</span> Pembelajaran Berbasis IT
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">science</span> Lab IPA
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">park</span> Taman
                    </div>
                </div>
            </section>
            <!-- Sejarah -->
            <div id="sejarah">
                <h2 class="text-3xl font-black mb-10 flex items-center gap-3">
                    <span class="w-2 h-8 bg-primary rounded-full"></span>
                    Sejarah Singkat
                </h2>
                <div class="relative pl-8 border-l-2 border-primary/20 space-y-12">
                    <!-- Timeline Item -->
                    <div class="relative">
                        <div class="absolute -left-10.25 top-0 size-5 bg-primary rounded-full ring-4 ring-white shadow-sm"></div>
                        <span class="text-primary font-black text-lg">2008</span>
                        <h3 class="text-xl font-bold mt-1">Peletakan Batu Pertama</h3>
                        <p class="text-slate-600 mt-2">Pembangunan gedung utama dimulai dengan visi untuk membangun pusat keunggulan pendidikan kejuruan di wilayah Pakuan.</p>
                    </div>
                    <!-- Timeline Item -->
                    <div class="relative">
                        <div class="absolute -left-10.25 top-0 size-5 bg-primary rounded-full ring-4 ring-white shadow-sm"></div>
                        <span class="text-primary font-black text-lg">2010</span>
                        <h3 class="text-xl font-bold mt-1">Angkatan Pertama</h3>
                        <p class="text-slate-600 mt-2">Membuka pendaftaran pertama untuk jurusan Teknik Informatika dan Akuntansi dengan total 120 siswa perdana.</p>
                    </div>
                    <!-- Timeline Item -->
                    <div class="relative">
                        <div class="absolute -left-10.25 top-0 size-5 bg-primary rounded-full ring-4 ring-white shadow-sm"></div>
                        <span class="text-primary font-black text-lg">2018</span>
                        <h3 class="text-xl font-bold mt-1">Akreditasi A</h3>
                        <p class="text-slate-600 mt-2">Meraih predikat akreditasi 'Sangat Baik' (A) dari BAN-SM sebagai bukti kualitas manajemen dan mutu pendidikan.</p>
                    </div>
                </div>
            </div>
            <!-- Core Values -->
            <div>
                <h2 class="text-3xl font-black mb-8 flex items-center gap-3">
                    <span class="w-2 h-8 bg-primary rounded-full"></span>
                    Nilai Inti (Core Values)
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl border-t-4 border-primary shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 bg-primary/20 text-charcoal flex items-center justify-center rounded-lg mb-4">
                            <span class="material-symbols-outlined font-bold">verified_user</span>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Integritas</h4>
                        <p class="text-sm text-slate-500">Membentuk karakter yang jujur, bertanggung jawab, dan memiliki moralitas tinggi.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border-t-4 border-primary shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 bg-primary/20 text-charcoal flex items-center justify-center rounded-lg mb-4">
                            <span class="material-symbols-outlined font-bold">psychology</span>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Inovasi</h4>
                        <p class="text-sm text-slate-500">Mendorong kreativitas dan keberanian untuk menciptakan solusi baru di era digital.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border-t-4 border-primary shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 bg-primary/20 text-charcoal flex items-center justify-center rounded-lg mb-4">
                            <span class="material-symbols-outlined font-bold">handshake</span>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Kolaborasi</h4>
                        <p class="text-sm text-slate-500">Membangun kerja sama yang harmonis antara sekolah, siswa, dan dunia industri.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Column: Sidebar -->
        <aside class="lg:col-span-4 space-y-8">
            <!-- Visi Misi Card -->
            <div class="bg-charcoal text-white p-8 rounded-2xl shadow-xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">target</span>
                    <h2 class="text-2xl font-black">Visi & Misi</h2>
                </div>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-primary font-bold text-sm uppercase tracking-widest mb-2">Visi</h3>
                        <p class="text-slate-300 italic">"Menjadi pusat pendidikan vokasi unggulan yang menghasilkan lulusan berakhlak mulia, kompeten, dan mandiri."</p>
                    </div>
                    <hr class="border-white/10"/>
                    <div>
                        <h3 class="text-primary font-bold text-sm uppercase tracking-widest mb-3">Misi</h3>
                        <ul class="space-y-3">
                            <li class="flex gap-3 text-sm text-slate-300 leading-relaxed">
                                <span class="text-primary font-bold">1.</span>
                                Menyelenggarakan pembelajaran berbasis kompetensi sesuai standar industri.
                            </li>
                            <li class="flex gap-3 text-sm text-slate-300 leading-relaxed">
                                <span class="text-primary font-bold">2.</span>
                                Mengembangkan lingkungan pendidikan yang menjunjung tinggi nilai integritas.
                            </li>
                            <li class="flex gap-3 text-sm text-slate-300 leading-relaxed">
                                <span class="text-primary font-bold">3.</span>
                                Memperkuat jejaring dengan dunia usaha dan industri secara global.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Campus Image/Identity -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-primary/10">
                <div class="aspect-video bg-slate-200" data-alt="University campus walkway with green trees and buildings" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDB3xAIQ-Op2E1ckgImglHSYCMGIw52P9GNV-AGL6rt4W9KzlcX_Jmqv_DSkVLm-jcJJFzRRSpU5Emj_EhhnPAn4p6dodkCuDy41Lyo-unCw7TMDCwkY8PiQEXsr5sTyMZ3Zb_t3G0fStezDWk_WuD4mfyqTdmR9PYqwpBuEAX-mbgMa0PqbEK3Z8kK4gv0bot73JhFcMehqb8bbhSktLC0alYqWJsr4mq6cruTxtSFskjRh3rjUFweaqf82piO-ZcgpPJgDpiuSw')"></div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-1">Identitas Sekolah</h3>
                    <p class="text-sm text-slate-500 mb-4">NPSN: 12345678 | Akreditasi: A</p>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-xl">location_on</span>
                            <span>Jl. Raya Pakuan No. 12, Jawa Barat</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-xl">call</span>
                            <span>(021) 555-0123</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-xl">mail</span>
                            <span>info@putrapakuan.sch.id</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Social Feed Placeholder/Call to action -->
            <div class="bg-primary p-8 rounded-2xl text-charcoal">
                <h3 class="font-black text-xl mb-2">Ingin tahu lebih banyak?</h3>
                <p class="text-sm font-medium mb-6">Kunjungi media sosial kami untuk update kegiatan terbaru siswa SMK Putra Pakuan.</p>
                <div class="flex gap-4">
                    <a class="size-10 bg-white/30 rounded-lg flex items-center justify-center hover:bg-white/50 transition-colors" href="#">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                    <a class="size-10 bg-white/30 rounded-lg flex items-center justify-center hover:bg-white/50 transition-colors" href="#">
                        <span class="material-symbols-outlined">play_circle</span>
                    </a>
                    <a class="size-10 bg-white/30 rounded-lg flex items-center justify-center hover:bg-white/50 transition-colors" href="#">
                        <span class="material-symbols-outlined">camera</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection