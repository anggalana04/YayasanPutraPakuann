@extends('layouts.admin.app')

@section('content')
<!-- Dashboard Canvas -->
<div class="p-8 max-w-7xl mx-auto">
    <!-- Hero Stats Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <!-- Stat Card 1 -->
        <div class="col-span-1 md:col-span-2 bg-[#1c190d] rounded-3xl p-8 relative overflow-hidden text-white flex flex-col justify-between h-64">
            <div class="relative z-10">
                <p class="text-white/60 text-sm font-medium tracking-wide mb-1">Total Applicants</p>
                <h2 class="text-5xl font-bold tracking-tight text-[#f2cc0d]">1,284</h2>
            </div>
            <div class="relative z-10 flex items-center gap-2 text-sm text-green-400 font-medium">
                <span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>
                <span>12.5% increase from last period</span>
            </div>
            <div class="absolute -right-10 -bottom-10 opacity-10">
                <span class="material-symbols-outlined text-[12rem]" data-icon="groups">groups</span>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="bg-primary-container rounded-3xl p-6 flex flex-col justify-between border-none shadow-sm h-64">
            <div class="w-12 h-12 rounded-2xl bg-[#1c190d] text-[#f2cc0d] flex items-center justify-center mb-4">
                <span class="material-symbols-outlined" data-icon="event_available">event_available</span>
            </div>
            <div>
                <p class="text-[#1c190d]/60 text-xs font-bold uppercase tracking-widest mb-1">Active Phase</p>
                <h3 class="text-xl font-bold text-[#1c190d]">Gelombang 2</h3>
                <p class="text-[#1c190d]/70 text-sm mt-1">Ends in 14 days</p>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-surface-container-lowest rounded-3xl p-6 flex flex-col justify-between border-none shadow-sm h-64">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-2xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="pending_actions">pending_actions</span>
                </div>
                <span class="bg-error-container/20 text-error font-bold text-[10px] px-2 py-1 rounded-full uppercase">Action Required</span>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-on-surface">42</h3>
                <p class="text-on-surface-variant text-sm font-medium">Pending Verifications</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Activity Panel -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Analytics Teaser -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-on-surface">Website Visitors</h3>
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-2 text-xs font-medium text-on-surface-variant">
                            <span class="w-2 h-2 rounded-full bg-primary-container"></span> Mobile
                        </span>
                        <span class="flex items-center gap-2 text-xs font-medium text-on-surface-variant">
                            <span class="w-2 h-2 rounded-full bg-[#1c190d]"></span> Desktop
                        </span>
                    </div>
                </div>
                <!-- Visual representation of data (Placeholder for Chart) -->
                <div class="h-48 w-full flex items-end gap-3 px-4">
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[40%] relative group">
                        <div class="absolute bottom-0 w-full bg-primary-container rounded-t-xl h-[60%] transition-all group-hover:h-[80%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[70%] relative group">
                        <div class="absolute bottom-0 w-full bg-[#1c190d] rounded-t-xl h-[40%] transition-all group-hover:h-[50%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[55%] relative group">
                        <div class="absolute bottom-0 w-full bg-primary-container rounded-t-xl h-[30%] transition-all group-hover:h-[40%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[90%] relative group">
                        <div class="absolute bottom-0 w-full bg-[#1c190d] rounded-t-xl h-[70%] transition-all group-hover:h-[85%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[65%] relative group">
                        <div class="absolute bottom-0 w-full bg-primary-container rounded-t-xl h-[50%] transition-all group-hover:h-[60%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[80%] relative group">
                        <div class="absolute bottom-0 w-full bg-[#1c190d] rounded-t-xl h-[30%] transition-all group-hover:h-[45%]"></div>
                    </div>
                    <div class="w-full bg-surface-container-low rounded-t-xl h-[45%] relative group">
                        <div class="absolute bottom-0 w-full bg-primary-container rounded-t-xl h-[80%] transition-all group-hover:h-[90%]"></div>
                    </div>
                </div>
                <div class="grid grid-cols-7 mt-4 px-4 text-[10px] text-outline font-bold uppercase tracking-wider text-center">
                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                </div>
            </div>
            <!-- Content Updates Table -->
            <div class="bg-surface-container-low/50 rounded-[2.5rem] p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-on-surface">Recent Content Updates</h3>
                    <button class="text-primary font-bold text-sm hover:underline">View All</button>
                </div>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-2xl flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
                                <span class="material-symbols-outlined" data-icon="article">article</span>
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">Updated: Admission Requirements</p>
                                <p class="text-xs text-on-surface-variant">Modified by Admin Sarah • 2 hours ago</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors" data-icon="chevron_right">chevron_right</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-secondary-container flex items-center justify-center text-on-secondary-container">
                                <span class="material-symbols-outlined" data-icon="image">image</span>
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">Hero Banner: New School Year 2024</p>
                                <p class="text-xs text-on-surface-variant">Modified by Admin Mike • 5 hours ago</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors" data-icon="chevron_right">chevron_right</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Sidebar: Recent Activity & Quick Actions -->
        <div class="space-y-8">
            <div class="bg-[#1c190d] text-white rounded-[2.5rem] p-8 shadow-xl">
                <h3 class="text-xl font-bold mb-8 text-[#f2cc0d]">Recent Registrations</h3>
                <div class="space-y-8 relative before:content-[''] before:absolute before:left-2.75 before:top-2 before:bottom-2 before:w-0.5 before:bg-white/10">
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary-container border-4 border-[#1c190d]"></div>
                        <p class="text-sm font-bold">Ahmad Fauzi</p>
                        <p class="text-xs text-white/50 mb-1">Teknik Komputer & Jaringan</p>
                        <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded text-white/70">12 min ago</span>
                    </div>
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-white/20 border-4 border-[#1c190d]"></div>
                        <p class="text-sm font-bold">Siti Aminah</p>
                        <p class="text-xs text-white/50 mb-1">Akuntansi</p>
                        <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded text-white/70">45 min ago</span>
                    </div>
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-white/20 border-4 border-[#1c190d]"></div>
                        <p class="text-sm font-bold">Rizky Pratama</p>
                        <p class="text-xs text-white/50 mb-1">Multi Media</p>
                        <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded text-white/70">1 hour ago</span>
                    </div>
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-white/20 border-4 border-[#1c190d]"></div>
                        <p class="text-sm font-bold">Larasati Putri</p>
                        <p class="text-xs text-white/50 mb-1">Perkantoran</p>
                        <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded text-white/70">3 hours ago</span>
                    </div>
                </div>
                <button class="w-full mt-10 py-3 border border-white/20 rounded-2xl text-sm font-medium hover:bg-white/5 transition-colors">See Detailed List</button>
            </div>
            <!-- Quick Navigation -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm">
                <h3 class="text-lg font-bold mb-6 text-on-surface">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-primary group-hover:text-on-primary-container" data-icon="mail">mail</span>
                        <span class="text-xs font-bold text-on-surface">Broadcast</span>
                    </button>
                    <button class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-primary group-hover:text-on-primary-container" data-icon="file_download">file_download</span>
                        <span class="text-xs font-bold text-on-surface">Export CSV</span>
                    </button>
                    <button class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-primary group-hover:text-on-primary-container" data-icon="analytics">analytics</span>
                        <span class="text-xs font-bold text-on-surface">Reports</span>
                    </button>
                    <button class="p-4 rounded-3xl bg-surface-container-low hover:bg-primary-container transition-all group flex flex-col gap-2">
                        <span class="material-symbols-outlined text-primary group-hover:text-on-primary-container" data-icon="lock">lock</span>
                        <span class="text-xs font-bold text-on-surface">Logs</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
