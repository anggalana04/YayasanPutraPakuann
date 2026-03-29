<!-- Core Values Section -->
<div class="w-full py-20 flex justify-center bg-white dark:bg-slate-900">
    <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
        <div class="flex flex-col gap-4 text-center items-center">
            <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black leading-tight">
                Nilai Inti Kami
            </h2>
            <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($coreValues as $coreValue)
                <div class="group flex flex-col gap-6 rounded-2xl bg-slate-50 dark:bg-slate-800 p-8 hover:shadow-xl transition-all border border-slate-200 dark:border-slate-700 hover:border-[#FDB913]/40">
                    <div class="w-14 h-14 rounded-xl bg-[#FDB913]/10 flex items-center justify-center mb-2 group-hover:bg-[#FDB913]/20 transition-colors">
                        <span class="material-symbols-outlined text-[#FDB913] text-4xl">star</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-slate-900 dark:text-white text-2xl font-bold">{{ $coreValue['title'] }}</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            {{ $coreValue['description'] }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500">Nilai inti belum tersedia.</div>
            @endforelse
        </div>
    </div>
</div>
