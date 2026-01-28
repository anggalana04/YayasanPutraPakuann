@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-text-muted-light dark:text-text-muted-dark mb-4">
        <a class="hover:text-primary transition-colors" href="/">Beranda</a>
        <span>/</span>
        <span class="text-primary">Prestasi</span>
    </div>
</div>
<!-- Hero Section -->
<section class="w-full max-w-[1280px] px-4 md:px-10 py-6 md:py-10">
    <div class="relative overflow-hidden rounded-2xl md:rounded-[2rem] bg-slate-900 min-h-[480px] flex items-end">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 hover:scale-105" data-alt="Students celebrating with trophies on a stage" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCX-E25y5AM7fmO__biRhI6ur8AGqP1M8vcSZpNknzz_7g-GuwWp9evdpploJlKW4KfuP7oNc0GjrOdOz7aQ7PYdvpeta-zyns0QwfzjGDfmzESv6WqbIgD5dw5pjJzlSETuKaksTkNfTFAFnZ3_H8IJkNNrn5nxJOiiTPWqsDm-dPIcl6yfaOVosc0iuq2Xh1uVHku8-X3axiep_7EN-2dSntog15sRWrw9crrBmPTkMi4rreKAn0GRmPre8m77nR8xid69zYhubw');">
            </div>
        </div>
        <!-- Hero Content -->
        <div class="relative z-20 flex flex-col gap-6 p-6 md:p-12 max-w-3xl">
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-primary/90 text-slate-900 text-xs font-bold uppercase tracking-wider backdrop-blur-sm">Foundation Hub</span>
                <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-bold uppercase tracking-wider backdrop-blur-sm">Since 1985</span>
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-4xl md:text-6xl font-black leading-tight tracking-tight">
                    Komitmen Mutu &amp; <span class="text-primary">Prestasi</span>
                </h1>
                <p class="text-slate-200 text-base md:text-lg font-normal leading-relaxed max-w-xl">
                    Membangun generasi unggul melalui standar pendidikan tinggi, akreditasi terpercaya, dan budaya pencapaian yang gemilang di setiap jenjang.
                </p>
            </div>
            <div class="flex flex-wrap gap-4 mt-2">
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-lg border border-white/10">
                    <span class="material-symbols-outlined text-secondary">school</span>
                    <span class="text-white font-bold text-sm">4 Unit Sekolah</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-lg border border-white/10">
                    <span class="material-symbols-outlined text-secondary">verified</span>
                    <span class="text-white font-bold text-sm">Akreditasi A</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-lg border border-white/10">
                    <span class="material-symbols-outlined text-secondary">emoji_events</span>
                    <span class="text-white font-bold text-sm">150+ Penghargaan</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Accreditations Section -->
