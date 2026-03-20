@extends('layouts.admin.app')

@section('title', 'Applicant Details - SMK Putra Pakuan')

@section('content')
<div class="pt-24 px-8 pb-12 min-h-screen">
    <!-- Applicant Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="relative">
                <img alt="Aditya Maulana Photo" class="w-24 h-24 rounded-3xl object-cover shadow-lg" data-alt="Portrait of a male high school student candidate" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDT7xXrtpIVac5C0qfDkyQLTlUTYnfxX2umOg4BkwQRlbdzSLdOiPGJdzFPQv5aViHco1ilUVL6_IdgWGcMwKWpD6YFV0lhtfxd4r_Luaty-ZmRNyesnRkWTCX3xSRCYsE589pMRxuxFsY_Dgs-6OsDY55dS5haZ2tusoRH9MhTd0RYr9z1BShPPEaZ4czms_p8FRJfrNKG0j4VBspF50CmidE4vAle9Qs4KvMzKhL13FdJ8iMcKqwJz5AFr2HBfPwNg84lX0M9tgQ"/>
                <span class="absolute -bottom-2 -right-2 bg-primary-container text-on-primary-container p-1 rounded-lg border-2 border-surface shadow-sm">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">stars</span>
                </span>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="text-xs font-bold tracking-widest text-primary uppercase">ID: SMK-2024-0892</span>
                    <span class="px-3 py-1 bg-tertiary-container text-on-tertiary-container rounded-full text-[10px] font-black uppercase">Pending Review</span>
                </div>
                <h1 class="text-4xl font-bold font-headline text-on-surface tracking-tight">Aditya Maulana</h1>
                <p class="text-on-surface-variant flex items-center gap-2 mt-1">
                    <span class="material-symbols-outlined text-sm">location_on</span> Bogor, Jawa Barat • Submitted on 14 Oct 2023
                </p>
            </div>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-3 rounded-3xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">Print Summary</button>
            <button class="px-6 py-3 rounded-3xl bg-primary text-on-primary font-bold text-sm shadow-md hover:shadow-xl transition-all">Contact Applicant</button>
        </div>
    </div>
    <!-- Bento Layout -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Left Column: Personal Data & Majors -->
        <div class="md:col-span-8 space-y-6">
            <!-- Major Selections Card -->
            <section class="glass-card rounded-3xl p-8 shadow-[0px_10px_40px_rgba(28,25,13,0.06)]">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-primary font-black text-sm uppercase tracking-tighter block mb-1">Pilihan Jurusan</span>
                        <h3 class="text-xl font-bold font-headline">Vocational Preferences</h3>
                    </div>
                    <span class="material-symbols-outlined text-primary-dim">school</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-primary-container/20 rounded-full -mr-8 -mt-8 group-hover:scale-110 transition-transform"></div>
                        <span class="text-xs font-bold text-primary mb-2 block">1st Priority</span>
                        <h4 class="text-lg font-bold">Software Engineering</h4>
                        <p class="text-xs text-on-surface-variant mt-1">Rekayasa Perangkat Lunak (RPL)</p>
                    </div>
                    <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-secondary-container/30 rounded-full -mr-8 -mt-8 group-hover:scale-110 transition-transform"></div>
                        <span class="text-xs font-bold text-secondary mb-2 block">2nd Priority</span>
                        <h4 class="text-lg font-bold">Multi Media</h4>
                        <p class="text-xs text-on-surface-variant mt-1">Desain Komunikasi Visual (DKV)</p>
                    </div>
                </div>
            </section>
            <!-- Personal Data Section -->
            <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 bg-surface-container-high rounded-full flex items-center justify-center text-primary-dim font-bold">01</span>
                    <h3 class="text-xl font-bold font-headline">Personal Information</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Full Name</label>
                        <p class="text-on-surface font-medium">Aditya Maulana</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">NISN (National ID)</label>
                        <p class="text-on-surface font-medium">0082716354</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Phone Number</label>
                        <p class="text-on-surface font-medium">+62 812-3456-7890</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Household Income</label>
                        <p class="text-on-surface font-medium">Rp 4.500.000 - Rp 7.000.000</p>
                    </div>
                    <div class="sm:col-span-2 space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Residential Address</label>
                        <p class="text-on-surface font-medium">Jl. Pajajaran No. 12, Kel. Baranangsiang, Kec. Bogor Timur, Kota Bogor, Jawa Barat 16143</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Father's Name</label>
                        <p class="text-on-surface font-medium">Rahmat Hidayat</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase">Mother's Name</label>
                        <p class="text-on-surface font-medium">Siti Aminah</p>
                    </div>
                </div>
            </section>
            <!-- Documents Section -->
            <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 bg-surface-container-high rounded-full flex items-center justify-center text-primary-dim font-bold">02</span>
                    <h3 class="text-xl font-bold font-headline">Document Vault</h3>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                    <div class="group relative aspect-3/4 bg-surface-container-low rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <img alt="Academic Certificate" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Official academic graduation certificate document" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQIj9n-eUh-_Z9THwlitdVtL4ZqC70KfLNVgDhsVvHlxQwhl4GvCv26VuDltsu9AmrjgU9oK-ROVB8DhTE-5J8FKB29rwsqHZKklTH2pXyGuD1cMgUJmYNkcMlj-b6uXIK6iTw0PQvYjq5VMKNqmrX5_YU8RB5uzVFzicvwAEtZsLRodQ6fQYEZTWQAyqtMyKTaWz_BBKLTiw9BzU6akWdb27vzSCoBx81_jnfZ95bhJkIODHZXFe-CGvAKt5s_nTYLKi_2fzIsEw"/>
                        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                            <p class="text-white text-xs font-bold mb-2">Ijazah SMP</p>
                            <button class="bg-white text-on-surface py-2 rounded-xl text-[10px] font-black uppercase flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span> View Full
                            </button>
                        </div>
                    </div>
                    <div class="group relative aspect-3/4 bg-surface-container-low rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <img alt="Report Card" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Student report card with grades and evaluations" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCZErQizeHyRNZ_x8VI_6mwMVNkJ_Ag4r4I1IxCqAPpERCXAf064ydJT0HE8qeJussmzVUPrwHSyFSS0IppsgbbEgV3Qu3IjSgVKdO_xkkz6f8EUu6jpTusKPwS2ieQewr714-G3dBf93mt8i465lrxdnScruhDccIg2DsXTKUOxjrk6NnPpomiyiJIXOkHt7AUs--zt5h-HOlw1eSMXVMqLipgOpzva30ZJ8sTzKUnyhOI-7FJkHqSoUyum2q4_hD4HBEomXX-UHI"/>
                        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                            <p class="text-white text-xs font-bold mb-2">Rapor Semester 1-5</p>
                            <button class="bg-white text-on-surface py-2 rounded-xl text-[10px] font-black uppercase flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span> View Full
                            </button>
                        </div>
                    </div>
                    <div class="group relative aspect-3/4 bg-surface-container-low rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <img alt="National ID" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Birth certificate or national identification card document" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCgdX9gI14oLN9mFGGKnkHDB5fGZUICItniesjuLw5Y-7NiALkjCIzDO1OzUxarVYOgGWvgxRkwUb4VOcnWIKhX_inFFY9mQbX7J02FCJINxg9o8IaxzEkrE9gHtEycGZLs-vv8UcAok6JCHjRuMxSgHSZ8eAb97WMQWB0JOqHKUaEoaPjUWoQhKL6R3HB-c2OwGCXXJzcmE5b0wolW87rzgH5Ynbf2ir34eQE-e5lAzb6tU_uupo2hKAPtFdzcfmW8LqGRuKUMVU"/>
                        <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                            <p class="text-white text-xs font-bold mb-2">Kartu Keluarga / AKTA</p>
                            <button class="bg-white text-on-surface py-2 rounded-xl text-[10px] font-black uppercase flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span> View Full
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right Column: Review Panel -->
        <div class="md:col-span-4">
            <div class="sticky top-24 space-y-6">
                <!-- Action Panel -->
                <section class="bg-inverse-surface text-white rounded-3xl p-8 shadow-2xl">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary-container">rate_review</span>
                        <h3 class="text-xl font-bold font-headline">Review Decision</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-bold text-outline-variant uppercase tracking-widest block mb-2">Change Status</label>
                            <div class="grid grid-cols-1 gap-2">
                                <button class="flex items-center justify-between w-full px-4 py-3 bg-white/10 hover:bg-white/20 rounded-2xl text-sm font-bold transition-colors">
                                    <span class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-blue-400"></span> Verify Docs</span>
                                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                                </button>
                                <button class="flex items-center justify-between w-full px-4 py-3 bg-primary/20 border border-primary/40 rounded-2xl text-sm font-bold text-primary-container transition-colors">
                                    <span class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-primary-container"></span> Approve</span>
                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                </button>
                                <button class="flex items-center justify-between w-full px-4 py-3 bg-error/10 hover:bg-error/20 rounded-2xl text-sm font-bold text-error-container transition-colors">
                                    <span class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-error"></span> Reject</span>
                                    <span class="material-symbols-outlined text-sm">cancel</span>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-outline-variant uppercase tracking-widest block mb-2">Internal Note</label>
                            <textarea class="w-full bg-white/5 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-container placeholder:text-gray-500" placeholder="Add a note for the admissions committee..." rows="4"></textarea>
                        </div>
                        <button class="w-full bg-primary-container text-on-primary-container py-4 rounded-3xl font-black uppercase text-sm tracking-widest hover:scale-[1.02] active:scale-95 transition-all shadow-lg">Submit Decision</button>
                    </div>
                </section>
                <!-- Stats / Timeline Card -->
                <section class="bg-surface-container-low rounded-3xl p-6">
                    <h4 class="text-sm font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">history</span> Application Timeline
                    </h4>
                    <div class="space-y-4 relative before:content-[''] before:absolute before:left-2 before:top-2 before:bottom-2 before:w-[1px] before:bg-outline-variant/30">
                        <div class="pl-6 relative">
                            <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-primary border-4 border-surface-container-low"></span>
                            <p class="text-xs font-bold">Registration Started</p>
                            <p class="text-[10px] text-on-surface-variant">12 Oct 2023, 09:15 AM</p>
                        </div>
                        <div class="pl-6 relative">
                            <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-primary border-4 border-surface-container-low"></span>
                            <p class="text-xs font-bold">Documents Uploaded</p>
                            <p class="text-[10px] text-on-surface-variant">14 Oct 2023, 02:45 PM</p>
                        </div>
                        <div class="pl-6 relative">
                            <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-outline-variant/50 border-4 border-surface-container-low"></span>
                            <p class="text-xs font-bold text-on-surface-variant">Final Verification</p>
                            <p class="text-[10px] text-on-surface-variant">Waiting...</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
