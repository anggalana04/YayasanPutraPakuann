@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1E3A8A", // Deep Blue from logo
                        "secondary": "#FFE030", // Yellow from logo
                        "accent": "#DC2626", // Red from logo
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "text-main-light": "#1e293b",
                        "text-main-dark": "#f1f5f9",
                        "text-muted-light": "#64748b",
                        "text-muted-dark": "#94a3b8",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-main-light dark:text-text-main-dark transition-colors duration-200 min-h-screen flex flex-col">

<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-8 py-6 lg:py-12">
<div class="w-full max-w-[1200px] flex flex-col gap-10">
<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-text-muted-light dark:text-text-muted-dark mb-4">
        <a class="hover:text-primary transition-colors" href="/">Beranda</a>
        <span>/</span>
        <span class="text-primary">Berita</span>
    </div>
</div>
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div class="flex flex-col gap-3">
        <div class="max-w-2xl">
            <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-3 text-primary dark:text-white">
                Berita & Pengumuman Terbaru
            </h1>
            <p class="text-text-muted-light dark:text-text-muted-dark text-lg leading-relaxed">Informasi terkini untuk keluarga besar Yayasan Putra Pakuan.</p>
        </div>
    </div>
    <div class="w-full lg:w-auto lg:min-w-[360px]">
        <label class="flex w-full items-center h-12 rounded-lg bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all shadow-sm">
            <div class="pl-4 flex items-center justify-center text-text-muted-light dark:text-text-muted-dark">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input class="w-full bg-transparent border-none text-text-main-light dark:text-text-main-dark placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark focus:ring-0 px-3 text-sm font-medium" placeholder="Cari berita, acara, pengumuman..."/>
        </label>
    </div>
</div>
<section class="@container">
<div class="relative rounded-2xl overflow-hidden shadow-lg shadow-slate-200/50 dark:shadow-none group">
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
<div class="w-full aspect-[16/9] lg:aspect-[21/9] bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Group of students working together on a science project in a laboratory" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBXTr5_nf4YDXijJkEYlyCT8Y7n_CVHM4HFqpNz36YAVMFWFTkE67d0k_wJf7PgIW1ENUFJ8UbLPP3oR7sF-kGzmMcaQB0pArYm_OJ5o81LtwTMnX8lry8v9_jzEHvySKUx69jpxcqUu1PR8vWnc6-Kb90yQIvO8FJfxJzXKkMRgnhSJsl3niiD75xhJ3Id8N4c9kWWDXL3fXtmyqCSilQr__Fnw1MJD4xDkSfSjCrsyGCHN0dM8CpyltuSpX-DMHVlMFEIb6McG9M");'>
</div>
<div class="absolute bottom-0 left-0 w-full p-6 lg:p-10 z-20 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
<div class="max-w-3xl">
<div class="flex items-center gap-3 mb-3">
<span class="px-3 py-1 rounded bg-secondary text-primary text-xs font-bold uppercase tracking-wider shadow-sm">Featured Event</span>
<span class="text-white/90 text-xs font-medium flex items-center gap-1 bg-black/30 px-2 py-1 rounded backdrop-blur-sm">
<span class="material-symbols-outlined text-[16px]">calendar_today</span> Oct 12, 2023
                            </span>
</div>
<h3 class="text-3xl lg:text-4xl font-bold leading-tight text-white mb-2">Annual Science Fair Registration Now Open</h3>
<p class="text-white/80 text-base lg:text-lg leading-relaxed line-clamp-2 max-w-2xl">
                                Students are invited to showcase their innovative projects. This year's theme focuses on sustainable energy solutions. Registration forms are available in the parent portal starting today.
                            </p>
</div>
<button class="flex-shrink-0 flex items-center gap-2 bg-white text-primary px-6 py-3 rounded-lg font-bold hover:bg-secondary transition-colors shadow-lg">
                            Read Full Article <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
