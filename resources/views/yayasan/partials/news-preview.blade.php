<!-- Berita Terbaru Section -->
<div class="w-full py-20 flex justify-center bg-white dark:bg-background-dark">
    <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-10">
        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
            <h2 class="text-slate-900 dark:text-white text-2xl md:text-3xl font-black tracking-tight">Berita Terbaru</h2>
            <a class="text-[#FDB913] font-bold hover:text-[#E5A800] text-sm flex items-center gap-2 transition-colors" href="{{ route('yayasan.berita') }}">
                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($newsItems as $news)
                <a class="group flex flex-col gap-4" href="{{ route('yayasan.berita.show', ['slug' => $news->slug]) }}">
                    <div class="bg-slate-100 dark:bg-slate-700 aspect-[4/3] rounded-xl overflow-hidden shadow-sm relative ring-1 ring-slate-200 dark:ring-slate-700">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ $news->image_url ?? '/images/default-news.jpg' }}');"></div>
                        <div class="absolute top-3 left-3 bg-[#FDB913] text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">{{ $news->category ?? 'Berita' }}</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-slate-800 dark:text-white font-bold text-base leading-snug group-hover:text-[#FDB913] transition-colors">{{ $news->title }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ optional($news->published_at)->format('d M Y') ?? '-' }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-slate-500">Berita terbaru belum tersedia.</div>
            @endforelse
        </div>
    </div>
</div>
