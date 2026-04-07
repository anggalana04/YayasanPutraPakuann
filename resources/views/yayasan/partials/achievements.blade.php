<!-- Achievements Section -->
<section class="w-full flex justify-center px-4 md:px-10 py-20 bg-slate-50 dark:bg-background-dark">
    <div class="max-w-[1300px] w-full">
        <div class="flex flex-col gap-2 mb-8">
            <h2 class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Jejak Langkah Prestasi</h2>
            <p class="text-slate-600 dark:text-slate-400">Raihan gemilang siswa-siswi kami di tingkat regional, nasional, hingga internasional.</p>
        </div>

        {{-- <!-- Unit Filters -->
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
        </div> --}}

        <!-- Achievement Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($achievementItems as $achievement)
                <a href="{{ route('yayasan.prestasi.show', ['slug' => $achievement->slug]) }}" class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="relative aspect-[4/3] w-full overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('{{ $achievement->image_url ?? '/images/default-achievement.jpg' }}');"></div>
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-indigo-600/90 text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">{{ Str::limit($achievement->category ?: 'Prestasi', 20) }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-[#FDB913] tracking-wide">{{ $achievement->school?->name ?? 'Yayasan' }}</span>
                            <span class="text-xs text-slate-500 dark:text-slate-500">{{ optional($achievement->published_at)->format('Y') ?? date('Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2 group-hover:text-[#FDB913] transition-colors">{{ $achievement->title }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-3 flex-1">{{ $achievement->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($achievement->content), 120) }}</p>
                        <span class="flex items-center gap-1 text-xs font-bold text-[#FDB913] opacity-0 group-hover:opacity-100 transition-opacity">
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-slate-500">Belum ada prestasi yang dipublikasikan.</div>
            @endforelse
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('yayasan.prestasi') }}" class="px-6 py-3 rounded-xl border-2 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white font-bold text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                Lihat Arsip Prestasi
            </a>
        </div>
    </div>
</section>