<section class="w-full max-w-[960px] px-4 md:px-10 py-10">
    <div class="flex flex-col md:flex-row gap-8 items-start md:items-end justify-between mb-8 border-b border-slate-200 dark:border-white/10 pb-4">
        <div class="max-w-2xl">
            <h2 class="text-text-main dark:text-white text-3xl font-bold leading-tight mb-3">
                Standar Pendidikan Terakreditasi
            </h2>
            <p class="text-text-muted dark:text-slate-400 text-base leading-relaxed">
                Pengakuan resmi dari BAN-S/M yang menjamin kualitas kurikulum, fasilitas, dan tenaga pengajar kami.
            </p>
        </div>
        <button class="text-secondary font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all whitespace-nowrap">
            Lihat Laporan Mutu <span class="material-symbols-outlined text-base">arrow_forward</span>
        </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="group flex flex-col gap-4 bg-white dark:bg-white/5 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-white/5 hover:shadow-md transition-all">
            <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-slate-100">
                <div class="w-full h-full bg-cover bg-center" data-alt="Official accreditation certificate document for Elementary School" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBI6JrRFyy5Zw9d6Ly55AombP_8XVbD3xHdD0991VPBEJwM6KZkY4ati8MSNgF5jlqHzQl5x9oMnmrXWBcNiPhN9LAHwXYOHYUP_G4JdH2n09_yQ1d4yUDEaWC7kyNAOIxEUP1qDbx8ZEdLPWQbBdRFO_DHh4uEcXppbj2gSdLv_j57ksQ0ZOJwDepKd8lAH2GGhh0owSGWPj8g3rHOAi_6C5T_P9nhyRn_MFbrhhhUO8sIWeMnx_6mWtp3Va2Gb9FGBn76_Hqt1hM");'></div>
                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow-sm">Unggul</div>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-primary text-lg">verified_user</span>
                    <p class="text-text-main dark:text-white text-lg font-bold">SD Putra Pakuan</p>
                </div>
                <p class="text-text-main dark:text-slate-200 text-sm font-medium">Akreditasi A (Nilai 98)</p>
                <p class="text-text-muted dark:text-slate-500 text-xs mt-1">Berlaku hingga: Desember 2028</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="group flex flex-col gap-4 bg-white dark:bg-white/5 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-white/5 hover:shadow-md transition-all">
            <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-slate-100">
                <div class="w-full h-full bg-cover bg-center" data-alt="Official accreditation certificate document for Junior High School" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAXKIOjJQbMK_ntIFv8mWMHdYLfHefKuO3qvR1ZpHk2lE6NS5wjmor3vTxqbY4eu2ZiSenD3DoRPn6TdPaI1T-Hcpnb6DniGd6HrZgs2h6nDuHt2lJZKG_6q23hQKDziFHaueT13bZyACEITBu4T5SJDopkfIZUo0nwLwT8H3RI-mMTxmkzAAdDYFzXfttUH-d6tNMDgt9WejaVNdH2JIqYEjFTqnu-FKG5zmfjn79SaM5n7rPsz_Yly3ftWt5lv7qkoZEUEGt61dI");'></div>
                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow-sm">Unggul</div>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-primary text-lg">verified_user</span>
                    <p class="text-text-main dark:text-white text-lg font-bold">SMP Putra Pakuan</p>
                </div>
                <p class="text-text-main dark:text-slate-200 text-sm font-medium">Akreditasi A (Nilai 96)</p>
                <p class="text-text-muted dark:text-slate-500 text-xs mt-1">Berlaku hingga: November 2027</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="group flex flex-col gap-4 bg-white dark:bg-white/5 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-white/5 hover:shadow-md transition-all">
            <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-slate-100">
                <div class="w-full h-full bg-cover bg-center" data-alt="Official accreditation certificate document for High School" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLswS83n0Qa6vynGHzMjXRGc46Zfz9iaLuBztvfdNibEwFRK1zeJxN2dfj5Gj9tWJ0uP7byh9X_3R6GcR_jSoTjQWjrJ2sl8ItQRw8_VpUDFGYAEmvV453JPzMr9t7slk9_MwZv1WPDBqiISugHFfNw-OWoweMocORVF0Ph0IrGeGxxYo0ELiiH2YQnti2GdAnvjD45Fy5XHRhGBfyljqcqLcKREaBQpdvu-BIRir9-p4h_5gm4hJejfrEyPLflccPbdK6gnmGFSE");'></div>
                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow-sm">Unggul</div>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-primary text-lg">verified_user</span>
                    <p class="text-text-main dark:text-white text-lg font-bold">SMA Putra Pakuan</p>
                </div>
                <p class="text-text-main dark:text-slate-200 text-sm font-medium">Akreditasi A (Nilai 97)</p>
                <p class="text-text-muted dark:text-slate-500 text-xs mt-1">Berlaku hingga: Juli 2029</p>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial / Trust Builder -->
