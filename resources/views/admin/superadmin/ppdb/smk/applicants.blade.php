@extends('layouts.admin.app')

@section('title', 'PPDB Applicant Management - ' . ($schoolModel->name ?? ''))

@section('content')
<div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
<!-- Header & Stats Bento -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<div class="md:col-span-2 space-y-2">
<div class="flex items-center gap-2 text-[#f2cc0d]">
<span class="text-sm font-bold tracking-widest uppercase">Management Console</span>
<div class="h-px w-12 bg-[#f2cc0d]"></div>
</div>
<h3 class="text-4xl font-bold tracking-tight text-[#1c190d]">Applicant Management - {{ $schoolModel->name ?? '' }}</h3>
<p class="text-on-surface-variant max-w-md">Oversee and manage the admission pipeline for the 2024/2025 academic year.</p>
</div>
<div class="bg-[#1c190d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#f2cc0d]/60 text-xs font-bold uppercase tracking-tighter">Total Applicants</span>
<div class="flex items-end justify-between">
<span class="text-3xl font-black text-[#f2cc0d]">{{ $applicants->count() }}</span>
<span class="text-[#f7f7f4]/40 text-xs flex items-center gap-1"><span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span></span>
</div>
</div>
<div class="bg-[#f2cc0d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#1c190d]/60 text-xs font-bold uppercase tracking-tighter">Pending Reviews</span>
<div class="flex items-end justify-between">
<span class="text-3xl font-black text-[#1c190d]">{{ $applicants->where('status', 'pending')->count() }}</span>
<span class="material-symbols-outlined text-[#1c190d]/40" data-icon="pending_actions">pending_actions</span>
</div>
</div>
</div>
<!-- Filters & Search Shell -->
<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10">
<div class="flex flex-col md:flex-row gap-4 items-center justify-between">
<div class="flex flex-wrap items-center gap-4 w-full md:w-auto">
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Vocational Major</label>
<div class="relative">
<select class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option>All Majors</option>
<option>Rekayasa Perangkat Lunak</option>
<option>Teknik Komputer Jaringan</option>
<option>Multimedia</option>
<option>Akuntansi</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="expand_more">expand_more</span>
</div>
</div>
<div class="flex flex-col gap-1.5 min-w-45">
<label class="text-[10px] font-bold uppercase text-on-surface-variant ml-2">Status Filter</label>
<div class="relative">
<select class="w-full appearance-none bg-surface-container-low border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f2cc0d]">
<option>All Status</option>
<option>Pending</option>
<option>Verified</option>
<option>Interviewed</option>
<option>Accepted</option>
<option>Rejected</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="filter_list">filter_list</span>
</div>
</div>
<div class="md:mt-5 self-end">
<button class="bg-surface-container-high hover:bg-surface-container-highest transition-colors px-4 py-2.5 rounded-2xl text-sm font-medium flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="restart_alt">restart_alt</span>
                                Reset
                             </button>
</div>
</div>
<div class="flex items-center gap-2 md:mt-5">
<button class="bg-[#1c190d] text-[#f2cc0d] px-6 py-2.5 rounded-2xl text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined text-sm" data-icon="download">download</span>
                            Export CSV
                        </button>
</div>
</div>
</div>
<!-- Applicant Table -->
<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 mt-8">
    <h4 class="text-lg font-bold mb-4">Applicants List</h4>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="text-xs text-on-surface-variant uppercase">
                    <th class="py-2 px-3 font-bold">#</th>
                    <th class="py-2 px-3 font-bold">Name</th>
                    <th class="py-2 px-3 font-bold">Email</th>
                    <th class="py-2 px-3 font-bold">Status</th>
                    <th class="py-2 px-3 font-bold">Registered</th>
                    <th class="py-2 px-3 font-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applicants as $i => $applicant)
                <tr class="bg-surface-container-low rounded-2xl">
                    <td class="py-3 px-3 font-semibold rounded-l-2xl">{{ $i+1 }}</td>
                    <td class="py-3 px-3">{{ $applicant->full_name }}</td>
                    <td class="py-3 px-3">{{ $applicant->email }}</td>
                    <td class="py-3 px-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $applicant->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : ($applicant->status == 'accepted' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($applicant->status) }}
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
                    <td colspan="6" class="py-3 px-3 text-center text-on-surface-variant">No applicants found for this school.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
