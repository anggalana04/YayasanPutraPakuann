@extends('layouts.SMK.app')

@section('title', $jurusan->name . ' - SMK Putra Pakuan')
@section('meta_description', $jurusan->tagline ?? 'Program keahlian ' . $jurusan->name . ' di SMK Putra Pakuan.')
@section('meta_image', $jurusan->cover_image_url ?? asset('images/logo-yayasan.png'))

@section('hero_page', '1')

@section('content')

{{-- ═══════════════════════════ HERO ════════════════════════════════════════════ --}}
<section class="relative min-h-[70vh] flex items-end overflow-hidden" data-hero-section>

    {{-- Background Image or Gradient --}}
    @if($jurusan->cover_image_url)
    <div class="absolute inset-0">
        <img src="{{ $jurusan->cover_image_url }}" alt="{{ $jurusan->name }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/60 to-charcoal/20"></div>
    </div>
    @else
    <div class="absolute inset-0" style="background: linear-gradient(135deg, #1c190d 0%, {{ $jurusan->accent_color }}33 100%)">
        <svg class="absolute inset-0 w-full h-full opacity-5" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid2" width="50" height="50" patternUnits="userSpaceOnUse">
                    <path d="M 50 0 L 0 0 0 50" fill="none" stroke="#f2cc0d" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid2)"/>
        </svg>
    </div>
    @endif

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 pb-14 pt-36">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
            <a href="{{ route('school.home', ['school' => 'smk']) }}" class="hover:text-primary transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('school.jurusan.index', ['school' => 'smk']) }}" class="hover:text-primary transition-colors">Program Keahlian</a>
            <span>/</span>
            <span class="text-white">{{ $jurusan->short_name ?? $jurusan->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-6">
            <div class="flex-1">
                @if($jurusan->short_name)
                <span class="inline-block text-xs font-black px-3 py-1.5 rounded-full mb-4"
                      style="background: {{ $jurusan->accent_color }}; color: #1c190d;">
                    {{ $jurusan->short_name }}
                </span>
                @endif
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight tracking-tight mb-4">
                    {{ $jurusan->name }}
                </h1>
                @if($jurusan->tagline)
                <p class="text-lg font-semibold" style="color: {{ $jurusan->accent_color }}">
                    {{ $jurusan->tagline }}
                </p>
                @endif
            </div>

            <div class="flex gap-3 shrink-0">
                <a href="{{ route('school.ppdb', ['school' => 'smk']) }}"
                   class="inline-flex items-center gap-2 font-black px-6 py-3 rounded-2xl text-sm shadow transition-all hover:-translate-y-0.5"
                   style="background: {{ $jurusan->accent_color }}; color: #1c190d;">
                    <span class="material-symbols-outlined">how_to_reg</span>
                    Daftar Sekarang
                </a>
                <a href="{{ route('school.jurusan.index', ['school' => 'smk']) }}"
                   class="inline-flex items-center gap-2 font-bold px-6 py-3 rounded-2xl text-sm bg-white/10 text-white hover:bg-white/20 backdrop-blur transition-all">
                    <span class="material-symbols-outlined">grid_view</span>
                    Semua Jurusan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════ DESCRIPTION + RICH CONTENT ══════════════════════ --}}
