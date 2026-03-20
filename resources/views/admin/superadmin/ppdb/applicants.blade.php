@extends('layouts.admin.app')

@section('title', 'PPDB Applicant Management - SMK Putra Pakuan')

@section('content')
<div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
<!-- Header & Stats Bento -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<div class="md:col-span-2 space-y-2">
<div class="flex items-center gap-2 text-[#f2cc0d]">
<span class="text-sm font-bold tracking-widest uppercase">Management Console</span>
<div class="h-px w-12 bg-[#f2cc0d]"></div>
</div>
<h3 class="text-4xl font-bold tracking-tight text-[#1c190d]">Applicant Management</h3>
<p class="text-on-surface-variant max-w-md">Oversee and manage the admission pipeline for the 2024/2025 academic year.</p>
</div>
<div class="bg-[#1c190d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#f2cc0d]/60 text-xs font-bold uppercase tracking-tighter">Total Applicants</span>
<div class="flex items-end justify-between">
<span class="text-3xl font-black text-[#f2cc0d]">1,284</span>
<span class="text-[#f7f7f4]/40 text-xs flex items-center gap-1"><span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span> +12%</span>
</div>
</div>
<div class="bg-[#f2cc0d] p-6 rounded-3xl flex flex-col justify-between">
<span class="text-[#1c190d]/60 text-xs font-bold uppercase tracking-tighter">Pending Reviews</span>
<div class="flex items-end justify-between">
<span class="text-3xl font-black text-[#1c190d]">42</span>
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
<!-- Table Section -->
<div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm border border-outline-variant/10">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant/10">
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant">Applicant Name</th>
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant">Reg ID</th>
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant">Major</th>
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant">Applied Date</th>
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant">Status</th>
<th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-on-surface-variant text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/5">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
    <div>
        <p class="text-sm font-bold text-[#1c190d]">Aditya Maulana</p>
        <p class="text-[10px] text-on-surface-variant">aditya.m@gmail.com</p>
    </div>
</div>
</td>
<td class="px-6 py-5 font-mono text-xs font-bold text-on-surface-variant">PPDB-2024-001</td>
<td class="px-6 py-5">
<span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold">RPL</span>
</td>
<td class="px-6 py-5 text-xs text-on-surface-variant">Oct 12, 2024</td>
<td class="px-6 py-5">
<span class="flex items-center gap-1.5 text-amber-600 font-bold text-[11px] uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Pending
                                    </span>
