@extends('layouts.app')

@push('styles')
    <style type="text/tailwindcss">
        @layer utilities {
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            .text-shadow-lg {
                text-shadow: 0 4px 8px rgba(0,0,0,0.5);
            }
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <div class="w-full relative overflow-hidden">
        <div class="w-full min-h-[700px] md:min-h-[600px] relative flex items-center">
            <!-- Background Video with Overlay -->
            <div class="absolute inset-0 overflow-hidden">
                <video class="absolute inset-0 w-full h-full object-cover scale-[1.45]" autoplay muted loop playsinline>
                    <source src="{{ asset('video/Company Profile SMK Putra Pakuan - Putra Pakuan Bogor (720p, h264).mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="absolute inset-0 bg-slate-900/70"></div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-20 right-10 w-72 h-72 bg-[#FDB913]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-[#FDB913]/5 rounded-full blur-3xl"></div>

            <!-- Content Container -->
            <div class="relative z-10 w-full max-w-[1280px] mx-auto px-4 md:px-10 py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Main Content -->
                    <div class="flex flex-col gap-8 text-center lg:text-left" data-aos="fade-right">
                        <div class="flex flex-col gap-4">
                            <h1 class="text-white text-4xl md:text-6xl lg:text-7xl font-black leading-tight tracking-tight text-shadow-lg">
                                Building the <span class="text-[#FDB913] relative inline-block">Leaders</span> of Tomorrow
                            </h1>

                            <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl font-medium">
                                Membentuk generasi unggul melalui pendidikan berkualitas dan pengembangan karakter islami yang kuat.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4 justify-center lg:justify-start items-center">
                            <button class="group flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-[#FDB913] hover:bg-[#E5A800] text-white text-base font-bold transition-all transform hover:scale-105 shadow-xl shadow-[#FDB913]/30">
                                <span>Join Us Today</span>
                                <span class="material-symbols-outlined text-xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                            <button class="flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:bg-white hover:text-slate-900 text-white text-base font-bold transition-all shadow-lg">
                                <span class="material-symbols-outlined text-xl">play_circle</span>
                                <span>Watch Video</span>
                            </button>
                        </div>
                    </div>

                    <!-- Right Column - PAXIST Card -->
                    <div class="flex items-center justify-center lg:justify-end" data-aos="fade-left">
                        <div class="relative">
                            <!-- Decorative Background -->
                            <div class="absolute inset-0 bg-[#FDB913]/10 rounded-3xl blur-xl transform rotate-6"></div>

                            <!-- Main Card -->
                            <div class="relative bg-white/95 backdrop-blur-md border border-slate-200 p-8 md:p-12 rounded-3xl shadow-2xl max-w-md">
                                <div class="flex flex-col gap-6 items-center text-center">

                                    <div class="w-40 h-40 rounded-2xl flex items-center justify-center">
                                        <img src="{{ asset('images/logo-putrapakuan.png') }}" alt="Logo Putra Pakuan" class="w-full h-full object-contain">
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <h2 class="text-slate-900 font-black text-3xl md:text-4xl tracking-wider">
                                            PAXIST
                                        </h2>
                                        <div class="w-16 h-1 bg-[#FDB913] rounded-full mx-auto"></div>
                                        <p class="text-slate-700 text-lg md:text-xl font-semibold leading-relaxed">
                                            Putra Pakuan Excellent, Intelectual, School Talent
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-3 w-full mt-4">
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Excellence in Education</span>
                                        </div>
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Character Development</span>
                                        </div>
                                        <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                            <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                            <span class="text-slate-900 font-medium">Talent Nurturing</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave SVG -->
            <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px] md:h-[100px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-white dark:fill-slate-900" d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Principals Section -->
    <div class="w-full bg-white dark:bg-background-dark py-20 flex justify-center">
        <div class="max-w-[1920px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                    Kepala Sekolah & Program
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl">
                    Para pemimpin yang berdedikasi membimbing setiap jenjang pendidikan di Yayasan Putra Pakuan.
                </p>
            </div>

            <!-- Grid of Principals -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-0 shadow-2xl rounded-xl overflow-hidden">
                <!-- PAUD IT -->
                <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="this.querySelector('video').play()" onmouseleave="this.querySelector('video').pause(); this.querySelector('video').currentTime = 0;">
                    <img
                        src="https://putrapakuan.sch.id/wp-content/uploads/2025/07/Lady.jpg"
                        alt="Principal PAUD IT"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    />
                    <video
                        class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        muted
                        loop
                        playsinline
                    >
                        <source src="{{ asset('video/talking.mp4') }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="text-3xl md:text-4xl font-black mb-2">PAUD IT</h3>
                        <p class="text-base md:text-lg font-semibold mb-4 opacity-90">Kepala Sekolah</p>
                        <p class="text-sm md:text-base leading-relaxed opacity-90">Membangun fondasi karakter islami sejak dini</p>
                    </div>
                </div>

                <!-- SDIT -->
                <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="this.querySelector('video').play()" onmouseleave="this.querySelector('video').pause(); this.querySelector('video').currentTime = 0;">
                    <img
                        src="https://putrapakuan.sch.id/wp-content/uploads/2025/07/Backup_of_KALENDER.jpg"
                        alt="Principal SDIT"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    />
                    <video
                        class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        muted
                        loop
                        playsinline
                    >
                        <source src="https://storage.coverr.co/videos/R9xqTFSMaTDQ02AOSqDxgFaVe2OJ9hk4kT?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="text-3xl md:text-4xl font-black mb-2">SDIT</h3>
                        <p class="text-base md:text-lg font-semibold mb-4 opacity-90">Kepala Sekolah</p>
                        <p class="text-sm md:text-base leading-relaxed opacity-90">Membentuk generasi qurani yang berprestasi</p>
                    </div>
                </div>

                <!-- SMP -->
                <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="this.querySelector('video').play()" onmouseleave="this.querySelector('video').pause(); this.querySelector('video').currentTime = 0;">
                    <img
                        src="https://putrapakuan.sch.id/wp-content/uploads/2025/07/BU-ELI.jpg"
                        alt="Principal SMP"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    />
                    <video
                        class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        muted
                        loop
                        playsinline
                    >
                        <source src="https://storage.coverr.co/videos/coverr-a-teacher-teaching-students-1829?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="text-3xl md:text-4xl font-black mb-2">SMP</h3>
                        <p class="text-base md:text-lg font-semibold mb-4 opacity-90">Kepala Sekolah</p>
                        <p class="text-sm md:text-base leading-relaxed opacity-90">Kembangkan pemimpin masa depan berakhlak</p>
                    </div>
                </div>

                <!-- SMK -->
                <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="this.querySelector('video').play()" onmouseleave="this.querySelector('video').pause(); this.querySelector('video').currentTime = 0;">
                    <img
                        src="https://putrapakuan.sch.id/wp-content/uploads/2025/07/Apid-Sutarno_DKV_Scan-PAS-FOTO-scaled.png"
                        alt="Principal SMK"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    />
                    <video
                        class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        muted
                        loop
                        playsinline
                    >
                        <source src="https://storage.coverr.co/videos/coverr-professional-man-on-a-video-call-2705?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="text-3xl md:text-4xl font-black mb-2">SMK</h3>
                        <p class="text-base md:text-lg font-semibold mb-4 opacity-90">Kepala Sekolah</p>
                        <p class="text-sm md:text-base leading-relaxed opacity-90">Mencetak profesional muda siap kerja</p>
                    </div>
                </div>

                <!-- PKBM -->
                <div class="group relative overflow-hidden h-[500px] md:h-[600px] lg:h-[700px] cursor-pointer" onmouseenter="this.querySelector('video').play()" onmouseleave="this.querySelector('video').pause(); this.querySelector('video').currentTime = 0;">
                    <img
                        src="https://putrapakuan.sch.id/wp-content/uploads/2025/07/PA-OMANG.jpg"
                        alt="Principal PKBM"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    />
                    <video
                        class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        muted
                        loop
                        playsinline
                    >
                        <source src="https://storage.coverr.co/videos/coverr-woman-in-a-video-call-1805?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="text-3xl md:text-4xl font-black mb-2">PKBM</h3>
                        <p class="text-base md:text-lg font-semibold mb-4 opacity-90">Kepala Program</p>
                        <p class="text-sm md:text-base leading-relaxed opacity-90">Pendidikan inklusif untuk semua kalangan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Educational Units Section -->
    <div class="w-full bg-slate-50 dark:bg-background-dark py-20 flex justify-center">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                    Our Educational Units
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl">
                    Comprehensive education pathways nurturing curiosity and character from early childhood to professional readiness.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAo01BG3mtgEitHxe_MQ2vep0z2ot3bs0O612Kjm-gwgff2eI6sepMUWcfG3nneT5FLMfv79BInFGYiipEZL8x5JkZncWSMG65HLe1QcCvPcTHZqJsVAgZ6vR0DQW0pgw5OhuCivdxLjU0-pQF7kYvD5AUNibuJObKqWnFxiK6yvIk4_iPPkxvInUuQYh9mWlLUIHvrUIjdBkWyf1VOIscR0xt4ph9YgkMn75Qftc7PqEqtY5XSFWsSt1YFYRTlVpDX-gFhuaJeO0A");'>
                        <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold tracking-widest uppercase text-sm">Explore</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow gap-2">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold">PAUD IT</h3>
                        <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">Early Childhood</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Nurturing curiosity in a safe, play-based Islamic environment.</p>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB-JlEYUkSfchaHnPhogCbXbQSxm636ROeu_ukTM5t1j45DfEujKoA4f1VaAiI4mtWsoqDvL-KeTGHtSDBxHKDkshAZEc8UZxR5A8Qg3_wK9T5RaKLtrH0js4TNUrPOaWGKN4c9L1F8VaZgYWH_qmtXMYVK1eGMiFxsQt3jRywM93hjr2BJr0a8fqUBrxsNTwSw7rtCF07tJ1jAm20IhWnPQT7j2HiJ65Nms-7fZtvYS7GKk4XTfyLixI79iyjuaqWM4YWUEhtSlWU");'>
                        <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold tracking-widest uppercase text-sm">Explore</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow gap-2">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold">SDIT</h3>
                        <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">Elementary</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Building strong academic foundations and Islamic character.</p>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDOpZEbLfT_lS262HMInAY73_hpc0Xdy6bWNOQum83Tr-gvq5Cu90GzKM0VJR6OKiks7oD_r0TcrjJ1_8SX77jXWta-hjyugrV3wa5DpLSdUhbtG_HQRL1R-svAwGCdPqAY6zA4sx7ypTX7FuMJmYnnCtV5PKR6XTP6C3qRDVbGezlbJuyB2J8OvWCglk_ftuBUYH7Sw2s324-FNE0yaFbRgAJ2K_N3rKel9HW97K-L3gvYJdR11zAt1czGVB7zKU99GD3Sb-tnpB4");'>
                        <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold tracking-widest uppercase text-sm">Explore</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow gap-2">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold">SMP</h3>
                        <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">Junior High</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Developing independent thinkers and future leaders.</p>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBAvn7-fl2vBzvH4yCncCE76n2QYfGO3mWe_Yb7tz2Wx09pU6qXW39hebWHHStYZ_ohRFg266lxS0vwtO7Fr_wOEFZGyFO1FgxNFANAPKXPLfHALb4H3t8eBeut5bjPmqe9K9DgP8-OTqnOile_8p6ixdQl6sEWKwjAQ2_QCdcfYtlFuF90M5lWO1qGpNofR6oWAeQVUc6Ef91k6cM-UloSpM2uNOg6DXZyVF7WbAm4ud8PTKBnvgdYM9i3AT9UErJECPT-oRv03yc");'>
                        <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold tracking-widest uppercase text-sm">Explore</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow gap-2">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold">SMK</h3>
                        <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">Vocational High</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Specialized training for professional career readiness.</p>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAv28cCiOdbqcYL-mmCVFjab8kekRh8pN5dflFgKYcEsXa1VwQCLqJsaJW1U-pizoiAqUyczOWasVKty1lqC_OUWxRFgcp63BMDahU3ZeZSvJDDQCgBbfun6FPMrVpdICMOUw0G25FBQZr8yyTIzjbgW28GIkgdq_RCwP59d4nUaxGkJPOkWy0q__GyRLpBs7CrZD9gCDgwR6NoppYTmtWTXr1jtnHHheqjrFICDIakJVFnESAwGJujTJwpbUmX8YkzmnC2rklyO6U");'>
                        <div class="absolute inset-0 bg-[#FDB913]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold tracking-widest uppercase text-sm">Explore</span>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow gap-2">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold">PKBM</h3>
                        <p class="text-xs text-[#FDB913] font-bold uppercase tracking-wider">Community Learning</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 leading-relaxed">Flexible education opportunities for the community.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button class="flex items-center justify-center rounded-xl h-12 px-8 border-2 border-[#FDB913] text-[#FDB913] hover:bg-[#FDB913] hover:text-white text-base font-bold transition-all shadow-sm hover:shadow-md">
                    View All Admissions Info
                </button>
            </div>
        </div>
    </div>

    <!-- Core Values Section -->
    <div class="w-full py-20 flex justify-center bg-white dark:bg-slate-900">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
            <div class="flex flex-col gap-4 text-center items-center">
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black leading-tight">
                    Our Core Values
                </h2>
                <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group flex flex-col gap-6 rounded-2xl bg-slate-50 dark:bg-slate-800 p-8 hover:shadow-xl transition-all border border-slate-200 dark:border-slate-700 hover:border-[#FDB913]/40">
                    <div class="w-14 h-14 rounded-xl bg-[#FDB913]/10 flex items-center justify-center mb-2 group-hover:bg-[#FDB913]/20 transition-colors">
                        <span class="material-symbols-outlined text-[#FDB913] text-4xl">star</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-slate-900 dark:text-white text-2xl font-bold">Excellent</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            We strive for the highest standards in teaching and learning, encouraging critical thinking and lifelong curiosity.
                        </p>
                    </div>
                </div>
                <div class="group flex flex-col gap-6 rounded-2xl bg-slate-50 dark:bg-slate-800 p-8 hover:shadow-xl transition-all border border-slate-200 dark:border-slate-700 hover:border-[#FDB913]/40">
                    <div class="w-14 h-14 rounded-xl bg-[#FDB913]/10 flex items-center justify-center mb-2 group-hover:bg-[#FDB913]/20 transition-colors">
                        <span class="material-symbols-outlined text-[#FDB913] text-4xl">psychology</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-slate-900 dark:text-white text-2xl font-bold">Intellectual</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            Instilling integrity, respect, empathy, and responsibility to nurture smart minds with strong character.
                        </p>
                    </div>
                </div>
                <div class="group flex flex-col gap-6 rounded-2xl bg-slate-50 dark:bg-slate-800 p-8 hover:shadow-xl transition-all border border-slate-200 dark:border-slate-700 hover:border-[#FDB913]/40">
                    <div class="w-14 h-14 rounded-xl bg-[#FDB913]/10 flex items-center justify-center mb-2 group-hover:bg-[#FDB913]/20 transition-colors">
                        <span class="material-symbols-outlined text-[#FDB913] text-4xl">emoji_events</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-slate-900 dark:text-white text-2xl font-bold">School Talent</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            Unlocking the potential within every student, fostering creativity and specific talents for future success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Achievements Section -->
    <section class="w-full flex justify-center px-4 md:px-10 py-20 bg-slate-50 dark:bg-background-dark">
        <div class="max-w-[1300px] w-full">
            <div class="flex flex-col gap-2 mb-8">
                <h2 class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Jejak Langkah Prestasi</h2>
                <p class="text-slate-600 dark:text-slate-400">Raihan gemilang siswa-siswi kami di tingkat regional, nasional, hingga internasional.</p>
            </div>

            <!-- Unit Filters -->
            <div class="flex overflow-x-auto pb-4 gap-2 mb-8 no-scrollbar">
                <button class="px-5 py-2.5 rounded-lg bg-[#FDB913] text-white font-bold text-sm shadow-lg shadow-[#FDB913]/25 whitespace-nowrap">
                    Semua Unit
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    TK
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SD
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SMP
                </button>
                <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 whitespace-nowrap transition-colors">
                    SMA
                </button>
            </div>

            <!-- Achievement Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-48 w-full overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMoKQDLTmg6xKFXbSrLFz7rp-SYIrHHyddAENCRlAkg13ezprAoIBT1p6IsmxbLIRC5OOsn1u6YrsolTYU_G1Q69-JFhSyFl3d9eEu8yVW-qhQo_zVn0TolqqQm6Y2RuROkHLcJ8Qasfxie2apnRyfGX9ozKesrHT-RDAGJcnVWpenCGPphZHhMzeToGP6G9pnMeZ7a1aWl0X9qKXWOyFk2aiXZB2TiQTgTwkEF2eIsZLUjyjyJKcy6SHqRkfErcHKEJqoh4RPcuA');"></div>
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-blue-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Akademik</span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913] tracking-wide">SMA PUTRA PAKUAN</span>
                            <span class="text-xs text-slate-500 dark:text-slate-500">2023</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2">Gold Medal National Science Olympiad</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                            Ananda Rizky Pratama berhasil menyisihkan 500 peserta dari seluruh provinsi dalam bidang Fisika.
                        </p>
                    </div>
                </div>

                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-48 w-full overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBynr7MwbSxyHgHRkF7E-BFe_nSxgp86ronlWXDTZPmZwtsgSuQaIrhcDngZom6U6joyf3J3NlNN2c7r9-IGgU_XkopMIEGWimGpu5KQy1VfoKHkhrxwU12jDi1CImuA6rbfHGIEQZ1XZaxl6XSvXXrfOvw443qMhGyShL6FCPGi1BlQTu31NHhAaA4B-zmuVOJ_MTdjFu2FvI1erxOoSfj9HPcYlMi9Ro_r46pOEANapQPAYH5TI2JMrStpgodjKq4qfBqiBb9Ffo');"></div>
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-orange-500/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Olahraga</span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913] tracking-wide">SMP PUTRA PAKUAN</span>
                            <span class="text-xs text-slate-500 dark:text-slate-500">2023</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2">Juara 1 DBL West Java Series</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                            Tim Basket Putra SMP mencetak sejarah baru dengan memenangkan kejuaraan tingkat provinsi.
                        </p>
                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-500">
                                Tim
                            </div>
                            <span class="text-xs font-medium text-slate-900 dark:text-slate-200">Tim Basket Putra</span>
                        </div>
                    </div>
                </div>

                <div class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-48 w-full overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDXUaTXdo_8kzolGV-WKNjLjxn-HFS0jEEKNjOI5d3yg4u3pj4iWxLNFXTUJITMN2O886k5vOyVODSVDqeQGIkK3pxBBk8NvDSgvIDn8Oh-wMBoiocsriKYRTVcbfnhOU2gTBOVqgcUf4OQuubWOPM8EzIMeHSN87RmfQtHbZ2nzn3dR704coqWkFg7OKT92_SYovximttWJ0Po33GDUbDykrDweIBhvmb9z3zq2vgtc9tWgBvo0-E6F8OipQIZiI1jBKls2C9MMkc');"></div>
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-purple-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Seni & Budaya</span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913] tracking-wide">SD PUTRA PAKUAN</span>
                            <span class="text-xs text-slate-500 dark:text-slate-500">2022</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2">Best Cultural Performance</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                            Penghargaan khusus dalam Festival Seni Pelajar Nasional untuk penampilan tari tradisional.
                        </p>
                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 overflow-hidden">
                                <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCCR7dH2XpyZ7rrHOKNBFNzYsAE4ORD9uTFm3YZDWo40NrWHrDTnGyNFTE9y_7L5CLJMuGtZ9VtgfTpjNR4KmyKCbWR1sdgoVyJkoE9w_BJf5v8cCwXajWlZk4m7oqQFzykFUwS7bEdskrNxfWoHjmnaKB9sXTVzRglzdykvaA0EoqYTNmK08-dK_FACKX3cxAchNdnRiU_A5wA4ecGpvSfLUdsqUkPCVqAQVsYiWak99lpiLsa0amNUjKSgxHlJdHD7X20mGZuT4I");'></div>
                            </div>
                            <span class="text-xs font-medium text-slate-900 dark:text-slate-200">Sarah Amalia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-10">
                <button class="px-6 py-3 rounded-xl border-2 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white font-bold text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Lihat Arsip Prestasi
                </button>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <div class="w-full py-20 flex justify-center bg-white dark:bg-background-dark">
        <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-10">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                <h2 class="text-slate-900 dark:text-white text-2xl md:text-3xl font-black tracking-tight">Latest News</h2>
                <a class="text-[#FDB913] font-bold hover:text-[#E5A800] text-sm flex items-center gap-2 transition-colors" href="#">
                    View All <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <a class="group flex flex-col gap-4" href="#">
                    <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBAvn7-fl2vBzvH4yCncCE76n2QYfGO3mWe_Yb7tz2Wx09pU6qXW39hebWHHStYZ_ohRFg266lxS0vwtO7Fr_wOEFZGyFO1FgxNFANAPKXPLfHALb4H3t8eBeut5bjPmqe9K9DgP8-OTqnOile_8p6ixdQl6sEWKwjAQ2_QCdcfYtlFuF90M5lWO1qGpNofR6oWAeQVUc6Ef91k6cM-UloSpM2uNOg6DXZyVF7WbAm4ud8PTKBnvgdYM9i3AT9UErJECPT-oRv03yc");'></div>
                        <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">Events</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">Annual Science Fair Registration Open</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Oct 24, 2023</p>
                    </div>
                </a>
                <a class="group flex flex-col gap-4" href="#">
                    <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC9B4p5fArLZhkFP6YPZSg9obA-LdnEVgGXtr9ByqPH7oAzOZdbyu6v0OGo3Lo33kRuLmaJtQn18T8FijSkc0AbeidsPuOYTYcHY6Q8LPnYVa3GYQb6KzQfadLFhlrLle8odiKyZSI35UxvVZvy1NX86vN1ESZs1yLr5D6wzihNK_A8efKwZNZ1BqsjaO8Gp8wAHDmtfbdS5xLc8Gh4qZaZIYUxL4uA1rlnBJwIRy32rSrW2Nivajz-i06HSHjul_H2SzQV2FE_qEA");'></div>
                        <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">Academic</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">Parent-Teacher Conference Schedule</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Oct 20, 2023</p>
                    </div>
                </a>
                <a class="group flex flex-col gap-4" href="#">
                    <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAdj21vxW_w5PRpTXr4FKR0KXwhYGbFItaSBW4LemP4jHHS7O7ZqbsJM8ucvQW1VLr3PEDNysxC-_G4lvCtkZlInrUTd0WzREyUKDtzPQ2d4mJImmJY8XtRMZ0MAKaIf8hmotfRsCRudP23kRp1GVbkNGP-7TWk4B8Rgg0IP2FSEEbOLqttD0VryO0-E0PU8esu2qK-XXRZtrIEHUY5al7Kw7TepZch42QpJynzByd2NVn1Ltv79U9ABi6F4ISgGZTmEigJWL_HQ2s");'></div>
                        <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">Sports</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">Basketball Team Wins Regional Finals</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Oct 18, 2023</p>
                    </div>
                </a>
                <a class="group flex flex-col gap-4" href="#">
                    <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAv28cCiOdbqcYL-mmCVFjab8kekRh8pN5dflFgKYcEsXa1VwQCLqJsaJW1U-pizoiAqUyczOWasVKty1lqC_OUWxRFgcp63BMDahU3ZeZSvJDDQCgBbfun6FPMrVpdICMOUw0G25FBQZr8yyTIzjbgW28GIkgdq_RCwP59d4nUaxGkJPOkWy0q__GyRLpBs7CrZD9gCDgwR6NoppYTmtWTXr1jtnHHheqjrFICDIakJVFnESAwGJujTJwpbUmX8YkzmnC2rklyO6U");'></div>
                        <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">Arts</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">Student Art Exhibition Next Week</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Oct 15, 2023</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