<section class="w-full bg-primary/5 dark:bg-white/5 py-16 px-4">
    <div class="max-w-[800px] mx-auto text-center flex flex-col gap-6">
        <span class="material-symbols-outlined text-4xl text-primary/40">format_quote</span>
        <h3 class="text-2xl md:text-3xl font-medium text-text-main dark:text-white leading-relaxed">
            "Konsistensi Yayasan Putra Pakuan dalam menjaga mutu pendidikan terlihat jelas dari raihan akreditasi A yang dipertahankan selama lebih dari 15 tahun berturut-turut."
        </h3>
        <div class="flex flex-col items-center gap-2">
            <div class="size-12 rounded-full bg-slate-300 overflow-hidden">
                <div class="w-full h-full bg-cover bg-center" data-alt="Portrait of Dr. Hendra Gunawan" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBqDDGPO35NPdppV8uaeiwv9snteChBi7iJaZVsJHZjc87O_1febl9DUIpoqu8qR5PzMW4VZReleJe8y0-TEHjCMk_CONy04NdOo0HwG-MDjl58t7tsqj_ysia_inl179K3TZYlc5W-8tiWnBUyMG1sH63AvNT3cTttegpJCpJ_-vHBYLsfFrF-LgF-x06uQrIZlmi9LgpO9cARltPNab19S2gLxQ9TBofYYWevb9e6R1VBPXPFbVFnsaMgduzi6J1-hCxTA-Knycc");'></div>
            </div>
            <div class="text-center">
                <p class="text-text-main dark:text-white font-bold text-sm">Dr. Hendra Gunawan, M.Pd</p>
                <p class="text-text-muted dark:text-slate-400 text-xs">Assesor Badan Akreditasi Nasional</p>
            </div>
        </div>
    </div>
