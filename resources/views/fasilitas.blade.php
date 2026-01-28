@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
        <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-text-muted-light dark:text-text-muted-dark mb-4">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span>/</span>
            <span class="text-primary">Fasilitas</span>
        </div>
    </div>
    <!-- Hero Section -->
    <section class="relative w-full">
        <div class="relative flex min-h-[560px] flex-col items-center justify-center overflow-hidden bg-cover bg-center p-8 text-center" data-alt="Modern school campus exterior with lush greenery and students walking" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCOuMRxIhmeGmCeXIa0oH4M-LUhZAml61IEnJclpamBZP0Ij90YkrtmDIYk0yjR844j26mKCaFNm7zmDTs83k_EXRllFwx5SGruNsI1nJXUMi2WY4fnI1ogOl9oOzH0rsDm5WJgXoplhtRhxwQxW5zQ7LV6g5FEngcqGpYfbJjP4JnQM0hGcayBuKDNEehDPcTUpelcWrn54ty_4HkkGEwG13nTj49JfmS9ap4ca1CieXkKsfabwZtf239UnZu7SBh-kMfKcsr_4hY");'>
            <div class="max-w-[800px] flex flex-col gap-6 animate-fade-in-up">
                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] md:text-6xl drop-shadow-lg">
                    Lingkungan Belajar Bertaraf Internasional untuk Putra-Putri Anda
                </h1>
                <h2 class="text-slate-100 text-lg font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-md">
                    Kampus kami dirancang untuk menumbuhkan rasa ingin tahu, kreativitas, dan menjamin keamanan setiap siswa dari TK hingga SMA.
                </h2>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-4">
                    <a href="#jadwal-tur" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-8 bg-primary hover:bg-sky-500 text-white text-base font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                        Jadwalkan Tur Kampus
                    </a>
                    <a href="#peta-interaktif" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-8 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white text-base font-bold transition-all">
                        Lihat Peta Interaktif
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Container -->
    <main class="flex flex-1 justify-center py-12 px-4 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark">
        <div class="flex flex-col max-w-[1200px] w-full gap-10">
            <!-- Filter Section -->
            <div class="flex flex-col gap-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h2 class="text-[#0d171b] dark:text-white tracking-tight text-[32px] font-bold leading-tight">Jelajahi Fasilitas Kami</h2>
                        <p class="text-slate-500 dark:text-slate-400 mt-2 text-lg">Filter berdasarkan kategori untuk menemukan fasilitas di setiap unit sekolah.</p>
                    </div>
                </div>
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                    <button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-primary text-white pl-5 pr-5 shadow-md transition-transform hover:scale-105">
                        <span class="material-symbols-outlined text-[20px]">grid_view</span>
                        <span class="text-sm font-bold">Semua</span>
                    </button>
                    <button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary/50 text-[#0d171b] dark:text-slate-200 pl-5 pr-5 transition-all hover:bg-slate-50 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined text-[20px] text-primary">school</span>
                        <span class="text-sm font-medium">Akademik</span>
                    </button>
                    <button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary/50 text-[#0d171b] dark:text-slate-200 pl-5 pr-5 transition-all hover:bg-slate-50 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined text-[20px] text-primary">sports_basketball</span>
                        <span class="text-sm font-medium">Olahraga & Kesehatan</span>
                    </button>
                    <button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary/50 text-[#0d171b] dark:text-slate-200 pl-5 pr-5 transition-all hover:bg-slate-50 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined text-[20px] text-primary">palette</span>
                        <span class="text-sm font-medium">Kreativitas & Seni</span>
                    </button>
                    <button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary/50 text-[#0d171b] dark:text-slate-200 pl-5 pr-5 transition-all hover:bg-slate-50 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined text-[20px] text-primary">local_library</span>
                        <span class="text-sm font-medium">Layanan Pendukung</span>
                    </button>
                </div>
            </div>
            <!-- Academic Section -->
            <section>
                <div class="flex items-center gap-2 mb-6">
                    <span class="h-8 w-1 bg-primary rounded-full"></span>
                    <h3 class="text-2xl font-bold text-[#0d171b] dark:text-white">Unggulan Akademik</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden">
                            <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Students working with microscopes in a modern science laboratory" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg5u3p7xVDBjMFYB1oRkJvS_NvGMzxi8gQPShKt9qYax2akQeK0AkmkFikaW3AVOi3Wm-7iBjigR6f5kgiRoYulKv4gp8uQSWJQ3AtQXm0UGAuUoaC3XGpwD7JaMJlMKw5ktBSLFwaBsQ9nOESRh86eoWfv7ahkTLvELi1PvOVN1GLSXP_wXG0u84sRwY47PaGjfJdRZC1_aGdSnzmjz-2vlGTBDZCcYjpUirpycXk2wK_WjkJBCDVcvvMl0mcRZmIlF9TDWsEi5g");'>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                                <span class="material-symbols-outlined text-[16px]">science</span>
                                <span>SMA & SMP</span>
                            </div>
                            <h4 class="text-xl font-bold text-[#0d171b] dark:text-white mb-2">Laboratorium Sains Lanjutan</h4>
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">Laboratorium lengkap untuk Fisika, Kimia, dan Biologi guna mendukung eksperimen langsung.</p>
                            <button class="text-primary font-bold text-sm hover:underline inline-flex items-center gap-1">
                                Lihat Galeri <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden">
                            <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Modern computer lab with rows of Apple computers and students coding" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC-k-lhoU-9BB_C5khUar9B6exLyRA2TKU77D2_2a1OsD4Mr8QmHfiaNBxZSnOmsvRUB5XzO8td3pr76NL3vdajl_UlVT1Jxs0dsLv7NHDoCRoPIbAWBLHPA9NMVTsNjl0G8LS4MsS4ktokwJjIXzcqpkRI-1HL2ZE7qwbMeUan3aR1173vQF4WK8jFNlDaCWalXGOfZRcH6B_fmgHIgRJPbAtkZnAcJqAzICoMWmzosgbB7jqZJXvRSf4fA3tUX5l5cghYlZ-v5R8");'>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                                <span class="material-symbols-outlined text-[16px]">computer</span>
                                <span>Semua Tingkatan</span>
                            </div>
                            <h4 class="text-xl font-bold text-[#0d171b] dark:text-white mb-2">Inovasi & Teknologi</h4>
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">Laboratorium komputer canggih dengan perangkat keras terbaru untuk coding, desain, dan riset.</p>
                            <button class="text-primary font-bold text-sm hover:underline inline-flex items-center gap-1">
                                Lihat Galeri <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden">
                            <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Quiet library interior with bookshelves and comfortable reading areas" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDK9eLYkmHhPFplwNl-UiGOmyL7H7FJQw2QCVPcWaQWU3uwhgV2lUe_OLG2MTJbTKHeuVwW5xEhhjM-27QZRLfVv7L4EBRz5kaT3DhDlbD8e20y1aS3RjU1apIxey8qjAwDiuIkJCVFJchsCLLK6OcbjD7kVBGP5fOF9tLZ-iXYBVwYZ7OVC63K-Kt9pZ3pHHFXwsEkbfRXneJMx8tNIfH6GNh1gMOEAtV9WCVq2Wb-vQU26uKglrxqa4OHVm6ZSLwolGC6B0ohaCM");'>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                                <span class="material-symbols-outlined text-[16px]">menu_book</span>
                                <span>Fasilitas Bersama</span>
                            </div>
                            <h4 class="text-xl font-bold text-[#0d171b] dark:text-white mb-2">Perpustakaan Pusat</h4>
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">Sebuah tempat tenang dengan lebih dari 10.000 sumber daya fisik dan digital untuk mendorong kebiasaan membaca seumur hidup.</p>
                            <button class="text-primary font-bold text-sm hover:underline inline-flex items-center gap-1">
                                Lihat Galeri <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Sports & Arts Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="h-8 w-1 bg-primary rounded-full"></span>
                        <h3 class="text-2xl font-bold text-[#0d171b] dark:text-white">Olahraga & Seni</h3>
                    </div>
                    <a class="hidden md:flex items-center text-primary font-bold hover:underline" href="#">Lihat Semua Fasilitas <span class="material-symbols-outlined text-lg ml-1">chevron_right</span></a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Featured Large Card Left -->
                    <div class="relative overflow-hidden rounded-xl bg-cover bg-center min-h-[320px] group cursor-pointer" data-alt="Indoor basketball court with polished wood floor and bright lighting" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuANycnAuwUhl9fFOGdXVlJb4dngjzr4wIQfWLfEvpWEMBUhfBlvgwBS8Az-2us4nlFsGCaISCDZ15YS_HJtC1bhOuD0U_zfgJWXmUwwGFHCmcxEJkqcV3H3DkhhX8dXsR5TeKor6gRQYaESoTDlhooeCZm_cJgp205ROFfXGgY-GJ1x5YknEK3_e-EMQB54AIInq0hbOlU8_covt4Y-vLdOu5n6Y0nLb9O7ro7-1Xu296AB7OoO4Cm-kKCO-bh_7qJWlLRGXudcOcU");'>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent transition-opacity group-hover:via-black/40"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <span class="inline-block px-3 py-1 bg-primary/90 text-white text-xs font-bold rounded-full mb-3 backdrop-blur-sm">Kompleks Olahraga</span>
                            <h4 class="text-white text-2xl font-bold mb-2">Arena Olahraga Dalam Ruangan</h4>
                            <p class="text-slate-200 text-sm line-clamp-2 max-w-[90%]">Menyelenggarakan turnamen basket, voli, dan bulu tangkis sepanjang tahun dalam suasana profesional.</p>
                        </div>
                    </div>
                    <!-- Featured Large Card Right -->
                    <div class="relative overflow-hidden rounded-xl bg-cover bg-center min-h-[320px] group cursor-pointer" data-alt="Music studio with piano, drums and soundproofing" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBdCmasm45skUF2hui-X95D1A_fGmj_XnLS96OTSKNymIMs7bNQVAMg8yqRb8MnFxuzY5S-mNQfLAbDSYOGcUQu8on8W650KPh3aLM7YyZYaXYXhSK8U-FGZzIim6hRYVkCtjNbmubIG_r8-vD4CobMn8RBONN0vr6U5rkL8GNCRLZQ5tbfdbSs_7objNvjJxK7fszBrq7zQ_-Xc-WV6k5ZRFNSeoJoSwyfJV_L-jDC9my5E5leXUVHh-eDnZ4Hz_cPnLTwSSRgXxE");'>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent transition-opacity group-hover:via-black/40"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <span class="inline-block px-3 py-1 bg-purple-600/90 text-white text-xs font-bold rounded-full mb-3 backdrop-blur-sm">Seni & Budaya</span>
                            <h4 class="text-white text-2xl font-bold mb-2">Studio Seni Pertunjukan</h4>
                            <p class="text-slate-200 text-sm line-clamp-2 max-w-[90%]">Studio kedap suara dan auditorium 300 kursi untuk drama, paduan suara, dan pertunjukan musik.</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                    <div class="relative rounded-lg overflow-hidden aspect-square group cursor-pointer">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Swimming pool lanes with blue water" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQbR1kWNFY4EBua7tnY8XI6czJbqbpNiVOQq2qXDwn_6MNn1MUeLG4RfMdScWXyEx6ngGGFG0jNaAJ2cUdRl1mdMLVgTpfNNWvvqdpNzcoBrAxkxaInuJMn4bAi9Flhrb98VJZL2YVimVXkDW-3a0WBJpUpqC4PW7idRY71afw-FGx7SV_WWJED91HqBkt5SUsOY8CtOwuu1XVmP5vS5n__VqGBcYH9Z3hIKduQFhFG532oYvA5s4jBuoQ3xRHwn0ROzPWr6SC95Y"/>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-bold text-center px-2">Kolam Renang</span>
                        </div>
                    </div>
                    <div class="relative rounded-lg overflow-hidden aspect-square group cursor-pointer">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="School playground with colorful equipment" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBM92YXUS8JNht53HQvOcZrYF2DSixEEqj3t8wtUfbFvh-TWgKfNqpQJOcl2n_JzukVBrDKVJuML5LckWfjpL9hJQZIOAQVmsqH7ZR3VXOTySVGuNB-Lnkm4nUBLsyIkUDNOVRtMGi6ezylAHxrvoiVD0uysZbI2vm5YILN9GPl__V5ZSBWCE60trfJw8tjj8C4achq8QggAWWAkLfLMahD1YKySowyqZXI2WiV1BpPU3K1CaiTs4jGvquncSj7xJgRWjtg9-4twQY"/>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-bold text-center px-2">Taman Bermain</span>
                        </div>
                    </div>
                    <div class="relative rounded-lg overflow-hidden aspect-square group cursor-pointer">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Art classroom with paintings and supplies" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXVS9rCHR0LfHBCufPnbWXCFI2vJJ2rqBndckGs8ksSJ4-qx2qh6A8W1Sb8U_saL0dEIOa_8jrsI3S4u5zZ7PecFKbS0gwMRsv1I0qvrvDKer2esQDPCNEluGuZkjOuBDavGhpesc-GgUk1SRFP7HrC5Jw6A4V94JO28wtBRTXiUWzzseaZusJTH84CcftP4AeXH7kvYeaVbWb6E19zx3vi9Xiu3lDxjNOPVQpQ2WAQOZTOc-EdaeV0Gu6CBH8Tfona_TcpXk3-y0"/>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-bold text-center px-2">Ruang Seni Rupa</span>
                        </div>
                    </div>
                    <div class="relative rounded-lg overflow-hidden aspect-square group cursor-pointer">
                        <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center text-primary hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                            <span class="material-symbols-outlined text-4xl mb-1">add_a_photo</span>
                            <span class="font-bold text-sm">Lihat Lainnya</span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Highlights / Quick Facts -->
            <section class="bg-primary/5 rounded-2xl p-8 border border-primary/10">
                <h3 class="text-2xl font-bold text-[#0d171b] dark:text-white mb-6 text-center">Fakta Singkat Kampus</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="size-14 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-primary shadow-sm">
                            <span class="material-symbols-outlined text-3xl">local_police</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-[#0d171b] dark:text-white">Keamanan 24/7</h5>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kampus berpagar dengan CCTV.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="size-14 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-primary shadow-sm">
                            <span class="material-symbols-outlined text-3xl">restaurant</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-[#0d171b] dark:text-white">Kantin Sehat</h5>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Menu bergizi disiapkan setiap hari.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="size-14 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-primary shadow-sm">
                            <span class="material-symbols-outlined text-3xl">medical_services</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-[#0d171b] dark:text-white">Klinik di Tempat</h5>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Perawat penuh waktu untuk keadaan darurat.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="size-14 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-primary shadow-sm">
                            <span class="material-symbols-outlined text-3xl">wifi</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-[#0d171b] dark:text-white">Wi-Fi Kampus</h5>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Internet cepat untuk pembelajaran.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Location / Map Section -->
            <section class="flex flex-col gap-6">
                <div class="flex items-center gap-2">
                    <span class="h-8 w-1 bg-primary rounded-full"></span>
                    <h3 class="text-2xl font-bold text-[#0d171b] dark:text-white">Peta Kampus</h3>
                </div>
                <div class="relative w-full rounded-2xl overflow-hidden shadow-md bg-slate-200 h-[400px]">
                    <!-- Embedded Google Map -->
                    <iframe
                        width="100%"
                        height="400"
                        frameborder="0"
                        style="border:0; filter: grayscale(20%) contrast(1.1);"
                        src="https://www.google.com/maps?q=-6.524428696542451,106.82913176417465&hl=id&z=16&output=embed"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <!-- Overlay Card -->
                    <div class="absolute bottom-4 left-4 right-4 md:left-8 md:bottom-8 md:right-auto md:w-80 bg-white dark:bg-slate-800 p-5 rounded-xl shadow-lg border-l-4 border-primary">
                        <h4 class="font-bold text-lg text-[#0d171b] dark:text-white mb-1">Yayasan Putra Pakuan</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mb-3">FRGH+6J9, Bogor Outer Ring Rd, Cimandala, Sukaraja, Kabupaten Bogor, Jawa Barat 16710</p>
                        <div class="flex gap-2">
                            <a href="https://maps.app.goo.gl/fVGtRjDWmeqhUvEP9" target="_blank" rel="noopener" class="flex-1 bg-primary text-white text-xs font-bold py-2 rounded-lg hover:bg-sky-600 transition-colors text-center">Buka di Google Maps</a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=-6.524428696542451,106.82913176417465" target="_blank" rel="noopener" class="flex-1 bg-slate-100 dark:bg-slate-700 text-[#0d171b] dark:text-slate-200 text-xs font-bold py-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors text-center">Petunjuk Arah</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Call to Action Footer Strip -->
            <section class="mt-8 mb-4">
                <div class="rounded-2xl bg-gradient-to-r from-[#101c22] to-[#1a2d36] p-8 md:p-12 text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl">
                    <div class="max-w-2xl">
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Ingin Melihat Langsung?</h3>
                        <p class="text-slate-300 text-base md:text-lg">Rasakan suasana Yayasan Putra Pakuan. Jadwalkan tur pribadi bersama tim penerimaan kami hari ini.</p>
                    </div>
                    <button class="shrink-0 bg-primary hover:bg-sky-500 text-white font-bold text-lg px-8 py-4 rounded-xl shadow-lg hover:shadow-primary/50 transition-all transform hover:-translate-y-1">
                        Jadwalkan Tur
                    </button>
                </div>
            </section>
        </div>
    </main>
@endsection
