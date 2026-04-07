@extends('layouts.admin.app')

@section('title', 'Applicant Details - SDIT Putra Pakuan')

@section('content')
<div class="pt-24 px-8 pb-12 min-h-screen">
    <!-- Applicant Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="relative">
                <img alt="{{ $applicant->full_name }} Photo" class="w-24 h-24 rounded-3xl object-cover shadow-lg" src="{{ $applicant->profile_photo_url }}"/>
                <span class="absolute -bottom-2 -right-2 bg-primary-container text-on-primary-container p-1 rounded-lg border-2 border-surface shadow-sm">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">stars</span>
                </span>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="text-xs font-bold tracking-widest text-primary uppercase">ID: {{ $applicant->application_id }}</span>
                    <span class="px-3 py-1 bg-tertiary-container text-on-tertiary-container rounded-full text-[10px] font-black uppercase">{{ ucfirst($applicant->status) }}</span>
                </div>
                <h1 class="text-4xl font-bold font-headline text-on-surface tracking-tight">{{ $applicant->full_name }}</h1>
                <p class="text-on-surface-variant flex items-center gap-2 mt-1">
                    <span class="material-symbols-outlined text-sm">location_on</span> {{ $applicant->address ?? '-' }} &middot; Dikirim pada {{ $applicant->created_at ? $applicant->created_at->format('d M Y') : '-' }}
                </p>
            </div>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-3 rounded-3xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">Cetak Ringkasan</button>
            <a href="mailto:{{ $applicant->email }}" class="px-6 py-3 rounded-3xl bg-primary text-on-primary font-bold text-sm shadow-md hover:shadow-xl transition-all">Hubungi Pendaftar</a>
        </div>
    </div>

    <!-- Bento Layout -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Left Column: Personal Data & Majors -->
        <div class="md:col-span-8 space-y-6">
            <!-- Personal Data Section -->
            <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 bg-surface-container-high rounded-full flex items-center justify-center text-primary-dim font-bold">01</span>
                    <h3 class="text-xl font-bold font-headline">Informasi Pribadi</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Email</label>
                        <p class="text-on-surface font-medium">{{ $applicant->email ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Nama Lengkap</label>
                        <p class="text-on-surface font-medium">{{ $applicant->full_name }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">NISN (Nomor Induk Siswa Nasional)</label>
                        <p class="text-on-surface font-medium">{{ $applicant->nisn ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Nomor Telepon</label>
                        <p class="text-on-surface font-medium">{{ $applicant->phone ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Jenis Kelamin</label>
                        <p class="text-on-surface font-medium">{{ $applicant->gender ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Tempat Lahir</label>
                        <p class="text-on-surface font-medium">{{ $applicant->place_of_birth ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Tanggal Lahir</label>
                        <p class="text-on-surface font-medium">{{ $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d M Y') : '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Sekolah Asal</label>
                        <p class="text-on-surface font-medium">{{ $applicant->previous_school ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Pendapatan Rumah Tangga</label>
                        <p class="text-on-surface font-medium">{{ $applicant->parent_salary_range ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Nama Ayah</label>
                        <p class="text-on-surface font-medium">{{ $applicant->father_name ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Pekerjaan Ayah</label>
                        <p class="text-on-surface font-medium">{{ $applicant->father_occupation ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Nama Ibu</label>
                        <p class="text-on-surface font-medium">{{ $applicant->mother_name ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Pekerjaan Ibu</label>
                        <p class="text-on-surface font-medium">{{ $applicant->mother_occupation ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Status</label>
                        <p class="text-on-surface font-medium uppercase">{{ $applicant->status ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Langkah Pendaftaran Terakhir</label>
                        <p class="text-on-surface font-medium">{{ $applicant->last_registration_step ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Alamat Tinggal</label>
                        <p class="text-on-surface font-medium">{{ $applicant->address ?? '-' }}</p>
                    </div>
                </div>
            </section>

            <!-- Documents Section -->
            <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 bg-surface-container-high rounded-full flex items-center justify-center text-primary-dim font-bold">02</span>
                    <h3 class="text-xl font-bold font-headline">Brankas Dokumen</h3>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                    @foreach ([
                        ['file' => $applicant->kk_file, 'label' => 'Kartu Keluarga / AKTA'],
                        ['file' => $applicant->ijazah_file, 'label' => 'Ijazah SD'],
                        ['file' => $applicant->prestasi_file, 'label' => 'Dokumen Prestasi / Sertifikat'],
                        ['file' => $applicant->raport_file, 'label' => 'Rapor Semester 1-5'],                        ['file' => $applicant->payment_proof, 'label' => 'Bukti Pembayaran'],                    ] as $doc)
                        @if(!empty($doc['file']))
                            @php
                                $ext = strtolower(pathinfo($doc['file'], PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','bmp']);
                                $isPdf = $ext === 'pdf';
                                $fileUrl = asset('storage/' . $doc['file']);
                            @endphp
                            <div class="flex flex-col gap-2">
                                <p class="text-xs font-bold text-on-surface line-clamp-2">{{ $doc['label'] }}</p>
                            <div class="group relative aspect-3/4 bg-surface-container-low rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col justify-end cursor-pointer" onclick="openDocViewer('{{ $fileUrl }}', '{{ addslashes($doc['label']) }}', '{{ $ext }}')">
                                @if($isImage)
                                    <img alt="{{ $doc['label'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="{{ $fileUrl }}"/>
                                @elseif($isPdf)
                                    <div class="flex flex-col items-center justify-center h-full p-4">
                                        <svg class="w-16 h-16 mb-2 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10.1,11.4C10.08,11.44 9.81,13.16 8,16.09C8,16.09 4.5,17.91 5.33,19.27C6,20.35 7.65,19.23 9.07,16.59C9.07,16.59 10.89,15.95 13.31,15.77C13.31,15.77 17.17,17.5 17.7,15.66C18.22,13.8 14.64,14.22 14,14.41C14,14.41 12,13.06 11.5,11.2C11.5,11.2 12.64,7.25 10.89,7.3C9.14,7.35 9.8,10.43 10.1,11.4Z"/></svg>
                                        <span class="text-xs font-bold text-on-surface">Dokumen PDF</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center h-full p-4">
                                        <span class="material-symbols-outlined text-5xl text-primary mb-2">description</span>
                                        <span class="text-xs font-bold text-on-surface">{{ strtoupper($ext) }} File</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-linear-to-t from-black/95 via-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                                    <p class="text-white text-xs font-extrabold mb-2 [text-shadow:0_1px_2px_rgba(0,0,0,0.8)]">{{ $doc['label'] }}</p>
                                    <div class="bg-white/95 text-black py-2 px-3 rounded-xl text-[10px] font-black uppercase flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">visibility</span> Preview
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Right Column: Review Panel -->
        <div class="md:col-span-4">
    <div class="sticky top-24 space-y-6">

        <!-- PAYMENT VERIFICATION PANEL -->
        @if($applicant->payment_proof || $applicant->payment_method === 'tu')
        @php
            $payExt = $applicant->payment_proof ? strtolower(pathinfo($applicant->payment_proof, PATHINFO_EXTENSION)) : null;
            $payUrl = $applicant->payment_proof ? asset('storage/' . $applicant->payment_proof) : null;
            $payIsImage = $payExt && in_array($payExt, ['jpg','jpeg','png','gif']);
            $isTuPayment = $applicant->payment_method === 'tu';
            $paymentConfirmed = collect($applicant->status_history ?? [])->contains(fn($h) => in_array($h['status'] ?? '', ['payment_confirmed_tu', 'payment_confirmed']));
        @endphp
        <section class="bg-white rounded-3xl p-6 shadow border">
            <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined {{ $isTuPayment ? 'text-amber-500' : 'text-green-600' }}" style="font-variation-settings:'FILL' 1">{{ $isTuPayment ? 'store' : 'receipt_long' }}</span>
                @if ($isTuPayment) Pembayaran di TU @else Verifikasi Pembayaran @endif
            </h3>

            @if($isTuPayment)
                <div class="mb-4 rounded-xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-800 space-y-1">
                    <div class="flex items-center gap-2 font-bold mb-2">
                        <span class="material-symbols-outlined text-amber-500 text-base">store</span>
                        Pembayaran Langsung di TU
                    </div>
                    <p>Pendaftar memilih membayar langsung ke kantor TU sekolah.</p>
                    @if ($paymentConfirmed)
                        <div class="mt-2 flex items-center gap-2 text-green-700 font-bold">
                            <span class="material-symbols-outlined text-base">check_circle</span>
                            Sudah dikonfirmasi oleh admin
                        </div>
                    @else
                        <div class="mt-2 flex items-center gap-2 text-amber-700">
                            <span class="material-symbols-outlined text-base">pending</span>
                            Menunggu konfirmasi admin
                        </div>
                    @endif
                </div>

                @if (!$paymentConfirmed)
                <form method="POST" action="{{ route('admin.ppdb.applicants.by_school.confirm_payment', ['school' => $schoolModel->slug, 'id' => $applicant->id]) }}">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('Konfirmasi bahwa pembayaran TU dari {{ addslashes($applicant->full_name) }} sudah diterima?')"
                        class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-base">how_to_reg</span>
                        Konfirmasi Pembayaran Diterima
                    </button>
                </form>
                @endif
            @else
                <div class="mb-4 cursor-pointer rounded-xl overflow-hidden border border-outline-variant" onclick="openDocViewer('{{ $payUrl }}', 'Bukti Pembayaran', '{{ $payExt }}')">
                    @if($payIsImage)
                        <img src="{{ $payUrl }}" alt="Bukti Pembayaran" class="w-full object-cover max-h-52 hover:opacity-90 transition-opacity">
                    @else
                        <div class="flex flex-col items-center justify-center p-6 bg-surface-container-low hover:bg-surface-container transition-colors">
                            <svg class="w-12 h-12 mb-2 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/></svg>
                            <span class="text-sm font-bold">Klik untuk Lihat PDF</span>
                        </div>
                    @endif
                </div>
                <a href="{{ $payUrl }}" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 w-full py-2 rounded-xl border border-outline-variant text-sm font-bold hover:bg-surface-container-low transition-colors mb-4">
                    <span class="material-symbols-outlined text-sm">open_in_new</span> Buka di Tab Baru
                </a>

                {{-- Confirm payment button for bank/ewallet --}}
                @if ($paymentConfirmed)
                    <div class="flex items-center gap-2 text-green-700 font-bold text-sm bg-green-50 border border-green-200 rounded-xl px-4 py-3 mb-2">
                        <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">check_circle</span>
                        Pembayaran telah dikonfirmasi
                        @if($applicant->unique_code)
                        — Kode: <span class="font-black tracking-wider">{{ $applicant->unique_code }}</span>
                        @endif
                    </div>
                @else
                    <form method="POST" action="{{ route('admin.ppdb.applicants.by_school.confirm_payment', ['school' => $schoolModel->slug, 'id' => $applicant->id]) }}">
                        @csrf
                        <button type="submit"
                            onclick="return confirm('Konfirmasi pembayaran dari {{ addslashes($applicant->full_name) }} sudah diterima dan kode unik akan dibuat?')"
                            class="w-full py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-base">verified</span>
                            Konfirmasi Pembayaran & Buat Kode Unik
                        </button>
                    </form>
                @endif
            @endif

            <div class="space-y-2 text-sm mt-4">
                @if($applicant->payment_amount)
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Jumlah</span>
                    <span class="font-bold">Rp {{ number_format($applicant->payment_amount, 0, ',', '.') }}</span>
                </div>
                @endif
                @if($applicant->payment_method)
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Metode</span>
                    <span class="font-bold">{{ $applicant->payment_method }}</span>
                </div>
                @endif
                @if($applicant->payment_date)
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Tanggal</span>
                    <span class="font-bold">{{ \Carbon\Carbon::parse($applicant->payment_date)->format('d M Y') }}</span>
                </div>
                @endif
            </div>
        @endif

        <!-- ACTION PANEL -->
        <section class="bg-white rounded-3xl p-6 shadow border">

            <h3 class="text-lg font-bold mb-4">Keputusan Tinjauan</h3>

            <form id="decisionForm" class="space-y-4">
                @csrf

                <button type="button"
                    class="decision-btn w-full p-4 rounded-2xl border text-left transition hover:scale-[1.02]"
                    data-status="accepted">
                    <div class="flex justify-between items-center">
                        <span class="font-bold">Terima Pendaftar</span>
                        <span class="text-xs text-gray-500">Penerimaan Umum SD</span>
                    </div>
                    <p class="text-xs mt-2 text-gray-600">Terima pendaftar ini sebagai siswa SD reguler.</p>
                </button>

                <!-- REJECT -->
                <button type="button"
                    class="decision-btn w-full p-4 rounded-2xl bg-red-50 text-red-600 font-bold"
                    data-status="rejected">
                    Tolak Pendaftar
                </button>

                <!-- NOTE -->
                <textarea id="decisionNote"
                    class="w-full border rounded-xl p-3 text-sm"
                    placeholder="Catatan internal..."></textarea>

                <input type="hidden" id="decisionStatus">

                <button type="submit"
                    class="w-full bg-black text-white py-3 rounded-xl font-bold">
                    Kirim Keputusan
                </button>

                <div id="decisionResult" class="text-sm font-semibold"></div>
            </form>
        </section>

        {{-- ARSIP: Promosikan ke Siswa --}}
        @php $promotedStudent = $applicant->student; @endphp

        @if($promotedStudent)
            <section class="bg-green-50 border border-green-200 rounded-3xl p-6">
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1">check_circle</span>
                    <h3 class="font-bold text-green-800 text-sm">Sudah Dipromosikan ke Sistem Siswa</h3>
                </div>
                @if($promotedStudent->nis)
                    <p class="text-green-700 text-xs mb-3">NIS: <span class="font-mono font-bold">{{ $promotedStudent->nis }}</span></p>
                @endif
                @php
                    $archiveSlug  = strtolower($applicant->school_type === 'SDIT' ? 'sd' : $applicant->school_type);
                    $archiveYear  = $promotedStudent->academic_year_entry;
                @endphp
                <a href="{{ url('/admin/archive/'.$archiveSlug.'/'.str_replace('/', '-', $archiveYear).'/'.$promotedStudent->id) }}"
                   class="flex items-center gap-2 w-full py-2.5 rounded-2xl bg-green-600 text-white font-bold text-sm justify-center hover:bg-green-700 transition-colors">
                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                    Lihat Data Siswa
                </a>
            </section>
        @elseif($applicant->status === 'accepted')
            <section x-data="{ showForm: false }" class="bg-primary-container/30 border border-primary-container rounded-3xl p-6">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">school</span>
                    <h3 class="font-bold text-on-surface text-sm">Promosikan ke Data Siswa</h3>
                </div>
                <p class="text-xs text-on-surface-variant mb-4">Pendaftar ini telah diterima. Promosikan ke sistem siswa permanen untuk mengelola data akademik.</p>

                <button @click="showForm = !showForm"
                        class="w-full py-3 rounded-2xl bg-primary text-on-primary font-bold text-sm hover:opacity-90 transition-opacity flex items-center justify-center gap-2 active:scale-95">
                    <span class="material-symbols-outlined text-sm" x-text="showForm ? 'close' : 'add_circle'">add_circle</span>
                    <span x-text="showForm ? 'Batal' : 'Promosikan ke Siswa'">Promosikan ke Siswa</span>
                </button>

                <div x-show="showForm"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-4 space-y-3"
                     style="display:none;">
                    @php $appYear = $applicant->created_at ? $applicant->created_at->year : now()->year; @endphp
                    <div>
                        <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">NIS</label>
                        <input id="promote-nis" type="text" placeholder="Nomor Induk Siswa (opsional)"
                               class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Kelas</label>
                            <input id="promote-class" type="text" placeholder="1 / 2 / 3 / 4 / 5 / 6"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Ruang</label>
                            <input id="promote-room" type="text" placeholder="A / B"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Tahun Ajaran</label>
                        <input id="promote-year" type="text" value="{{ $appYear.'/'.(($appYear)+1) }}" placeholder="2024/2025"
                               class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Tanggal Masuk</label>
                        <input id="promote-date" type="date" value="{{ now()->toDateString() }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <button
                        @click="
                            const btn = $el;
                            btn.disabled = true;
                            btn.textContent = 'Memproses...';
                            fetch('{{ route('admin.students.promote') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    ppdb_application_id: {{ $applicant->id }},
                                    nis: document.getElementById('promote-nis').value,
                                    current_class: document.getElementById('promote-class').value,
                                    class_room: document.getElementById('promote-room').value,
                                    academic_year_entry: document.getElementById('promote-year').value,
                                    enrolled_at: document.getElementById('promote-date').value,
                                })
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    const t = document.createElement('div');
                                    t.style.cssText = 'position:fixed;top:24px;right:24px;z-index:9999;background:#14532d;color:#fff;font-weight:700;font-size:13px;padding:14px 22px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.25);display:flex;align-items:center;gap:10px;transition:opacity 0.4s';
                                    t.innerHTML = '<span style=&quot;font-size:18px;line-height:1&quot;>&#x2713;</span> ' + (data.message || 'Siswa berhasil dipromosikan.');
                                    document.body.appendChild(t);
                                    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 400); }, 2500);
                                    setTimeout(() => window.location.reload(), 1200);
                                } else {
                                    alert(data.message);
                                    btn.disabled = false;
                                    btn.textContent = 'Simpan & Promosikan';
                                }
                            })
                            .catch(() => {
                                alert('Terjadi kesalahan. Coba lagi.');
                                btn.disabled = false;
                                btn.textContent = 'Simpan & Promosikan';
                            })
                        "
                        class="w-full bg-primary text-on-primary font-bold text-sm py-3 rounded-2xl hover:opacity-90 transition-opacity active:scale-95">
                        Simpan & Promosikan
                    </button>
                </div>
            </section>
        @endif

    </div>
</div>
    </div>
</div>

<!-- PROFESSIONAL DOCUMENT VIEWER MODAL -->
<div id="docViewerModal" class="doc-viewer-modal">
    <div class="doc-viewer-overlay"></div>
    <div class="doc-viewer-container">
        <!-- Header -->
        <div class="doc-viewer-header">
            <h2 id="docViewerTitle" class="doc-viewer-title"></h2>
            <div class="doc-viewer-actions">
                <button id="downloadBtn" class="doc-btn doc-btn-secondary" title="Unduh">
                    <span class="material-symbols-outlined">download</span>
                </button>
                <button id="closeViewerBtn" class="doc-btn doc-btn-close" title="Tutup (ESC)">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        <!-- Controls (for images and PDFs) -->
        <div id="docViewerControls" class="doc-viewer-controls">
            <!-- Zoom controls -->
            <button id="zoomOutBtn" class="doc-btn" title="Perkecil (-)">
                <span class="material-symbols-outlined">zoom_out</span>
            </button>
            <span id="zoomLevel" class="doc-zoom-level">100%</span>
            <button id="zoomInBtn" class="doc-btn" title="Perbesar (+)">
                <span class="material-symbols-outlined">zoom_in</span>
            </button>
            <button id="resetZoomBtn" class="doc-btn" title="Reset">
                <span class="material-symbols-outlined">fit_screen</span>
            </button>

            <!-- PDF navigation -->
            <div id="pdfNavigation" class="doc-pdf-nav" style="display: none;">
                <button id="prevPageBtn" class="doc-btn">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <span id="pageInfo" class="doc-page-info"></span>
                <button id="nextPageBtn" class="doc-btn">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <!-- Loading spinner -->
        <div id="docViewerLoader" class="doc-viewer-loader">
            <div class="doc-spinner"></div>
            <p>Memuat dokumen...</p>
        </div>

        <!-- Content area -->
        <div id="docViewerContent" class="doc-viewer-content"></div>
    </div>
</div>
@endsection

@push('scripts')
<style>
/* Document Viewer Modal Styles */
.doc-viewer-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    animation: fadeIn 0.2s ease-out;
}

.doc-viewer-modal.active {
    display: block;
}

.doc-viewer-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.92);
    backdrop-filter: blur(10px);
}

.doc-viewer-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    z-index: 1;
}

.doc-viewer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.doc-viewer-title {
    color: white;
    font-size: 18px;
    font-weight: 700;
    margin: 0;
}

.doc-viewer-actions {
    display: flex;
    gap: 8px;
}

.doc-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    color: white;
    cursor: pointer;
    transition: all 0.2s;
    min-width: 42px;
    height: 42px;
}

.doc-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.doc-btn:active {
    transform: scale(0.95);
}

.doc-btn-secondary {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.4);
}

.doc-btn-secondary:hover {
    background: rgba(59, 130, 246, 0.3);
}

.doc-btn-close {
    background: rgba(239, 68, 68, 0.2);
    border-color: rgba(239, 68, 68, 0.4);
}

.doc-btn-close:hover {
    background: rgba(239, 68, 68, 0.3);
}

.doc-viewer-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 16px 24px;
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.doc-zoom-level {
    color: white;
    font-weight: 600;
    min-width: 60px;
    text-align: center;
}

.doc-pdf-nav {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-left: 24px;
    padding-left: 24px;
    border-left: 1px solid rgba(255, 255, 255, 0.2);
}

.doc-page-info {
    color: white;
    font-weight: 600;
    min-width: 80px;
    text-align: center;
}

.doc-viewer-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
    z-index: 10;
}

.doc-viewer-loader p {
    margin-top: 16px;
    font-size: 16px;
    font-weight: 600;
}

.doc-spinner {
    width: 60px;
    height: 60px;
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-top: 4px solid #3b82f6;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto;
}

.doc-viewer-content {
    flex: 1;
    overflow: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    position: relative;
}

.doc-viewer-content img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    cursor: grab;
    transition: transform 0.2s ease-out;
    user-select: none;
    -webkit-user-drag: none;
}

.doc-viewer-content img:active {
    cursor: grabbing;
}

.doc-viewer-content iframe {
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 12px;
    background: white;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Smooth scrollbar */
.doc-viewer-content::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

.doc-viewer-content::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.doc-viewer-content::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 6px;
}

.doc-viewer-content::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}
.decision-btn.selected {
    border-color: #2563eb;
    background-color: #eff6ff;
    transform: scale(1.01);
}

.decision-btn.selected .font-bold {
    color: #1d4ed8;
}

</style>

<script>
// Professional Document Viewer
class DocumentViewer {
    constructor() {
        this.modal = document.getElementById('docViewerModal');
        this.title = document.getElementById('docViewerTitle');
        this.content = document.getElementById('docViewerContent');
        this.loader = document.getElementById('docViewerLoader');
        this.controls = document.getElementById('docViewerControls');
        this.pdfNavigation = document.getElementById('pdfNavigation');

        this.currentZoom = 1;
        this.minZoom = 0.5;
        this.maxZoom = 3;
        this.zoomStep = 0.2;

        this.isDragging = false;
        this.startX = 0;
        this.startY = 0;
        this.scrollLeft = 0;
        this.scrollTop = 0;

        this.currentUrl = '';
        this.currentType = '';

        this.initEventListeners();
    }

    initEventListeners() {
        // Close button
        document.getElementById('closeViewerBtn').addEventListener('click', () => this.close());

        // Download button
        document.getElementById('downloadBtn').addEventListener('click', () => this.download());

        // Zoom controls
        document.getElementById('zoomInBtn').addEventListener('click', () => this.zoom(this.zoomStep));
        document.getElementById('zoomOutBtn').addEventListener('click', () => this.zoom(-this.zoomStep));
        document.getElementById('resetZoomBtn').addEventListener('click', () => this.resetZoom());

        // Click overlay to close
        this.modal.querySelector('.doc-viewer-overlay').addEventListener('click', () => this.close());

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));

        // Prevent body scroll when modal is open
        this.modal.addEventListener('transitionend', () => {
            if (this.modal.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            }
        });
    }

    open(url, title, type) {
        this.currentUrl = url;
        this.currentType = type;

        this.modal.classList.add('active');
        this.title.textContent = title;
        this.content.innerHTML = '';
        this.loader.style.display = 'flex';
        this.controls.style.display = 'flex';
        this.pdfNavigation.style.display = 'none';
        this.currentZoom = 1;
        this.updateZoomDisplay();

        document.body.style.overflow = 'hidden';

        // Load content based on type
        setTimeout(() => {
            if (this.isImage(type)) {
                this.loadImage(url);
            } else if (type === 'pdf') {
                this.loadPDF(url);
            } else {
                this.loadOther(url, type);
            }
        }, 100);
    }

    isImage(type) {
        return ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(type.toLowerCase());
    }

    loadImage(url) {
        const img = document.createElement('img');
        img.src = url;
        img.alt = 'Document preview';

        img.onload = () => {
            this.loader.style.display = 'none';
            this.content.appendChild(img);
            this.enableImagePan(img);
            console.log('? Image loaded successfully');
        };

        img.onerror = () => {
            this.showError('Failed to load image');
        };
    }

    loadPDF(url) {
        this.controls.style.display = 'none';
        this.loader.style.display = 'none';

        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        this.content.appendChild(iframe);

        console.log('? PDF loaded in iframe');
    }

    loadOther(url, type) {
        this.loader.style.display = 'none';
        this.controls.style.display = 'none';

        this.content.innerHTML = `
            <div style="text-align: center; color: white;">
                <span class="material-symbols-outlined" style="font-size: 80px; margin-bottom: 20px; display: block;">description</span>
                <h3 style="font-size: 24px; margin-bottom: 12px;">File Preview Not Supported</h3>
                <p style="font-size: 16px; margin-bottom: 24px; opacity: 0.8;">This ${type.toUpperCase()} file cannot be previewed in the browser.</p>
                <a href="${url}" target="_blank" download style="display: inline-block; padding: 12px 24px; background: #3b82f6; color: white; text-decoration: none; border-radius: 10px; font-weight: 600;">
                    Download File
                </a>
            </div>
        `;
    }

    showError(message) {
        this.loader.style.display = 'none';
        this.content.innerHTML = `
            <div style="text-align: center; color: white;">
                <span style="font-size: 60px; display: block; margin-bottom: 20px;">??</span>
                <h3 style="font-size: 24px; margin-bottom: 12px;">Error</h3>
                <p style="font-size: 16px; opacity: 0.8;">${message}</p>
            </div>
        `;
    }

    enableImagePan(img) {
        this.content.addEventListener('mousedown', (e) => {
            if (e.target !== img) return;
            this.isDragging = true;
            this.startX = e.pageX - this.content.offsetLeft;
            this.startY = e.pageY - this.content.offsetTop;
            this.scrollLeft = this.content.scrollLeft;
            this.scrollTop = this.content.scrollTop;
        });

        this.content.addEventListener('mousemove', (e) => {
            if (!this.isDragging) return;
            e.preventDefault();
            const x = e.pageX - this.content.offsetLeft;
            const y = e.pageY - this.content.offsetTop;
            const walkX = (x - this.startX) * 1.5;
            const walkY = (y - this.startY) * 1.5;
            this.content.scrollLeft = this.scrollLeft - walkX;
            this.content.scrollTop = this.scrollTop - walkY;
        });

        this.content.addEventListener('mouseup', () => {
            this.isDragging = false;
        });

        this.content.addEventListener('mouseleave', () => {
            this.isDragging = false;
        });
    }

    zoom(delta) {
        if (this.currentType === 'pdf') return;

        const img = this.content.querySelector('img');
        if (!img) return;

        this.currentZoom = Math.max(this.minZoom, Math.min(this.maxZoom, this.currentZoom + delta));
        img.style.transform = `scale(${this.currentZoom})`;
        this.updateZoomDisplay();
    }

    resetZoom() {
        if (this.currentType === 'pdf') return;

        const img = this.content.querySelector('img');
        if (!img) return;

        this.currentZoom = 1;
        img.style.transform = 'scale(1)';
        this.updateZoomDisplay();
        this.content.scrollLeft = 0;
        this.content.scrollTop = 0;
    }

    updateZoomDisplay() {
        document.getElementById('zoomLevel').textContent = Math.round(this.currentZoom * 100) + '%';
    }

    download() {
        const a = document.createElement('a');
        a.href = this.currentUrl;
        a.download = this.title.textContent || 'document';
        a.click();
    }

    close() {
        this.modal.classList.remove('active');
        this.content.innerHTML = '';
        document.body.style.overflow = '';
        this.currentZoom = 1;
    }

    handleKeyboard(e) {
        if (!this.modal.classList.contains('active')) return;

        if (e.key === 'Escape') {
            this.close();
        } else if (e.key === '+' || e.key === '=') {
            this.zoom(this.zoomStep);
        } else if (e.key === '-') {
            this.zoom(-this.zoomStep);
        } else if (e.key === '0') {
            this.resetZoom();
        }
    }
}

// Initialize viewer
const docViewer = new DocumentViewer();

// Global function to open viewer
function openDocViewer(url, title, type) {
    console.log('?? Opening document:', title, type);
    docViewer.open(url, title, type);
}

// Keputusan Tinjauan interactions
document.addEventListener('DOMContentLoaded', function () {
    const decisionButtons = document.querySelectorAll('.decision-btn');
    const decisionStatusInput = document.getElementById('decisionStatus');
    const decisionForm = document.getElementById('decisionForm');
    const decisionResult = document.getElementById('decisionResult');
    const decisionNote = document.getElementById('decisionNote');
    const decisionUrl = '{{ route("admin.ppdb.applicants.by_school.decision", ["school" => $schoolModel->slug, "id" => $applicant->id]) }}';

    async function submitDecision(status, note) {
        decisionResult.textContent = 'Submitting decision...';
        decisionResult.style.color = '';

        const token = document.querySelector('meta[name="csrf-token"]')?.content || decisionForm.querySelector('input[name="_token"]')?.value;

        try {
            const response = await fetch(decisionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: status,
                    note: note || ''
                })
            });

            if (!response.ok) {
                const err = await response.json().catch(() => ({}));
                throw new Error(err.message || 'Failed to save decision');
            }

            const data = await response.json();
            if (data.success) {
                decisionResult.textContent = 'Decision saved: ' + (data.status === 'rejected' ? 'Rejected' : 'Accepted') + '.';
                decisionResult.style.color = '#047857';
                setTimeout(() => {
                    window.location.reload();
                }, 800);
            } else {
                throw new Error('Decision saving failed');
            }
        } catch (error) {
            console.error('Decision submit error:', error);
            decisionResult.textContent = 'Error: ' + (error.message || 'Unable to send decision');
            decisionResult.style.color = '#b91c1c';
        }
    }

    decisionButtons.forEach(button => {
        button.addEventListener('click', async () => {
            if (button.disabled) return;
            decisionButtons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            const status = button.getAttribute('data-status');
            decisionStatusInput.value = status;
            decisionResult.textContent = '';

            if (status === 'rejected') {
                const confirmed = confirm('Are you sure you want to reject this applicant? This action cannot be undone.');
                if (!confirmed) {
                    button.classList.remove('selected');
                    decisionStatusInput.value = '';
                    return;
                }
                await submitDecision(status, decisionNote?.value || '');
            }
        });
    });

    decisionForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const selectedStatus = decisionStatusInput.value;
        if (!selectedStatus) {
            decisionResult.textContent = 'Please select a decision before submitting.';
            return;
        }

        await submitDecision(selectedStatus, decisionNote?.value || '');
    });
});
</script>
@endpush







