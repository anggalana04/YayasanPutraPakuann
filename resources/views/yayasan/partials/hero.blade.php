<!-- Hero Section -->
<div class="w-full relative overflow-hidden">
    <div class="w-full min-h-[700px] md:min-h-[600px] relative flex items-center">
        <!-- Background Video with Overlay -->
        <div class="absolute inset-0 overflow-hidden">
            <video id="hero-video" class="absolute inset-0 w-full h-full object-cover scale-[1.45]" muted loop playsinline preload="auto">
                <source src="{{ asset('videos/Pakuan (1) (1).mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung video.
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
                            {{ $heroTitle }}
                        </h1>

                        <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl font-medium">
                            {{ $heroSubtitle }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start items-center">
                        {{-- <a href="{{ route('daftar') }}" class="group flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-[#FDB913] hover:bg-[#E5A800] text-white text-base font-bold transition-all transform hover:scale-105 shadow-xl shadow-[#FDB913]/30">
                            <span>{{ $heroCta }}</span>
                            <span class="material-symbols-outlined text-xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                        <button class="flex items-center gap-2 cursor-pointer justify-center rounded-full h-14 px-8 bg-white/10 backdrop-blur-sm border-2 border-white/20 hover:bg-white hover:text-slate-900 text-white text-base font-bold transition-all shadow-lg">
                            <span class="material-symbols-outlined text-xl">play_circle</span>
                            <span>{{ $heroCtaSecondary }}</span>
                        </button> --}}
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
                                    <img src="{{ asset('images/logo-yayasan.png') }}" alt="Logo Yayasan Putra Pakuan" class="w-full h-full object-contain">
                                </div>

                                <div class="flex flex-col gap-3">
                                    <h2 class="text-slate-900 font-black text-3xl md:text-4xl tracking-wider">
                                        PAXIST
                                    </h2>
                                    <div class="w-16 h-1 bg-[#FDB913] rounded-full mx-auto"></div>
                                    <p class="text-slate-700 text-lg md:text-xl font-semibold leading-relaxed">
                                        Putra Pakuan Excellent, Intellectual, School Talent
                                    </p>
                                </div>

                                <div class="flex flex-col gap-3 w-full mt-4">
                                    <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                        <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                        <span class="text-slate-900 font-medium">Keunggulan dalam Pendidikan</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                        <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                        <span class="text-slate-900 font-medium">Pengembangan Karakter</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-slate-50 rounded-lg p-3 hover:bg-[#FDB913]/5 transition-colors">
                                        <span class="material-symbols-outlined text-[#FDB913] text-2xl">check_circle</span>
                                        <span class="text-slate-900 font-medium">Pengembangan Bakat</span>
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

<script>
    // Lazy-load hero video after page completes initial render
    (function() {
        const video = document.getElementById('hero-video');
        if (!video) return;

        // Play as soon as the browser has buffered enough data
        function tryPlay() {
            video.play().catch(() => {});
        }
        if (video.readyState >= 3) {
            tryPlay();
        } else {
            video.addEventListener('canplay', tryPlay, { once: true });
        }
    })();
</script>
