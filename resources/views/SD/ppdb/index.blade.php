@extends('layouts.SD.app')

@section('content')
@php
    use App\Models\School;
    use App\Models\PpdbApplication;
    use App\Models\PpdbManagementPhase;
    use Carbon\Carbon;

    $schoolType = strtoupper($school);
    $schoolModel = School::where('type', School::resolveDbType($school))->first();



    $phases = collect();
    if ($schoolModel) {
        $phases = PpdbManagementPhase::where('school_id', $schoolModel->id)
            ->orderBy('start_date')
            ->get();
    }

    $ppdbOpen = $phases->where('is_live', true)->isNotEmpty();
    $now = Carbon::now();

    $activePhase = $phases
        ->filter(function ($phase) use ($now) {
            $start = Carbon::parse($phase->start_date)->startOfDay();
            $end = Carbon::parse($phase->end_date)->endOfDay();
            return $now->gte($start) && $now->lte($end);
        })
        ->sortByDesc(function ($phase) {
            return Carbon::parse($phase->start_date)->timestamp;
        })
        ->first();

    if (!$activePhase) {
        $activePhase = $phases->firstWhere('status', 'active');
    }

    $livePhase = $phases
        ->filter(function ($phase) use ($now) {
            return $phase->is_live && Carbon::parse($phase->end_date)->endOfDay()->gte($now);
        })
        ->sortByDesc(function ($phase) {
            return Carbon::parse($phase->start_date)->timestamp;
        })
        ->first();

    $upcomingPhases = $phases->filter(function ($phase) use ($now) {
        return Carbon::parse($phase->start_date)->startOfDay()->gt($now);
    })->sortBy(function ($phase) {
        return Carbon::parse($phase->start_date)->timestamp;
    })->values();

    $phaseForPeriod = $activePhase ?: $livePhase ?: $upcomingPhases->first() ?? $phases->last();
    $ppdbPeriod = '2024/2025';
    if ($phaseForPeriod) {
        $yearStart = Carbon::parse($phaseForPeriod->start_date)->year;
        $ppdbPeriod = $yearStart . '/' . ($yearStart + 1);
    }

    $displayPhaseName = $activePhase
        ? $activePhase->phase_name
        : ($livePhase
            ? 'Upcoming: ' . $livePhase->phase_name
            : ($upcomingPhases->first() ? 'Upcoming: ' . $upcomingPhases->first()->phase_name : 'Belum ada fase aktif'));
