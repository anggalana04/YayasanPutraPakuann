@extends('layouts.smk.app')

@section('content')




    <div class="max-w-[1280px] mx-auto px-10 pb-12">
        <section class="mb-10">
            <div class="mb-6">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">Prestasi Siswa</h2>
                <p class="text-slate-600 dark:text-slate-400">Raihan gemilang di tingkat regional, nasional, dan internasional.</p>
                <p class="text-xs text-slate-500 dark:text-slate-300">Total: {{ collect($prestasi ?? [])->count() }} prestasi.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3 xl:gap-6">
                @forelse ($prestasi ?? [] as $item)
                    <a href="{{ route('school.prestasi.show', ['school' => $school, 'slug' => $item->slug]) }}"
                       class="block bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                        <div class="relative h-48 w-full bg-cover bg-center" style="background-image: url('{{ $item->image_url ?? 'https://via.placeholder.com/640x360?text=Tanpa+Gambar' }}');">
                            <div class="absolute top-3 left-3">
                                <span class="bg-blue-600/90 text-white text-xs font-bold px-2 py-1 rounded backdrop-blur-sm">{{ $item->category ?? 'Umum' }}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-[#FDB913]">{{ strtoupper($schoolModel->type ?? $school ?? 'SEKOLAH') }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $item->published_at ? $item->published_at->format('Y') : 'TBD' }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $item->title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-2">{{ \Illuminate\Support\Str::limit($item->excerpt ?? $item->content, 120) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 p-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-center text-slate-500 dark:text-slate-400">
                        Belum ada data prestasi yang ditayangkan. Silakan tambahkan melalui dashboard admin.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection




