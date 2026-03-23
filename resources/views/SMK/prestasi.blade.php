@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="w-full max-w-[1200px] mx-auto px-4 pt-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
            <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
            <span>/</span>
            <span class="text-slate-900 dark:text-white">Prestasi</span>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative w-full mb-8">
        <div class="relative max-w-[1280px] mx-auto px-4">
            <div class="relative overflow-hidden rounded-2xl bg-slate-900 min-h-[300px] md:min-h-[450px] flex items-end">
                <!-- Background -->
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/50 to-transparent z-10"></div>
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCX-E25y5AM7fmO__biRhI6ur8AGqP1M8vcSZpNknzz_7g-GuwWp9evdpploJlKW4KfuP7oNc0GjrOdOz7aQ7PYdvpeta-zyns0QwfzjGDfmzESv6WqbIgD5dw5pjJzlSETuKaksTkNfTFAFnZ3_H8IJkNNrn5nxJOiiTPWqsDm-dPIcl6yfaOVosc0iuq2Xh1uVHku8-X3axiep_7EN-2dSntog15sRWrw9crrBmPTkMi4rreKAn0GRmPre8m77nR8xid69zYhubw');"></div>
                </div>
                <!-- Content -->
                <div class="relative z-20 p-6 md:p-10 max-w-3xl">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 rounded-full bg-[#FDB913] text-slate-900 text-xs font-bold">Foundation Hub</span>
                        <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-bold backdrop-blur-sm">Since 1985</span>
                    </div>
                    <h1 class="text-white text-3xl md:text-5xl font-black leading-tight mb-3">
                        Komitmen Mutu & <span class="text-[#FDB913]">Prestasi</span>
                    </h1>
                    <p class="text-slate-200 text-base md:text-lg mb-6 max-w-2xl">
                        Membangun generasi unggul dengan standar pendidikan tinggi dan budaya pencapaian gemilang
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-2 rounded-lg border border-white/20">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">school</span>
                            <span class="text-white font-bold text-sm">4 Unit</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-2 rounded-lg border border-white/20">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">verified</span>
                            <span class="text-white font-bold text-sm">Akreditasi A</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-2 rounded-lg border border-white/20">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">emoji_events</span>
                            <span class="text-white font-bold text-sm">150+ Award</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-[1200px] mx-auto px-4 pb-12">

        <!-- Accreditations -->
        <section class="mb-12">
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-2">
                    Akreditasi Resmi
                </h2>
                <p class="text-slate-600 dark:text-slate-400">
                    Pengakuan resmi BAN-S/M untuk standar pendidikan berkualitas
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="relative aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBI6JrRFyy5Zw9d6Ly55AombP_8XVbD3xHdD0991VPBEJwM6KZkY4ati8MSNgF5jlqHzQl5x9oMnmrXWBcNiPhN9LAHwXYOHYUP_G4JdH2n09_yQ1d4yUDEaWC7kyNAOIxEUP1qDbx8ZEdLPWQbBdRFO_DHh4uEcXppbj2gSdLv_j57ksQ0ZOJwDepKd8lAH2GGhh0owSGWPj8g3rHOAi_6C5T_P9nhyRn_MFbrhhhUO8sIWeMnx_6mWtp3Va2Gb9FGBn76_Hqt1hM");'>
                        <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Unggul</div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">verified_user</span>
                            <p class="text-slate-900 dark:text-white font-bold">SD Putra Pakuan</p>
                        </div>
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium">Akreditasi A (98)</p>
                        <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Hingga: Des 2028</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="relative aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAXKIOjJQbMK_ntIFv8mWMHdYLfHefKuO3qvR1ZpHk2lE6NS5wjmor3vTxqbY4eu2ZiSenD3DoRPn6TdPaI1T-Hcpnb6DniGd6HrZgs2h6nDuHt2lJZKG_6q23hQKDziFHaueT13bZyACEITBu4T5SJDopkfIZUo0nwLwT8H3RI-mMTxmkzAAdDYFzXfttUH-d6tNMDgt9WejaVNdH2JIqYEjFTqnu-FKG5zmfjn79SaM5n7rPsz_Yly3ftWt5lv7qkoZEUEGt61dI");'>
                        <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Unggul</div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">verified_user</span>
                            <p class="text-slate-900 dark:text-white font-bold">SMP Putra Pakuan</p>
                        </div>
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium">Akreditasi A (96)</p>
                        <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Hingga: Nov 2027</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="relative aspect-video w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLswS83n0Qa6vynGHzMjXRGc46Zfz9iaLuBztvfdNibEwFRK1zeJxN2dfj5Gj9tWJ0uP7byh9X_3R6GcR_jSoTjQWjrJ2sl8ItQRw8_VpUDFGYAEmvV453JPzMr9t7slk9_MwZv1WPDBqiISugHFfNw-OWoweMocORVF0Ph0IrGeGxxYo0ELiiH2YQnti2GdAnvjD45Ry5XHRhGBfyljqcqLcKREaBQpdvu-BIRir9-p4h_5gm4hJejfrEyPLflccPbdK6gnmGFSE");'>
                        <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Unggul</div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-[#FDB913] text-lg">verified_user</span>
                            <p class="text-slate-900 dark:text-white font-bold">SMA Putra Pakuan</p>
                        </div>
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium">Akreditasi A (97)</p>
                        <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Hingga: Jul 2029</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 md:p-12 mb-12 border border-slate-200 dark:border-slate-700">
            <div class="max-w-3xl mx-auto text-center">
                <span class="material-symbols-outlined text-4xl text-[#FDB913]/30 mb-4 block">format_quote</span>
                <p class="text-xl md:text-2xl font-medium text-slate-900 dark:text-white mb-6 leading-relaxed">
                    "Konsistensi Yayasan Putra Pakuan dalam menjaga mutu pendidikan terlihat jelas dari raihan akreditasi A yang dipertahankan selama lebih dari 15 tahun."
                </p>
                <div class="flex flex-col items-center gap-3">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-200">
                        <div class="w-full h-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBqDDGPO35NPdppV8uaeiwv9snteChBi7iJaZVsJHZjc87O_1febl9DUIpoqu8qR5PzMW4VZReleJe8y0-TEHjCMk_CONy04NdOo0HwG-MDjl58t7tsqj_ysia_inl179K3TZYlc5W-8tiWnBUyMG1sH63AvNT3cTttegpJCpJ_-vHBYLsfFrF-LgF-x06uQrIZlmi9LgpO9cARltPNab19S2gLxQ9TBofYYWevb9e6R1VBPXPFbVFnsaMgduzi6J1-hCxTA-Knycc");'></div>
                    </div>
                    <div>
                        <p class="text-slate-900 dark:text-white font-bold text-sm">Dr. Hendra Gunawan, M.Pd</p>
                        <p class="text-slate-600 dark:text-slate-400 text-xs">Assesor BAN</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievements -->
        <section class="mb-12">
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-2">Prestasi Siswa</h2>
                <p class="text-slate-600 dark:text-slate-400">Raihan gemilang di tingkat regional, nasional, dan internasional</p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex gap-2 overflow-x-auto pb-3 mb-6 -mx-4 px-4">
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-[#FDB913] text-white text-sm font-bold shadow-sm">
                    Semua
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    TK
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    SD
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    SMP
                </button>
                <button class="flex-shrink-0 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    SMA
                </button>
            </div>

            <!-- Achievement Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="relative h-48 w-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMoKQDLTmg6xKFXbSrLFz7rp-SYIrHHyddAENCRlAkg13ezprAoIBT1p6IsmxbLIRC5OOsn1u6YrsolTYU_G1Q69-JFhSyFl3d9eEu8yVW-qhQo_zVn0TolqqQm6Y2RuROkHLcJ8Qasfxie2apnRyfGX9ozKesrHT-RDAGJcnVWpenCGPphZHhMzeToGP6G9pnMeZ7a1aWl0X9qKXWOyFk2aiXZB2TiQTgTwkEF2eIsZLUjyjyJKcy6SHqRkfErcHKEJqoh4RPcuA');">
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-600/90 text-white text-xs font-bold px-2 py-1 rounded backdrop-blur-sm">Akademik</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913]">SMA</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">2023</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Gold Medal Science Olympiad</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-2">
                            Rizky Pratama juara nasional bidang Fisika
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="relative h-48 w-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBynr7MwbSxyHgHRkF7E-BFe_nSxgp86ronlWXDTZPmZwtsgSuQaIrhcDngZom6U6joyf3J3NlNN2c7r9-IGgU_XkopMIEGWimGpu5KQy1VfoKHkhrxwU12jDi1CImuA6rbfHGIEQZ1XZaxl6XSvXXrfOvw443qMhGyShL6FCPGi1BlQTu31NHhAaA4B-zmuVOJ_MTdjFu2FvI1erxOoSfj9HPcYlMi9Ro_r46pOEANapQPAYH5TI2JMrStpgodjKq4qfBqiBb9Ffo');">
                        <div class="absolute top-3 left-3">
                            <span class="bg-orange-500/90 text-white text-xs font-bold px-2 py-1 rounded backdrop-blur-sm">Olahraga</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913]">SMP</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">2023</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Juara 1 DBL West Java</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-2">
                            Tim basket juara kejuaraan provinsi
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="relative h-48 w-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDXUaTXdo_8kzolGV-WKNjLjxn-HFS0jEEKNjOI5d3yg4u3pj4iWxLNFXTUJITMN2O886k5vOyVODSVDqeQGIkK3pxBBk8NvDSgvIDn8Oh-wMBoiocsriKYRTVcbfnhOU2gTBOVqgcUf4OQuubWOPM8EzIMeHSN87RmfQtHbZ2nzn3dR704coqWkFg7OKT92_SYovximttWJ0Po33GDUbDykrDweIBhvmb9z3zq2vgtc9tWgBvo0-E6F8OipQIZiI1jBKls2C9MMkc');">
                        <div class="absolute top-3 left-3">
                            <span class="bg-purple-600/90 text-white text-xs font-bold px-2 py-1 rounded backdrop-blur-sm">Seni</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913]">SD</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">2022</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Best Cultural Performance</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-2">
                            Tari tradisional terbaik nasional
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <button class="px-6 py-3 rounded-xl border-2 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Lihat Arsip Prestasi
                </button>
            </div>
        </section>

        <!-- Timeline -->
        <section>
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-6 md:p-10 border border-slate-200 dark:border-slate-700">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2 bg-[#FDB913]/10 rounded-lg">
                        <span class="material-symbols-outlined text-[#FDB913]">history_edu</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Milestone Penting</h2>
                </div>

                <div class="relative pl-8 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200 dark:before:bg-slate-700">
                    <!-- Item 1 -->
                    <div class="relative">
                        <div class="absolute -left-[22px] top-1 w-3 h-3 rounded-full bg-[#FDB913] border-4 border-white dark:border-slate-800"></div>
                        <div>
                            <span class="text-[#FDB913] font-bold text-lg">2023</span>
                            <h4 class="text-slate-900 dark:text-white font-bold mt-1">Sekolah Adiwiyata Nasional</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Penghargaan sekolah berbudaya lingkungan</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="relative">
                        <div class="absolute -left-[22px] top-1 w-3 h-3 rounded-full bg-slate-300 dark:bg-slate-600 border-4 border-white dark:border-slate-800"></div>
                        <div>
                            <span class="text-slate-500 dark:text-slate-400 font-bold text-lg">2018</span>
                            <h4 class="text-slate-900 dark:text-white font-bold mt-1">Gedung Laboratorium Terpadu</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Fasilitas riset berbasis STEM</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="relative">
                        <div class="absolute -left-[22px] top-1 w-3 h-3 rounded-full bg-slate-300 dark:bg-slate-600 border-4 border-white dark:border-slate-800"></div>
                        <div>
                            <span class="text-slate-500 dark:text-slate-400 font-bold text-lg">2010</span>
                            <h4 class="text-slate-900 dark:text-white font-bold mt-1">Akreditasi A Pertama</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">SD & SMP meraih standar tertinggi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
