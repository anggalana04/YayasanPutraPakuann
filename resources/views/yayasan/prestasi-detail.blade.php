@extends('layouts.app')

@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Str;

    $metaExcerpt     = trim(strip_tags((string)($prestasi->excerpt ?? $prestasi->content ?? 'Prestasi unggulan dari Yayasan Putra Pakuan Bogor.')));
    $metaDescription = Str::limit($metaExcerpt, 160);
    $imageRaw        = trim((string)($prestasi->image_url ?? ''));
    $imageUrl        = Str::startsWith($imageRaw, ['http://', 'https://'])
        ? $imageRaw
        : ($imageRaw !== '' ? asset(ltrim($imageRaw, '/')) : asset('images/logo-yayasan.png'));
    $prestasiUrl     = route('yayasan.prestasi.show', ['slug' => $prestasi->slug]);
    $category        = $prestasi->category ?? 'Prestasi';
    $year            = $prestasi->published_at
        ? Carbon::parse($prestasi->published_at)->format('Y')
        : ($prestasi->created_at ? Carbon::parse($prestasi->created_at)->format('Y') : date('Y'));
    $dateStr         = $prestasi->published_at
        ? Carbon::parse($prestasi->published_at)->translatedFormat('d F Y')
        : ($prestasi->created_at ? Carbon::parse($prestasi->created_at)->translatedFormat('d F Y') : '');
    $categoryColors  = [
        'akademik'      => 'bg-blue-600',
        'olahraga'      => 'bg-orange-500',
        'seni'          => 'bg-purple-600',
        'seni & budaya' => 'bg-purple-600',
        'teknologi'     => 'bg-cyan-600',
        'pramuka'       => 'bg-green-600',
        'agama'         => 'bg-emerald-600',
        'karya tulis'   => 'bg-rose-600',
    ];
    $badgeColor = $categoryColors[strtolower(trim($category))] ?? 'bg-slate-600';
@endphp

@section('title', ($prestasi->title ?? 'Prestasi') . ' — Yayasan Putra Pakuan')
@section('meta_description', $metaDescription)
@section('meta_keywords', 'prestasi ' . Str::lower($category) . ' yayasan putra pakuan bogor, ' . Str::lower($prestasi->title ?? '') . ', prestasi siswa bogor pendidikan')
@section('meta_image', $imageUrl)

@push('structured_data')
@php
    $schema = [
        '@context'          => 'https://schema.org',
        '@type'             => 'Article',
        'headline'          => $prestasi->title,
        'description'       => $metaDescription,
        'image'             => [$imageUrl],
        'datePublished'     => optional($prestasi->published_at ?? $prestasi->created_at)->toAtomString(),
        'dateModified'      => optional($prestasi->updated_at ?? $prestasi->published_at ?? $prestasi->created_at)->toAtomString(),
        'mainEntityOfPage'  => ['@type' => 'WebPage', '@id' => $prestasiUrl],
        'author'            => ['@type' => 'Organization', 'name' => 'Yayasan Putra Pakuan'],
        'publisher'         => [
            '@type' => 'Organization',
            'name'  => 'Yayasan Putra Pakuan',
            'logo'  => ['@type' => 'ImageObject', 'url' => asset('images/logo-yayasan.png')],
        ],
        'keywords'          => $category . ', prestasi, yayasan putra pakuan, bogor',
        'articleSection'    => $category,
    ];
@endphp
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')

<!-- ─── Hero Banner ─────────────────────────────────────── -->
<div class="w-full relative overflow-hidden" style="height: clamp(240px, 40vw, 480px);">
    <div class="absolute inset-0 bg-cover bg-center scale-[1.03]"
         style="background-image: url('{{ $imageUrl }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-black/10"></div>

    <div class="relative z-10 h-full max-w-[900px] mx-auto px-4 sm:px-6 flex flex-col justify-end pb-10 md:pb-14">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-white/60 text-xs font-medium mb-4">
            <a href="/" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('yayasan.prestasi') }}" class="hover:text-white transition-colors">Prestasi</a>
            <span>/</span>
            <span class="text-white/90 truncate max-w-[200px]">{{ $prestasi->title }}</span>
        </nav>

        <!-- Meta badges -->
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="{{ $badgeColor }} text-white text-xs font-bold uppercase px-3 py-1 rounded-full backdrop-blur-sm">
                {{ $category }}
            </span>
            @if ($prestasi->featured)
                <span class="bg-[#FDB913] text-slate-900 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[13px]" style="font-variation-settings:'FILL' 1">star</span>
                    Prestasi Unggulan
                </span>
            @endif
            @if ($dateStr)
                <span class="text-white/70 text-xs font-medium">{{ $dateStr }}</span>
            @endif
        </div>

        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white leading-tight max-w-3xl">
            {{ $prestasi->title }}
        </h1>
    </div>
</div>