<section class="py-16 bg-[#f8f8f5] dark:bg-[#18160d]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Main content --}}
            <div class="lg:col-span-2">
                @if($jurusan->description)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-sm mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                             style="background: {{ $jurusan->accent_color }}22;">
                            <span class="material-symbols-outlined" style="color: {{ $jurusan->accent_color }}">{{ $jurusan->icon }}</span>
                        </div>
                        <h2 class="text-xl font-black text-charcoal dark:text-white">Tentang Program Ini</h2>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $jurusan->description }}</p>
                </div>
                @endif

                @if($jurusan->content)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-sm jurusan-rich-content">
                    {!! $jurusan->content !!}
                </div>
                @else
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-10 shadow-sm text-center text-slate-400 dark:text-slate-500">
                    <span class="material-symbols-outlined text-4xl mb-3 block">article</span>
                    <p>Konten detail jurusan belum tersedia.</p>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Quick Info --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm">
                    <h3 class="font-black text-charcoal dark:text-white text-lg mb-4">Info Singkat</h3>
                    <div class="space-y-3">
                        @if($jurusan->short_name)
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-base text-slate-400">badge</span>
                            <span class="text-slate-500 dark:text-slate-400">Kode Jurusan</span>
                            <span class="font-bold ml-auto">{{ $jurusan->short_name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-base text-slate-400">school</span>
                            <span class="text-slate-500 dark:text-slate-400">Jenjang</span>
                            <span class="font-bold ml-auto">SMK</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-base text-slate-400">schedule</span>
                            <span class="text-slate-500 dark:text-slate-400">Durasi</span>
                            <span class="font-bold ml-auto">3 Tahun</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-100 dark:border-slate-700">
                        <a href="{{ route('school.ppdb', ['school' => 'smk']) }}"
                           class="w-full flex items-center justify-center gap-2 font-black px-4 py-3 rounded-2xl text-sm transition-all hover:opacity-90"
                           style="background: {{ $jurusan->accent_color }}; color: #1c190d;">
                            <span class="material-symbols-outlined">how_to_reg</span>
                            Daftar Jurusan Ini
                        </a>
                    </div>
                </div>

                {{-- Other Jurusan --}}
                @if($otherJurusans->isNotEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm">
                    <h3 class="font-black text-charcoal dark:text-white text-lg mb-4">Program Lainnya</h3>
                    <div class="space-y-2">
                        @foreach($otherJurusans as $other)
                        <a href="{{ route('school.jurusan.show', ['school' => 'smk', 'slug' => $other->slug]) }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors group">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                 style="background: {{ $other->accent_color }}22;">
                                <span class="material-symbols-outlined text-sm" style="color: {{ $other->accent_color }}">{{ $other->icon }}</span>
                            </div>
                            <span class="text-sm font-semibold text-charcoal dark:text-white group-hover:text-[#6c5a00] dark:group-hover:text-primary transition-colors line-clamp-1">
                                {{ $other->name }}
                            </span>
                            <span class="material-symbols-outlined text-sm text-slate-400 ml-auto transition-transform group-hover:translate-x-1">chevron_right</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════ PRESTASI CAROUSEL ══════════════════════════════ --}}
@if($prestasi->isNotEmpty())
<section class="py-16 bg-white dark:bg-slate-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="font-bold tracking-widest text-xs uppercase mb-2" style="color: {{ $jurusan->accent_color }}">Prestasi Siswa</p>
                <h2 class="text-3xl md:text-4xl font-black text-charcoal dark:text-white">Raihan Gemilang</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2">Pencapaian membanggakan dari siswa SMK Putra Pakuan.</p>
            </div>
            <div class="hidden md:flex items-center gap-2">
                <button id="prestasi-prev"
                        class="w-10 h-10 rounded-full border-2 flex items-center justify-center transition-colors hover:text-white"
                        style="border-color: {{ $jurusan->accent_color }}; color: {{ $jurusan->accent_color }}"
                        onmouseenter="this.style.background='{{ $jurusan->accent_color }}'"
                        onmouseleave="this.style.background='transparent'">
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </button>
                <button id="prestasi-next"
                        class="w-10 h-10 rounded-full border-2 flex items-center justify-center transition-colors hover:text-white"
                        style="border-color: {{ $jurusan->accent_color }}; color: {{ $jurusan->accent_color }}"
                        onmouseenter="this.style.background='{{ $jurusan->accent_color }}'"
                        onmouseleave="this.style.background='transparent'">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </button>
            </div>
        </div>

        {{-- Carousel track --}}
        <div class="overflow-hidden" id="prestasi-carousel-outer">
            <div class="flex gap-6 transition-transform duration-500 ease-in-out" id="prestasi-track"
                 style="width: max-content;">
                @foreach($prestasi as $item)
                <div class="w-72 shrink-0 bg-[#f8f8f5] dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 flex flex-col">
                    <div class="relative h-44 w-full overflow-hidden bg-slate-200 dark:bg-slate-700">
                        @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800">
                            <span class="material-symbols-outlined text-5xl text-slate-400">emoji_events</span>
                        </div>
                        @endif
                        @if($item->category)
                        <div class="absolute top-3 left-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full text-charcoal"
                                  style="background: {{ $jurusan->accent_color }}">
                                {{ $item->category }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-2">
                            <span class="font-bold uppercase text-[10px] tracking-wider">SMK PUTRA PAKUAN</span>
                            <span>{{ $item->published_at ? $item->published_at->format('Y') : '' }}</span>
                        </div>
                        <h3 class="font-black text-charcoal dark:text-white text-sm leading-snug flex-1">
                            {{ $item->title }}
                        </h3>
                        @if($item->excerpt)
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ $item->excerpt }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Mobile prev/next --}}
        <div class="flex items-center justify-center gap-4 mt-8 md:hidden">
            <button id="prestasi-prev-mobile"
                    class="w-10 h-10 rounded-full border-2 flex items-center justify-center"
                    style="border-color: {{ $jurusan->accent_color }}; color: {{ $jurusan->accent_color }}">
                <span class="material-symbols-outlined text-base">chevron_left</span>
            </button>
            <button id="prestasi-next-mobile"
                    class="w-10 h-10 rounded-full border-2 flex items-center justify-center"
                    style="border-color: {{ $jurusan->accent_color }}; color: {{ $jurusan->accent_color }}">
                <span class="material-symbols-outlined text-base">chevron_right</span>
            </button>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════ CTA ═════════════════════════════════════════════ --}}
