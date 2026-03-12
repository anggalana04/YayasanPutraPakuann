@extends('layouts.SMK.app')

@section('title', 'SMK Putra Pakuan - Unggul, Berkarakter, Berdaya Saing')

@push('head')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
                    "charcoal": "#1c190d",
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
<style type="text/tailwindcss">
    body { font-family: 'Lexend', sans-serif; }
    .hero-slider {
        height: calc(100vh - 72px);
        position: relative;
        overflow: hidden;
    }
    .slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    .slide.active {
        opacity: 1;
    }
    .glass-card {
        background: rgba(28, 25, 13, 0.4);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(242, 204, 13, 0.2);
    }
</style>
@endpush

@section('content')
<section class="hero-slider bg-charcoal">
<div class="slide active">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCXpMjqgfiuKKSUoRdYNiimPNmi33yGSv3H1SaO224yREfseZpcO58hsaQNLTW26k-6h_ReeWKPSDwfwkCeRL47KVJ2OZ7_07xCQIUf_yjDCQTcuI0StKSRBoKdWJ_g40oTEJdFkwC33UMvSCyoruiBd_VRAxai80IG1XSnml39DK0QKzEQefEAJkEs2c6oRqRjrVPzsHQV8CNWeS5RNQQAyen_XVhX3q_tGFyatat2H16LqQ97VODQMhJMqZCeKy2Oa27diTKrcw')">
<div class="absolute inset-0 bg-gradient-to-r from-charcoal/80 via-charcoal/40 to-transparent"></div>
</div>
<div class="relative h-full max-w-7xl mx-auto px-6 flex items-center">
<div class="glass-card p-8 lg:p-12 rounded-3xl max-w-2xl">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 text-primary text-sm font-medium mb-6">
<span class="relative flex h-2 w-2">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
</span>
                    Tahun Ajaran 2024/2025
                </div>
<h2 class="text-4xl lg:text-7xl font-black text-white leading-tight mb-6">
                    SMK PUTRA <span class="text-primary">PAKUAN</span>
</h2>
<p class="text-xl text-slate-200 leading-relaxed mb-8">
                    Membentuk tenaga kerja profesional, berkarakter, dan siap bersaing di kancah industri global melalui inovasi pendidikan.
                </p>
<div class="flex flex-wrap gap-4">
<button class="bg-primary text-charcoal px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                        Pendaftaran Siswa Baru
                    </button>
<button class="flex items-center gap-2 px-8 py-4 rounded-xl font-bold text-lg border border-white/30 text-white hover:bg-white/10 transition-all backdrop-blur-md">
<span class="material-symbols-outlined">play_circle</span>
                        Video Kampus
                    </button>
</div>
</div>
</div>
</div>
<div class="slide">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA9jN6K-M6TXiwVtRwKGwC1bXraVK356kE3rvjNLRaWlRHC0rPZsfFchCr2rEWvkBekVrQDT72KGx33ecs172NKHB8RRAZQ5lK2ZGpsF70BkIJ77V2qv3GnQo4l35Eis7Z8YU3edbqX5lZclu3bQ6Htt5GSMAGHg0gGq_dYsJyqa6unEfhxVW9Ug4APEhI5zYLInlFVsa2DhRmrwH6m62_RscLRki4_d7_hLTzdC4WRh3noySWdy-i7gF7KMzWRKIgLTyOyJwoxdQ')">
<div class="absolute inset-0 bg-charcoal/40"></div>
</div>
</div>
<div class="absolute inset-x-0 bottom-10 z-20 flex justify-center items-center gap-8">
<button class="text-white/50 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-4xl">chevron_left</span>
</button>
<div class="flex gap-3">
<div class="w-12 h-1.5 rounded-full bg-primary shadow-sm cursor-pointer"></div>
<div class="w-12 h-1.5 rounded-full bg-white/20 hover:bg-white/40 cursor-pointer transition-colors"></div>
<div class="w-12 h-1.5 rounded-full bg-white/20 hover:bg-white/40 cursor-pointer transition-colors"></div>
</div>
<button class="text-white/50 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-4xl">chevron_right</span>
</button>
</div>
</section>
<section class="bg-primary py-16">
<div class="max-w-7xl mx-auto px-6">
<div class="bg-charcoal rounded-3xl p-8 lg:p-12 flex flex-col lg:flex-row items-center justify-between gap-10 shadow-2xl overflow-hidden relative">
<div class="absolute top-0 right-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[300px]">edit_note</span>
</div>
<div class="relative z-10 flex-1 text-center lg:text-left">
<div class="inline-block px-4 py-1 rounded-full bg-primary text-charcoal text-sm font-bold mb-6">REGISTRATION OPEN</div>
<h2 class="text-4xl lg:text-5xl font-black text-white mb-4">PPDB 2024 TELAH DIBUKA</h2>
<p class="text-slate-400 text-lg max-w-lg mb-8">
                    Segera daftarkan diri Anda dan menjadi bagian dari keluarga besar SMK Putra Pakuan. Kuota terbatas untuk setiap jurusan!
                </p>
