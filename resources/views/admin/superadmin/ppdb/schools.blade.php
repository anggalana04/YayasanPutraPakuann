@extends('layouts.admin.app')

@section('title', 'Pilih Sekolah - Yayasan Putra Pakuan')

@section('content')
<div class="p-10 flex-1">
    <div class="mb-12">
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-bold tracking-tight text-[#1c190d] mb-2">Pilih Unit Sekolah</h3>
                <p class="text-on-surface-variant max-w-xl">Pilih unit sekolah di bawah untuk mengelola data SPMB dan pengaturannya.</p>
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
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">ID</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Nama Sekolah</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Jenis</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1c190d]/5">
                        @forelse($schools as $school)
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6 font-mono text-xs text-on-surface-variant">{{ $school->id }}</td>
                            <td class="px-6 py-6 font-bold text-[#1c190d]">{{ $school->name }}</td>
                            <td class="px-6 py-6 text-on-surface-variant">{{ $school->type }}</td>
                            <td class="px-6 py-6">
                                <a href="{{ route('admin.ppdb.management', $school->slug) }}"
                                   data-admin-nav
                                   hx-boost="true"
                                   hx-target="#admin-page-shell"
                                   hx-select="#admin-page-shell"
                                   hx-swap="outerHTML transition:true"
                                   hx-push-url="true"
                                   class="inline-block rounded-xl bg-[#f2cc0d] px-4 py-2 text-sm font-bold text-[#1c190d] shadow-sm transition-all hover:scale-[1.02] active:scale-95">Kelola</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-on-surface-variant">Tidak ada sekolah ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection





