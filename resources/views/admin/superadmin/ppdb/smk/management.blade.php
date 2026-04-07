@extends('layouts.admin.app')

@section('title', 'Manajemen SPMB - SMK Putra Pakuan CMS')

@section('content')
<div x-data="{ showPaymentModal: {{ $errors->any() ? 'true' : 'false' }}, paymentTab: 'ewallet' }" class="p-8 max-w-7xl mx-auto w-full">
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
            <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">Manajemen SPMB</h2>
            <p class="text-on-surface-variant mt-1">{{ $school->name }}</p>
        </div>
    </div>

    {{-- ── Pengaturan Pembayaran SPMB ────────────────────────────────── --}}
    @php $schoolTypeSlug = strtolower($school->type === 'SDIT' ? 'sd' : $school->type); @endphp
    <div class="bg-white rounded-3xl p-5 border border-outline flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 shadow-sm">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">payments</span>
            </div>
            <div class="min-w-0">
                <h3 class="text-sm font-bold text-[#1c190d]">Pengaturan Pembayaran SPMB</h3>
                <p class="text-xs text-on-surface-variant mt-0.5">
                    @if ($homepage && ($homepage->payment_bank_account || $homepage->payment_ewallet_gopay || $homepage->payment_ewallet_dana || $homepage->payment_ewallet_ovo || $homepage->payment_ewallet_shopee))
                        @if ($homepage->payment_bank_account)<span class="font-medium">{{ $homepage->payment_bank_name }}</span> {{ $homepage->payment_bank_account }}@endif
                        @if ($homepage->payment_ewallet_gopay) &middot; GoPay @endif
                        @if ($homepage->payment_ewallet_dana) &middot; DANA @endif
                        @if ($homepage->payment_ewallet_ovo) &middot; OVO @endif
                        @if ($homepage->payment_ewallet_shopee) &middot; ShopeePay @endif
                    @else
                        <span class="text-amber-600 font-medium">Belum dikonfigurasi &mdash; klik Edit untuk mengisi</span>
                    @endif
                </p>
            </div>
        </div>
        <button @click="showPaymentModal = true"
            class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 bg-primary text-on-primary font-bold rounded-2xl text-sm hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-base">edit</span>
            Edit Pembayaran
        </button>
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
                                {{ $isLive ? 'SPMB Aktif' : 'SPMB Nonaktif' }}
                            </span>
                        </button>
                    </form>
                    <p class="text-xs text-muted-foreground mt-2">Ubah status: saat aktif, tombol SPMB publik akan muncul dan hitung mundur mengikuti fase saat ini/berikutnya.</p>
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
                            <input type="date" name="periode_1_start" class="w-full p-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 1')?->start_date?->format('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_1_end" class="w-full p-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 1')?->end_date?->format('Y-m-d') }}" required>
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
                            <input type="date" name="periode_2_start" class="w-full p-3 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 2')?->start_date?->format('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_2_end" class="w-full p-3 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 2')?->end_date?->format('Y-m-d') }}" required>
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
                            <input type="date" name="periode_3_start" class="w-full p-3 border border-pink-200 rounded-xl focus:ring-2 focus:ring-pink-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 3')?->start_date?->format('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase">Tanggal Selesai</label>
                            <input type="date" name="periode_3_end" class="w-full p-3 border border-pink-200 rounded-xl focus:ring-2 focus:ring-pink-400" value="{{ $selectedPhases->firstWhere('phase_name','Periode 3')?->end_date?->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <!-- WA Group Link -->                <div class="md:col-span-3 p-6 rounded-2xl border-2 border-green-200 bg-green-50/50">
                    <label class="block text-sm font-bold text-green-900 mb-1 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.978-1.418A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a7.95 7.95 0 01-4.073-1.117l-.292-.174-3.018.86.872-2.938-.19-.302A7.95 7.95 0 014 12c0-4.418 3.582-8 8-8s8 3.582 8 8-3.582 8-8 8zm4.406-5.845c-.242-.121-1.434-.707-1.657-.788-.222-.081-.384-.121-.545.121-.162.242-.626.788-.768.95-.141.162-.283.182-.525.061-.242-.121-1.022-.376-1.947-1.2-.719-.641-1.205-1.433-1.346-1.675-.142-.242-.015-.373.106-.493.109-.109.242-.283.363-.424.12-.141.161-.243.242-.404.08-.162.04-.303-.02-.424-.061-.121-.545-1.316-.747-1.8-.197-.473-.397-.409-.545-.417l-.465-.008c-.162 0-.424.061-.646.303-.222.242-.848.829-.848 2.022s.868 2.346.99 2.508c.12.162 1.71 2.611 4.143 3.662.58.25 1.031.4 1.382.512.58.185 1.108.159 1.526.096.465-.07 1.434-.586 1.636-1.152.202-.566.202-1.051.141-1.152-.06-.1-.222-.162-.465-.283z"/></svg>
                        Link Grup WhatsApp Peserta Didik Baru
                    </label>
                    <p class="text-xs text-green-700/70 mb-3">Link ini akan tampil di dashboard SPMB calon siswa yang diterima, sebagai panduan untuk daftar ulang dan bergabung ke grup.</p>
                    <input type="url" name="wa_group_link" placeholder="https://chat.whatsapp.com/..." class="w-full p-3 border border-green-300 rounded-xl focus:ring-2 focus:ring-green-400 bg-white" value="{{ optional($selectedPhases->first())->wa_group_link }}">
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
                                    @php
                                        $computed = $phase->computed_status ?? $phase->status;
                                        $label = ucfirst($computed);
                                        $classes = $computed == 'active'
                                            ? 'bg-green-100 text-green-700'
                                            : ($computed == 'finished' ? 'bg-slate-100 text-slate-700' : 'bg-blue-100 text-blue-700');
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $classes }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-1 flex justify-end">
                                    @if(($phase->computed_status ?? $phase->status) !== 'active')
                                        <form method="POST" action="{{ route('admin.ppdb.management.phase.activate', ['school' => $school->slug, 'phase' => $phase->id]) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 rounded-lg bg-green-100 text-green-700 text-xs font-bold hover:bg-green-200">Aktifkan</button>
                                        </form>
                                    @endif
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

    {{-- ── Payment Settings Modal ────────────────────────────────────── --}}
    <div
        x-show="showPaymentModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @keydown.escape.window="showPaymentModal = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-[#1c190d]/50 backdrop-blur-sm" @click="showPaymentModal = false"></div>
        {{-- Panel --}}
        <div class="relative bg-surface-container-lowest rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden" style="max-height: 90vh; overflow-y: auto;">
            {{-- Modal Header --}}
            <div class="bg-[#1c190d] px-6 py-5 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#1c190d] text-lg">payments</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-base">Pengaturan Pembayaran SPMB</h4>
                        <p class="text-white/50 text-xs">{{ $school->name }}</p>
                    </div>
                </div>
                <button @click="showPaymentModal = false" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
            {{-- Form --}}
            <form method="POST" action="{{ route('admin.cms.payment_settings.update', ['schoolType' => $schoolTypeSlug]) }}" class="px-6 py-6">
                @csrf
                <input type="hidden" name="_redirect_to" value="ppdb_management">
                {{-- Tabs --}}
                <div class="flex gap-2 mb-5">
                    <button type="button" @click="paymentTab = 'ewallet'"
                        :class="paymentTab === 'ewallet' ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high'"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">wallet</span> E-Wallet
                    </button>
                    <button type="button" @click="paymentTab = 'bank'"
                        :class="paymentTab === 'bank' ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high'"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">account_balance</span> Transfer Bank
                    </button>
                </div>
                {{-- E-Wallet Tab --}}
                <div x-show="paymentTab === 'ewallet'" class="space-y-3 mb-2">
                    <p class="text-xs text-on-surface-variant">Isi nomor HP/telepon yang terdaftar. Kosongkan yang tidak dipakai.</p>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">GoPay</label>
                        <input type="text" name="payment_ewallet_gopay" value="{{ old('payment_ewallet_gopay', $homepage?->payment_ewallet_gopay) }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">DANA</label>
                        <input type="text" name="payment_ewallet_dana" value="{{ old('payment_ewallet_dana', $homepage?->payment_ewallet_dana) }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">OVO</label>
                        <input type="text" name="payment_ewallet_ovo" value="{{ old('payment_ewallet_ovo', $homepage?->payment_ewallet_ovo) }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">ShopeePay</label>
                        <input type="text" name="payment_ewallet_shopee" value="{{ old('payment_ewallet_shopee', $homepage?->payment_ewallet_shopee) }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                </div>
                {{-- Bank Transfer Tab --}}
                <div x-show="paymentTab === 'bank'" class="space-y-3 mb-2">
                    <p class="text-xs text-on-surface-variant">Nomor rekening bank tujuan pembayaran SPMB.</p>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Nama Bank</label>
                        <input type="text" name="payment_bank_name" value="{{ old('payment_bank_name', $homepage?->payment_bank_name) }}"
                            placeholder="Contoh: Bank Mandiri"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Nomor Rekening</label>
                        <input type="text" name="payment_bank_account" value="{{ old('payment_bank_account', $homepage?->payment_bank_account) }}"
                            placeholder="Contoh: 1330012345678"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Nama Pemilik Rekening</label>
                        <input type="text" name="payment_bank_holder" value="{{ old('payment_bank_holder', $homepage?->payment_bank_holder) }}"
                            placeholder="Contoh: SMK PUTRA PAKUAN"
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>
                </div>
                {{-- Biaya Pendaftaran --}}
                <div class="pt-4 border-t border-outline mt-4">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1.5">Biaya Pendaftaran (Rp)</label>
                    <input type="number" name="payment_registration_fee" value="{{ old('payment_registration_fee', $homepage?->payment_registration_fee) }}"
                        placeholder="Contoh: 150000" min="0" step="1000"
                        class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    <p class="text-xs text-on-surface-variant mt-1">Kosongkan jika tidak ditampilkan di halaman pembayaran.</p>
                </div>
                {{-- Actions --}}
                <div class="flex gap-3 pt-5">
                    <button type="button" @click="showPaymentModal = false"
                        class="flex-1 py-2.5 rounded-xl border border-outline-variant/50 text-on-surface-variant text-sm font-semibold hover:bg-surface-container transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-[#1c190d] text-[#fbd51d] text-sm font-bold hover:bg-[#1c190d]/90 transition-colors shadow-sm active:scale-[0.98]">
                        Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
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








