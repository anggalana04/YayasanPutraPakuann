@extends('layouts.admin.app')

@section('title', 'Manajemen PPDB - SMP Putra Pakuan CMS')

@section('content')
<div class="p-8 max-w-7xl mx-auto w-full">
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-100 text-rose-800 border border-rose-200">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">Manajemen PPDB</h2>
            <p class="text-on-surface-variant mt-1">{{ $school->name }}</p>
        </div>
    </div>

    <!-- Year Selection & Controls Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Main Year Selector -->
        <div class="md:col-span-2 bg-gradient-to-br from-primary-container to-primary-container/50 rounded-3xl p-8 border border-primary-container">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">calendar_today</span>
                Pilih Periode Tahun Ajaran
            </h3>
            <form method="GET" action="{{ route('admin.ppdb.management', ['school' => $school->slug]) }}" class="flex gap-3 items-end flex-wrap">
                <div class="flex-1 min-w-64">
                    <label class="block text-xs font-bold text-on-surface-variant mb-2 uppercase">Pilih Periode</label>
                    <select name="year" id="yearSelect" class="w-full bg-white border border-outline px-4 py-3 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary" required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year }}" {{ $selectedYear === $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl hover:bg-primary/90 transition-all">Muat</button>
            </form>
        </div>

        <!-- Add New Year -->
        <div class="bg-surface-container-lowest rounded-3xl p-6 border border-outline">
            <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-600">add_circle</span>
                Periode Tahun Baru
            </h3>
            <form method="POST" action="{{ route('admin.ppdb.management.year.store', ['school' => $school->slug]) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Format</label>
                    <input type="text" name="year" placeholder="2024/2025" class="w-full px-4 py-2 border rounded-xl text-sm" required>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all">Tambah Periode</button>
            </form>
            <p class="text-xs text-on-surface-variant mt-3">Membuat 3 periode default siap dikonfigurasi.</p>
        </div>
    </div>

    <!-- Content Section (Gated by Year Selection) -->
    @if($mustSelectYear)
        <!-- Onboarding State -->
        <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200 p-12 text-center">
            <div class="mb-4">
                <span class="material-symbols-outlined text-6xl text-blue-600">date_range</span>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-2">Pilih Periode Tahun untuk Memulai</h3>
            <p class="text-blue-700 max-w-md mx-auto">Pilih periode yang ada atau buat yang baru di atas untuk mengelola fase dan melihat pendaftar.</p>
        </div>
    @else
        <!-- Live Status Bar -->
        <div class="bg-gradient-to-r from-primary/10 to-transparent rounded-3xl p-6 mb-10 border border-primary/20">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="text-sm font-bold text-on-surface-variant uppercase mb-1">Fase Aktif Saat Ini</p>
                    @if($nextPhase)
                        <p class="text-2xl font-bold text-primary">{{ $nextPhase->phase_name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $nextPhase->start_date->format('d M') }} - {{ $nextPhase->end_date->format('d M Y') }}</p>
                    @else
                        <p class="text-xl font-bold text-on-surface-variant">Tidak ada fase aktif</p>
                    @endif
                </div>
                <div class="flex flex-col items-end gap-3">
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase mb-1">Year</p>
                        <p class="text-lg font-bold text-primary">{{ $selectedYear }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.ppdb.management.year.toggle-live', ['school' => $school->slug]) }}?year={{ urlencode($selectedYear) }}" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        @php
                            $isLive = $selectedPhases->first()?->is_live ?? false;
                        @endphp
                        <button type="submit" class="flex items-center gap-3 px-4 py-2 bg-white border rounded-full shadow-sm transition-all hover:shadow-md">
                            <span class="relative inline-block w-12 h-6 rounded-full transition-colors {{ $isLive ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white transition-transform {{ $isLive ? 'translate-x-6' : '' }}"></span>
                            </span>
                            <span class="text-sm font-bold {{ $isLive ? 'text-emerald-700' : 'text-slate-600' }}">
                                {{ $isLive ? 'PPDB Aktif' : 'PPDB Nonaktif' }}
                            </span>
                        </button>
                    </form>
                    <p class="text-xs text-muted-foreground mt-2">Ubah status: saat aktif, tombol PPDB publik akan muncul dan hitung mundur mengikuti fase saat ini/berikutnya.</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl p-6 border border-blue-200">
                <p class="text-sm text-blue-600 font-bold uppercase mb-1">Total Pendaftar</p>
                <p class="text-5xl font-black text-blue-900">{{ $applicants->count() }}</p>
                <p class="text-xs text-blue-600 mt-2">{{ $selectedYear }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-3xl p-6 border border-yellow-200">
                <p class="text-sm text-yellow-600 font-bold uppercase mb-1">Perlu Ditinjau</p>
                <p class="text-5xl font-black text-yellow-900">{{ $pendingCount }}</p>
                <p class="text-xs text-yellow-600 mt-2">Perlu Tindakan</p>
            </div>

        </div>

        <!-- Action Button -->
        @if ($selectedYear)
            <a href="{{ route('admin.ppdb.applicants.by_school', ['school' => $school->slug]) }}?year={{ urlencode($selectedYear) }}" class="block mb-3 px-8 py-4 bg-gradient-to-r from-primary to-primary/80 text-on-primary font-bold rounded-3xl shadow-lg text-center hover:shadow-xl transition-all flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-xl">group</span>
                Kelola Pendaftar untuk {{ $selectedYear }}
            </a>
            <a href="{{ route('admin.ppdb.management.capacity', ['school' => $school->slug]) }}?year={{ urlencode($selectedYear) }}" class="block mb-10 px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-700 text-on-primary font-bold rounded-3xl shadow-lg text-center hover:shadow-xl transition-all flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-xl">storage</span>
                Kelola Kapasitas untuk {{ $selectedYear }}
            </a>
        @else
            <p class="text-xs text-red-600">Silakan pilih periode tahun terlebih dahulu untuk mengelola pendaftar.</p>
        @endif

        <!-- 3 Periode Setup -->
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline mb-10 p-8">
            <h3 class="text-2xl font-bold mb-2">Atur 3 Periode Pendaftaran</h3>
            <p class="text-sm text-on-surface-variant mb-6">Define start and Tanggal Selesais for each period.</p>
            <form method="POST" action="{{ route('admin.ppdb.management.phase.setup', ['school' => $school->slug]) }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @csrf
                <input type="hidden" name="year" value="{{ $selectedYear }}" />

                <!-- Periode 1 -->
                <div class="p-6 rounded-2xl border-2 border-blue-200 bg-blue-50/50">
                    <h4 class="font-bold text-blue-900 mb-4 text-lg flex items-center gap-2">
                        <span class="h-6 w-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">1</span>
                        Periode 1
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Mulai</label>
                            <input type="date" name="periode_1_start" class="w-full p-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 1'))->start_date }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_1_end" class="w-full p-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 1'))->end_date }}" required>
                        </div>
                    </div>
                </div>

                <!-- Periode 2 -->
                <div class="p-6 rounded-2xl border-2 border-purple-200 bg-purple-50/50">
                    <h4 class="font-bold text-purple-900 mb-4 text-lg flex items-center gap-2">
                        <span class="h-6 w-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs font-bold">2</span>
                        Periode 2
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Mulai</label>
                            <input type="date" name="periode_2_start" class="w-full p-3 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 2'))->start_date }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_2_end" class="w-full p-3 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 2'))->end_date }}" required>
                        </div>
                    </div>
                </div>

                <!-- Periode 3 -->
                <div class="p-6 rounded-2xl border-2 border-pink-200 bg-pink-50/50">
                    <h4 class="font-bold text-pink-900 mb-4 text-lg flex items-center gap-2">
                        <span class="h-6 w-6 rounded-full bg-pink-600 text-white flex items-center justify-center text-xs font-bold">3</span>
                        Periode 3
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Mulai</label>
                            <input type="date" name="periode_3_start" class="w-full p-3 border border-pink-200 rounded-xl focus:ring-2 focus:ring-pink-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 3'))->start_date }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_3_end" class="w-full p-3 border border-pink-200 rounded-xl focus:ring-2 focus:ring-pink-400" value="{{ optional($selectedPhases->firstWhere('phase_name','Periode 3'))->end_date }}" required>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 flex justify-end gap-3 pt-4 border-t border-outline">
                    <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-2xl hover:bg-primary/90 transition-all">Simpan Semua 3 Periode</button>
                </div>
            </form>
        </div>

        <!-- Registration Phases Table -->
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline overflow-hidden">
            <div class="px-8 py-6 border-b border-outline bg-primary/5">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">table_chart</span>
                    Konfigurasi Fase
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container-high text-on-surface-variant">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">Fase</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-bold uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline">
                        @forelse($selectedPhases as $phase)
                            <tr class="hover:bg-surface-container-high transition-colors">
                                <td class="px-6 py-4 font-semibold">{{ $phase->phase_name }}</td>
                                <td class="px-6 py-4 text-on-surface-variant">{{ $phase->start_date ? $phase->start_date->format('d M Y') : '-' }}</td>
                                <td class="px-6 py-4 text-on-surface-variant">{{ $phase->end_date ? $phase->end_date->format('d M Y') : '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $phase->status == 'active' ? 'bg-green-100 text-green-700' : ($phase->status == 'finished' ? 'bg-slate-100 text-slate-700' : 'bg-blue-100 text-blue-700') }}">
                                        {{ ucfirst($phase->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-1 flex justify-end">
                                    <form method="POST" action="{{ route('admin.ppdb.management.phase.activate', ['school' => $school->slug, 'phase' => $phase->id]) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 rounded-lg bg-green-100 text-green-700 text-xs font-bold hover:bg-green-200">Aktifkan</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.ppdb.management.phase.destroy', ['school' => $school->slug, 'phase' => $phase->id]) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 rounded-lg bg-rose-100 text-rose-700 text-xs font-bold hover:bg-rose-200">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">
                                    <p class="mb-2">Belum ada fase yang dikonfigurasi.</p>
                                    <p class="text-xs">Atur tanggal di atas untuk membuat fase.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const yearSelect = document.getElementById('yearSelect');
        if (yearSelect) {
            yearSelect.addEventListener('change', function () {
                const selected = this.value;
                if (!selected) return;
                const schoolSlug = "{{ $school->slug }}";
                const url = new URL(window.location.href);
                url.searchParams.set('year', selected);
                window.location = url.toString();
            });
        }
    });
</script>
@endsection








