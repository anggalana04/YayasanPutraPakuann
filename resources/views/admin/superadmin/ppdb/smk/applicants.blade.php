@extends('layouts.admin.app')

@section('title', 'PPDB Manajemen Pendaftar - ' . ($schoolModel->name ?? ''))

@section('content')
<div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
@php
    $capacities = $capacities ?? collect();
    $yearOptions = $capacities->pluck('year')->unique()->values();
    if ($yearOptions->isEmpty()) {
        $yearOptions = $applicants->pluck('created_at')
            ->filter()
            ->map(fn($dt) => $dt->format('Y').'/'.($dt->format('Y')+1))
            ->unique()
            ->sort()
            ->values();
    }
@endphp
<!-- Header & Stats Bento -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<div class="md:col-span-2 space-y-2">
<div class="flex items-center gap-2 text-[#f2cc0d]">
<span class="text-sm font-bold tracking-widest uppercase">Konsol Manajemen</span>
<div class="h-px w-12 bg-[#f2cc0d]"></div>
</div>
<h3 class="text-4xl font-bold tracking-tight text-[#1c190d]">Manajemen Pendaftar - {{ $schoolModel->name ?? '' }}</h3>
@if(!empty($selectedYear))
    <p class="text-on-surface-variant font-semibold">Menampilkan data untuk tahun ajaran: {{ $selectedYear }}</p>
@else
    <p class="text-on-surface-variant">Belum ada tahun dipilih, menampilkan semua pendaftar untuk {{ $schoolModel->name ?? '' }}.</p>
@endif
<p class="text-on-surface-variant max-w-md">Kelola dan pantau jalur penerimaan untuk periode yang dipilih.</p>
</div>
<div class="bg-[#1c190d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#f2cc0d]/60 text-xs font-bold uppercase tracking-tighter">Total Pendaftar</span>
<div class="flex items-end justify-between">
<span id="totalApplicantsValue" class="text-3xl font-black text-[#f2cc0d]">{{ $applicants->count() }}</span>
<span class="text-[#f7f7f4]/40 text-xs flex items-center gap-1"><span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span></span>
</div>
</div>
<div class="bg-[#f2cc0d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#1c190d]/60 text-xs font-bold uppercase tracking-tighter">Perlu Direview ❗</span>
<div class="flex items-end justify-between">
<span id="pendingApplicantsValue" class="text-3xl font-black text-[#1c190d]">{{ $pendingCount ?? $applicants->whereIn('status', ['pending', 'payment_uploaded'])->count() }}</span>
<span class="material-symbols-outlined text-[#1c190d]/40" data-icon="pending_actions">pending_actions</span>
</div>
</div>

</div>

<!-- Capacity cards (major slices) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    @if($capacities->isNotEmpty())
        @foreach($capacities as $cap)
            @php
                $yearStart = intval(substr($cap->year, 0, 4));
                $assignedCount = \App\Models\PpdbApplication::where('school_type', 'SMK')
                    ->where('assigned_major', $cap->major)
                    ->where('status', 'accepted')
                    ->whereYear('created_at', $yearStart)
                    ->count();
                $percent = $cap->capacity ? min(100, round($assignedCount / $cap->capacity * 100)) : 0;
                $levelClass = $percent >= 95 ? 'bg-red-500' : ($percent >= 70 ? 'bg-yellow-400' : 'bg-green-500');
            @endphp
            <div class="bg-white shadow border rounded-2xl p-4">
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <p class="text-xs text-slate-500 uppercase tracking-widest">{{ $cap->year }}</p>
                        <h5 class="text-base font-bold">{{ $cap->major }}</h5>
                    </div>
                    <span class="text-xs font-semibold {{ $percent >= 95 ? 'text-red-600' : 'text-slate-600' }}">{{ $percent }}%</span>
                </div>
                <div class="mt-3 h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full {{ $levelClass }}" style="width: {{ $percent }}%"></div>
                </div>
                <p class="text-xs mt-2 text-slate-500">{{ $assignedCount }} / {{ $cap->capacity }} assigned ({{ max($cap->capacity - $assignedCount,0) }} open)</p>
            </div>
        @endforeach
    @else
        <div class="col-span-1 md:col-span-4 p-4 bg-surface-container-highest rounded-2xl text-center text-slate-500">
            No major capacity records found. Please configure capacity in management settings.
        </div>
    @endif
</div>

