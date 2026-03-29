@extends('layouts.app')

@section('content')
    @if (!empty($pageContent))
        {!! $pageContent !!}
    @else
    @php
        $facilityItems = isset($facilityItems) && $facilityItems instanceof \Illuminate\Support\Collection
            ? $facilityItems
            : collect();
    @endphp
    <!-- Breadcrumb -->
    <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-8 pt-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 dark:text-slate-400 mb-4">
            <a class="hover:text-slate-900 dark:hover:text-white transition-colors" href="/">Beranda</a>
            <span>/</span>
            <span class="text-slate-900 dark:text-white">Fasilitas</span>
        </div>
    </div>

    <main class="w-full max-w-[1280px] mx-auto px-4 sm:px-8 pb-16">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">Fasilitas Yayasan</h1>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Sarana &amp; prasarana yang mendukung kegiatan dan pembelajaran</p>
            </div>
            <div class="self-start rounded-xl bg-slate-100 dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                {{ $facilityItems->count() }} fasilitas
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3 xl:gap-6">
            @forelse ($facilityItems as $item)
                        @php
                            $imageRaw = trim((string)($item['image_url'] ?? $item->image_url ?? ''));
                            $imageUrl = \Illuminate\Support\Str::startsWith($imageRaw, ['http://', 'https://'])
                                ? $imageRaw
                                : asset(ltrim($imageRaw, '/'));
                            $title = $item['title'] ?? $item->title ?? 'Fasilitas';
                            $description = $item['description'] ?? $item->description ?? 'Informasi fasilitas belum diisi.';
                        @endphp
                        <div class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                            <div class="aspect-video w-full bg-cover bg-center bg-slate-100 dark:bg-slate-700" style='background-image: url("{{ $imageUrl }}");'></div>
                            <div class="p-5">
                                <div class="text-[#FDB913] text-xs font-bold uppercase tracking-wide mb-2">Yayasan Putra Pakuan</div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 leading-tight">{{ $title }}</h3>
                                <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300 line-clamp-3">{{ $description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 xl:col-span-3 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 p-12 text-center bg-slate-50 dark:bg-slate-800/50">
                            <div class="w-12 h-12 rounded-2xl bg-slate-200 dark:bg-slate-700 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-slate-400">apartment</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada fasilitas dipublikasikan</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm">Tambahkan konten dari menu Kelola Fasilitas di CMS Yayasan.</p>
                        </div>
                    @endforelse
        </div>
    </main>
    @endif
@endsection




