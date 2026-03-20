@extends('layouts.admin.app')

@section('title', 'Select School - Yayasan Putra Pakuan')

@section('content')
<div class="p-10 flex-1">
    <!-- Breadcrumbs / Header -->
    <div class="mb-12">
        <div class="flex items-center gap-2 text-on-surface-variant text-sm mb-4">
            <span>CMS</span>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-[#f2cc0d] font-medium">Select School</span>
        </div>
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-bold tracking-tight text-[#1c190d] mb-2">Select School Unit</h3>
                <p class="text-on-surface-variant max-w-xl">Choose a school unit below to manage its content and settings.</p>
            </div>
        </div>
    </div>
    <!-- School Selection Table -->
    <div class="grid grid-cols-12 gap-6 mb-12">
        <div class="col-span-12 bg-surface-container-lowest rounded-3xl p-1 overflow-hidden shadow-sm ring-1 ring-[#1c190d]/5">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">School Name</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Type</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1c190d]/5">
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6 font-bold text-[#1c190d]">SMK Putra Pakuan</td>
                            <td class="px-6 py-6 text-on-surface-variant">SMK</td>
                            <td class="px-6 py-6">
                                <a href="{{ route('admin.cms.index') }}" class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all inline-block">Manage</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6 font-bold text-[#1c190d]">SDIT Putra Pakuan</td>
                            <td class="px-6 py-6 text-on-surface-variant">SDIT</td>
                            <td class="px-6 py-6">
                                <a href="#" class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all inline-block">Manage</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6 font-bold text-[#1c190d]">SMP Putra Pakuan</td>
                            <td class="px-6 py-6 text-on-surface-variant">SMP</td>
                            <td class="px-6 py-6">
                                <a href="#" class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all inline-block">Manage</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6 font-bold text-[#1c190d]">Yayasan Putra Pakuan</td>
                            <td class="px-6 py-6 text-on-surface-variant">Yayasan</td>
                            <td class="px-6 py-6">
                                <a href="#" class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all inline-block">Manage</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