<!-- Filters & Search Shell -->
<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10">
<div class="flex flex-col md:flex-row gap-4 items-center justify-between">
<div class="flex flex-wrap items-center gap-4 w-full md:w-auto">
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Jurusan</label>
<div class="relative">
<select id="majorFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Jurusan</option>
@foreach($capacities->pluck('major')->unique() as $majorOption)
<option value="{{ $majorOption }}">{{ $majorOption }}</option>
@endforeach
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="expand_more">expand_more</span>
</div>
</div>
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Filter Status</label>
<div class="relative">
<select id="statusFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Status</option>
<option value="payment_uploaded">Pembayaran Diunggah</option>
<option value="accepted">Diterima</option>
<option value="rejected">Ditolak</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="filter_list">filter_list</span>
</div>
</div>
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Cari</label>
<div class="relative">
<input id="searchFilter" type="search" placeholder="Ketik nama/email/ID" class="w-full bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]" />
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="search">search</span>
</div>
</div>

<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Year</label>
<div class="relative">
<select id="yearFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Tahun</option>
@foreach($yearOptions as $yearOption)
<option value="{{ $yearOption }}" {{ ($selectedYear == $yearOption) ? 'selected' : '' }}>{{ $yearOption }}</option>
@endforeach
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="expand_more">expand_more</span>
</div>
</div>
<div class="md:mt-5 self-end">
<button id="resetFiltersBtn" type="button" class="bg-surface-container-high hover:bg-surface-container-highest transition-colors px-4 py-2.5 rounded-2xl text-sm font-medium flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="restart_alt">restart_alt</span>
Reset
</button>
</div>
</div>
<div class="flex flex-wrap items-center gap-2 md:mt-5">
<button id="exportCsvBtn" type="button" class="bg-[#1c190d] text-[#f2cc0d] px-6 py-2.5 rounded-2xl text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
    <span class="material-symbols-outlined text-sm" data-icon="download">download</span> Ekspor CSV
</button>
<button id="exportXlsxBtn" type="button" class="bg-[#0077b6] text-white px-6 py-2.5 rounded-2xl text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
    <span class="material-symbols-outlined text-sm" data-icon="grid_view">grid_view</span> Ekspor Excel
