@extends('layouts.SD.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <div class="relative rounded-xl overflow-hidden mb-12 bg-charcoal dark:bg-black h-80 flex flex-col justify-center items-center text-center p-8">
        <div class="absolute inset-0 opacity-40">
            <div class="w-full h-full bg-linear-to-br from-charcoal via-primary/20 to-accent-yellow/20" data-alt="Abstract geometric background in charcoal and blue"></div>
        </div>
        <div class="relative z-10 space-y-4 max-w-2xl">
            <h2 class="text-4xl md:text-5xl font-black text-white leading-tight">Direktori Civitas Akademika</h2>
            <p class="text-slate-300 text-lg">Temukan profil tenaga pendidik dan staf profesional yang berdedikasi tinggi di SDIT Putra Pakuan.</p>
            <div class="flex gap-3 justify-center pt-4">
                <span class="px-4 py-1.5 bg-primary/20 border border-primary/30 text-primary text-xs font-bold rounded-full uppercase tracking-tighter">120+ Staf</span>
            </div>
        </div>
    </div>
    <!-- Search & Filter Controls -->
    <div class="bg-background-light dark:bg-background-dark py-4 space-y-4 rounded-xl shadow-sm mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-charcoal border-none rounded-xl focus:ring-2 focus:ring-primary shadow-sm text-sm placeholder:text-slate-400 transition-all" placeholder="Cari nama guru, jabatan, atau mata pelajaran..." type="text"/>
            </div>
            <!-- Dropdown Filter -->
            <div class="relative w-full md:w-64">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">filter_list</span>
                <select class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-charcoal border-none rounded-xl focus:ring-2 focus:ring-primary shadow-sm text-sm appearance-none transition-all">
                    <option value="">Semua Departemen</option>
                    <option value="management">Manajemen Sekolah</option>
                    <option value="tkj">Teknik Komputer &amp; Jaringan</option>
                    <option value="rpl">Rekayasa Perangkat Lunak</option>
                    <option value="umum">Mata Pelajaran Umum</option>
                    <option value="admin">Staf Administrasi</option>
                </select>
            </div>
        </div>
        <!-- Quick Filter Tags -->
        <div class="flex gap-2 overflow-x-auto pb-2 no-scrollbar">
            <button class="px-5 py-2 rounded-lg bg-primary text-white text-xs font-bold whitespace-nowrap">Semua</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Guru Produktif</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Wali Kelas</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Staf IT</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Laboran</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Bimbingan Konseling</button>
        </div>
    </div>
    <!-- Directory Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse ($teacherStaff as $person)
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="relative overflow-hidden h-40 sm:h-44 md:h-48">
                @if ($person->photo_url)
                    <img alt="{{ $person->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="{{ $person->photo_url }}"/>
                @else
                    <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-400 text-6xl">person</span>
                    </div>
                @endif
                <div class="absolute top-4 right-4 px-3 py-1
                    @if($person->type === 'management') bg-accent-yellow text-charcoal
                    @elseif($person->type === 'teacher') bg-primary text-white
                    @elseif($person->type === 'staff') bg-slate-500 text-white
                    @else bg-slate-400 text-white @endif
                    text-[10px] font-bold rounded-full uppercase">
                    @switch($person->type)
                        @case('management') Manajemen @break
                        @case('teacher') Guru @break
                        @case('staff') Staf @break
                        @default {{ ucfirst($person->type) }}
                    @endswitch
                </div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">{{ $person->name }}</h3>
                <p class="text-primary text-sm font-medium">{{ $person->title }}</p>
                @if ($person->department)
                    <p class="text-slate-500 dark:text-slate-400 text-xs">{{ $person->department }}</p>
                @endif
                <div class="pt-3 flex gap-3">
                    @if ($person->email)
                        <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="mailto:{{ $person->email }}" title="Email">
                            <span class="material-symbols-outlined text-lg">mail</span>
                        </a>
                    @endif
                    @if ($person->phone)
                        <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="tel:{{ $person->phone }}" title="Telepon">
                            <span class="material-symbols-outlined text-lg">phone</span>
                        </a>
                    @endif
                    @if (!$person->email && !$person->phone)
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-400">
                            <span class="material-symbols-outlined text-lg">contact_mail</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="space-y-4">
                <span class="material-symbols-outlined text-6xl text-slate-300">school</span>
                <div>
                    <h3 class="text-xl font-bold text-charcoal dark:text-white mb-2">Belum ada data guru/staff</h3>
                    <p class="text-slate-500 dark:text-slate-400">Data tenaga pendidik dan kependidikan akan segera ditambahkan.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="mt-16 flex flex-col items-center gap-6">
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Menampilkan {{ $teacherStaff->count() }} dari {{ method_exists($teacherStaff, 'total') ? $teacherStaff->total() : $teacherStaff->count() }} Staf &amp; Pengajar
        </p>
        <div class="flex items-center gap-2">
            @if (method_exists($teacherStaff, 'hasPages') && $teacherStaff->hasPages())
                @if (method_exists($teacherStaff, 'onFirstPage') && $teacherStaff->onFirstPage())
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 opacity-50 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                @else
                    <a href="{{ $teacherStaff->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif

                @if (method_exists($teacherStaff, 'getUrlRange'))
                    @foreach ($teacherStaff->getUrlRange(1, $teacherStaff->lastPage()) as $page => $url)
                        @if ($page == $teacherStaff->currentPage())
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif

                @if (method_exists($teacherStaff, 'hasMorePages') && $teacherStaff->hasMorePages())
                    <a href="{{ $teacherStaff->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 opacity-50 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                @endif
            @else
                <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">1</button>
            @endif
        </div>
    </div>
</div>
@endsection




