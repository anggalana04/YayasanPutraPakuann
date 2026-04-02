@extends('layouts.SMK.app')

@section('title', 'Program Keahlian - SMK Putra Pakuan')
@section('meta_description', 'Temukan program keahlian (jurusan) unggulan di SMK Putra Pakuan. Kurikulum berbasis industri, fasilitas modern, dan lulusan siap kerja.')

@section('content')
<div id="main-content">

{{-- ═══════════════════════════════════════ HERO ══════════════════════════════════════════ --}}
<section class="relative pt-28 pb-20 overflow-hidden bg-charcoal text-white">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-br from-charcoal via-charcoal to-[#2d2910]"></div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#f8f8f5] dark:from-[#18160d] to-transparent"></div>
        {{-- Decorative grid --}}
        <svg class="absolute inset-0 w-full h-full opacity-5" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#f2cc0d" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-6">
        <div class="max-w-2xl">
            <p class="text-primary font-bold tracking-widest text-xs uppercase mb-3">SMK Putra Pakuan</p>
            <h1 class="text-4xl md:text-6xl font-black leading-tight mb-5 tracking-tight">
                Program<br class="md:hidden"> Keahlian
            </h1>
            <p class="text-slate-300 text-lg leading-relaxed max-w-xl">
                Pilih jurusan yang sesuai dengan minat dan bakatmu. Setiap program dirancang bersama industri untuk menghasilkan lulusan yang kompeten dan siap kerja.
            </p>
        </div>
        <div class="mt-8 flex items-center gap-4">
            <div class="h-px flex-1 max-w-xs bg-primary/30"></div>
            <span class="text-primary text-xs font-bold tracking-widest uppercase">{{ $jurusans->count() }} Program Keahlian</span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════ JURUSAN CARDS ═════════════════════════════════ --}}
<section class="py-16 bg-[#f8f8f5] dark:bg-[#18160d]">
    <div class="max-w-7xl mx-auto px-6">

        @if($jurusans->isEmpty())
            <div class="text-center py-20 text-slate-400 dark:text-slate-500">
                <span class="material-symbols-outlined text-5xl mb-4 block">school</span>
                <p class="text-lg font-semibold">Data program keahlian belum tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($jurusans as $jurusan)
                <a href="{{ route('school.jurusan.show', ['school' => 'smk', 'slug' => $jurusan->slug]) }}"
                   class="group relative bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">

                    {{-- Cover image --}}
                    <div class="relative h-52 overflow-hidden bg-slate-200 dark:bg-slate-700">
                        @if($jurusan->cover_image_url)
                            <img src="{{ $jurusan->cover_image_url }}"
                                 alt="{{ $jurusan->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center"
                                 style="background: linear-gradient(135deg, {{ $jurusan->accent_color }}22 0%, {{ $jurusan->accent_color }}44 100%)">
                                <span class="material-symbols-outlined text-7xl" style="color: {{ $jurusan->accent_color }}">{{ $jurusan->icon }}</span>
                            </div>
                        @endif
                        {{-- Accent badge --}}
                        @if($jurusan->short_name)
                        <div class="absolute top-4 right-4">
                            <span class="text-xs font-black px-3 py-1.5 rounded-full shadow"
                                  style="background: {{ $jurusan->accent_color }}; color: #1c190d;">
                                {{ $jurusan->short_name }}
                            </span>
                        </div>
                        @endif
                        {{-- Cover gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 mt-0.5"
                                 style="background: {{ $jurusan->accent_color }}22;">
                                <span class="material-symbols-outlined text-xl" style="color: {{ $jurusan->accent_color }}">{{ $jurusan->icon }}</span>
                            </div>
                            <div>
                                <h2 class="font-black text-charcoal dark:text-white text-lg leading-snug group-hover:text-[#6c5a00] dark:group-hover:text-primary transition-colors">
                                    {{ $jurusan->name }}
                                </h2>
                                @if($jurusan->tagline)
                                <p class="text-xs font-semibold mt-0.5" style="color: {{ $jurusan->accent_color }}">{{ $jurusan->tagline }}</p>
                                @endif
                            </div>
                        </div>

                        @if($jurusan->description)
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 flex-1">
                            {{ $jurusan->description }}
                        </p>
                        @endif

                        <div class="mt-5 flex items-center gap-2 text-xs font-bold" style="color: {{ $jurusan->accent_color }}">
                            <span>Lihat Detail</span>
                            <span class="material-symbols-outlined text-base transition-transform duration-300 group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </div>

                    {{-- Bottom accent strip --}}
                    <div class="h-1 w-0 group-hover:w-full transition-all duration-500 rounded-b-3xl"
                         style="background: {{ $jurusan->accent_color }}"></div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════ CTA ══════════════════════════════════════════ --}}
<section class="py-16 bg-charcoal text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <p class="text-primary font-bold tracking-widest text-xs uppercase mb-3">Siap Bergabung?</p>
        <h2 class="text-3xl md:text-4xl font-black mb-5">Daftarkan Dirimu Sekarang</h2>
        <p class="text-slate-300 mb-8 max-w-xl mx-auto">Jadilah bagian dari lulusan SMK Putra Pakuan yang kompeten, berkarakter, dan berdaya saing tinggi.</p>
        <a href="{{ route('school.ppdb', ['school' => 'smk']) }}"
           class="inline-flex items-center gap-2 bg-primary text-charcoal font-black px-8 py-4 rounded-2xl hover:bg-primary/90 transition-all text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5">
            <span class="material-symbols-outlined">how_to_reg</span>
            Daftar PPDB Online
        </a>
    </div>
</section>

</div>
@endsection