</td>
<td class="px-6 py-5 text-right"><div class="flex items-center justify-end gap-2">
<a href="{{ route('admin.ppdb.applicant_detail', ['id' => 'PPDB-2024-001']) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#f2cc0d]/10 hover:bg-[#f2cc0d] text-[#1c190d] transition-colors group" title="View Details">
<span class="material-symbols-outlined text-lg" data-icon="visibility">visibility</span>
</a>
<div class="relative inline-block text-left">
<select class="appearance-none bg-[#f2cc0d] text-[#1c190d] text-[10px] font-black uppercase py-1.5 pl-3 pr-8 rounded-lg cursor-pointer border-none ring-0 focus:ring-2 focus:ring-[#1c190d]">
<option>Change Status</option>
<option>Verify</option>
<option>Interview</option>
<option>Accept</option>
<option>Reject</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[#1c190d] text-sm pointer-events-none" data-icon="swap_vert">swap_vert</span>
</div>
</div></td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
    <div>
        <p class="text-sm font-bold text-[#1c190d]">Siti Permata</p>
        <p class="text-[10px] text-on-surface-variant">siti.permata@yahoo.com</p>
    </div>
</div>
</td>
<td class="px-6 py-5 font-mono text-xs font-bold text-on-surface-variant">PPDB-2024-042</td>
<td class="px-6 py-5">
<span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold">TKJ</span>
</td>
<td class="px-6 py-5 text-xs text-on-surface-variant">Oct 10, 2024</td>
<td class="px-6 py-5">
<span class="flex items-center gap-1.5 text-blue-600 font-bold text-[11px] uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                        Verified
                                    </span>
</td>
<td class="px-6 py-5 text-right"><div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#f2cc0d]/10 hover:bg-[#f2cc0d] text-[#1c190d] transition-colors group" title="View Details">
<span class="material-symbols-outlined text-lg" data-icon="visibility">visibility</span>
</button>
<div class="relative inline-block text-left">
<select class="appearance-none bg-[#f2cc0d] text-[#1c190d] text-[10px] font-black uppercase py-1.5 pl-3 pr-8 rounded-lg cursor-pointer border-none ring-0 focus:ring-2 focus:ring-[#1c190d]">
<option>Change Status</option>
<option>Interview</option>
<option>Accept</option>
<option>Reject</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[#1c190d] text-sm pointer-events-none" data-icon="swap_vert">swap_vert</span>
</div>
</div></td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
    <div>
        <p class="text-sm font-bold text-[#1c190d]">Raka Fadillah</p>
        <p class="text-[10px] text-on-surface-variant">raka.f@outlook.com</p>
    </div>
</div>
</td>
<td class="px-6 py-5 font-mono text-xs font-bold text-on-surface-variant">PPDB-2024-118</td>
<td class="px-6 py-5">
<span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold">MM</span>
</td>
<td class="px-6 py-5 text-xs text-on-surface-variant">Oct 08, 2024</td>
<td class="px-6 py-5">
<span class="flex items-center gap-1.5 text-green-600 font-bold text-[11px] uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        Accepted
                                    </span>
</td>
<td class="px-6 py-5 text-right"><div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#f2cc0d]/10 hover:bg-[#f2cc0d] text-[#1c190d] transition-colors group" title="View Details">
<span class="material-symbols-outlined text-lg" data-icon="visibility">visibility</span>
</button>
<div class="relative inline-block text-left">
<select class="appearance-none bg-surface-container text-[#1c190d] text-[10px] font-black uppercase py-1.5 pl-3 pr-8 rounded-lg cursor-pointer border-none ring-0">
<option>Finalized</option>
<option>Change Status</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[#1c190d] text-sm pointer-events-none" data-icon="lock">lock</span>
</div>
</div></td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
    <div>
        <p class="text-sm font-bold text-[#1c190d]">Budi Darmawan</p>
        <p class="text-[10px] text-on-surface-variant">budi.d@gmail.com</p>
    </div>
</div>
</td>
<td class="px-6 py-5 font-mono text-xs font-bold text-on-surface-variant">PPDB-2024-055</td>
<td class="px-6 py-5">
<span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold">AK</span>
</td>
<td class="px-6 py-5 text-xs text-on-surface-variant">Oct 05, 2024</td>
<td class="px-6 py-5">
<span class="flex items-center gap-1.5 text-purple-600 font-bold text-[11px] uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                        Interviewed
                                    </span>
</td>
<td class="px-6 py-5 text-right"><div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#f2cc0d]/10 hover:bg-[#f2cc0d] text-[#1c190d] transition-colors group" title="View Details">
<span class="material-symbols-outlined text-lg" data-icon="visibility">visibility</span>
</button>
<div class="relative inline-block text-left">
<select class="appearance-none bg-[#f2cc0d] text-[#1c190d] text-[10px] font-black uppercase py-1.5 pl-3 pr-8 rounded-lg cursor-pointer border-none ring-0 focus:ring-2 focus:ring-[#1c190d]">
<option>Change Status</option>
<option>Accept</option>
<option>Reject</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[#1c190d] text-sm pointer-events-none" data-icon="swap_vert">swap_vert</span>
</div>
</div></td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
    <div>
        <p class="text-sm font-bold text-[#1c190d]">Dina Nurhaliza</p>
        <p class="text-[10px] text-on-surface-variant">dina.nur@gmail.com</p>
    </div>
</div>
</td>
<td class="px-6 py-5 font-mono text-xs font-bold text-on-surface-variant">PPDB-2024-201</td>
<td class="px-6 py-5">
<span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[11px] font-bold">RPL</span>
</td>
<td class="px-6 py-5 text-xs text-on-surface-variant">Oct 01, 2024</td>
<td class="px-6 py-5">
<span class="flex items-center gap-1.5 text-error font-bold text-[11px] uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-error"></span>
                                        Rejected
                                    </span>
</td>
<td class="px-6 py-5 text-right"><div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#f2cc0d]/10 hover:bg-[#f2cc0d] text-[#1c190d] transition-colors group" title="View Details">
<span class="material-symbols-outlined text-lg" data-icon="visibility">visibility</span>
</button>
<div class="relative inline-block text-left">
<select class="appearance-none bg-surface-container text-on-surface-variant text-[10px] font-black uppercase py-1.5 pl-3 pr-8 rounded-lg cursor-pointer border-none ring-0">
<option>No Actions</option>
<option>Re-evaluate</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm pointer-events-none" data-icon="block">block</span>
</div>
</div></td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Shell -->
<div class="px-6 py-6 bg-surface-container-low/30 flex items-center justify-between border-t border-outline-variant/5">
<p class="text-xs text-on-surface-variant font-medium">Showing 1-10 of 1,284 applicants</p>
<div class="flex items-center gap-1">
<button class="p-2 hover:bg-surface-container-high rounded-xl transition-colors disabled:opacity-30">
<span class="material-symbols-outlined text-sm" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-xl bg-[#1c190d] text-[#f2cc0d] text-xs font-bold">1</button>
<button class="w-8 h-8 rounded-xl hover:bg-surface-container-high text-xs font-bold transition-colors">2</button>
<button class="w-8 h-8 rounded-xl hover:bg-surface-container-high text-xs font-bold transition-colors">3</button>
<span class="px-2 text-on-surface-variant">...</span>
<button class="w-8 h-8 rounded-xl hover:bg-surface-container-high text-xs font-bold transition-colors">128</button>
<button class="p-2 hover:bg-surface-container-high rounded-xl transition-colors">
<span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
@endsection