<button class="bg-primary text-charcoal px-10 py-4 rounded-xl font-black text-xl hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    DAFTAR SEKARANG
                </button>
</div>
<div class="relative z-10 w-full lg:w-auto">
<div class="flex flex-col gap-4">
<p class="text-white/60 font-bold text-center mb-2 uppercase tracking-widest text-sm">Pendaftaran Ditutup Dalam:</p>
<div class="flex gap-4">
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-6 min-w-[100px] backdrop-blur-sm">
<span class="text-4xl font-black text-primary">12</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Hari</span>
</div>
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-6 min-w-[100px] backdrop-blur-sm">
<span class="text-4xl font-black text-primary">08</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Jam</span>
</div>
<div class="flex flex-col items-center bg-white/5 border border-white/10 rounded-2xl p-6 min-w-[100px] backdrop-blur-sm">
<span class="text-4xl font-black text-primary">45</span>
<span class="text-white/60 text-xs font-bold uppercase mt-1">Menit</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="py-24 bg-white dark:bg-charcoal/30">
<div class="max-w-7xl mx-auto px-6">
<div class="flex flex-col lg:flex-row gap-16 items-center">
<div class="w-full lg:w-5/12 relative">
<div class="absolute -top-6 -left-6 w-32 h-32 bg-primary rounded-2xl -z-10"></div>
<div class="rounded-3xl overflow-hidden shadow-2xl">
<img alt="Principal Portrait" class="w-full h-auto object-cover" src="{{ asset('images/KEPSEK_SMK.png') }}"/>
</div>
<div class="absolute -bottom-6 -right-6 bg-primary p-6 rounded-2xl shadow-xl">
<p class="text-charcoal font-black text-xl leading-none">Apid Sutarno, S.Kom, Gr.</p>
<p class="text-charcoal/70 text-sm font-bold mt-1">Kepala Sekolah</p>
</div>
</div>
<div class="w-full lg:w-7/12 space-y-6">
<span class="material-symbols-outlined text-primary text-6xl">format_quote</span>
<h2 class="text-4xl font-black text-charcoal dark:text-white">Sambutan Kepala Sekolah</h2>
<p class="text-xl italic text-slate-600 dark:text-slate-300 leading-relaxed">
                    "Bismillahirrahmanirrahim

Assalamualaikum warahmatullahi wabarakatuh

Alhamdulillahi rabbil'alamin kami panjatkan kehadlirat Allah SWT, bahwasannya dengan rahmat dan karunia-nya akhirnya website sekolah ini dengan alamat http://smk.putrapakuan.sch.id/ dapat kami perbaharui.

Kami mengucapkan selamat datang di Website kami Sekolah Menengah Kejuruan Putra Pakuan yang saya tujukan untuk seluruh guru, karyawan dan siswa siswi serta khalayak umum guna dapat mengakses seluruh informasi tentang segala profil, aktivitas/kegiatan serta fasilitas  yang ada di sekolah kami.

"
                </p>
<p class="text-slate-600 dark:text-slate-400">
                    Kami berharap, dengan adanya media layanan informasi situs ini semoga dapat mewujudkan hubungan silaturahmi yang lebih erat lagi, menambah wawasan, mempermudah dan mempercepat proses dalam mendapatkan informasi yang dibutuhkan.
                </p>
</div>
</div>
</div>
</section>
<section class="py-24 bg-background-light dark:bg-background-dark">
<div class="max-w-7xl mx-auto px-6">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="text-4xl font-black text-charcoal dark:text-white">Tulisan Terbaru</h2>
<p class="text-slate-500 mt-2">Update terkini kegiatan dan berita dari kampus kami.</p>
</div>
<a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-primary font-bold hover:gap-4 transition-all" href="#">
                Lihat Semua Berita <span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
<div class="grid md:grid-cols-3 gap-8">
<article class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
<div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC8toQGsfwk89NSEU-59xc2y6nC5fYwJSQQkiME-9CidHOk1JivrEfj8BJcIafRLZkRziw4sz2otEoeyDad_NzeIqjiXDrZF8TZwTW4z_7yw0zO79BE4eP7Fre-7Bm64gVgbOlllp-dB9xNo_0nkaZB0tU1tU9AV3yF63PDvr57YLbPWNoDVTVQ0sbCcQyp3LfPUKH3P_ZwZfoxcBluZuBA67S_8YvlYKGhjYAdvn_xQ6mI0Ki0fveFusS7JuLR4QoPhEpnEJolIg')">
<div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
</div>
<div class="p-6 space-y-4">
<div class="flex gap-4 text-xs font-bold text-slate-400">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 24 Okt 2023</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">person</span> Admin</span>
</div>
<h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Kunjungan Industri ke Perusahaan Teknologi Nasional</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Siswa kelas XI Jurusan RPL melakukan kunjungan belajar untuk melihat langsung proses pengembangan software di industri nyata...
                    </p>
