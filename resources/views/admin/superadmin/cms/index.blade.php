@extends('layouts.admin.app')

@section('content')
<div class="p-10 flex-1">
    <!-- Breadcrumbs / Header -->
    <div class="mb-12">
        <div class="flex items-center gap-2 text-on-surface-variant text-sm mb-4">
            <span>CMS</span>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-[#f2cc0d] font-medium">Page Selection</span>
        </div>
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-bold tracking-tight text-[#1c190d] mb-2">Web Content</h3>
                <p class="text-on-surface-variant max-w-xl">Select a page module to manage its editorial content, media assets, and SEO configurations.</p>
            </div>
            <button class="flex items-center gap-2 bg-[#1c190d] text-white px-6 py-3 rounded-2xl hover:bg-[#1c190d]/90 transition-all font-medium">
                <span class="material-symbols-outlined">add</span>
                <span>Create New Page</span>
            </button>
        </div>
    </div>
    <!-- Bento-Style Overview Grid -->
    <div class="grid grid-cols-12 gap-6 mb-12">
        <div class="col-span-12 bg-surface-container-lowest rounded-3xl p-1 overflow-hidden shadow-sm ring-1 ring-[#1c190d]/5">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Page Identity</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Last Updated</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1c190d]/5">
                        <!-- Home -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Home</div>
                                    <div class="text-xs text-on-surface-variant">/index.html</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 24, 2023 · 14:20</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <a href="{{ url('/admin/cms/detail') }}" class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all inline-block">Edit Content</a>
                            </td>
                        </tr>
                        <!-- Profil -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Profil</div>
                                    <div class="text-xs text-on-surface-variant">/profil</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 20, 2023 · 09:15</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Visi & Misi -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Visi & Misi</div>
                                    <div class="text-xs text-on-surface-variant">/visi-misi</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 18, 2023 · 10:00</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Kategori/Jurusan -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Jurusan</div>
                                    <div class="text-xs text-on-surface-variant">/jurusan</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Yesterday · 16:45</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Draft</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Direktori Guru & Tenaga Kependidikan -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Direktori Guru & Tenaga Kependidikan</div>
                                    <div class="text-xs text-on-surface-variant">/direktori-guru</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 15, 2023 · 13:30</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Direktori Peserta Didik -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Direktori Peserta Didik</div>
                                    <div class="text-xs text-on-surface-variant">/direktori-siswa</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 14, 2023 · 12:00</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Berita -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Berita</div>
                                    <div class="text-xs text-on-surface-variant">/berita</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 13, 2023 · 15:45</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Galeri -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Galeri</div>
                                    <div class="text-xs text-on-surface-variant">/galeri</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 12, 2023 · 11:00</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                        <!-- Kontak -->
                        <tr class="hover:bg-surface-container-low/30 transition-colors group">
                            <td class="px-6 py-6">
                                <div>
                                    <div class="font-bold text-[#1c190d]">Hubungi Kami</div>
                                    <div class="text-xs text-on-surface-variant">/hubungi-kami</div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-on-surface-variant">Oct 11, 2023 · 10:30</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Published</span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button class="bg-[#f2cc0d] text-[#1c190d] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-[1.02] active:scale-95 transition-all">Edit Content</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Footer-like action bar -->
    <div class="mt-auto pt-8 flex items-center justify-between border-t border-[#1c190d]/5">
        <div class="text-xs text-on-surface-variant">
            © 2024 SMK Putra Pakuan CMS System. All editorial rights reserved.
        </div>
        <div class="flex gap-4">
            <button class="px-4 py-2 text-xs font-bold text-on-surface-variant hover:text-[#1c190d]">Global SEO Settings</button>
            <button class="px-4 py-2 text-xs font-bold text-on-surface-variant hover:text-[#1c190d]">Media Library</button>
        </div>
    </div>
</div>
@endsection