</button>
</div>
</div>
</div>
<!-- Applicant Table -->
<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 mt-8">
    <h4 class="text-lg font-bold mb-4">Daftar Pendaftar</h4>

    <div id="applicantTableLoading" class="flex items-center justify-center p-4 bg-white rounded-xl border mb-4" style="display: none;">
        <div class="animate-spin h-8 w-8 border-4 border-slate-300 border-t-[#1c190d] rounded-full"></div>
        <span class="ml-3 font-semibold">Memuat pendaftar...</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="text-xs text-on-surface-variant uppercase">
                    <th class="py-2 px-3 font-bold">#</th>
                    <th class="py-2 px-3 font-bold">Name</th>
                    <th class="py-2 px-3 font-bold">Email</th>
                    <th class="py-2 px-3 font-bold">Major 1</th>
                    <th class="py-2 px-3 font-bold">Major 2</th>
                    <th class="py-2 px-3 font-bold">Jurusan Ditetapkan</th>
                    <th class="py-2 px-3 font-bold">Status</th>
                    <th class="py-2 px-3 font-bold">Terdaftar</th>
                    <th class="py-2 px-3 font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody id="applicantTableBody">
                @forelse($applicants as $i => $applicant)
                <tr class="bg-surface-container-low rounded-2xl">
                    <td class="py-3 px-3 font-semibold rounded-l-2xl">{{ $i+1 }}</td>
                    <td class="py-3 px-3">{{ $applicant->full_name }}</td>
                    <td class="py-3 px-3">{{ $applicant->email }}</td>
                    <td class="py-3 px-3">{{ $applicant->major_1 }}</td>
                    <td class="py-3 px-3">{{ $applicant->major_2 }}</td>
                    <td class="py-3 px-3">{{ $applicant->assigned_major ?? '-' }}</td>
                    <td class="py-3 px-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ in_array($applicant->status, ['payment_uploaded', 'pending']) ? 'bg-yellow-100 text-yellow-700' : ($applicant->status === 'accepted' ? 'bg-green-100 text-green-700' : ($applicant->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700')) }}">
                            {{ in_array($applicant->status, ['payment_uploaded', 'pending']) ? 'Pembayaran Diunggah' : ucfirst($applicant->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-3">{{ $applicant->created_at ? $applicant->created_at->format('Y-m-d') : '-' }}</td>
                    <td class="py-3 px-3 rounded-r-2xl">
                        <a href="{{ route('admin.ppdb.applicants.smk.detail', $applicant->id) }}" class="inline-flex items-center px-4 py-2 bg-primary text-on-primary rounded-2xl text-xs font-bold hover:bg-primary/90 transition-colors">
                            <span class="material-symbols-outlined text-sm mr-1">visibility</span> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-3 px-3 text-center text-on-surface-variant">Tidak ada pendaftar ditemukan untuk sekolah ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="applicantPagination" class="mt-4 flex items-center justify-between text-sm"></div>
</div>
</div>

@section('page_scripts')
<script>
    (() => {
        const majorFilter = document.getElementById('majorFilter');
        const statusFilter = document.getElementById('statusFilter');
        const yearFilter = document.getElementById('yearFilter');
        const searchFilter = document.getElementById('searchFilter');
        const resetBtn = document.getElementById('resetFiltersBtn');
        const applicantTableBody = document.getElementById('applicantTableBody');
        const totalApplicants = document.getElementById('totalApplicantsValue');
        const pendingApplicants = document.getElementById('pendingApplicantsValue');

        const dataUrl = '{{ route("admin.ppdb.applicants.by_school.data", ["school" => $schoolModel->slug]) }}';
        const exportUrl = '{{ route("admin.ppdb.applicants.by_school.export", ["school" => $schoolModel->slug]) }}';
        const exportXlsxUrl = '{{ route("admin.ppdb.applicants.by_school.export.xlsx", ["school" => $schoolModel->slug]) }}';
        const loadingIndicator = document.getElementById('applicantTableLoading');
        const paginationContainer = document.getElementById('applicantPagination');
        const exportCsvBtn = document.getElementById('exportCsvBtn');
        const exportXlsxBtn = document.getElementById('exportXlsxBtn');
        const pendingOverallApplicants = document.getElementById('pendingOverallApplicantsValue');
        let currentPage = 1;
        let lastPage = 1;
        const perPage = 10;

        console.log('PPDB applicant AJAX data URL:', dataUrl);

        function renderApplicantRows(applicants, page = 1) {
            if (!applicants.length) {
                applicantTableBody.innerHTML = '<tr><td colspan="9" class="py-3 px-3 text-center text-on-surface-variant">Tidak ada pendaftar ditemukan untuk filter yang dipilih.</td></tr>';
                return;
            }
            const offset = (page - 1) * perPage;

            applicantTableBody.innerHTML = applicants.map((app, idx) => {
                const statusClass = ['pending', 'payment_uploaded'].includes(app.status)
                    ? 'bg-yellow-100 text-yellow-700'
                    : (app.status === 'accepted'
                        ? 'bg-green-100 text-green-700'
                        : (app.status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700'));
                const statusLabel = ['pending', 'payment_uploaded'].includes(app.status)
                    ? 'Pembayaran Diunggah'
                    : (app.status ? app.status.charAt(0).toUpperCase() + app.status.slice(1) : '-');

                return `
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-3 px-3 font-semibold rounded-l-2xl">${offset + idx + 1}</td>
                        <td class="py-3 px-3">${app.full_name}</td>
                        <td class="py-3 px-3">${app.email}</td>
                        <td class="py-3 px-3">${app.major_1 || '-'} </td>
                        <td class="py-3 px-3">${app.major_2 || '-'} </td>
                        <td class="py-3 px-3">${app.assigned_major || '-'} </td>
                        <td class="py-3 px-3"><span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${statusClass}">${statusLabel}</span></td>
                        <td class="py-3 px-3">${app.created_at}</td>
                        <td class="py-3 px-3 rounded-r-2xl">
                            <a href="{{ url('/admin/ppdb/applicants/smk') }}/${app.id}" class="inline-flex items-center px-4 py-2 bg-primary text-on-primary rounded-2xl text-xs font-bold hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined text-sm mr-1">visibility</span> Detail
                            </a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        function renderPagination(meta) {
            if (!paginationContainer) return;

            const current = meta.current_page || 1;
            const last = meta.last_page || 1;
            currentPage = current;
            lastPage = last;

            if (last <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            const prevDisabled = current <= 1;
            const nextDisabled = current >= last;

            const pagesToShow = 5;
            const half = Math.floor(pagesToShow / 2);
            let start = Math.max(1, current - half);
            let end = Math.min(last, current + half);
            if (end - start + 1 < pagesToShow) {
                if (start === 1) {
                    end = Math.min(last, start + pagesToShow - 1);
                } else if (end === last) {
                    start = Math.max(1, end - pagesToShow + 1);
                }
            }

            let html = '<div class="flex gap-2 items-center">';
            html += `<button class="px-3 py-1 rounded-lg border ${prevDisabled ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-gray-100'}" ${prevDisabled ? 'disabled' : ''} data-action="prev">Sebelumnya</button>`;

            for (let page = start; page <= end; page++) {
                html += `<button class="px-3 py-1 rounded-lg border ${page === current ? 'bg-[#1c190d] text-[#f2cc0d]' : 'bg-white hover:bg-gray-100'}" data-page="${page}">${page}</button>`;
            }

            html += `<button class="px-3 py-1 rounded-lg border ${nextDisabled ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-gray-100'}" ${nextDisabled ? 'disabled' : ''} data-action="next">Berikutnya</button>`;
            html += '</div>';

            paginationContainer.innerHTML = html;

            paginationContainer.querySelectorAll('button[data-page]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const page = Number(btn.getAttribute('data-page'));
                    if (!isNaN(page)) loadFilteredData(page);
                });
            });

            if (!prevDisabled) {
                paginationContainer.querySelector('button[data-action="prev"]').addEventListener('click', () => loadFilteredData(current - 1));
            }

            if (!nextDisabled) {
                paginationContainer.querySelector('button[data-action="next"]').addEventListener('click', () => loadFilteredData(current + 1));
            }
        }

        async function loadFilteredData(page = 1) {
            currentPage = page;
            const params = new URLSearchParams();
            if (majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
            if (statusFilter.value && statusFilter.value !== 'all') params.append('status', statusFilter.value);
            if (yearFilter.value && yearFilter.value !== 'all') params.append('year', yearFilter.value);
            if (searchFilter && searchFilter.value.trim() !== '') params.append('search', searchFilter.value.trim());
            params.append('page', page);

            console.log('Load data with params:', params.toString());

            if (loadingIndicator) {
                loadingIndicator.style.display = 'flex';
            }

            try {
                const response = await fetch(`${dataUrl}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    console.error('Failed to load applicants', response.status);
                    applicantTableBody.innerHTML = '<tr><td colspan="9" class="py-3 px-3 text-center text-red-600">Gagal memuat data pendaftar (HTTP ' + response.status + ').</td></tr>';
                    return;
                }

                const json = await response.json();
                console.log('AJAX load success', json);
                renderApplicantRows(json.applicants, json.current_page || 1);
                renderPagination(json);
                if (totalApplicants) totalApplicants.textContent = json.total ?? 0;
                if (pendingApplicants) pendingApplicants.textContent = json.pending ?? 0;
                if (pendingOverallApplicants) pendingOverallApplicants.textContent = json.pending_overall ?? 0;
            } catch (error) {
                console.error('AJAX load error:', error);
                applicantTableBody.innerHTML = '<tr><td colspan="9" class="py-3 px-3 text-center text-red-600">Gagal memuat data pendaftar. Silakan coba lagi.</td></tr>';
            } finally {
                if (loadingIndicator) {
                    loadingIndicator.style.display = 'none';
                }
            }
        }

        majorFilter.addEventListener('change', () => loadFilteredData(1));
        statusFilter.addEventListener('change', () => loadFilteredData(1));
        yearFilter.addEventListener('change', () => loadFilteredData(1));
        if (searchFilter) {
            searchFilter.addEventListener('input', debounce(() => loadFilteredData(1), 250));
        }

        if (exportCsvBtn) {
            exportCsvBtn.addEventListener('click', () => {
                const params = new URLSearchParams();
                if (majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
                if (statusFilter.value && statusFilter.value !== 'all') params.append('status', statusFilter.value);
                if (yearFilter.value && yearFilter.value !== 'all') params.append('year', yearFilter.value);
                if (searchFilter && searchFilter.value.trim() !== '') params.append('search', searchFilter.value.trim());

                window.location.href = `${exportUrl}?${params.toString()}`;
            });
        }

        if (exportXlsxBtn) {
            exportXlsxBtn.addEventListener('click', () => {
                const params = new URLSearchParams();
                if (majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
                if (statusFilter.value && statusFilter.value !== 'all') params.append('status', statusFilter.value);
                if (yearFilter.value && yearFilter.value !== 'all') params.append('year', yearFilter.value);
                if (searchFilter && searchFilter.value.trim() !== '') params.append('search', searchFilter.value.trim());

                window.location.href = `${exportXlsxUrl}?${params.toString()}`;
            });
        }

        resetBtn.addEventListener('click', function () {
            majorFilter.value = 'all';
            statusFilter.value = 'all';
            yearFilter.value = 'all';
            if (searchFilter) searchFilter.value = '';
            loadFilteredData(1);
        });

        loadFilteredData(1);
    })();
</script>
@endsection
@endsection








