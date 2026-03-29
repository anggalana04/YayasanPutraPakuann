@extends('layouts.SMP.app')

@section('content')
<!-- Breadcrumb -->
<div class="w-full max-w-7xl mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.home', ['school' => request()->route('school')]) }}">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white">Berita</span>
    </div>
</div>

<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-8 py-6 lg:py-12">
<div class="w-full max-w-7xl flex flex-col gap-10">

<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div class="flex flex-col gap-3">
        <div class="max-w-2xl">
            <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-3 text-charcoal dark:text-white">
                Berita & Pengumuman SMP
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">Informasi terbaru untuk siswa, guru, dan orang tua SMP Putra Pakuan.</p>
        </div>
    </div>
    <div class="w-full lg:w-auto lg:min-w-[360px]">
        <label class="flex w-full items-center h-12 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all shadow-sm">
            <div class="pl-4 flex items-center justify-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input class="w-full bg-transparent border-none text-charcoal dark:text-white placeholder:text-slate-500 dark:placeholder:text-slate-400 focus:ring-0 px-3 text-sm font-medium" placeholder="Cari berita, acara, pengumuman..."/>
        </label>
    </div>
</div>

<section class="@container">
<div class="relative rounded-2xl overflow-hidden shadow-lg shadow-primary/10 dark:shadow-none group">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>

    @if ($featuredNews)
        <div class="w-full aspect-[16/9] lg:aspect-[21/9] bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
             data-alt="{{ $featuredNews->title }}"
             style='background-image: url("{{ $featuredNews->image_url ?? asset('images/default-hero.jpg') }}")'>
        </div>
        <div class="absolute bottom-0 left-0 w-full p-6 lg:p-10 z-20 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-3">
                    @if ($featuredNews->featured)
                        <span class="px-3 py-1 rounded bg-blue-600 text-white text-xs font-bold uppercase tracking-wider shadow-sm">Unggulan</span>
                    @else
                        <span class="px-3 py-1 rounded bg-primary text-charcoal text-xs font-bold uppercase tracking-wider shadow-sm">Top News</span>
                    @endif
                    <span class="text-white/90 text-xs font-medium flex items-center gap-1 bg-black/30 px-2 py-1 rounded backdrop-blur-sm">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ $featuredNews->published_at?->format('d M Y') ?? $featuredNews->created_at->format('d M Y') }}
                    </span>
                </div>
                <h3 class="text-3xl lg:text-4xl font-bold leading-tight text-white mb-2">{{ $featuredNews->title }}</h3>
                <p class="text-white/80 text-base lg:text-lg leading-relaxed line-clamp-2 max-w-2xl">
                    {{ \Illuminate\Support\Str::limit($featuredNews->excerpt ?? strip_tags($featuredNews->content ?? ''), 170) }}
                </p>
            </div>
            <a href="{{ route('school.berita.detail', ['school' => $school, 'news' => $featuredNews->id]) }}"
               class="flex-shrink-0 flex items-center gap-2 bg-white text-charcoal px-6 py-3 rounded-lg font-bold hover:bg-primary transition-colors shadow-lg">
                Baca Selengkapnya <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </a>
        </div>
    @else
        <div class="w-full aspect-[16/9] lg:aspect-[21/9] bg-slate-200 dark:bg-slate-800"></div>
        <div class="absolute inset-0 z-20 flex items-center justify-center p-6">
            <p class="text-white/90 text-sm md:text-base font-semibold text-center">Belum ada berita unggulan yang dipublikasikan.</p>
        </div>
    @endif
</div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
<div class="lg:col-span-12 flex flex-col gap-10">
<div class="border-b border-slate-200 dark:border-slate-800">
<div class="flex overflow-x-auto pb-4 gap-6 scrollbar-hide">
<button class="text-charcoal dark:text-white font-bold border-b-2 border-primary pb-1 text-sm whitespace-nowrap">Semua Berita</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Akademik</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Event</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Kebijakan</button>
<button class="text-slate-600 dark:text-slate-400 hover:text-charcoal dark:hover:text-white font-medium pb-1 text-sm whitespace-nowrap transition-colors">Kehidupan Siswa</button>
</div>
</div>

<div class="flex flex-col gap-8">
@forelse ($news as $item)
<article class="group flex flex-col md:flex-row gap-6 bg-white dark:bg-slate-800 rounded-xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all hover:border-primary/20 cursor-pointer"
    onclick="window.location.href='{{ route('school.berita.detail', ['school' => $school, 'news' => $item->id]) }}'">
    <div class="w-full md:w-1/3 aspect-video md:aspect-4/3 rounded-lg overflow-hidden relative">
        <div
            class="w-full h-full bg-cover bg-center transform group-hover:scale-105 transition-transform duration-500"
            data-alt="{{ $item->title }}"
            @if ($item->image_url)
                style='background-image: url("{{ $item->image_url }}")'
            @endif
        >
        </div>
        <div class="absolute top-2 left-2">
            <span class="px-2 py-1 rounded bg-primary text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">{{ $item->category ?? 'Berita' }}</span>
        </div>
    </div>
    <div class="flex-1 flex flex-col">
        <div class="flex items-center gap-2 mb-2 text-xs font-medium text-slate-500">
            <span class="material-symbols-outlined text-[16px]">schedule</span>
            {{ $item->published_at ? $item->published_at->format('d M Y') : ($item->created_at?->format('d M Y') ?? '-') }}
            @if ($item->featured)
                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-white bg-blue-600 rounded-full">Unggulan</span>
            @endif
        </div>
        <h3 class="text-xl font-bold leading-tight text-charcoal dark:text-white mb-2 group-hover:text-primary transition-colors">{{ $item->title }}</h3>
        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2 mb-4">
            {{ \Illuminate\Support\Str::limit($item->excerpt ?? strip_tags($item->content ?? ''), 160) }}
        </p>
        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <a class="text-sm font-bold text-primary flex items-center gap-1 group/link hover:text-[#E5A800]" href="{{ route('school.berita.detail', ['school' => $school, 'news' => $item->id]) }}">
                Baca Update <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
            </a>
            <button class="text-slate-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">share</span>
            </button>
        </div>
    </div>
</article>
@empty
<div class="text-slate-600 dark:text-slate-400 text-sm">Belum ada berita yang dipublikasikan.</div>
@endforelse
</div>

<div class="flex justify-center pt-4">
    {{ $news->links() }}
</div>
</div>

</div>
</div>
</main>
@endsection





