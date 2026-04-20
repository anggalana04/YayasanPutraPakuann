@extends('layouts.admin.app')

@section('title', 'SPMB Manajemen Pendaftar - ' . ($schoolModel->name ?? ''))

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

    $paymentMethodOptions = $applicants->pluck('payment_method')->filter()->unique()->values();
    if ($paymentMethodOptions->isEmpty()) {
        $paymentMethodOptions = collect(['gopay', 'dana', 'ovo', 'shopeepay', 'bank', 'tu']);
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
@if(!empty($selectedPaymentMethod) || !empty($selectedPaymentStatus))
    <p class="text-on-surface-variant font-semibold">
        @if(!empty($selectedPaymentMethod))
            Metode pembayaran: {{ strtoupper(str_replace('_', ' ', $selectedPaymentMethod)) }}
        @endif
        @if(!empty($selectedPaymentMethod) && !empty($selectedPaymentStatus))
            ·
        @endif
        @if(!empty($selectedPaymentStatus))
            Status pembayaran: {{ $selectedPaymentStatus === 'paid' ? 'Sudah Bayar' : ($selectedPaymentStatus === 'unpaid' ? 'Belum Bayar' : ucfirst(str_replace('_', ' ', $selectedPaymentStatus))) }}
        @endif
    </p>
@else
    <p class="text-on-surface-variant">Belum ada filter dipilih, menampilkan semua pendaftar untuk {{ $schoolModel->name ?? '' }}.</p>
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
<span class="text-[#1c190d]/60 text-xs font-bold uppercase tracking-tighter">Perlu Direview ?</span>
<div class="flex items-end justify-between">
<span id="pendingApplicantsValue" class="text-3xl font-black text-[#1c190d]">{{ $pendingCount ?? $applicants->whereIn('status', ['pending', 'payment_uploaded'])->count() }}</span>
<span class="material-symbols-outlined text-[#1c190d]/40" data-icon="pending_actions">pending_actions</span>
</div>
</div>

</div>


<!-- Filters & Search Shell -->
<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10">
<div class="flex flex-col md:flex-row gap-4 items-center justify-between">
<div class="flex flex-wrap items-center gap-4 w-full md:w-auto">
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Status Pembayaran</label>
<div class="relative">
<select id="paymentStatusFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Status Pembayaran</option>
<option value="unpaid" {{ ($selectedPaymentStatus == 'unpaid') ? 'selected' : '' }}>Belum Bayar</option>
<option value="paid" {{ ($selectedPaymentStatus == 'paid') ? 'selected' : '' }}>Sudah Bayar</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="filter_list">filter_list</span>
</div>
</div>
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Langkah Pendaftaran</label>
<div class="relative">
<select id="registrationStepFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Langkah</option>
<option value="waiting_payment_verification" {{ ($selectedRegistrationStep == 'waiting_payment_verification') ? 'selected' : '' }}>Menunggu Verifikasi Pembayaran</option>
<option value="biodata" {{ ($selectedRegistrationStep == 'biodata') ? 'selected' : '' }}>Biodata</option>
<option value="berkas" {{ ($selectedRegistrationStep == 'berkas') ? 'selected' : '' }}>Berkas</option>
<option value="selesai" {{ ($selectedRegistrationStep == 'selesai') ? 'selected' : '' }}>Selesai</option>
<option value="wawancara" {{ ($selectedRegistrationStep == 'wawancara') ? 'selected' : '' }}>Wawancara</option>
<option value="diterima" {{ ($selectedRegistrationStep == 'diterima') ? 'selected' : '' }}>Diterima</option>
<option value="ditolak" {{ ($selectedRegistrationStep == 'ditolak') ? 'selected' : '' }}>Ditolak</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="expand_more">expand_more</span>
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
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Metode Pembayaran</label>
<div class="relative">
<select id="paymentMethodFilter" class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option value="all">Semua Metode Pembayaran</option>
@foreach($paymentMethodOptions as $paymentMethodOption)
<option value="{{ $paymentMethodOption }}" {{ ($selectedPaymentMethod == $paymentMethodOption) ? 'selected' : '' }}>{{ strtoupper(str_replace('_', ' ', $paymentMethodOption)) }}</option>
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
<button id="showReviewBtn" type="button" class="bg-warning-container text-on-warning-container px-4 py-2.5 rounded-2xl text-sm font-bold hover:opacity-90 transition-opacity">
    <span class="material-symbols-outlined text-sm">visibility</span> Perlu Direview
</button>
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

    <!-- Bulk Action Bar -->
    <div id="bulkActionBar" class="hidden mb-4 p-4 bg-primary-container/20 border border-primary/30 rounded-2xl flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="text-sm font-semibold text-on-surface">
                Dipilih: <span id="selectedCount" class="font-bold text-primary">0</span> pendaftar
            </span>
        </div>
        <div class="flex items-center gap-2">
            <button id="bulkDeleteBtn" type="button" class="bg-error text-on-error px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined text-sm">delete</span> Hapus Yang Dipilih
            </button>
            <button id="clearSelectionBtn" type="button" class="bg-surface-container text-on-surface px-4 py-2.5 rounded-xl text-xs font-bold hover:bg-surface-container-highest transition-colors">
                Batal
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-outline-variant/30">
                    <th class="px-4 py-4 text-left">
                        <input type="checkbox" id="selectAllCheckbox" class="rounded border-outline-variant">
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">ID</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Email</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jenis Pembayaran</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Terdaftar</th>
                    <th class="px-4 py-4 text-right text-xs font-bold text-on-surface-variant uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="applicantTableBody" class="divide-y divide-outline-variant/20">
                @forelse($applicants as $i => $applicant)
                <tr class="hover:bg-surface-container-low/50 transition-colors group">
                    <td class="px-4 py-3">
                        <input type="checkbox" class="rowCheckbox rounded border-outline-variant" value="{{ $applicant->id }}">
                    </td>
                    <td class="px-4 py-3 font-mono text-on-surface-variant text-xs">{{ $applicant->application_id }}</td>
                    <td class="px-4 py-3 font-semibold text-on-surface">{{ $applicant->full_name }}</td>
                    <td class="px-4 py-3 text-on-surface-variant">{{ $applicant->email }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ in_array($applicant->status, ['payment_uploaded', 'pending']) ? 'bg-warning-container text-on-warning-container' : ($applicant->status === 'accepted' ? 'bg-success-container text-on-success-container' : ($applicant->status === 'rejected' ? 'bg-error-container text-on-error-container' : 'bg-surface-container text-on-surface')) }}">
                            {{ in_array($applicant->status, ['payment_uploaded', 'pending']) ? 'Menunggu' : ucfirst($applicant->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $applicant->payment_method ? strtoupper(str_replace('_', ' ', $applicant->payment_method)) : '—' }}</td>
                    <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $applicant->created_at ? $applicant->created_at->format('d M Y') : '—' }}</td>
                    <td class="px-4 py-3 text-right">
                        @if(in_array($applicant->status, ['pending', 'payment_uploaded']) && $applicant->payment_method)
                            <button type="button" onclick="openPaymentVerificationModal({{ $applicant->id }})" class="inline-flex items-center gap-1 text-xs font-bold text-green-600 hover:underline px-3 py-1.5 rounded-full bg-green-50 hover:bg-green-100 transition-colors">
                                <span class="material-symbols-outlined text-sm">verified_user</span>
                                Konfirmasi
                            </button>
                        @else
                            <a href="{{ route('admin.ppdb.applicants.by_school.detail', ['school' => $schoolModel->slug, 'id' => $applicant->id]) }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:underline px-3 py-1.5 rounded-full bg-blue-50 hover:bg-blue-100 transition-colors">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                Lihat
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada pendaftar ditemukan untuk sekolah ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-outline-variant/20 text-xs text-on-surface-variant">
        Menampilkan {{ $applicants->count() }} pendaftar
    </div>

    <div id="applicantPagination" class="mt-4 flex items-center justify-between text-sm"></div>
