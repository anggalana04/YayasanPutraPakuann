@extends('layouts.app')

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')
    @if (!empty($pageContent))
        {!! $pageContent !!}
    @else
    @php
        $prestasiItems = isset($prestasiItems) && $prestasiItems instanceof \Illuminate\Support\Collection
            ? $prestasiItems
            : collect();

        $categories = $prestasiItems->pluck('category')->filter()->unique()->sort()->values();

        $categoryColors = [
            'akademik'      => 'bg-blue-600/90',
            'olahraga'      => 'bg-orange-500/90',
            'seni'          => 'bg-purple-600/90',
            'seni & budaya' => 'bg-purple-600/90',
            'teknologi'     => 'bg-cyan-600/90',
            'pramuka'       => 'bg-green-600/90',
            'agama'         => 'bg-emerald-600/90',
            'karya tulis'   => 'bg-rose-600/90',
        ];
    @endphp

    <!-- Breadcrumb -->
    <div class="w-full px-4 sm:px-10 pt-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400">
            <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
            <span>/</span>
            <span class="text-slate-900 dark:text-white">Prestasi</span>
        </div>
    </div>

    <!-- Main Section — matches Achievements section style in index -->
    <section class="w-full flex justify-center px-4 sm:px-10 py-10 pb-20 bg-slate-50 dark:bg-background-dark">
        <div class="w-full max-w-[1400px]">

            <!-- Section Header -->
            <div class="flex flex-col gap-2 mb-8">
                <h1 class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Jejak Langkah Prestasi</h1>
                <p class="text-slate-600 dark:text-slate-400">Raihan gemilang siswa-siswi kami di tingkat regional, nasional, hingga internasional.</p>
            </div>

            <!-- Category Filters -->
            @if ($categories->isNotEmpty())
            <div class="flex overflow-x-auto pb-4 gap-2 mb-8 no-scrollbar">
                <button
                    class="prestasi-filter-btn px-5 py-2.5 rounded-lg text-sm whitespace-nowrap transition-all"
                    style="background:#FDB913;color:white;font-weight:700;box-shadow:0 4px 12px rgba(253,185,19,0.3)"
                    data-filter="all"
                >Semua Prestasi</button>
                @foreach ($categories as $cat)
                <button
                    class="prestasi-filter-btn px-5 py-2.5 rounded-lg text-sm font-medium whitespace-nowrap transition-all bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700"
                    data-filter="{{ $cat }}"
                >{{ $cat }}</button>
                @endforeach
            </div>
            @endif

            <!-- Cards Grid -->
            <div id="prestasi-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($prestasiItems as $item)
                    @php
                        $imageRaw   = trim((string)($item->image_url ?? ''));
                        $imageUrl   = \Illuminate\Support\Str::startsWith($imageRaw, ['http://', 'https://'])
                            ? $imageRaw
                            : asset(ltrim($imageRaw, '/'));
                        $title      = $item->title ?? 'Prestasi';
                        $category   = $item->category ?? 'Prestasi';
                        $excerpt    = $item->excerpt ?? '';
                        $year       = $item->published_at
                            ? \Illuminate\Support\Carbon::parse($item->published_at)->format('Y')
                            : ($item->created_at ? \Illuminate\Support\Carbon::parse($item->created_at)->format('Y') : '-');
                        $featured   = (bool)($item->featured ?? false);
                        $badgeColor = $categoryColors[strtolower(trim($category))] ?? 'bg-slate-600/90';
                    @endphp
                    <div
                        class="prestasi-card group flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                        data-category="{{ $category }}"
                    >
                        <div class="relative h-48 w-full overflow-hidden">
                            <div
                                class="absolute inset-0 bg-cover bg-center bg-slate-100 dark:bg-slate-700 transition-transform duration-500 group-hover:scale-110"
                                style="background-image: url('{{ $imageUrl }}');"
                            ></div>
                            <div class="absolute bottom-3 left-3 flex items-center gap-1.5">
                                <span class="{{ $badgeColor }} text-white text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm">{{ $category }}</span>
                                @if ($featured)
                                    <span class="bg-[#FDB913] text-slate-900 text-[10px] font-bold uppercase px-2 py-1 rounded backdrop-blur-sm flex items-center gap-0.5">
                                        <span class="material-symbols-outlined" style="font-size:11px;font-variation-settings:'FILL' 1">star</span>
                                        Unggulan
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col flex-1 p-5">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-[#FDB913] tracking-wide">YAYASAN PUTRA PAKUAN</span>
                                <span class="text-xs text-slate-500 dark:text-slate-500">{{ $year }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-2">{{ $title }}</h3>
                            @if ($excerpt)
                                <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 flex-1">{{ $excerpt }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 xl:col-span-4 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 p-14 text-center bg-white dark:bg-slate-800">
                        <span class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600 mb-3 block">emoji_events</span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada prestasi dipublikasikan</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm">Tambahkan konten dari menu Kelola Prestasi di CMS Yayasan.</p>
                    </div>
                @endforelse

                <!-- Empty state for filtered results -->
                <div id="prestasi-no-result" class="hidden md:col-span-2 lg:col-span-3 xl:col-span-4 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 p-14 text-center bg-white dark:bg-slate-800">
                    <span class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600 mb-3 block">search_off</span>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Tidak ada prestasi di kategori ini</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Coba pilih kategori lain.</p>
                </div>
            </div>

            <!-- Result count -->
            <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">
                Menampilkan <span id="prestasi-count-num">{{ $prestasiItems->count() }}</span> dari {{ $prestasiItems->count() }} prestasi
            </p>
        </div>
    </section>

    <script>
    (function () {
        var filterBtns = document.querySelectorAll('.prestasi-filter-btn');
        var cards      = document.querySelectorAll('.prestasi-card');
        var noResult   = document.getElementById('prestasi-no-result');
        var countNum   = document.getElementById('prestasi-count-num');

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var filter = this.dataset.filter;

                // Reset all to inactive
                filterBtns.forEach(function (b) {
                    b.style.background = '';
                    b.style.color      = '';
                    b.style.fontWeight = '';
                    b.style.boxShadow  = '';
                });

                // Mark this one active
                this.style.background = '#FDB913';
                this.style.color      = 'white';
                this.style.fontWeight = '700';
                this.style.boxShadow  = '0 4px 12px rgba(253,185,19,0.3)';

                // Show / hide cards
                var visible = 0;
                cards.forEach(function (card) {
                    if (filter === 'all' || (card.dataset.category || '') === filter) {
                        card.classList.remove('hidden');
                        visible++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (noResult)  noResult.classList.toggle('hidden', visible > 0);
                if (countNum)  countNum.textContent = visible;
            });
        });
    }());
    </script>
    @endif
@endsection




