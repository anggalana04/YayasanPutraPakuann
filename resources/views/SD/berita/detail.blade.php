@extends('layouts.SD.app')

@php
    $newsExcerpt = trim(strip_tags((string) ($newsItem->excerpt ?? $newsItem->content ?? 'Berita terbaru dari SDIT Putra Pakuan.')));
    $newsDescription = \Illuminate\Support\Str::limit($newsExcerpt, 160);
    $newsImageRaw = trim((string) ($newsItem->image_url ?? ''));
    $newsImage = \Illuminate\Support\Str::startsWith($newsImageRaw, ['http://', 'https://'])
        ? $newsImageRaw
        : ($newsImageRaw !== '' ? asset(ltrim($newsImageRaw, '/')) : asset('images/logo-sdit-putrapakuan.png'));
    $schoolSlug = request()->route('school') ?? 'sd';
    $newsUrl = route('school.berita.detail', ['school' => $schoolSlug, 'news' => $newsItem->id]);
@endphp

@section('title', ($newsItem->title ?? 'Detail Berita') . ' | SDIT Putra Pakuan')
@section('meta_description', $newsDescription)
@section('meta_keywords', 'berita sdit putra pakuan, info sekolah dasar islam bogor, kegiatan siswa sdit')
@section('meta_image', $newsImage)

@push('structured_data')
@php
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $newsItem->title,
        'description' => $newsDescription,
        'image' => [$newsImage],
        'datePublished' => optional($newsItem->published_at ?? $newsItem->created_at)->toAtomString(),
        'dateModified' => optional($newsItem->updated_at ?? $newsItem->published_at ?? $newsItem->created_at)->toAtomString(),
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $newsUrl,
        ],
        'author' => [
            '@type' => 'Organization',
            'name' => 'SDIT Putra Pakuan',
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'SDIT Putra Pakuan',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo-sdit-putrapakuan.png'),
            ],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
@php
    $imageRaw = trim((string)($newsItem->image_url ?? ''));
    $imageUrl = \Illuminate\Support\Str::startsWith($imageRaw, ['http://', 'https://'])
        ? $imageRaw
        : ($imageRaw !== '' ? asset(ltrim($imageRaw, '/')) : '');
    $category = $newsItem->category ?? 'Berita';
    $dateStr = $newsItem->published_at
        ? \Illuminate\Support\Carbon::parse($newsItem->published_at)->translatedFormat('d F Y')
        : '';
@endphp

@if ($imageUrl)
<div class="w-full relative overflow-hidden" style="height: clamp(220px, 38vw, 460px);">
    <div class="absolute inset-0 bg-cover bg-center scale-[1.02]" style="background-image: url('{{ $imageUrl }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/35 to-black/10"></div>
    <div class="relative z-10 h-full max-w-[860px] mx-auto px-4 sm:px-6 flex flex-col justify-end pb-8 md:pb-12">
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#FDB913] text-slate-900 text-xs font-bold uppercase tracking-wide">
                {{ $category }}
            </span>
            @if ($dateStr)
                <span class="text-white/75 text-xs font-medium">{{ $dateStr }}</span>
            @endif
        </div>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white leading-tight max-w-3xl">
            {{ $newsItem->title }}
        </h1>
    </div>
</div>
@endif

<div class="w-full max-w-[860px] mx-auto px-4 sm:px-6 pt-6">
    <div class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-slate-500 dark:text-slate-400">
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.home', ['school' => $schoolSlug]) }}">Beranda</a>
        <span class="text-slate-300 dark:text-slate-600">/</span>
        <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('school.berita', ['school' => $schoolSlug]) }}">Berita</a>
        <span class="text-slate-300 dark:text-slate-600">/</span>
        <span class="text-slate-700 dark:text-slate-300 line-clamp-1 max-w-[240px]">{{ $newsItem->title }}</span>
    </div>
</div>

<article class="w-full max-w-[860px] mx-auto px-4 sm:px-6 py-8 pb-20">
    @if (!$imageUrl)
        <div class="mb-8">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#FDB913] text-slate-900 text-xs font-bold uppercase tracking-wide">{{ $category }}</span>
                @if ($dateStr)
                    <span class="text-slate-500 dark:text-slate-400 text-xs">{{ $dateStr }}</span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white leading-tight">{{ $newsItem->title }}</h1>
        </div>
    @endif

    @if (!empty($newsItem->excerpt))
        <p class="text-lg text-slate-700 dark:text-slate-200 font-medium leading-relaxed mb-8 pl-4 border-l-4 border-[#FDB913]">
            {{ $newsItem->excerpt }}
        </p>
    @endif

    @if (!empty($newsItem->content))
        <div class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed
                    prose-headings:font-bold prose-headings:text-slate-900 dark:prose-headings:text-white
                    prose-a:text-[#FDB913] prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-xl prose-img:shadow-md prose-img:w-full">
            {!! $newsItem->content !!}
        </div>
    @else
        <p class="text-slate-500 dark:text-slate-400 italic">Konten artikel belum tersedia.</p>
    @endif

    <div class="mt-12 pt-6 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
            <span class="inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-slate-400">category</span>
                {{ $category }}
            </span>
            @if ($dateStr)
            <span class="inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-slate-400">calendar_month</span>
                {{ $dateStr }}
            </span>
            @endif
        </div>
        <a
            href="{{ route('school.berita', ['school' => $schoolSlug]) }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-[#FDB913] dark:hover:text-[#FDB913] transition-colors"
        >
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke Berita
        </a>
    </div>
</article>
@endsection