<button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Selengkapnya
                    </button>
</div>
</article>
<article class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
<div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDDJmMhXjcr2KCkTWI-mqHWll_sluV5Nv4Tywd9nfqOg8HJs9tpwu8haBGFBP2gik28BJed5sTEcCytCNJ8QPMVNq0IBnK8Xue7BJbBQ_6UxXaKVwALHJzmPnl4VhSekWZ2RQkVBToRvmFs6_HTFbIbxBx8O8BfKwvK7Ls_EhRqLT3t7R-JHw0g7EEfbIHB2lu7BOPUGQjZwqcK_4qYw9uKNyVSaaZxgRrT4AoTPtcpY0rU-sTMO01O07FWLUpJyvhyXM6zt6v2fw')">
<div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
</div>
<div class="p-6 space-y-4">
<div class="flex gap-4 text-xs font-bold text-slate-400">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 15 Okt 2023</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">person</span> Kesiswaan</span>
</div>
<h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Pemenang Lomba Keterampilan Siswa (LKS) Tingkat Kota</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Selamat kepada tim SMK Putra Pakuan yang berhasil meraih juara 1 dalam bidang Network Support di ajang LKS tahun ini...
                    </p>
<button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Selengkapnya
                    </button>
</div>
</article>
<article class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
<div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDrs-xYRpyg0mRnIgy3Q65YVM1nHr2fo4yipt9WjNjO08pjxUJj4LNpPBprcv5P8R3fvdUYY0ik2ZWHnf3M3KuYGqBVcEb6ca0m1_1P4kY95gRBqRqX6wcBwgAO4cPsrU4DOcamSdp8aKbeo5HwIgHq3wOhpWUOm402YPRRX3aYHU-2KodZCi1wkkJoeLvnxEkZbQMtEvT-WU0MPTshLvI32GKK-BZCC9w9nLaSnCNrBwS2aYbWA38qhB_Ohj6zWp92kg7GkE0S2A')">
<div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
</div>
<div class="p-6 space-y-4">
<div class="flex gap-4 text-xs font-bold text-slate-400">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 02 Okt 2023</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">person</span> Humas</span>
</div>
<h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Tips Persiapan Ujian Kompetensi Keahlian bagi Kelas XII</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Menghadapi UKK memerlukan persiapan yang matang baik dari sisi teknis maupun mental. Berikut adalah beberapa tips dari guru pembimbing...
                    </p>
<button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Selengkapnya
                    </button>
</div>
</article>
</div>
</div>
</section>
<!-- Foto & Video Terbaru Section -->
<section class="py-24 bg-white dark:bg-charcoal/30">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black text-charcoal dark:text-white">Foto & Video Terbaru</h2>
                <p class="text-slate-500 mt-2">Dokumentasi kegiatan dan momen spesial terbaru dari SMK Putra Pakuan.</p>
            </div>
            <a class="hidden lg:flex items-center gap-2 text-charcoal dark:text-primary font-bold hover:gap-4 transition-all" href="#">
                Lihat Semua Galeri <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Foto 1 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80')">
                    <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 10 Mar 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">photo_camera</span> Dokumentasi</span>
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Kegiatan Praktek Industri Siswa RPL</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Siswa kelas XI RPL sedang melakukan praktek kerja industri di perusahaan mitra untuk meningkatkan kompetensi...
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Lihat Foto
                    </button>
                </div>
            </div>
            <!-- Video 1 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="h-56 bg-black flex items-center justify-center">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/1Q8fG0TtVAY" title="Video Kegiatan" allowfullscreen></iframe>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 05 Mar 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">videocam</span> Video</span>
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Liputan Kegiatan Expo SMK</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Saksikan keseruan Expo SMK Putra Pakuan yang menampilkan karya dan inovasi siswa dari berbagai jurusan.
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Tonton Video
                    </button>
                </div>
            </div>
            <!-- Foto 2 -->
            <div class="bg-white dark:bg-charcoal/40 rounded-2xl overflow-hidden shadow-md border border-charcoal/5 dark:border-white/5 hover:shadow-xl transition-shadow group">
                <div class="h-56 bg-cover bg-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80')">
                    <div class="w-full h-full bg-charcoal/20 group-hover:bg-charcoal/0 transition-colors"></div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex gap-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> 28 Feb 2024</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">photo_camera</span> Dokumentasi</span>
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">Juara Lomba Desain Grafis Nasional</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3">
                        Tim Multimedia SMK Putra Pakuan berhasil meraih juara 1 dalam lomba desain grafis tingkat nasional.
                    </p>
                    <button class="text-charcoal dark:text-white font-bold text-sm flex items-center gap-1 underline decoration-primary decoration-2 underline-offset-4">
                        Lihat Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
