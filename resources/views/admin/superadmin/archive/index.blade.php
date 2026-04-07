@extends('layouts.admin.app')

@section('title', 'Arsip Digital - Admin')

@section('content')
<div class="pt-8 pb-16">

    {{-- Page Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">folder_open</span>
            <h1 class="text-3xl font-bold font-headline text-on-surface tracking-tight">Arsip Digital</h1>
        </div>
        <p class="text-on-surface-variant text-sm">Kelola data siswa dan rekam jejak penerimaan per sekolah dan tahun ajaran.</p>
    </div>

    {{-- School Cards --}}
    @if($schools->isEmpty())
        <div class="rounded-3xl bg-surface-container p-16 flex flex-col items-center gap-4 text-center">
            <span class="material-symbols-outlined text-5xl text-outline-variant">folder_off</span>
            <p class="text-on-surface-variant font-medium">Tidak ada data sekolah yang dapat diakses.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($schools as $school)
                @php
                    $colors = match(strtoupper($school->type)) {
                        'SDIT'  => ['bg' => 'bg-[#e8f5e9]', 'icon_bg' => 'bg-[#4caf50]', 'text' => 'text-[#1b5e20]', 'badge' => 'bg-[#c8e6c9] text-[#1b5e20]'],
                        'SMP'   => ['bg' => 'bg-[#e3f2fd]', 'icon_bg' => 'bg-[#2196f3]', 'text' => 'text-[#0d47a1]', 'badge' => 'bg-[#bbdefb] text-[#0d47a1]'],
                        'SMK'   => ['bg' => 'bg-[#fff3e0]', 'icon_bg' => 'bg-[#ff9800]', 'text' => 'text-[#e65100]', 'badge' => 'bg-[#ffe0b2] text-[#e65100]'],
                        default => ['bg' => 'bg-surface-container', 'icon_bg' => 'bg-outline', 'text' => 'text-on-surface', 'badge' => 'bg-surface-container-high text-on-surface-variant'],
                    };
                    $slug = strtolower($school->type === 'SDIT' ? 'sd' : $school->type);
                    $latestYear = $school->year_list->first();
                @endphp
                <div class="{{ $colors['bg'] }} rounded-3xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 group">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="{{ $colors['icon_bg'] }} w-14 h-14 rounded-2xl flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-white text-2xl" style="font-variation-settings: 'FILL' 1;">school</span>
                            </div>
                            <div>
                                <span class="{{ $colors['badge'] }} text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full">{{ $school->type }}</span>
                                <h2 class="{{ $colors['text'] }} text-lg font-bold font-headline mt-1 leading-tight">{{ $school->name }}</h2>
                            </div>
                        </div>
                    </div>

                    {{-- Stats chips --}}
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-white/60 backdrop-blur-sm text-on-surface text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">calendar_month</span>
                            {{ $school->year_list->count() }} Tahun Ajaran
                        </span>
                        <span class="bg-white/60 backdrop-blur-sm text-on-surface text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">people</span>
                            {{ number_format($school->total_students) }} Siswa
                        </span>
                    </div>

                    {{-- Year list --}}
                    @if($school->year_list->isNotEmpty())
                        <div class="space-y-2 mb-6">
                            @foreach($school->year_list->take(4) as $year)
                                <a href="{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $year)) }}"
                                   class="flex items-center justify-between bg-white/70 hover:bg-white/90 transition-colors px-4 py-3 rounded-2xl group/item">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-sm {{ $colors['text'] }}">folder</span>
                                        <span class="font-semibold text-on-surface text-sm">{{ $year }}</span>
                                    </div>
                                    <span class="material-symbols-outlined text-sm text-outline-variant group-hover/item:text-on-surface transition-colors">chevron_right</span>
                                </a>
                            @endforeach
                            @if($school->year_list->count() > 4)
                                <p class="text-xs text-on-surface-variant text-center pt-1">+{{ $school->year_list->count() - 4 }} tahun ajaran lainnya</p>
                            @endif
                        </div>
                    @else
                        <p class="text-sm text-on-surface-variant italic mb-6">Belum ada data siswa.</p>
                    @endif

                    {{-- Action button --}}
                    @if($latestYear)
                        <a href="{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $latestYear)) }}"
                           class="{{ $colors['icon_bg'] }} text-white w-full py-3 rounded-2xl flex items-center justify-center gap-2 font-bold text-sm hover:opacity-90 transition-opacity active:scale-95">
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                            Buka Tahun Terbaru
                        </a>
                    @else
                        <div class="text-center text-xs text-on-surface-variant bg-white/40 py-3 rounded-2xl">Belum ada data</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- Info banner --}}
    <div class="mt-10 bg-primary-container/30 border border-primary-container rounded-3xl p-6 flex items-start gap-4">
        <span class="material-symbols-outlined text-primary shrink-0" style="font-variation-settings: 'FILL' 1;">info</span>
        <div>
            <p class="font-bold text-on-surface text-sm mb-1">Cara menggunakan Arsip Digital</p>
            <p class="text-on-surface-variant text-sm">Pilih sekolah dan tahun ajaran untuk melihat daftar siswa, berkas dokumen, dan statistik penerimaan. Siswa diterima dari SPMB dapat dipromosikan langsung dari halaman detail pendaftar.</p>
        </div>
    </div>
</div>
@endsection