</button>
</div>
</div>
</section>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
<div class="lg:col-span-8 flex flex-col gap-10">
<div class="border-b border-slate-200 dark:border-slate-800">
<div class="flex overflow-x-auto pb-4 gap-6 scrollbar-hide">
<button class="text-primary font-bold border-b-2 border-primary pb-1 text-sm whitespace-nowrap">All Updates</button>
<button class="text-text-muted-light dark:text-text-muted-dark hover:text-primary font-medium pb-1 text-sm whitespace-nowrap transition-colors">Academic</button>
<button class="text-text-muted-light dark:text-text-muted-dark hover:text-primary font-medium pb-1 text-sm whitespace-nowrap transition-colors">Events</button>
<button class="text-text-muted-light dark:text-text-muted-dark hover:text-primary font-medium pb-1 text-sm whitespace-nowrap transition-colors">Policy</button>
<button class="text-text-muted-light dark:text-text-muted-dark hover:text-primary font-medium pb-1 text-sm whitespace-nowrap transition-colors">Student Life</button>
</div>
</div>
<div class="flex flex-col gap-8">
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-md transition-all hover:border-primary/20">
<div class="w-full md:w-1/3 aspect-video md:aspect-[4/3] rounded-lg overflow-hidden relative">
<div class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500" data-alt="Teacher helping students crossing the street safely with stop sign" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTyPsZB5w1LUk7djUDa91BJSOF4ndR7HXwKID8V_PicCKctO3A1ofuVd23fYLSJUUAwe60TUuByvW75N0eA2h_GNHYS2BJnpshQATTJGQdoaKhBw_iZoV47NuEWPP4BplM8jRdAsIDWeiVHCC0fgqeIgzL5m0U87nRj4cOSwO8_FVqQxHnEESytitQSxvGRwD726rWA0keEiAjl3KQU7EL8DEMBA_FaimBUxyjJ01yauYcdB6k9SihvZIlL-Nu27D5q7iRz5jztqs");'>
</div>
<div class="absolute top-2 left-2">
<span class="px-2 py-1 rounded bg-accent text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">Policy</span>
</div>
</div>
<div class="flex-1 flex flex-col">
<div class="flex items-center gap-2 mb-2 text-xs font-medium text-text-muted-light">
<span class="material-symbols-outlined text-[16px]">schedule</span> Oct 10, 2023
                            </div>
<h3 class="text-xl font-bold leading-tight text-text-main-light dark:text-white mb-2 group-hover:text-primary transition-colors">New Safety Protocols for Drop-off</h3>
<p class="text-text-muted-light dark:text-text-muted-dark text-sm leading-relaxed line-clamp-2 mb-4">
                                    To ensure the safety of all students, new traffic flow regulations will be implemented at the North Gate starting next Monday. Please review the updated map.
                                </p>
<div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
<a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-blue-700" href="#">
                                        Read Update <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
</a>
<button class="text-text-muted-light hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">share</span>
</button>
</div>
</div>
</article>
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-md transition-all hover:border-primary/20">
<div class="w-full md:w-1/3 aspect-video md:aspect-[4/3] rounded-lg overflow-hidden relative">
<div class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500" data-alt="Students running on track field during sports day" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB6T0Lijr8p7h33P4S00_nMiMLLGAonjUbVOpliTwefjIWKIpVsPfSOJ278wyJLEDYUouhWb8UtjVJ14CfM8bIhabFn8vQlVQY3sdjTG-2hw1BjqaPOuC6ZD1CCDZmi3l9riFQ0Ut78bepP7UgdmA1XDIzAJq7e147TSCkhmfBzbnHEghSF4RCbNOLVhrz_y9DTAutTF7kzLS7UC9xePk9Ln0ngV30WbU-WhtO0nVItt5TKrtZs_7BFX65jUPYj7ZSYPR7-rzH3hIU");'>
</div>
<div class="absolute top-2 left-2">
<span class="px-2 py-1 rounded bg-secondary text-primary text-[10px] font-bold uppercase tracking-wider shadow-sm">Events</span>
</div>
</div>
<div class="flex-1 flex flex-col">
<div class="flex items-center gap-2 mb-2 text-xs font-medium text-text-muted-light">
<span class="material-symbols-outlined text-[16px]">schedule</span> Oct 08, 2023
                            </div>
<h3 class="text-xl font-bold leading-tight text-text-main-light dark:text-white mb-2 group-hover:text-primary transition-colors">Highlights from Inter-School Sports Meet</h3>
<p class="text-text-muted-light dark:text-text-muted-dark text-sm leading-relaxed line-clamp-2 mb-4">
                                    Our athletes brought home the gold! Check out the photo gallery and results from this weekend's exciting competition against regional schools.
                                </p>
<div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
<a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-blue-700" href="#">
                                        View Gallery <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
</a>
<button class="text-text-muted-light hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">share</span>
</button>
</div>
</div>
</article>
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-md transition-all hover:border-primary/20">
<div class="w-full md:w-1/3 aspect-video md:aspect-[4/3] rounded-lg overflow-hidden relative">
<div class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500" data-alt="Close up of a report card and pen on a desk" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDUJ_ONRBtkpAwmODJdV1RNm30cFon14b8z-EbxGDQN0Xppz-uViEgUzoh9534zMXMEW_SFdTD-wsLToHg6y6HQNCfU24Vyaal_cjQxKpZSiN0Yq2xzD_6lLKkxQznU7kfcoZnRWEc6SrpWJe2NvP1Nwb0Yg_ZvHV5Slh8aRuymdVmbmFqFH7Y5sm0JcBn1VS1DOWgkphOn1hV1C7H6rb1so9GsKKXDccYBZpmmrMGmOaqqEbtFOP_s_xuMecl1KwFpWwMchPbqv_8");'>
</div>
<div class="absolute top-2 left-2">
<span class="px-2 py-1 rounded bg-primary text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">Academic</span>
</div>
</div>
<div class="flex-1 flex flex-col">
<div class="flex items-center gap-2 mb-2 text-xs font-medium text-text-muted-light">
<span class="material-symbols-outlined text-[16px]">schedule</span> Oct 05, 2023
                            </div>
<h3 class="text-xl font-bold leading-tight text-text-main-light dark:text-white mb-2 group-hover:text-primary transition-colors">Term 2 Report Cards Released</h3>
<p class="text-text-muted-light dark:text-text-muted-dark text-sm leading-relaxed line-clamp-2 mb-4">
                                    Digital report cards are now accessible via the Parent Portal. Please schedule a meeting with teachers if needed to discuss progress.
                                </p>
<div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
<a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-blue-700" href="#">
                                        Access Portal <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
</a>
<button class="text-text-muted-light hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">share</span>
</button>
</div>
</div>
</article>
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-surface-dark rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-md transition-all hover:border-primary/20">
<div class="w-full md:w-1/3 aspect-video md:aspect-[4/3] rounded-lg overflow-hidden relative">
<div class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500" data-alt="Group of diverse students talking and laughing in hallway" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDVnesqYuwfx79MAOwxAFdf4S84z5Ier1LPD7ORW1EM8oo4KOeUgkWDqzkxZbtPWZwGgJCNpEbm1GbPi0GtHVYyQ3k8wQVDCvlDvrCMnUAynC9LQ8srG-Pov87xP5_p6OaUmJ1GMn5wTjcXP_fOTp9C4qByPg6CEoytka2kFWnnWj_ONjkx_2Qg_eT1hv9Jv-Fu3hicuFfWxuHl2pWH8RAjvDMqO_xZAnr3EpncPVaaDNobZuOJfA6xxhPZHfKudVeET3gE4S38xVY");'>
</div>
<div class="absolute top-2 left-2">
<span class="px-2 py-1 rounded bg-green-600 text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">Student Life</span>
</div>
</div>
<div class="flex-1 flex flex-col">
<div class="flex items-center gap-2 mb-2 text-xs font-medium text-text-muted-light">
<span class="material-symbols-outlined text-[16px]">schedule</span> Oct 01, 2023
                            </div>
<h3 class="text-xl font-bold leading-tight text-text-main-light dark:text-white mb-2 group-hover:text-primary transition-colors">Mental Health Awareness Week</h3>
<p class="text-text-muted-light dark:text-text-muted-dark text-sm leading-relaxed line-clamp-2 mb-4">
                                    We are hosting a series of workshops and activities aimed at promoting well-being and mindfulness for students across all grades.
                                </p>