</section>
<!-- Achievements & Victories -->
<section class="w-full max-w-[960px] px-4 md:px-10 py-16">
    <div class="flex flex-col gap-2 mb-8">
        <h2 class="text-text-main dark:text-white text-3xl font-bold leading-tight tracking-tight">Jejak Langkah Prestasi</h2>
        <p class="text-text-muted dark:text-slate-400">Raihan gemilang siswa-siswi kami di tingkat regional, nasional, hingga internasional.</p>
    </div>
    <!-- Unit Filters (Tabs) -->
    <div class="flex overflow-x-auto pb-4 gap-2 mb-8 no-scrollbar">
        <button class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 whitespace-nowrap">
            Semua Unit
        </button>
        <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">
            TK
        </button>
        <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">
            SD
        </button>
        <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">
            SMP
        </button>
        <button class="px-5 py-2.5 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 font-medium text-sm hover:bg-slate-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">
            SMA
        </button>
    </div>
    <!-- Featured Victory Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Victory 1 -->
        <div class="group flex flex-col bg-white dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-48 w-full overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" data-alt="Student holding a gold medal in science olympiad" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMoKQDLTmg6xKFXbSrLFz7rp-SYIrHHyddAENCRlAkg13ezprAoIBT1p6IsmxbLIRC5OOsn1u6YrsolTYU_G1Q69-JFhSyFl3d9eEu8yVW-qhQo_zVn0TolqqQm6Y2RuROkHLcJ8Qasfxie2apnRyfGX9ozKesrHT-RDAGJcnVWpenCGPphZHhMzeToGP6G9pnMeZ7a1aWl0X9qKXWOyFk2aiXZB2TiQTgTwkEF2eIsZLUjyjyJKcy6SHqRkfErcHKEJqoh4RPcuA');">
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="bg-blue-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Akademik</span>
                </div>
            </div>
            <div class="flex flex-col flex-1 p-5">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-primary tracking-wide">SMA PUTRA PAKUAN</span>
                    <span class="text-xs text-text-muted dark:text-slate-500">2023</span>
                </div>
                <h3 class="text-lg font-bold text-text-main dark:text-white leading-tight mb-2">Gold Medal National Science Olympiad</h3>
                <p class="text-sm text-text-muted dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                    Ananda Rizky Pratama berhasil menyisihkan 500 peserta dari seluruh provinsi dalam bidang Fisika.
                </p>
                {{-- <div class="pt-4 border-t border-slate-100 dark:border-white/10 flex items-center gap-3">
                    <div class="size-8 rounded-full bg-slate-200 overflow-hidden">
                        <div class="w-full h-full bg-cover bg-center" data-alt="Portrait of student Rizky" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD8ndN7Hrdx6KYp83M42vOhAc9jGGbdc-DPmi3KkQzD6JQb9H2L-oDiXxRgZFKB3sZal9m5m3FrM89RUPrZS02IDlvKZ1_7HhUEaEYibnvEI4CEBFsxViAbeIMsqjagCqn0Ams_DaEF3-kpv5Wb0SuWOTBy3KGGTZaj1JGdBoeLhwOlC_l0M9ZG0SrCuFPXVN45xu93BhEpcoW8U5p_dxQicN4BsR7msIkrvNxI_rlnVSzSwEYCDMj8HDQfY0KyikMghHfniban0Fg");'></div>
                    </div>
                    <span class="text-xs font-medium text-text-main dark:text-slate-200">Rizky Pratama</span>
                </div> --}}
            </div>
        </div>
        <!-- Victory 2 -->
        <div class="group flex flex-col bg-white dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-48 w-full overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" data-alt="Basketball team holding trophy" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBynr7MwbSxyHgHRkF7E-BFe_nSxgp86ronlWXDTZPmZwtsgSuQaIrhcDngZom6U6joyf3J3NlNN2c7r9-IGgU_XkopMIEGWimGpu5KQy1VfoKHkhrxwU12jDi1CImuA6rbfHGIEQZ1XZaxl6XSvXXrfOvw443qMhGyShL6FCPGi1BlQTu31NHhAaA4B-zmuVOJ_MTdjFu2FvI1erxOoSfj9HPcYlMi9Ro_r46pOEANapQPAYH5TI2JMrStpgodjKq4qfBqiBb9Ffo');">
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="bg-orange-500/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Olahraga</span>
                </div>
            </div>
            <div class="flex flex-col flex-1 p-5">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-primary tracking-wide">SMP PUTRA PAKUAN</span>
                    <span class="text-xs text-text-muted dark:text-slate-500">2023</span>
                </div>
                <h3 class="text-lg font-bold text-text-main dark:text-white leading-tight mb-2">Juara 1 DBL West Java Series</h3>
                <p class="text-sm text-text-muted dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                    Tim Basket Putra SMP mencetak sejarah baru dengan memenangkan kejuaraan tingkat provinsi.
                </p>
                <div class="pt-4 border-t border-slate-100 dark:border-white/10 flex items-center gap-3">
                    <div class="size-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500">
                        Tim
                    </div>
                    <span class="text-xs font-medium text-text-main dark:text-slate-200">Tim Basket Putra</span>
                </div>
            </div>
        </div>
        <!-- Victory 3 -->
        <div class="group flex flex-col bg-white dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-48 w-full overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" data-alt="Student performing traditional dance on stage" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDXUaTXdo_8kzolGV-WKNjLjxn-HFS0jEEKNjOI5d3yg4u3pj4iWxLNFXTUJITMN2O886k5vOyVODSVDqeQGIkK3pxBBk8NvDSgvIDn8Oh-wMBoiocsriKYRTVcbfnhOU2gTBOVqgcUf4OQuubWOPM8EzIMeHSN87RmfQtHbZ2nzn3dR704coqWkFg7OKT92_SYovximttWJ0Po33GDUbDykrDweIBhvmb9z3zq2vgtc9tWgBvo0-E6F8OipQIZiI1jBKls2C9MMkc');">
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="bg-purple-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">Seni &amp; Budaya</span>
                </div>
            </div>
            <div class="flex flex-col flex-1 p-5">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-primary tracking-wide">SD PUTRA PAKUAN</span>
                    <span class="text-xs text-text-muted dark:text-slate-500">2022</span>
                </div>
                <h3 class="text-lg font-bold text-text-main dark:text-white leading-tight mb-2">Best Cultural Performance</h3>
                <p class="text-sm text-text-muted dark:text-slate-400 line-clamp-2 mb-4 flex-1">
                    Penghargaan khusus dalam Festival Seni Pelajar Nasional untuk penampilan tari tradisional.
                </p>
                <div class="pt-4 border-t border-slate-100 dark:border-white/10 flex items-center gap-3">
                    <div class="size-8 rounded-full bg-slate-200 overflow-hidden">
                        <div class="w-full h-full bg-cover bg-center" data-alt="Portrait of student Sarah" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCCR7dH2XpyZ7rrHOKNBFNzYsAE4ORD9uTFm3YZDWo40NrWHrDTnGyNFTE9y_7L5CLJMuGtZ9VtgfTpjNR4KmyKCbWR1sdgoVyJkoE9w_BJf5v8cCwXajWlZk4m7oqQFzykFUwS7bEdskrNxfWoHjmnaKB9sXTVzRglzdykvaA0EoqYTNmK08-dK_FACKX3cxAchNdnRiU_A5wA4ecGpvSfLUdsqUkPCVqAQVsYiWak99lpiLsa0amNUjKSgxHlJdHD7X20mGZuT4I");'></div>
                    </div>
                    <span class="text-xs font-medium text-text-main dark:text-slate-200">Sarah Amalia</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-10">
        <button class="px-6 py-3 rounded-xl border border-slate-300 dark:border-white/20 text-text-main dark:text-white font-bold text-sm hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
            Lihat Arsip Prestasi
        </button>
    </div>