</div>
</div>

<!-- APPLICANT DETAIL MODAL -->
<div id="applicantDetailModal" class="applicant-detail-modal">
    <div class="modal-overlay" onclick="closeDetailModal()"></div>
    <div class="modal-container">
        <div class="modal-header">
            <h2 id="detailModalTitle" class="modal-title">Detail Pendaftar</h2>
            <button onclick="closeDetailModal()" class="modal-close-btn" title="Tutup (ESC)">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <div class="modal-loader">
                <div class="spinner"></div>
                <p>Memuat data pendaftar...</p>
            </div>
        </div>
    </div>
</div>

<!-- PROFESSIONAL DOCUMENT VIEWER MODAL -->
<div id="docViewerModal" class="doc-viewer-modal">
    <div class="doc-viewer-overlay"></div>
    <div class="doc-viewer-container">
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
        <div id="docViewerControls" class="doc-viewer-controls">
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
        <div id="docViewerLoader" class="doc-viewer-loader">
            <div class="doc-spinner"></div>
            <p>Memuat dokumen...</p>
        </div>
        <div id="docViewerContent" class="doc-viewer-content"></div>
    </div>
</div>

@section('page_scripts')
<style>
/* Applicant Detail Modal Styles */
.applicant-detail-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99999;
}

.applicant-detail-modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(28, 25, 13, 0.5);
    backdrop-filter: blur(4px);
}

