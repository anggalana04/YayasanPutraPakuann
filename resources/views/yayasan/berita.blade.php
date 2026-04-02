@extends('layouts.app')

@section('content')
@if (!empty($pageContent))
    {!! $pageContent !!}
@else
@php
    $newsItems = isset($newsItems) && $newsItems instanceof \Illuminate\Support\Collection
        ? $newsItems
        : collect();

    $featuredNews = isset($featuredNews) && $featuredNews
        ? $featuredNews
        : ($newsItems->firstWhere('featured', true) ?? $newsItems->first());
@endphp

<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white">Berita</span>
    </div>
</div>

<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-8 py-6 lg:py-12">
    <div class="w-full max-w-[1200px] flex flex-col gap-10">
        <div class="flex flex-col gap-3">
            <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] text-slate-900 dark:text-white">
                Berita & Pengumuman Yayasan
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                Ikuti perkembangan terbaru Yayasan Putra Pakuan melalui berita dan pengumuman resmi.
            </p>
        </div>

        @if ($featuredNews)
            @php
                $featureImageRaw = trim((string)($featuredNews['image_url'] ?? $featuredNews->image_url ?? ''));
                $featureImageUrl = \Illuminate\Support\Str::startsWith($featureImageRaw, ['http://', 'https://'])
                    ? $featureImageRaw
                    : asset(ltrim($featureImageRaw, '/'));
                $featureTitle = $featuredNews['title'] ?? $featuredNews->title ?? '-';
                $featureCategory = $featuredNews['category'] ?? $featuredNews->category ?? 'Berita';
                $featureExcerpt = $featuredNews['excerpt'] ?? $featuredNews->excerpt ?? 'Ringkasan belum tersedia.';
                $featureDate = $featuredNews['published_at'] ?? $featuredNews->published_at ?? null;
            @endphp
            <a href="{{ $featuredNews->slug ? route('yayasan.berita.show', $featuredNews->slug) : '#' }}" class="relative rounded-2xl overflow-hidden shadow-lg group min-h-[320px] block hover:shadow-2xl transition-shadow">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $featureImageUrl }}');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>
                <div class="relative z-10 p-6 lg:p-10 text-white h-full flex flex-col justify-end">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 rounded bg-[#FDB913] text-slate-900 text-xs font-bold uppercase tracking-wider">Unggulan</span>
                        <span class="text-xs font-medium">{{ $featureDate ? \Illuminate\Support\Carbon::parse($featureDate)->translatedFormat('d M Y') : '-' }}</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold leading-tight mb-2">{{ $featureTitle }}</h2>
                    <p class="text-white/85 text-base lg:text-lg leading-relaxed max-w-3xl">{{ $featureExcerpt }}</p>
                    <div class="mt-4 text-sm font-bold uppercase tracking-wide text-[#FDB913]">{{ $featureCategory }}</div>
                </div>
            </a>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($newsItems as $item)
                @php
                    $imageRaw = trim((string)($item['image_url'] ?? $item->image_url ?? ''));
                    $imageUrl = \Illuminate\Support\Str::startsWith($imageRaw, ['http://', 'https://'])
                        ? $imageRaw
                        : asset(ltrim($imageRaw, '/'));
                    $title = $item['title'] ?? $item->title ?? '-';
                    $category = $item['category'] ?? $item->category ?? 'Berita';
                    $excerpt = $item['excerpt'] ?? $item->excerpt ?? 'Ringkasan belum tersedia.';
                    $dateValue = $item['published_at'] ?? $item->published_at ?? null;
                @endphp
                <a href="{{ $item->slug ? route('yayasan.berita.show', $item->slug) : '#' }}" class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 block">
                    <div class="aspect-video w-full bg-cover bg-center bg-slate-100 dark:bg-slate-700" style="background-image: url('{{ $imageUrl }}');"></div>
                    <div class="p-5 space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="px-2 py-1 rounded bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-semibold">{{ $category }}</span>
                            <span class="text-slate-500 dark:text-slate-400">{{ $dateValue ? \Illuminate\Support\Carbon::parse($dateValue)->translatedFormat('d M Y') : '-' }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">{{ $title }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-3">{{ $excerpt }}</p>
                    </div>
                </a>
            @empty
                <div class="md:col-span-2 xl:col-span-3 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 p-10 text-center bg-white dark:bg-slate-800">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada berita dipublikasikan</h3>
                    <p class="text-slate-600 dark:text-slate-400">Tambahkan konten dari menu Kelola Berita di CMS Yayasan.</p>
                </div>
            @endforelse
        </section>
    </div>
</main>
@endif
@endsection