</section>
<!-- Timeline of Excellence -->
<section class="w-full max-w-[960px] px-4 md:px-10 pb-20">
    <div class="bg-slate-50 dark:bg-white/5 rounded-2xl p-6 md:p-10 border border-slate-200 dark:border-white/5">
        <div class="flex items-center gap-3 mb-8">
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <span class="material-symbols-outlined">history_edu</span>
            </div>
            <h2 class="text-xl font-bold text-text-main dark:text-white">Milestone Penting</h2>
        </div>
        <div class="relative pl-8 md:pl-10 space-y-8 before:absolute before:left-3 md:before:left-4 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200 dark:before:bg-white/10">
            <!-- Timeline Item -->
            <div class="relative">
                <div class="absolute -left-[29px] md:-left-[33px] top-1.5 size-4 rounded-full border-4 border-white dark:border-[#1e293b] bg-primary shadow-sm"></div>
                <div class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-4">
                    <span class="text-primary font-black text-lg">2023</span>
                    <h4 class="text-text-main dark:text-white font-bold text-base">Sekolah Adiwiyata Nasional</h4>
                </div>
                <p class="text-text-muted dark:text-slate-400 text-sm mt-1">Penghargaan dari Kementerian Lingkungan Hidup atas komitmen sekolah berbudaya lingkungan.</p>
            </div>
            <!-- Timeline Item -->
            <div class="relative">
                <div class="absolute -left-[29px] md:-left-[33px] top-1.5 size-4 rounded-full border-4 border-white dark:border-[#1e293b] bg-slate-300 dark:bg-slate-600 shadow-sm"></div>
                <div class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-4">
                    <span class="text-slate-500 dark:text-slate-400 font-bold text-lg">2018</span>
                    <h4 class="text-text-main dark:text-white font-bold text-base">Peresmian Gedung Laboratorium Terpadu</h4>
                </div>
                <p class="text-text-muted dark:text-slate-400 text-sm mt-1">Fasilitas penunjang riset siswa untuk mendukung pembelajaran berbasis STEM.</p>
            </div>
            <!-- Timeline Item -->
            <div class="relative">
                <div class="absolute -left-[29px] md:-left-[33px] top-1.5 size-4 rounded-full border-4 border-white dark:border-[#1e293b] bg-slate-300 dark:bg-slate-600 shadow-sm"></div>
                <div class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-4">
                    <span class="text-slate-500 dark:text-slate-400 font-bold text-lg">2010</span>
                    <h4 class="text-text-main dark:text-white font-bold text-base">Akreditasi A Pertama (SD &amp; SMP)</h4>
                </div>
                <p class="text-text-muted dark:text-slate-400 text-sm mt-1">Pencapaian standar mutu pendidikan tertinggi yang terus dipertahankan hingga kini.</p>
            </div>
        </div>
    </div>
</section>
@endsection
