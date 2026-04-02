@extends('layouts.admin.app')

@section('content')
<!-- Dashboard Canvas -->
<div class="p-8 max-w-7xl mx-auto">
    <!-- Hero Stats Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Stat Card 1 -->
        <div class="col-span-1 md:col-span-2 bg-[#1c190d] rounded-3xl p-8 relative overflow-hidden text-white flex flex-col justify-between h-64">
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium tracking-wide mb-1">Total Pendaftar (Semua Jenjang)</p>
                <h2 class="text-5xl font-bold tracking-tight text-[#f2cc0d]">{{ number_format($masterTotalApplicants ?? 0) }}</h2>
            </div>
            <div class="relative z-10 flex items-center gap-2 text-sm text-green-400 font-medium">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                <span>Realtime angka ter-update</span>
            </div>
            <div class="absolute -right-10 -bottom-10 opacity-10">
                <span class="material-symbols-outlined text-[12rem]">groups</span>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-surface-container-lowest rounded-3xl p-6 flex flex-col justify-between border-none shadow-sm h-64">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-2xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="pending_actions">pending_actions</span>
                </div>
                <span class="bg-error-container/20 text-error font-bold text-[10px] px-2 py-1 rounded-full uppercase">Perlu Tindakan</span>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-on-surface">{{ number_format($pendingVerifications ?? 0) }}</h3>
                <p class="text-on-surface-variant text-sm font-medium">Verifikasi Tertunda</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @foreach($jenjangStats as $stat)
            <div class="rounded-3xl p-6 border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1f1f1f] shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs font-bold uppercase text-gray-500 dark:text-gray-300">{{ $stat['type'] }} Applicants</p>
                        <h3 class="text-3xl font-black text-[#1c190d] dark:text-white">{{ number_format($stat['totalApplicants'] ?? 0) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">school</span>
                    </div>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-300 mb-2">Phase: <strong>{{ $stat['activePhase'] ?? 'N/A' }}</strong></p>
                <p class="text-xs text-slate-500 dark:text-slate-300">Status: <span class="font-bold {{ $stat['isLive'] ? 'text-emerald-600' : 'text-amber-500' }}">{{ $stat['isLive'] ? 'Live' : 'Offline' }}</span></p>
                <p class="text-xs text-slate-400 dark:text-slate-400 mt-1">Berakhir dalam: {{ $stat['endsIn'] !== null ? $stat['endsIn'] . ' hari lagi' : 'N/A' }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Activity Panel -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Analytics Teaser -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-on-surface">Pengunjung Website</h3>
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-2 text-xs font-medium text-on-surface-variant">
                            <span class="w-2 h-2 rounded-full bg-primary-container"></span> Mobile
                        </span>
                        <span class="flex items-center gap-2 text-xs font-medium text-on-surface-variant">
                            <span class="w-2 h-2 rounded-full bg-[#1c190d]"></span> Desktop
                        </span>
                    </div>
                </div>
                <!-- Visual representation of data from real PPDB applicants -->
                @php
                    $weeklyMax = max($weeklyApplicants->pluck('count')->max(), 1);
                @endphp
                <div class="h-48 w-full flex items-end gap-3 px-4">
                    @foreach($weeklyApplicants as $item)
                        @php
                            $heightPercent = $weeklyMax ? max(8, round(($item['count'] / $weeklyMax) * 100)) : 8;
                        @endphp
                        <div class="w-full bg-surface-container-low rounded-t-xl relative group" style="height: 100%;">
                            <div class="absolute bottom-0 w-full bg-primary-container rounded-t-xl transition-all" style="height: {{ $heightPercent }}%;"></div>
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-7 mt-4 px-4 text-[10px] text-outline font-bold uppercase tracking-wider text-center">
                    @foreach($weeklyApplicants as $item)
                        <span>{{ $item['label'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Right Sidebar: Recent Activity & Aksi Cepat -->
        <div class="space-y-8">
            <!-- Quick Navigation -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm">
                <h3 class="text-lg font-bold mb-6 text-on-surface">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    @php $academicYear = now()->year . '/' . (now()->year + 1); @endphp
                    <a href="{{ route('admin.ppdb.applicants.by_school', ['school' => 'sdit-putra-pakuan']) }}?year={{ urlencode($academicYear) }}" class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-4xl text-primary">school</span>
                        <span class="text-xs font-bold text-on-surface">Pendaftar SD</span>
                        <span class="text-[10px] text-on-surface-variant">{{ $academicYear }}</span>
                    </a>
                    <a href="{{ route('admin.ppdb.applicants.by_school', ['school' => 'smp-putra-pakuan']) }}?year={{ urlencode($academicYear) }}" class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-4xl text-primary">groups</span>
                        <span class="text-xs font-bold text-on-surface">Pendaftar SMP</span>
                        <span class="text-[10px] text-on-surface-variant">{{ $academicYear }}</span>
                    </a>
                    <a href="{{ route('admin.ppdb.applicants.smk') }}?year={{ urlencode($academicYear) }}" class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-4xl text-primary">engineering</span>
                        <span class="text-xs font-bold text-on-surface">Pendaftar SMK</span>
                        <span class="text-[10px] text-on-surface-variant">{{ $academicYear }}</span>
                    </a>
                    <a href="{{ route('admin.ppdb.applicants.smk') }}?year={{ urlencode($academicYear) }}&status=pending" class="p-4 rounded-3xl bg-surface-container-low hover:bg-error-container/20 transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-4xl text-error">pending_actions</span>
                        <span class="text-xs font-bold text-on-surface">Tertunda</span>
                        <span class="text-[10px] text-error font-medium">{{ $pendingVerifications }} menunggu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