.modal-container {
    position: relative;
    background: white;
    border-radius: 24px;
    width: 90%;
    max-width: 600px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px;
    border-bottom: 1px solid #e5e5e5;
}

.modal-title {
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    color: #1c190d;
}

.modal-close-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 12px;
    background: #f5f5f5;
    color: #1c190d;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0;
}

.modal-close-btn:hover {
    background: #efefef;
    transform: rotate(90deg);
}

.modal-close-btn span {
    font-size: 20px;
}

.modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 24px;
}

.modal-loader {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 24px;
    color: #666;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #e5e5e5;
    border-top-color: #1c190d;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-bottom: 16px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}


.payment-proof:hover {
    border-color: #1c190d;
    box-shadow: 0 4px 12px rgba(28, 25, 13, 0.1);
}

.payment-proof img {
    width: 100%;
    height: auto;
    display: block;
    max-height: 300px;
    object-fit: cover;
}


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

.doc-viewer-content::-webkit-scrollbar {
    width: 12px;
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
</style>
<script>
    // Modal management functions
    function closeDetailModal() {
        const modal = document.getElementById('applicantDetailModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Payment proof viewer state
    let paymentProofState = {
        currentZoom: 1,
        minZoom: 0.5,
        maxZoom: 3,
        offsetX: 0,
        offsetY: 0,
        isDragging: false,
        startX: 0,
        startY: 0
    };

    function initPaymentProofViewer(imageUrl) {
        const img = document.getElementById('paymentProofImg');
        const container = document.getElementById('paymentProofContainer');

        if (!img || !container) return;

        paymentProofState = {
            currentZoom: 1,
            minZoom: 0.5,
            maxZoom: 3,
            offsetX: 0,
            offsetY: 0,
            isDragging: false,
            startX: 0,
            startY: 0
        };

        // Mouse events
        img.addEventListener('mousedown', (e) => {
            paymentProofState.isDragging = true;
            paymentProofState.startX = e.clientX - paymentProofState.offsetX;
            paymentProofState.startY = e.clientY - paymentProofState.offsetY;
            img.style.cursor = 'grabbing';
            e.preventDefault();
        });

        document.addEventListener('mousemove', (e) => {
            if (!paymentProofState.isDragging) return;
            paymentProofState.offsetX = e.clientX - paymentProofState.startX;
            paymentProofState.offsetY = e.clientY - paymentProofState.startY;
            updatePaymentProofTransform();
        });

        document.addEventListener('mouseup', () => {
            paymentProofState.isDragging = false;
            const img = document.getElementById('paymentProofImg');
            if (img) img.style.cursor = 'grab';
        });

        // Touch events for mobile
        img.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) {
                paymentProofState.isDragging = true;
                paymentProofState.startX = e.touches[0].clientX - paymentProofState.offsetX;
                paymentProofState.startY = e.touches[0].clientY - paymentProofState.offsetY;
            }
        });

        img.addEventListener('touchmove', (e) => {
            if (!paymentProofState.isDragging || e.touches.length !== 1) return;
            paymentProofState.offsetX = e.touches[0].clientX - paymentProofState.startX;
            paymentProofState.offsetY = e.touches[0].clientY - paymentProofState.startY;
            updatePaymentProofTransform();
            e.preventDefault();
        });

        img.addEventListener('touchend', () => {
            paymentProofState.isDragging = false;
        });
    }

    function updatePaymentProofTransform() {
        const img = document.getElementById('paymentProofImg');
        if (!img) return;
        img.style.transform = `translate(${paymentProofState.offsetX}px, ${paymentProofState.offsetY}px) scale(${paymentProofState.currentZoom})`;
    }

    function zoomPaymentProof(delta) {
        paymentProofState.currentZoom = Math.max(paymentProofState.minZoom, Math.min(paymentProofState.maxZoom, paymentProofState.currentZoom + delta));
        updatePaymentProofTransform();
    }

    function resetPaymentProofZoom() {
        paymentProofState.currentZoom = 1;
        paymentProofState.offsetX = 0;
        paymentProofState.offsetY = 0;
        updatePaymentProofTransform();
    }

    async function openPaymentVerificationModal(applicantId) {
        const modal = document.getElementById('applicantDetailModal');
        const modalBody = document.getElementById('detailModalBody');
        const detailModalTitle = document.getElementById('detailModalTitle');

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        detailModalTitle.textContent = 'Memuat...';
        modalBody.innerHTML = '<div class="modal-loader"><div class="spinner"></div><p>Memuat data verifikasi pembayaran...</p></div>';

        try {
            const response = await fetch(`{{ route('admin.ppdb.applicants.by_school.data', ['school' => $schoolModel->slug]) }}?id=${applicantId}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) throw new Error('Failed to load');
            const data = await response.json();
            const applicant = data.applicants?.[0] || data;

            // Only proceed if applicant has a payment method
            if (!applicant.payment_method) {
                closeDetailModal();
                alert('Pendaftar ini belum melakukan pembayaran.');
                return;
            }

            detailModalTitle.textContent = 'Verifikasi Pembayaran';

            // Build payment verification HTML
            let html = '<div class="space-y-5">';

            html += `<div class="rounded-3xl border border-outline p-4 bg-surface-container-low shadow-sm">
                <div class="text-xs font-bold uppercase tracking-[0.3em] text-primary mb-2">SPMB ID</div>
                <div class="font-mono text-2xl md:text-3xl font-black tracking-[0.25em] text-on-surface">${applicant.application_id || '—'}</div>
                <div class="mt-2 text-sm text-on-surface-variant">${applicant.full_name || '—'}</div>
            </div>`;

            html += `<div class="rounded-3xl border border-blue-200 bg-blue-50 p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-blue-700">Data Pendaftar</p>
                        <p class="text-sm text-on-surface-variant">Detail pembayaran dan informasi pendaftar</p>
                    </div>
                    ${applicant.status ? `<span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-700">${applicant.status.replace(/_/g, ' ')}</span>` : ''}
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <div class="space-y-1"><p class="text-gray-600">Nama</p><p class="font-bold">${applicant.full_name || '—'}</p></div>
                    <div class="space-y-1"><p class="text-gray-600">Email</p><p class="font-bold">${applicant.email || '—'}</p></div>
                    ${applicant.payment_method ? `<div class="space-y-1"><p class="text-gray-600">Metode</p><p class="font-bold uppercase">${applicant.payment_method}</p></div>` : ''}
                    ${applicant.payment_date ? `<div class="space-y-1"><p class="text-gray-600">Tanggal</p><p class="font-bold">${new Date(applicant.payment_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p></div>` : ''}
                </div>
            </div>`;

            // Payment proof section
            if (applicant.payment_proof) {
                const payExt = applicant.payment_proof.split('.').pop();
                const payUrl = '/storage/' + applicant.payment_proof;
                html += `<div class="rounded-3xl border border-outline p-4 bg-white shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-2xl text-primary">photo_library</span>
                        <div>
                            <p class="text-sm font-bold">Bukti Pembayaran</p>
                            <p class="text-xs text-on-surface-variant">Klik untuk memperbesar</p>
                        </div>
                    </div>
                    <div id="paymentProofContainer" class="rounded-3xl overflow-hidden border border-surface-variant bg-surface-container-low">
                        <img src="${payUrl}" alt="Bukti Pembayaran" id="paymentProofImg" class="w-full h-auto max-h-[420px] object-cover" style="touch-action: none; cursor: grab;" />
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-2">
                        <button type="button" onclick="zoomPaymentProof(0.2)" title="Zoom In" class="rounded-2xl border border-outline px-3 py-2 text-sm font-semibold text-on-surface hover:bg-surface-container transition">
                            <span class="material-symbols-outlined align-middle">add</span> Zoom In
                        </button>
                        <button type="button" onclick="zoomPaymentProof(-0.2)" title="Zoom Out" class="rounded-2xl border border-outline px-3 py-2 text-sm font-semibold text-on-surface hover:bg-surface-container transition">
                            <span class="material-symbols-outlined align-middle">remove</span> Zoom Out
                        </button>
                        <button type="button" onclick="resetPaymentProofZoom()" title="Reset" class="rounded-2xl border border-outline px-3 py-2 text-sm font-semibold text-on-surface hover:bg-surface-container transition">
                            <span class="material-symbols-outlined align-middle">refresh</span> Reset
                        </button>
                    </div>
                    <p class="text-xs text-on-surface-variant text-center mt-3">💡 Geser untuk pan, gunakan tombol di atas untuk zoom.</p>
                </div>`;
                setTimeout(() => initPaymentProofViewer(payUrl), 100);
            }

            // Payment details
            html += `<div class="rounded-3xl border border-outline p-4 bg-surface-container-low shadow-sm">
                <p class="text-xs uppercase tracking-[0.3em] font-bold text-on-surface-variant mb-4">Detail Pembayaran</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">`;

            if (applicant.payment_amount) {
                html += `<div class="rounded-2xl bg-white p-3 border border-surface-variant"><p class="text-gray-600">Jumlah</p><p class="font-bold">Rp ${new Intl.NumberFormat('id-ID').format(applicant.payment_amount)}</p></div>`;
            }
            if (applicant.payment_method) {
                html += `<div class="rounded-2xl bg-white p-3 border border-surface-variant"><p class="text-gray-600">Metode</p><p class="font-bold uppercase">${applicant.payment_method.toUpperCase()}</p></div>`;
            }
            if (applicant.payment_date) {
                html += `<div class="rounded-2xl bg-white p-3 border border-surface-variant"><p class="text-gray-600">Tanggal</p><p class="font-bold">${new Date(applicant.payment_date).toLocaleDateString('id-ID', {year: 'numeric', month: 'long', day: 'numeric'})}</p></div>`;
            }

            html += `</div>
            </div>`;

            // Status check - only show "already verified" if payment_confirmed
            const isAlreadyConfirmed = applicant.status === 'payment_confirmed';
            const shouldShowConfirmButton = ['pending', 'payment_uploaded'].includes(applicant.status);

            if (isAlreadyConfirmed && !shouldShowConfirmButton) {
                html += `<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-3">
                    <span style="font-size: 24px;">✓</span>
                    <div>
                        <p class="font-bold text-blue-800 text-sm">Pembayaran Sudah Terverifikasi</p>
                        <p class="text-xs text-blue-700">Pembayaran ini sudah dikonfirmasi oleh admin pada ${applicant.payment_date ? new Date(applicant.payment_date).toLocaleDateString('id-ID', {year: 'numeric', month: 'long', day: 'numeric'}) : 'N/A'}.</p>
                    </div>
                </div>`;
            } else if (shouldShowConfirmButton) {
                // Verification button
                html += `<div class="space-y-2">
                    <button type="button" onclick="confirmPaymentVerification(${applicantId})" id="verifyPaymentBtn" class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-base">verified</span>
                        Konfirmasi Pembayaran
                    </button>
                </div>`;
            }

            html += '</div>';
            modalBody.innerHTML = html;
        } catch (error) {
            console.error('Error loading payment data:', error);
            modalBody.innerHTML = '<div style="text-align: center; color: #d32f2f; padding: 20px;"><p>Gagal memuat data pembayaran</p></div>';
        }
    }

    async function confirmPaymentVerification(applicantId) {
        const btn = document.getElementById('verifyPaymentBtn');
        if (!confirm('Konfirmasi pembayaran dari pendaftar ini?')) return;

        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined text-base animate-spin" style="display: inline-block;">hourglass_empty</span> Memproses...';

        try {
            const response = await fetch(`/admin/ppdb/applicants/{{ $schoolModel->slug }}/${applicantId}/confirm-payment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ id: applicantId })
            });

            const data = await response.json();

            if (data.success) {
                const modalBody = document.getElementById('detailModalBody');
                modalBody.innerHTML = `<div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center space-y-3">
                    <span style="font-size: 48px; display: block;">✓</span>
                    <h3 class="font-bold text-green-800 text-lg">Pembayaran Terverifikasi!</h3>
                    <p class="text-sm text-green-700">Pembayaran pendaftar telah dikonfirmasi dengan sukses.</p>
                </div>`;

                // Reload table after 1.5 seconds
                setTimeout(() => {
                    closeDetailModal();
                    if (window.loadFilteredData) window.loadFilteredData(1);
                }, 1500);
            } else {
                alert('Error: ' + (data.message || 'Gagal mengkonfirmasi pembayaran'));
                btn.disabled = false;
                btn.innerHTML = '<span class="material-symbols-outlined text-base">verified</span> Konfirmasi Pembayaran';
            }
        } catch (error) {
            console.error('Error confirming payment:', error);
            alert('Terjadi kesalahan saat mengkonfirmasi pembayaran');
            btn.disabled = false;
            btn.innerHTML = '<span class="material-symbols-outlined text-base">verified</span> Konfirmasi Pembayaran';
        }
    }

    // Document viewer class
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
            this.currentUrl = '';
            this.currentType = '';
            this.initEventListeners();
        }

        initEventListeners() {
            document.getElementById('closeViewerBtn').addEventListener('click', () => this.close());
            document.getElementById('downloadBtn').addEventListener('click', () => this.download());
            document.getElementById('zoomInBtn').addEventListener('click', () => this.zoom(this.zoomStep));
            document.getElementById('zoomOutBtn').addEventListener('click', () => this.zoom(-this.zoomStep));
            document.getElementById('resetZoomBtn').addEventListener('click', () => this.resetZoom());
            this.modal.querySelector('.doc-viewer-overlay').addEventListener('click', () => this.close());
            document.addEventListener('keydown', (e) => this.handleKeyboard(e));
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
            img.alt = 'Document';
            img.onload = () => {
                this.loader.style.display = 'none';
                this.content.appendChild(img);
                this.enableImagePan(img);
            };
            img.onerror = () => this.showError('Gagal memuat gambar');
        }

        loadPDF(url) {
            this.controls.style.display = 'none';
            this.loader.style.display = 'none';
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            this.content.appendChild(iframe);
        }

        loadOther(url, type) {
            this.loader.style.display = 'none';
            this.controls.style.display = 'none';
            this.content.innerHTML = `<div style="text-align: center; color: white;"><p style="font-size: 18px;">File ${type.toUpperCase()} tidak dapat ditampilkan</p></div>`;
        }

        showError(message) {
            this.loader.style.display = 'none';
            this.content.innerHTML = `<div style="text-align: center; color: white;"><p>${message}</p></div>`;
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

            this.content.addEventListener('mouseup', () => this.isDragging = false);
            this.content.addEventListener('mouseleave', () => this.isDragging = false);
        }

        zoom(delta) {
            const img = this.content.querySelector('img');
            if (!img) return;
            this.currentZoom = Math.max(this.minZoom, Math.min(this.maxZoom, this.currentZoom + delta));
            img.style.transform = `scale(${this.currentZoom})`;
            this.updateZoomDisplay();
        }

        resetZoom() {
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
            if (e.key === 'Escape') this.close();
            else if (e.key === '+' || e.key === '=') this.zoom(this.zoomStep);
            else if (e.key === '-') this.zoom(-this.zoomStep);
            else if (e.key === '0') this.resetZoom();
        }
    }

    const docViewer = new DocumentViewer();
    function openDocViewer(url, title, type) {
        docViewer.open(url, title, type);
    }

    // Close modals on escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeDetailModal();
        }
    });

    (() => {
        const majorFilter = document.getElementById('majorFilter');
        const registrationStepFilter = document.getElementById('registrationStepFilter');
        const paymentStatusFilter = document.getElementById('paymentStatusFilter');
        const paymentMethodFilter = document.getElementById('paymentMethodFilter');
        const searchFilter = document.getElementById('searchFilter');
        const selectedYear = @json($selectedYear ?? null);
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
        const showReviewBtn = document.getElementById('showReviewBtn');
        const pendingOverallApplicants = document.getElementById('pendingOverallApplicantsValue');
        let currentPage = 1;
        let lastPage = 1;
        const perPage = 10;

        console.log('SPMB applicant AJAX data URL:', dataUrl);

        const bulkActionBar = document.getElementById('bulkActionBar');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const selectedCountSpan = document.getElementById('selectedCount');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const clearSelectionBtn = document.getElementById('clearSelectionBtn');
        const schoolSlug = '{{ $schoolModel->slug }}';
        const bulkDeleteUrl = '{{ route("admin.ppdb.applicants.by_school.bulk_delete", ["school" => $schoolModel->slug]) }}';
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('.rowCheckbox:checked');
            const count = checkedBoxes.length;
            selectedCountSpan.textContent = count;
            bulkActionBar.classList.toggle('hidden', count === 0);
        }

        function attachCheckboxListeners() {
            const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });
        }

        selectAllCheckbox?.addEventListener('change', function() {
            const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });

        clearSelectionBtn?.addEventListener('click', function() {
            const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            selectAllCheckbox.checked = false;
            updateSelectedCount();
        });

        bulkDeleteBtn?.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.rowCheckbox:checked');
            if (checkedBoxes.length === 0) {
                alert('Silakan pilih setidaknya satu pendaftar untuk dihapus.');
                return;
            }

            if (!confirm(`Anda yakin ingin menghapus ${checkedBoxes.length} pendaftar? Tindakan ini tidak dapat dibatalkan.`)) {
                return;
            }

            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            bulkDeleteBtn.disabled = true;
            bulkDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">hourglass_empty</span> Menghapus...';

            fetch(bulkDeleteUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`${data.deleted || ids.length} pendaftar berhasil dihapus.`);
                    // Reload the data
                    loadFilteredData(1);
                    clearSelectionBtn.click();
                } else {
                    alert('Error: ' + (data.message || 'Gagal menghapus pendaftar'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saat menghapus pendaftar: ' + error.message);
            })
            .finally(() => {
                bulkDeleteBtn.disabled = false;
                bulkDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-sm">delete</span> Hapus Yang Dipilih';
            });
        });

        function renderApplicantRows(applicants, page = 1) {
            if (!applicants.length) {
                applicantTableBody.innerHTML = '<tr><td colspan="7" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada pendaftar ditemukan untuk filter yang dipilih.</td></tr>';
                return;
            }

            applicantTableBody.innerHTML = applicants.map((app, idx) => {
                const statusClass = ['pending', 'payment_uploaded'].includes(app.status)
                    ? 'bg-warning-container text-on-warning-container'
                    : (app.status === 'accepted'
                        ? 'bg-success-container text-on-success-container'
                        : (app.status === 'rejected' ? 'bg-error-container text-on-error-container' : 'bg-surface-container text-on-surface'));
                const statusLabel = ['pending', 'payment_uploaded'].includes(app.status)
                    ? 'Menunggu'
                    : (app.status ? app.status.charAt(0).toUpperCase() + app.status.slice(1) : '—');

                // Show konfirmasi button only for pending/payment_uploaded status AND has payment method
                const showKonfirmasiBtn = ['pending', 'payment_uploaded'].includes(app.status) && app.payment_method;

                return `
                    <tr class="hover:bg-surface-container-low/50 transition-colors group">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rowCheckbox rounded border-outline-variant" value="${app.id}">
                        </td>
                        <td class="px-4 py-3 font-mono text-on-surface-variant text-xs">${app.application_id}</td>
                        <td class="px-4 py-3 font-semibold text-on-surface">${app.full_name}</td>
                        <td class="px-4 py-3 text-on-surface-variant">${app.email}</td>
                        <td class="px-4 py-3"><span class="text-xs font-bold px-2.5 py-1 rounded-full ${statusClass}">${statusLabel}</span></td>
                        <td class="px-4 py-3 text-on-surface-variant text-xs">${app.created_at}</td>
                        <td class="px-4 py-3 text-right">
                            ${showKonfirmasiBtn ? `
                                <button type="button" onclick="openPaymentVerificationModal(${app.id})" class="inline-flex items-center gap-1 text-xs font-bold text-green-600 hover:underline px-3 py-1.5 rounded-full bg-green-50 hover:bg-green-100 transition-colors">
                                    <span class="material-symbols-outlined text-sm">verified_user</span>
                                    Konfirmasi
                                </button>
                            ` : `
                                <a href="/admin/ppdb/applicants/{{ $schoolModel->slug }}/${app.id}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:underline px-3 py-1.5 rounded-full bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    Lihat
                                </a>
                            `}
                        </td>
                    </tr>
                `;
            }).join('');

            // Re-attach checkbox event listeners after rendering
            attachCheckboxListeners();
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
            if (majorFilter && majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
            if (registrationStepFilter && registrationStepFilter.value && registrationStepFilter.value !== 'all') params.append('registration_step', registrationStepFilter.value);
            if (paymentStatusFilter && paymentStatusFilter.value && paymentStatusFilter.value !== 'all') params.append('payment_status', paymentStatusFilter.value);
            if (paymentMethodFilter.value && paymentMethodFilter.value !== 'all') params.append('payment_method', paymentMethodFilter.value);
            if (selectedYear && selectedYear !== 'all') params.append('year', selectedYear);
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

        window.loadFilteredData = loadFilteredData;

        if (majorFilter) {
            majorFilter.addEventListener('change', () => loadFilteredData(1));
        }
        if (registrationStepFilter) {
            registrationStepFilter.addEventListener('change', () => loadFilteredData(1));
        }
        if (paymentStatusFilter) {
            paymentStatusFilter.addEventListener('change', () => loadFilteredData(1));
        }
        paymentMethodFilter.addEventListener('change', () => loadFilteredData(1));
        if (searchFilter) {
            searchFilter.addEventListener('input', debounce(() => loadFilteredData(1), 250));
        }

        if (exportCsvBtn) {
            exportCsvBtn.addEventListener('click', () => {
                const params = new URLSearchParams();
                if (majorFilter && majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
                if (registrationStepFilter && registrationStepFilter.value && registrationStepFilter.value !== 'all') params.append('registration_step', registrationStepFilter.value);
                if (paymentStatusFilter && paymentStatusFilter.value && paymentStatusFilter.value !== 'all') params.append('payment_status', paymentStatusFilter.value);
                if (paymentMethodFilter.value && paymentMethodFilter.value !== 'all') params.append('payment_method', paymentMethodFilter.value);
                if (selectedYear && selectedYear !== 'all') params.append('year', selectedYear);
                if (searchFilter && searchFilter.value.trim() !== '') params.append('search', searchFilter.value.trim());

                window.location.href = `${exportUrl}?${params.toString()}`;
            });
        }

        if (exportXlsxBtn) {
            exportXlsxBtn.addEventListener('click', () => {
                const params = new URLSearchParams();
                if (majorFilter && majorFilter.value && majorFilter.value !== 'all') params.append('major', majorFilter.value);
                if (registrationStepFilter && registrationStepFilter.value && registrationStepFilter.value !== 'all') params.append('registration_step', registrationStepFilter.value);
                if (paymentStatusFilter && paymentStatusFilter.value && paymentStatusFilter.value !== 'all') params.append('payment_status', paymentStatusFilter.value);
                if (paymentMethodFilter.value && paymentMethodFilter.value !== 'all') params.append('payment_method', paymentMethodFilter.value);
                if (selectedYear && selectedYear !== 'all') params.append('year', selectedYear);
                if (searchFilter && searchFilter.value.trim() !== '') params.append('search', searchFilter.value.trim());

                window.location.href = `${exportXlsxUrl}?${params.toString()}`;
            });
        }

        if (showReviewBtn) {
            showReviewBtn.addEventListener('click', () => {
                if (paymentStatusFilter) {
                    paymentStatusFilter.value = 'unpaid';
                }
                loadFilteredData(1);
            });
        }

        resetBtn.addEventListener('click', function () {
            if (majorFilter) majorFilter.value = 'all';
            if (registrationStepFilter) registrationStepFilter.value = 'all';
            if (paymentStatusFilter) paymentStatusFilter.value = 'all';
            paymentMethodFilter.value = 'all';
            if (searchFilter) searchFilter.value = '';
            loadFilteredData(1);
        });

        loadFilteredData(1);
    })();
</script>
@endsection
@endsection