<div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
<a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-blue-700" href="#">
                                        View Schedule <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
</a>
<button class="text-text-muted-light hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">share</span>
</button>
</div>
</div>
</article>
</div>
<div class="flex justify-center pt-4">
<button class="px-8 py-3 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-text-main-light dark:text-text-main-dark rounded-lg font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2 shadow-sm">
                            Load More Updates
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
</button>
</div>
</div>
<aside class="lg:col-span-4 flex flex-col gap-6">
<div class="bg-primary rounded-xl p-6 shadow-lg text-white relative overflow-hidden">
<div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
<div class="absolute -left-10 -bottom-10 w-32 h-32 bg-secondary/20 rounded-full blur-2xl"></div>
<div class="relative z-10">
<div class="flex items-center justify-between mb-6">
<h3 class="text-lg font-bold">Quick Announcements</h3>
<span class="material-symbols-outlined text-secondary">campaign</span>
</div>
<div class="flex flex-col gap-4">
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-[3rem] bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Oct</span>
<span class="text-lg font-bold text-secondary">24</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-secondary transition-colors">Upcoming Board Meeting</h4>
<p class="text-xs text-white/70 mt-1">Open to all parent reps.</p>
</div>
</div>
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-[3rem] bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Nov</span>
<span class="text-lg font-bold text-secondary">01</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-secondary transition-colors">Holiday Closure</h4>
<p class="text-xs text-white/70 mt-1">Closed for Heroes Day.</p>
</div>
</div>
<div class="flex gap-3 items-start pb-4 border-b border-white/10">
<div class="flex flex-col items-center min-w-[3rem] bg-white/10 rounded p-1 backdrop-blur-sm">
<span class="text-[10px] font-medium uppercase text-white/70">Nov</span>
<span class="text-lg font-bold text-secondary">05</span>
</div>
<div>
<h4 class="font-semibold text-sm leading-snug cursor-pointer hover:text-secondary transition-colors">Uniform Shop Sale</h4>
<p class="text-xs text-white/70 mt-1">20% off all winter gear.</p>
</div>
</div>
</div>
<button class="w-full mt-4 text-xs font-bold uppercase tracking-wider text-secondary hover:text-white transition-colors flex items-center justify-center gap-1">
                        View All Notices <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</button>
</div>
</div>
<div class="grid grid-cols-2 gap-4">
<a class="flex flex-col items-center justify-center p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 rounded-xl hover:shadow-lg transition-all group hover:-translate-y-1 hover:border-accent/30" href="#">
<div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center mb-3 group-hover:bg-accent group-hover:text-white transition-colors text-accent">
<span class="material-symbols-outlined text-2xl">calendar_month</span>
</div>
<span class="text-sm font-bold text-text-main-light dark:text-white">Calendar</span>
</a>
<a class="flex flex-col items-center justify-center p-6 bg-white dark:bg-surface-dark border border-slate-100 dark:border-slate-800 rounded-xl hover:shadow-lg transition-all group hover:-translate-y-1 hover:border-secondary/30" href="#">
<div class="w-12 h-12 rounded-full bg-secondary/20 flex items-center justify-center mb-3 group-hover:bg-secondary group-hover:text-primary transition-colors text-yellow-600">
<span class="material-symbols-outlined text-2xl">menu_book</span>
</div>
<span class="text-sm font-bold text-text-main-light dark:text-white">Handbook</span>
</a>
</div>
<div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-6 border border-slate-100 dark:border-slate-800">
<h3 class="text-lg font-bold mb-1 text-primary dark:text-white">Subscribe to News</h3>
<p class="text-sm text-text-muted-light dark:text-text-muted-dark mb-4">Weekly digests, no spam.</p>
<div class="flex gap-2">
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-sm px-3 py-2 focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="Email address" type="email"/>
<button class="bg-primary hover:bg-blue-900 text-white rounded-lg px-4 py-2 text-sm font-bold transition-colors">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</aside>
</div>
</div>
</main>

</body></html>
@endsection