<section class="py-20 bg-charcoal text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <p class="font-bold tracking-widest text-xs uppercase mb-3" style="color: {{ $jurusan->accent_color }}">
            Tertarik dengan {{ $jurusan->short_name ?? $jurusan->name }}?
        </p>
        <h2 class="text-3xl md:text-4xl font-black mb-5">Bergabunglah Bersama Kami</h2>
        <p class="text-slate-300 mb-8 max-w-xl mx-auto">
            Jadilah bagian dari generasi unggul SMK Putra Pakuan. Daftarkan dirimu sekarang melalui SPMB online.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('school.ppdb', ['school' => 'smk']) }}"
               class="inline-flex items-center justify-center gap-2 font-black px-8 py-4 rounded-2xl text-sm shadow-lg hover:-translate-y-0.5 transition-all"
               style="background: {{ $jurusan->accent_color }}; color: #1c190d;">
                <span class="material-symbols-outlined">how_to_reg</span>
                Daftar SPMB Online
            </a>
            <a href="{{ route('school.kontak', ['school' => 'smk']) }}"
               class="inline-flex items-center justify-center gap-2 font-bold px-8 py-4 rounded-2xl text-sm bg-white/10 hover:bg-white/20 backdrop-blur transition-all">
                <span class="material-symbols-outlined">chat</span>
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

</div>

{{-- Rich Content Styles --}}
<style>
.jurusan-rich-content {
    line-height: 1.8;
    color: #374151;
}
.dark .jurusan-rich-content {
    color: #d1d5db;
}
.jurusan-rich-content h1,
.jurusan-rich-content h2,
.jurusan-rich-content h3,
.jurusan-rich-content h4 {
    font-weight: 900;
    margin-top: 1.75rem;
    margin-bottom: 0.75rem;
    color: #1c190d;
    line-height: 1.3;
}
.dark .jurusan-rich-content h1,
.dark .jurusan-rich-content h2,
.dark .jurusan-rich-content h3 { color: #f1f5f9; }
.jurusan-rich-content h1 { font-size: 2rem; }
.jurusan-rich-content h2 { font-size: 1.5rem; }
.jurusan-rich-content h3 { font-size: 1.25rem; }
.jurusan-rich-content p { margin-bottom: 1rem; }
.jurusan-rich-content ul,
.jurusan-rich-content ol {
    padding-left: 1.75rem;
    margin-bottom: 1rem;
}
.jurusan-rich-content ul { list-style-type: disc; }
.jurusan-rich-content ol { list-style-type: decimal; }
.jurusan-rich-content li { margin-bottom: 0.35rem; }
.jurusan-rich-content a { color: #6c5a00; text-decoration: underline; }
.dark .jurusan-rich-content a { color: #f2cc0d; }
.jurusan-rich-content blockquote {
    border-left: 4px solid #f2cc0d;
    padding-left: 1.25rem;
    color: #6b7280;
    font-style: italic;
    margin: 1.5rem 0;
    background: #fafaf7;
    border-radius: 0 0.75rem 0.75rem 0;
    padding: 1rem 1.25rem;
}
.dark .jurusan-rich-content blockquote { background: #1e1c10; color: #9ca3af; }
.jurusan-rich-content pre,
.jurusan-rich-content code {
    background: #f3f3f0;
    border-radius: 0.5rem;
    font-size: 0.9em;
}
.dark .jurusan-rich-content pre,
.dark .jurusan-rich-content code { background: #1a1912; }
.jurusan-rich-content pre { padding: 1rem; overflow-x: auto; margin-bottom: 1rem; }
.jurusan-rich-content code { padding: 0.15rem 0.4rem; }
.jurusan-rich-content img {
    max-width: 100%;
    border-radius: 1rem;
    margin: 1.25rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.jurusan-rich-content video,
.jurusan-rich-content audio {
    max-width: 100%;
    border-radius: 0.75rem;
    margin: 1.25rem 0;
}
.jurusan-rich-content iframe {
    max-width: 100%;
    border-radius: 0.75rem;
    margin: 1.25rem 0;
    aspect-ratio: 16/9;
    width: 100%;
}
.jurusan-rich-content table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.25rem;
    font-size: 0.9em;
}
.jurusan-rich-content th,
.jurusan-rich-content td {
    border: 1px solid #e5e7eb;
    padding: 0.6rem 0.9rem;
}
.jurusan-rich-content th { background: #f9f8f3; font-weight: 700; }
.dark .jurusan-rich-content th { background: #1e1d15; }
.dark .jurusan-rich-content td,
.dark .jurusan-rich-content th { border-color: #374151; }
</style>

{{-- Prestasi Carousel Script --}}
@if($prestasi->isNotEmpty())
<script>
(function () {
    const track      = document.getElementById('prestasi-track');
    const cardWidth  = 288 + 24; // w-72 (288px) + gap-6 (24px)
    const total      = {{ $prestasi->count() }};
    let   current    = 0;

    function slide(dir) {
        current = (current + dir + total) % total;
        const outer     = document.getElementById('prestasi-carousel-outer');
        const maxScroll = Math.max(0, total - Math.floor(outer.offsetWidth / cardWidth));
        const clamped   = Math.min(current, maxScroll);
        track.style.transform = `translateX(-${clamped * cardWidth}px)`;
    }

    ['prestasi-prev', 'prestasi-prev-mobile'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', () => slide(-1));
    });
    ['prestasi-next', 'prestasi-next-mobile'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', () => slide(1));
    });

    // Auto-slide every 5 seconds
    setInterval(() => slide(1), 5000);
})();
</script>
@endif
@endsection
