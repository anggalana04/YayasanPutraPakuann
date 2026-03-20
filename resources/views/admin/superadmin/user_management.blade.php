@extends('layouts.admin.app')

@section('title', 'User Management - SMK Putra Pakuan CMS')

@section('content')
<div class="p-8 max-w-7xl mx-auto w-full">
    <div class="mb-10">
        <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">User Management</h2>
        <p class="text-on-surface-variant mt-1">Manage admin users for each school unit (SMK, SMP, SDIT).</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- SMK Admins -->
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-primary-container/20 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-primary">SMK Admins</h3>
                <button class="px-3 py-2 bg-primary text-on-primary font-bold rounded-xl text-xs shadow hover:bg-primary/90 transition-all">+ Add Admin</button>
            </div>
            <table class="w-full text-sm text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-xs text-on-surface-variant uppercase">
                        <th class="py-2 px-2 font-bold">Name</th>
                        <th class="py-2 px-2 font-bold">Email</th>
                        <th class="py-2 px-2 font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-2 px-2 font-semibold rounded-l-2xl">Budi Santoso</td>
                        <td class="py-2 px-2">budi@smk.sch.id</td>
                        <td class="py-2 px-2 rounded-r-2xl flex gap-2">
                            <button class="text-primary hover:underline text-xs">Edit</button>
                            <button class="text-error hover:underline text-xs">Delete</button>
                        </td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
        <!-- SMP Admins -->
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-primary-container/20 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-primary">SMP Admins</h3>
                <button class="px-3 py-2 bg-primary text-on-primary font-bold rounded-xl text-xs shadow hover:bg-primary/90 transition-all">+ Add Admin</button>
            </div>
            <table class="w-full text-sm text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-xs text-on-surface-variant uppercase">
                        <th class="py-2 px-2 font-bold">Name</th>
                        <th class="py-2 px-2 font-bold">Email</th>
                        <th class="py-2 px-2 font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-2 px-2 font-semibold rounded-l-2xl">Siti Aminah</td>
                        <td class="py-2 px-2">siti@smp.sch.id</td>
                        <td class="py-2 px-2 rounded-r-2xl flex gap-2">
                            <button class="text-primary hover:underline text-xs">Edit</button>
                            <button class="text-error hover:underline text-xs">Delete</button>
                        </td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
        <!-- SDIT Admins -->
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-primary-container/20 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg text-primary">SDIT Admins</h3>
                <button class="px-3 py-2 bg-primary text-on-primary font-bold rounded-xl text-xs shadow hover:bg-primary/90 transition-all">+ Add Admin</button>
            </div>
            <table class="w-full text-sm text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-xs text-on-surface-variant uppercase">
                        <th class="py-2 px-2 font-bold">Name</th>
                        <th class="py-2 px-2 font-bold">Email</th>
                        <th class="py-2 px-2 font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-surface-container-low rounded-2xl">
                        <td class="py-2 px-2 font-semibold rounded-l-2xl">Ahmad Fauzi</td>
                        <td class="py-2 px-2">ahmad@sdit.sch.id</td>
                        <td class="py-2 px-2 rounded-r-2xl flex gap-2">
                            <button class="text-primary hover:underline text-xs">Edit</button>
                            <button class="text-error hover:underline text-xs">Delete</button>
                        </td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
