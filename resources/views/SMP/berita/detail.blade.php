@extends('layouts.smp.app')

@section('content')
<!-- Breadcrumb -->
<div class="w-full max-w-7xl mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.home', ['school' => request()->route('school') ?? 'smk']) }}">Beranda</a>
        <span>/</span>
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.berita', ['school' => request()->route('school') ?? 'smk']) }}">Berita</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white">Detail Berita</span>
    </div>
</div>

<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-8 py-6 lg:py-12">
<div class="w-full max-w-7xl flex flex-col gap-10">
    <article class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-8 lg:p-12 flex flex-col gap-8">
        <div
            class="w-full aspect-[16/9] rounded-xl overflow-hidden mb-6 bg-cover bg-center"
            @if ($newsItem->image_url)
                style="background-image: url('{{ $newsItem->image_url }}')"
            @endif
        ></div>
        <div class="flex items-center gap-3 mb-4">
            <span class="px-3 py-1 rounded bg-primary text-charcoal text-xs font-bold uppercase tracking-wider shadow-sm">{{ $newsItem->category ?? 'Berita' }}</span>
            <span class="text-slate-500 dark:text-slate-400 text-xs font-medium flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                {{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y') : ($newsItem->created_at?->format('M d, Y') ?? '-') }}
            </span>
        </div>
        <h1 class="text-3xl lg:text-4xl font-black leading-tight tracking-tight text-charcoal dark:text-white mb-4">{{ $newsItem->title }}</h1>
        <div class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
            {!! nl2br(e($newsItem->content)) !!}
        </div>
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="material-symbols-outlined">person</span> Oleh {{ $newsItem->created_by ?? 'Admin' }}
                <span class="material-symbols-outlined">schedule</span> Dipublikasikan:
                {{ $newsItem->published_at ? $newsItem->published_at->format('d M Y') : ($newsItem->created_at?->format('d M Y') ?? '-') }}
            </div>
            <div class="flex gap-2">
                <button class="bg-primary hover:bg-[#E5A800] text-charcoal rounded-lg px-4 py-2 text-sm font-bold transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">share</span> Bagikan
                </button>
                <button class="bg-charcoal hover:bg-primary text-white hover:text-charcoal rounded-lg px-4 py-2 text-sm font-bold transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">arrow_back</span> Kembali ke Berita
                </button>
            </div>
        </div>
    </article>
</div>
</main>
@endsection