<!-- ─── Body ────────────────────────────────────────────── -->
<div class="max-w-[1100px] mx-auto px-4 sm:px-6 py-12 grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

    <!-- Main Content -->
    <article>
        {{-- Excerpt lead --}}
        @if ($prestasi->excerpt)
            <p class="text-lg font-semibold text-slate-700 dark:text-slate-300 leading-relaxed border-l-4 border-[#FDB913] pl-5 mb-8">
                {{ $prestasi->excerpt }}
            </p>
        @endif

        {{-- Rich content --}}
        @if ($prestasi->content)
            <div class="prose prose-slate dark:prose-invert max-w-none
                        prose-headings:font-bold prose-headings:tracking-tight
                        prose-a:text-[#FDB913] prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-xl prose-img:shadow-lg
                        prose-blockquote:border-[#FDB913] prose-blockquote:text-slate-600 dark:prose-blockquote:text-slate-400
                        prose-code:bg-slate-100 dark:prose-code:bg-slate-800 prose-code:px-1.5 prose-code:rounded">
                {!! $prestasi->content !!}
            </div>
        @else
            <div class="text-slate-500 dark:text-slate-400 italic py-8 text-center">
                Konten detail belum tersedia untuk prestasi ini.
            </div>
        @endif

        <!-- Share + Back row -->
        <div class="mt-12 pt-6 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <a href="{{ route('yayasan.prestasi') }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 dark:text-slate-400 hover:text-[#FDB913] dark:hover:text-[#FDB913] transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Semua Prestasi
            </a>
            <!-- Share buttons -->
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($prestasi->title . ' - ' . $prestasiUrl) }}"
                   target="_blank" rel="noopener noreferrer"
                   class="size-9 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-80 transition-opacity"
                   title="Bagikan via WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.938 3.659 1.432 5.63 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($prestasiUrl) }}"
                   target="_blank" rel="noopener noreferrer"
                   class="size-9 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:opacity-80 transition-opacity"
                   title="Bagikan via Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ $prestasiUrl }}').then(()=>{ this.innerHTML='<span class=\'material-symbols-outlined text-[16px]\'>check</span>'; setTimeout(()=>{ this.innerHTML='<span class=\'material-symbols-outlined text-[16px]\'>link</span>'; },1800); })"
                        class="size-9 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 flex items-center justify-center hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors"
                        title="Salin tautan">
                    <span class="material-symbols-outlined text-[16px]">link</span>
                </button>
            </div>
        </div>
    </article>

    <!-- Sidebar -->
    <aside class="space-y-6">
        <!-- Meta card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 space-y-4 shadow-sm">
            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Detail Prestasi</h3>

            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[#FDB913] text-[20px] mt-0.5">category</span>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Kategori</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $category }}</p>
                </div>
            </div>

            @if ($dateStr)
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[#FDB913] text-[20px] mt-0.5">calendar_today</span>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Tanggal Prestasi</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $dateStr }}</p>
                </div>
            </div>
            @endif

            @if ($prestasi->featured)
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[20px] text-[#FDB913] mt-0.5" style="font-variation-settings:'FILL' 1">star</span>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Status</p>
                    <p class="font-bold text-[#FDB913]">Prestasi Unggulan</p>
                </div>
            </div>
            @endif

            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[#FDB913] text-[20px] mt-0.5">school</span>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Unit</p>
                    <p class="font-bold text-slate-900 dark:text-white">Yayasan Putra Pakuan</p>
                </div>
            </div>
        </div>

        <!-- Call to action -->
        <div class="bg-[#FDB913]/10 border border-[#FDB913]/30 rounded-2xl p-6 text-center">
            <span class="material-symbols-outlined text-[#FDB913] text-4xl mb-3 block" style="font-variation-settings:'FILL' 1">emoji_events</span>
            <p class="text-sm font-bold text-slate-800 dark:text-white mb-1">Bergabunglah bersama kami</p>
            <p class="text-xs text-slate-600 dark:text-slate-400 mb-4">Raih prestasi terbaik di Yayasan Putra Pakuan</p>
            <a href="{{ route('yayasan.kontak') }}"
               class="inline-flex items-center gap-2 bg-[#FDB913] hover:bg-[#E5A800] text-slate-900 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">mail</span>
                Hubungi Kami
            </a>
        </div>
    </aside>
</div>

<!-- ─── Related Prestasi ─────────────────────────────────── -->
@if ($related->isNotEmpty())
<section class="bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700 py-14 px-4 sm:px-6">
    <div class="max-w-[1100px] mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Prestasi Lainnya</h2>
            <a href="{{ route('yayasan.prestasi') }}"
               class="text-sm font-bold text-[#FDB913] hover:text-[#E5A800] flex items-center gap-1 transition-colors">
                Lihat Semua
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($related as $item)
            @php
                $rImageRaw  = trim((string)($item->image_url ?? ''));
                $rImageUrl  = \Illuminate\Support\Str::startsWith($rImageRaw, ['http://', 'https://'])
                    ? $rImageRaw : ($rImageRaw !== '' ? asset(ltrim($rImageRaw, '/')) : asset('images/logo-yayasan.png'));
                $rCategory  = $item->category ?? 'Prestasi';
                $rBadge     = $categoryColors[strtolower(trim($rCategory))] ?? 'bg-slate-600';
                $rYear      = $item->published_at ? \Illuminate\Support\Carbon::parse($item->published_at)->format('Y') : '';
            @endphp
            <a href="{{ route('yayasan.prestasi.show', ['slug' => $item->slug]) }}"
               class="group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative aspect-[4/3] overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                         style="background-image: url('{{ $rImageUrl }}');"></div>
                    <div class="absolute bottom-3 left-3 flex gap-1.5">
                        <span class="{{ $rBadge }} text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">{{ $rCategory }}</span>
                        @if ($item->featured)
                            <span class="bg-[#FDB913] text-slate-900 text-[10px] font-bold px-2 py-1 rounded backdrop-blur-sm flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-[10px]" style="font-variation-settings:'FILL' 1">star</span>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-[#FDB913]">YAYASAN PUTRA PAKUAN</span>
                        @if ($rYear)<span class="text-xs text-slate-500">{{ $rYear }}</span>@endif
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white leading-snug group-hover:text-[#FDB913] transition-colors line-clamp-2">{{ $item->title }}</h3>
                    @if ($item->excerpt)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 line-clamp-2 flex-1">{{ $item->excerpt }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
