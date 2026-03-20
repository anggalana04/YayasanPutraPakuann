@extends('layouts.admin.app')

@section('title', 'PPDB Management - SMK Putra Pakuan CMS')

@section('content')
<div class="p-8 max-w-7xl mx-auto w-full">
    <!-- Management Navigation Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">PPDB Management</h2>
            <p class="text-on-surface-variant mt-1">Configure admission cycles, quotas, and registration phases.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.ppdb.applicants') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-on-primary font-bold rounded-3xl shadow-lg hover:scale-105 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-lg">group</span>
                Manage Applicants
            </a>
            <button class="flex items-center gap-2 px-6 py-3 bg-surface-container-high text-on-surface font-semibold rounded-3xl hover:bg-surface-variant transition-all">
                <span class="material-symbols-outlined text-lg">download</span>
                Export Data
            </button>
            <button class="flex items-center gap-2 px-6 py-3 bg-primary-container text-on-primary-fixed font-bold rounded-3xl shadow-lg hover:scale-105 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-lg">save</span>
                Save Changes
            </button>
        </div>
    </div>
    <!-- Target Academic Year & Landing Timer (side by side, equal height) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="flex-1 flex flex-col h-full">
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-primary-container/20 w-full h-full flex flex-col justify-between">
                <label class="block text-[10px] uppercase font-bold text-on-surface-variant mb-4">Target Academic Year</label>
                <div class="flex gap-2 items-center mb-4">
                    <select id="academic-year-select" class="flex-1 bg-surface-container-low border-none rounded-2xl py-3 px-4 text-sm font-bold text-[#1c190d] focus:ring-2 focus:ring-primary-container">
                        <option>2024/2025 (Current)</option>
                        <option>2025/2026</option>
                        <option>2023/2024 (Archived)</option>
                    </select>
                    <button type="button" onclick="addAcademicYear()" class="flex items-center gap-1 px-3 py-2 bg-primary text-on-primary font-bold rounded-xl text-xs shadow hover:bg-primary/90 transition-all">
                        <span class="material-symbols-outlined text-base">add</span>
                        Add Year
                    </button>
                </div>
                <div class="mt-2 p-4 bg-primary-container/10 rounded-2xl">
                    <p class="text-xs text-on-primary-container leading-relaxed">Changes to the academic year will affect all reporting and certificate generation.</p>
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col h-full">
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-primary-container/20 w-full h-full flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-[#1c190d]">Landing Timer</h3>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox"/>
                            <div class="w-11 h-6 bg-primary-container/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-primary after:border-primary after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-6 italic">Show a live countdown on the public registration page for the next deadline.</p>
                    <div class="space-y-4">
                        <div class="bg-primary-container/10 rounded-2xl p-4 flex items-center justify-between">
                            <span class="text-xs text-on-surface-variant">Target Phase</span>
                            <span class="text-xs font-bold text-primary">Phase 1 End</span>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex-1 bg-primary-container/10 rounded-2xl p-3 text-center">
                                <div class="text-xl font-bold text-primary">42</div>
                                <div class="text-[8px] uppercase tracking-widest text-on-surface-variant/60">Days</div>
                            </div>
                            <div class="flex-1 bg-primary-container/10 rounded-2xl p-3 text-center">
                                <div class="text-xl font-bold text-primary">12</div>
                                <div class="text-[8px] uppercase tracking-widest text-on-surface-variant/60">Hours</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration Phase Settings (simple table, aligned with main content) -->
    <div class="bg-surface-container-lowest rounded-3xl shadow-sm mb-10 mt-0">
        <div class="flex justify-between items-center mb-8 px-8 pt-8">
            <h3 class="text-xl font-bold text-[#1c190d] flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">calendar_month</span>
                Registration Phases
            </h3>
            <div class="flex items-center bg-surface-container-low p-1 rounded-2xl">
                <button class="px-4 py-2 bg-surface-container-lowest shadow-sm rounded-xl text-xs font-bold">Timeline View</button>
                <button class="px-4 py-2 text-on-surface-variant text-xs font-medium">Table View</button>
            </div>
        </div>
        <div class="px-8 pb-8">
            <table class="w-full text-sm text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-xs text-on-surface-variant uppercase">
                        <th class="py-2 px-3 font-bold">Phase</th>
                        <th class="py-2 px-3 font-bold">Start Date</th>
                        <th class="py-2 px-3 font-bold">End Date</th>
                        <th class="py-2 px-3 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-3 px-3 font-semibold rounded-l-2xl">Early Bird</td>
                        <td class="py-3 px-3">2024-03-01</td>
                        <td class="py-3 px-3">2024-04-15</td>
                        <td class="py-3 px-3 rounded-r-2xl">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Active</span>
                        </td>
                    </tr>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-3 px-3 font-semibold rounded-l-2xl">Regular</td>
                        <td class="py-3 px-3">2024-04-16</td>
                        <td class="py-3 px-3">2024-06-30</td>
                        <td class="py-3 px-3 rounded-r-2xl">
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant text-[10px] font-bold uppercase tracking-wider rounded-full">Upcoming</span>
                        </td>
                    </tr>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-3 px-3 font-semibold rounded-l-2xl">Late Entry</td>
                        <td class="py-3 px-3">2024-07-01</td>
                        <td class="py-3 px-3">2024-07-15</td>
                        <td class="py-3 px-3 rounded-r-2xl">
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant text-[10px] font-bold uppercase tracking-wider rounded-full">Upcoming</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