@endphp

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="mx-auto w-full max-w-7xl px-6 lg:px-10">
        <!-- Hero Section -->
        <section class="py-12 lg:py-20">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center">
                <div class="flex flex-col gap-8">
                    {{-- <div class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-charcoal">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-primary"></span>
                        </span>
                        Pendaftaran Dibuka
                    </div> --}}
                    <h1 class="text-5xl font-black leading-tight tracking-tight text-charcoal dark:text-slate-50 lg:text-7xl">
                        SPMB {{ $ppdbPeriod }} <br/>
                        <span class="text-primary">SDIT Putra Pakuan</span>
                    </h1>
                    <p class="max-w-135 text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                        Wujudkan masa depan gemilang dengan pendidikan vokasi berkualitas.
                        @if($ppdbOpen)
                            Pendaftaran Peserta Didik Baru Tahun Ajaran {{ $ppdbPeriod }} sedang dibuka.
                        @else
                            Saat ini SPMB belum dibuka atau sedang tutup. Cek jadwal di bawah untuk informasi lebih lanjut.
                        @endif
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <button class="flex h-14 items-center justify-center rounded-xl px-8 text-base font-bold text-charcoal transition-transform hover:scale-[1.02] active:scale-95 {{ $ppdbOpen ? 'bg-primary' : 'bg-slate-300 cursor-not-allowed'}}" {{ $ppdbOpen ? '' : 'disabled'}}
                            onclick="if({{ $ppdbOpen ? 'true' : 'false' }}) window.location.href='{{ route('ppdb.register', ['school'=>$school]) }}';">
                            {{ $ppdbOpen ? 'Daftar Sekarang' : 'SPMB Saat Ini Ditutup' }}
                        </button>
                        <button class="flex h-14 items-center justify-center rounded-xl border-2 border-charcoal/10 px-8 text-base font-bold text-charcoal transition-colors hover:bg-charcoal/5 dark:border-slate-800 dark:text-slate-200"
                            onclick="window.location.href='{{ route('ppdb.login', ['school'=>$school]) }}'">
                            Login Pendaftar
                        </button>
                        <button class="flex h-14 items-center justify-center rounded-xl border-2 border-primary px-8 text-base font-bold text-primary bg-white transition-colors hover:bg-primary/5"
                            onclick="window.location.href='{{ route('ppdb.cek.kode', ['school'=>$school]) }}'">
                            Cek Status Pendaftaran
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square w-full overflow-hidden rounded-3xl bg-slate-200 dark:bg-slate-800" style="background-image: url('https://images.pexels.com/photos/35107553/pexels-photo-35107553.jpeg?auto=compress&cs=tinysrgb&w=1260&fit=max'); background-size: cover; background-position: center;"></div>
                </div>
            </div>
        </section>
        <!-- Admission Steps -->
        <section class="py-16">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-black text-charcoal dark:text-slate-100 lg:text-4xl">Alur Pendaftaran</h2>
                <p class="mx-auto mt-4 max-w-2xl text-slate-600 dark:text-slate-400">Ikuti langkah-langkah mudah berikut untuk menjadi bagian dari keluarga besar SDIT Putra Pakuan.</p>
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <a href="{{ route('ppdb.register', ['school'=>$school]) }}" class="group flex flex-col h-full rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">payments</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">1. Daftar & Bayar</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Daftar dan bayar biaya pendaftaran untuk mendapatkan kode unik akses formulir.</p>
                </a>
                <a href="{{ route('ppdb.biodata', ['school'=>$school]) }}" class="group flex flex-col h-full rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">app_registration</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">2. Isi Biodata</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Lengkapi data diri calon peserta didik menggunakan kode unik Anda.</p>
                </a>
                <a href="{{ route('ppdb.berkas', ['school'=>$school]) }}" class="group flex flex-col h-full rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">upload_file</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">3. Unggah Berkas</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Unggah dokumen persyaratan seperti Ijazah, KK, dan Akta Kelahiran.</p>
                </a>
            </div>
        </section>
        <!-- Important Dates -->
        <section class="rounded-3xl bg-charcoal p-8 text-white lg:p-16">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                <div>
                    <h2 class="mb-6 text-3xl font-black lg:text-4xl">Jadwal Penting</h2>
                    <p class="mb-10 text-slate-400">Catat tanggal-tanggal penting agar tidak terlewat proses seleksinya.</p>
                    <div class="space-y-6">
                        @forelse($phases->take(3) as $phase)
                            @php
                                $start = Carbon::parse($phase->start_date);
                                $month = $start->format('M');
                                $day = $start->format('d');
                            @endphp
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center rounded-lg {{ $phase->is_live ? 'bg-emerald-200 text-emerald-800' : 'bg-neutral-800 text-neutral-300' }} p-3">
                                    <span class="text-xs font-bold uppercase">{{ $month }}</span>
                                    <span class="text-xl font-black">{{ $day }}</span>
                                </div>
                                <div class="pt-1">
                                    <h4 class="font-bold">{{ $phase->phase_name }}</h4>
                                    <p class="text-sm text-slate-400">{{ $start->format('d M Y') }} - {{ Carbon::parse($phase->end_date)->format('d M Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center rounded-lg bg-slate-800 p-3 text-slate-400">
                                    <span class="text-xs font-bold uppercase">--</span>
                                    <span class="text-xl font-black">--</span>
                                </div>
                                <div class="pt-1">
                                    <h4 class="font-bold">Jadwal Belum Tersedia</h4>
                                    <p class="text-sm text-slate-400">Silakan hubungi admin untuk membuat fase SPMB.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- Requirements Grid -->
                <div class="rounded-2xl bg-white/5 p-8 backdrop-blur-sm">
                    <h3 class="mb-6 text-xl font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">fact_check</span>
                        Persyaratan Dokumen
                    </h3>
                    <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Fotokopi Ijazah/SKL
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Akta Kelahiran
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Kartu Keluarga
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Pas Foto 3x4 (4 lembar)
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Akta Kelahiran
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Sertifikat Prestasi (Opsional)
                        </li>
                    </ul>
                    <div class="mt-8 rounded-xl bg-primary p-4 text-charcoal">
                        <p class="text-xs font-bold uppercase tracking-wide opacity-70">Info Penting</p>
                        <p class="text-sm font-medium mt-1">Seluruh berkas fisik dikumpulkan ke sekretariat PPDB saat verifikasi tatap muka.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Registration Form CTA Section -->
        <section class="py-20">
            <div class="flex flex-col items-center text-center">
                <h2 class="mb-4 text-3xl font-black text-charcoal dark:text-slate-100 lg:text-5xl">Siap Bergabung?</h2>
                <p class="mb-10 max-w-2xl text-lg text-slate-600 dark:text-slate-400">Jangan tunda lagi, kuota terbatas. Daftar sekarang dan amankan kursimu!</p>
                <div class="w-full max-w-lg rounded-2xl border-2 border-primary/20 bg-white p-8 shadow-2xl shadow-primary/10 dark:bg-slate-900">
                    <form method="POST" action="{{ route('ppdb.register.post', ['school' => $school]) }}" class="flex flex-col gap-4 text-left">
                        @csrf
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Nama Lengkap Siswa</label>
                            <input name="full_name" value="{{ old('full_name') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="Contoh: Budi Santoso" type="text" required />
                            @error('full_name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Email</label>
                            <input name="email" value="{{ old('email') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="contoh@mail.com" type="email" required />
                            @error('email')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Nomor WhatsApp</label>
                                <input name="phone" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="0812..." type="tel" />
                                @error('phone')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Kata Sandi</label>
                                <input name="password" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="Minimal 8 karakter" type="password" required />
                                @error('password')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <button type="submit" class="mt-4 flex h-14 w-full items-center justify-center gap-2 rounded-xl {{ $ppdbOpen ? 'bg-primary' : 'bg-slate-300 cursor-not-allowed'}} text-base font-black text-charcoal transition-all hover:scale-[1.01] active:scale-95" {{ $ppdbOpen ? '' : 'disabled'}}>
                            {{ $ppdbOpen ? 'Mulai Registrasi Online' : 'SPMB Ditutup' }}
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        <p class="text-center text-[10px] text-slate-400">Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan pendaftaran SDIT Putra Pakuan.</p>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection




