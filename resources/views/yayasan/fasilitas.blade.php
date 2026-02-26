@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="w-full max-w-[1200px] mx-auto px-4 pt-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
            <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
            <span>/</span>
            <span class="text-slate-900 dark:text-white">Fasilitas</span>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative w-full mb-8">
        <div class="relative flex min-h-[300px] md:min-h-[500px] flex-col items-center justify-center bg-cover bg-center px-4 py-12 text-center" style='background-image: linear-gradient(rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.85) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCOuMRxIhmeGmCeXIa0oH4M-LUhZAml61IEnJclpamBZP0Ij90YkrtmDIYk0yjR844j26mKCaFNm7zmDTs83k_EXRllFwx5SGruNsI1nJXUMi2WY4fnI1ogOl9oOzH0rsDm5WJgXoplhtRhxwQxW5zQ7LV6g5FEngcqGpYfbJjP4JnQM0hGcayBuKDNEehDPcTUpelcWrn54ty_4HkkGEwG13nTj49JfmS9ap4ca1CieXkKsfabwZtf239UnZu7SBh-kMfKcsr_4hY");'>
            <div class="max-w-3xl">
                <h1 class="text-white text-3xl md:text-5xl font-black leading-tight mb-4">
                    Fasilitas Terbaik untuk Pendidikan Berkualitas
                </h1>
                <p class="text-slate-200 text-base md:text-lg mb-6">
                    Kampus modern dengan fasilitas lengkap untuk mendukung pembelajaran optimal
                </p>
                <a href="#jadwal-tur" class="inline-flex items-center justify-center rounded-xl h-12 px-8 bg-[#FDB913] hover:bg-[#E5A800] text-white font-bold transition-all shadow-lg">
                    Jadwalkan Tur
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-[1200px] mx-auto px-4 pb-12">

        <!-- Filter Buttons -->
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-4">Jelajahi Fasilitas</h2>
            <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4">
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-[#FDB913] text-white text-sm font-bold">
                    Semua
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium">
                    Akademik
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium">
                    Olahraga
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium">
                    Seni
                </button>
            </div>
        </div>

        <!-- Facilities Grid -->
        <div class="space-y-12">

            <!-- Academic Facilities -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-[#FDB913] rounded-full"></div>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Fasilitas Akademik</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg5u3p7xVDBjMFYB1oRkJvS_NvGMzxi8gQPShKt9qYax2akQeK0AkmkFikaW3AVOi3Wm-7iBjigR6f5kgiRoYulKv4gp8uQSWJQ3AtQXm0UGAuUoaC3XGpwD7JaMJlMKw5ktBSLFwaBsQ9nOESRh86eoWfv7ahkTLvELi1PvOVN1GLSXP_wXG0u84sRwY47PaGjfJdRZC1_aGdSnzmjz-2vlGTBDZCcYjpUirpycXk2wK_WjkJBCDVcvvMl0mcRZmIlF9TDWsEi5g");'></div>
                        <div class="p-4">
                            <div class="text-[#FDB913] text-xs font-bold uppercase mb-2">SMA & SMP</div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Lab Sains</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Laboratorium lengkap untuk Fisika, Kimia, dan Biologi</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC-k-lhoU-9BB_C5khUar9B6exLyRA2TKU77D2_2a1OsD4Mr8QmHfiaNBxZSnOmsvRUB5XzO8td3pr76NL3vdajl_UlVT1Jxs0dsLv7NHDoCRoPIbAWBLHPA9NMVTsNjl0G8LS4MsS4ktokwJjIXzcqpkRI-1HL2ZE7qwbMeUan3aR1173vQF4WK8jFNlDaCWalXGOfZRcH6B_fmgHIgRJPbAtkZnAcJqAzICoMWmzosgbB7jqZJXvRSf4fA3tUX5l5cghYlZ-v5R8");'></div>
                        <div class="p-4">
                            <div class="text-[#FDB913] text-xs font-bold uppercase mb-2">Semua Tingkat</div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Lab Komputer</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Perangkat modern untuk coding dan desain</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDK9eLYkmHhPFplwNl-UiGOmyL7H7FJQw2QCVPcWaQWU3uwhgV2lUe_OLG2MTJbTKHeuVwW5xEhhjM-27QZRLfVv7L4EBRz5kaT3DhDlbD8e20y1aS3RjU1apIxey8qjAwDiuIkJCVFJchsCLLK6OcbjD7kVBGP5fOF9tLZ-iXYBVwYZ7OVC63K-Kt9pZ3pHHFXwsEkbfRXneJMx8tNIfH6GNh1gMOEAtV9WCVq2Wb-vQU26uKglrxqa4OHVm6ZSLwolGC6B0ohaCM");'></div>
                        <div class="p-4">
                            <div class="text-[#FDB913] text-xs font-bold uppercase mb-2">Semua Tingkat</div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Perpustakaan</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300">10.000+ koleksi buku fisik dan digital</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sports & Arts -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-[#FDB913] rounded-full"></div>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Olahraga & Seni</h3>
                </div>

                <!-- Large Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="relative rounded-xl overflow-hidden h-64 md:h-80 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuANycnAuwUhl9fFOGdXVlJb4dngjzr4wIQfWLfEvpWEMBUhfBlvgwBS8Az-2us4nlFsGCaISCDZ15YS_HJtC1bhOuD0U_zfgJWXmUwwGFHCmcxEJkqcV3H3DkhhX8dXsR5TeKor6gRQYaESoTDlhooeCZm_cJgp205ROFfXGgY-GJ1x5YknEK3_e-EMQB54AIInq0hbOlU8_covt4Y-vLdOu5n6Y0nLb9O7ro7-1Xu296AB7OoO4Cm-kKCO-bh_7qJWlLRGXudcOcU");'>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="inline-block px-3 py-1 bg-[#FDB913] text-white text-xs font-bold rounded-full mb-3">Olahraga</span>
                            <h4 class="text-white text-xl md:text-2xl font-bold mb-2">Arena Indoor</h4>
                            <p class="text-slate-200 text-sm">Basket, voli, dan bulu tangkis</p>
                        </div>
                    </div>

                    <div class="relative rounded-xl overflow-hidden h-64 md:h-80 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBdCmasm45skUF2hui-X95D1A_fGmj_XnLS96OTSKNymIMs7bNQVAMg8yqRb8MnFxuzY5S-mNQfLAbDSYOGcUQu8on8W650KPh3aLM7YyZYaXYXhSK8U-FGZzIim6hRYVkCtjNbmubIG_r8-vD4CobMn8RBONN0vr6U5rkL8GNCRLZQ5tbfdbSs_7objNvjJxK7fszBrq7zQ_-Xc-WV6k5ZRFNSeoJoSwyfJV_L-jDC9my5E5leXUVHh-eDnZ4Hz_cPnLTwSSRgXxE");'>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="inline-block px-3 py-1 bg-purple-600 text-white text-xs font-bold rounded-full mb-3">Seni</span>
                            <h4 class="text-white text-xl md:text-2xl font-bold mb-2">Studio Seni</h4>
                            <p class="text-slate-200 text-sm">Auditorium 300 kursi</p>
                        </div>
                    </div>
                </div>

                <!-- Small Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="aspect-square rounded-lg overflow-hidden bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDQbR1kWNFY4EBua7tnY8XI6czJbqbpNiVOQq2qXDwn_6MNn1MUeLG4RfMdScWXyEx6ngGGFG0jNaAJ2cUdRl1mdMLVgTpfNNWvvqdpNzcoBrAxkxaInuJMn4bAi9Flhrb98VJZL2YVimVXkDW-3a0WBJpUpqC4PW7idRY71afw-FGx7SV_WWJED91HqBkt5SUsOY8CtOwuu1XVmP5vS5n__VqGBcYH9Z3hIKduQFhFG532oYvA5s4jBuoQ3xRHwn0ROzPWr6SC95Y");'></div>
                    <div class="aspect-square rounded-lg overflow-hidden bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBM92YXUS8JNht53HQvOcZrYF2DSixEEqj3t8wtUfbFvh-TWgKfNqpQJOcl2n_JzukVBrDKVJuML5LckWfjpL9hJQZIOAQVmsqH7ZR3VXOTySVGuNB-Lnkm4nUBLsyIkUDNOVRtMGi6ezylAHxrvoiVD0uysZbI2vm5YILN9GPl__V5ZSBWCE60trfJw8tjj8C4achq8QggAWWAkLfLMahD1YKySowyqZXI2WiV1BpPU3K1CaiTs4jGvquncSj7xJgRWjtg9-4twQY");'></div>
                    <div class="aspect-square rounded-lg overflow-hidden bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDXVS9rCHR0LfHBCufPnbWXCFI2vJJ2rqBndckGs8ksSJ4-qx2qh6A8W1Sb8U_saL0dEIOa_8jrsI3S4u5zZ7PecFKbS0gwMRsv1I0qvrvDKer2esQDPCNEluGuZkjOuBDavGhpesc-GgUk1SRFP7HrC5Jw6A4V94JO28wtBRTXiUWzzseaZusJTH84CcftP4AeXH7kvYeaVbWb6E19zx3vi9Xiu3lDxjNOPVQpQ2WAQOZTOc-EdaeV0Gu6CBH8Tfona_TcpXk3-y0");'></div>
                    <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center border border-slate-200 dark:border-slate-700">
                        <span class="material-symbols-outlined text-[#FDB913] text-3xl mb-1">add_circle</span>
                        <span class="font-bold text-xs text-slate-700 dark:text-slate-300">Lainnya</span>
                    </div>
                </div>
            </section>

            <!-- Quick Facts -->
            <section class="bg-white dark:bg-slate-800 rounded-2xl p-6 md:p-8 border border-slate-200 dark:border-slate-700">
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white text-center mb-6">Fakta Kampus</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#FDB913]/10 flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">local_police</span>
                        </div>
                        <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-1">Keamanan 24/7</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400">CCTV & Pagar</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#FDB913]/10 flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">restaurant</span>
                        </div>
                        <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-1">Kantin Sehat</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Menu Bergizi</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#FDB913]/10 flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">medical_services</span>
                        </div>
                        <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-1">Klinik</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Perawat Fulltime</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-[#FDB913]/10 flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">wifi</span>
                        </div>
                        <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-1">Wi-Fi</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Internet Cepat</p>
                    </div>
                </div>
            </section>

            <!-- Map -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-[#FDB913] rounded-full"></div>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Lokasi</h3>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-[300px] md:h-[400px] border border-slate-200 dark:border-slate-700">
                    <iframe
                        width="100%"
                        height="100%"
                        frameborder="0"
                        style="border:0;"
                        src="https://www.google.com/maps?q=-6.524428696542451,106.82913176417465&hl=id&z=16&output=embed"
                        allowfullscreen
                        loading="lazy"
                    ></iframe>
                    <div class="absolute bottom-4 left-4 right-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700">
                        <h4 class="font-bold text-slate-900 dark:text-white mb-1">Yayasan Putra Pakuan</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mb-3">Bogor, Jawa Barat 16710</p>
                        <div class="flex gap-2">
                            <a href="https://maps.app.goo.gl/fVGtRjDWmeqhUvEP9" target="_blank" class="flex-1 bg-[#FDB913] hover:bg-[#E5A800] text-white text-xs font-bold py-2 rounded-lg text-center transition-colors">
                                Buka Maps
                            </a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=-6.524428696542451,106.82913176417465" target="_blank" class="flex-1 bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200 text-xs font-bold py-2 rounded-lg text-center hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                Arah
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="bg-slate-900 dark:bg-slate-800 rounded-2xl p-6 md:p-10 text-center border border-slate-800 dark:border-slate-700">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Ingin Melihat Langsung?</h3>
                <p class="text-slate-300 mb-6 max-w-xl mx-auto">Jadwalkan tur kampus bersama tim kami</p>
                <button class="inline-flex items-center justify-center rounded-xl h-12 px-8 bg-[#FDB913] hover:bg-[#E5A800] text-white font-bold transition-all shadow-lg">
                    Jadwalkan Tur
                </button>
            </section>

        </div>
    </main>
@endsection
