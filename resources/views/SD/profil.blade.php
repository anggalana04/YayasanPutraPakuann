@extends('layouts.SD.app')

@section('title', 'Profil Sekolah | SDIT Putra Pakuan')

@push('head')
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
                        Sekolah Dasar Islam Terpadu (SDIT) Putra Pakuan berdiri tahun 2008 dan berlokasi di Provinsi Jawa Barat, Kabupaten Bogor, tepatnya di kota Bogor dengan alamat <span class="font-semibold text-charcoal">Jl. Ruko Megapolitan Kebon Kelapa No.5, Desa, RT.03/RW.04, Cimandala, Kec. Sukaraja, Bogor, Jawa Barat 16710</span>.
                    </p>
                    <p class="leading-relaxed mt-4">
                        SDIT Putra Pakuan didukung oleh tenaga pendidik profesional yang sangat memahami kebutuhan dan potensi setiap peserta didik. Dengan lingkungan belajar yang inspiratif dan fasilitas lengkap, kami berkomitmen mencetak lulusan yang siap melanjutkan pendidikan ke jenjang yang lebih tinggi.
                    </p>
                </div>
            </div>
            <!-- Program Unggulan Section -->
            <section id="program" class="mb-12">
                <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">menu_book</span>
                    Program Unggulan
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">science</span>
                        <span class="font-semibold text-charcoal">Sains & Matematika</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">language</span>
                        <span class="font-semibold text-charcoal">Bahasa Indonesia & Bahasa Inggris</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">computer</span>
                        <span class="font-semibold text-charcoal">Teknologi Informasi & Komputer</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">palette</span>
                        <span class="font-semibold text-charcoal">Seni Budaya & Prakarya</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">sports_soccer</span>
                        <span class="font-semibold text-charcoal">Pendidikan Jasmani & Olahraga</span>
                    </div>
                    <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">church</span>
                        <span class="font-semibold text-charcoal">Pendidikan Agama & Budi Pekerti</span>
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
                        <span class="material-symbols-outlined text-primary">biotech</span> Lab IPA
                    </div>
                    <div class="bg-white border border-primary/10 rounded-xl p-4 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">record_voice_over</span> Lab Bahasa
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
                        <p class="text-slate-600 mt-2">Pembangunan gedung utama dimulai dengan visi untuk membangun pusat keunggulan pendidikan di wilayah Pakuan.</p>
                    </div>
                    <!-- Timeline Item -->
                    <div class="relative">
                        <div class="absolute -left-10.25 top-0 size-5 bg-primary rounded-full ring-4 ring-white shadow-sm"></div>
                        <span class="text-primary font-black text-lg">2010</span>
                        <h3 class="text-xl font-bold mt-1">Angkatan Pertama</h3>
                        <p class="text-slate-600 mt-2">Membuka pendaftaran pertama untuk mata pelajaran pilihan dengan total 120 siswa perdana.</p>
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
                <div class="aspect-video bg-slate-200" data-alt="Jalur kampus dengan pepohonan hijau dan gedung" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDB3xAIQ-Op2E1ckgImglHSYCMGIw52P9GNV-AGL6rt4W9KzlcX_Jmqv_DSkVLm-jcJJFzRRSpU5Emj_EhhnPAn4p6dodkCuDy41Lyo-unCw7TMDCwkY8PiQEXsr5sTyMZ3Zb_t3G0fStezDWk_WuD4mfyqTdmR9PYqwpBuEAX-mbgMa0PqbEK3Z8kK4gv0bot73JhFcMehqb8bbhSktLC0alYqWJsr4mq6cruTxtSFskjRh3rjUFweaqf82piO-ZcgpPJgDpiuSw')"></div>
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
        </aside>
    </div>
</section>

<!-- Visi & Misi Section (Merged) -->
<section id="visi-misi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <h2 class="text-3xl font-black mb-4 flex items-center gap-3">
        <span class="w-2 h-8 bg-primary rounded-full"></span>
        Visi & Misi SDIT Putra Pakuan
    </h2>
    <p class="text-slate-600 mb-12">Arah dan tujuan yang menjadi landasan SDIT Putra Pakuan dalam menyelenggarakan pendidikan dasar Islam terpadu yang berkualitas dan berkarakter islami.</p>

    <!-- Visi -->
    <div class="rounded-xl p-8 md:p-16 relative overflow-hidden shadow-2xl mb-12" style="background: linear-gradient(135deg, #101c22 0%, #1a2e38 100%)">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col items-center text-center">
            <span class="text-primary font-bold tracking-[0.2em] uppercase mb-6 flex items-center gap-2">
                <span class="w-8 h-px bg-primary"></span>
                Visi Utama
                <span class="w-8 h-px bg-primary"></span>
            </span>
            <blockquote class="max-w-4xl">
                <p class="text-white text-2xl md:text-4xl font-bold leading-tight md:leading-snug italic">
                    &quot;Membentuk manusia terampil, profesional, unggul dalam ilmu pengetahuan dan teknologi mampu menciptakan lapangan kerja sendiri dan siap terjun di dunia usaha/kerja yang didasari iman dan taqwa&quot;
                </p>
            </blockquote>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <span class="bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2 rounded-full text-white/80 text-sm font-medium">#Unggul</span>
                <span class="bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2 rounded-full text-white/80 text-sm font-medium">#Berkarakter</span>
                <span class="bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2 rounded-full text-white/80 text-sm font-medium">#Mandiri</span>
            </div>
        </div>
    </div>

    <!-- Misi -->
    <h3 class="text-2xl font-bold text-primary mb-6">Misi</h3>
    <div class="grid md:grid-cols-2 gap-6 mb-16">
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

    <!-- Nilai Utama -->
    <h3 class="text-2xl font-bold text-charcoal mb-8 text-center">Nilai-Nilai Utama Kami</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex flex-col items-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-4">verified</span>
            <p class="font-bold text-charcoal">Integritas</p>
        </div>
        <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex flex-col items-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-4">bolt</span>
            <p class="font-bold text-charcoal">Inovatif</p>
        </div>
        <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex flex-col items-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-4">groups</span>
            <p class="font-bold text-charcoal">Kolaborasi</p>
        </div>
        <div class="p-8 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex flex-col items-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-4">psychology</span>
            <p class="font-bold text-charcoal">Kreatif</p>
        </div>
    </div>
</section>
@endsection




