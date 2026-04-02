@extends('layouts.admin.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'CMS Guru & Staff - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">Guru & Staff Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Kelola data guru, staf, dan tenaga kependidikan per jenjang sekolah.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                Kembali ke CMS
            </a>
            <a href="{{ route('admin.cms.guru.create', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah Guru/Staff
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-3xl p-5 shadow-sm ring-1 ring-[#1c190d]/5 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Foto</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Nama</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Jabatan</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Departemen</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Tipe</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($teacherStaff as $person)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4">
                            @if ($person->photo_url)
                                <img src="{{ $person->photo_url }}" alt="{{ $person->name }}" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-200 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">person</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-[#1c190d]">{{ $person->name }}</div>
                            @if ($person->email)
                                <div class="text-xs text-on-surface-variant/70">{{ $person->email }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm">{{ $person->title }}</td>
                        <td class="px-4 py-4 text-sm">{{ $person->department ?? '-' }}</td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 text-xs font-bold rounded-full
                                @if($person->type === 'management') bg-accent-yellow text-[#1c190d]
                                @elseif($person->type === 'teacher') bg-primary text-white
                                @else bg-slate-500 text-white @endif">
                                {{ ucfirst($person->type) }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 text-xs font-bold rounded-full
                                @if($person->status === 'active') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($person->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('admin.cms.guru.edit', ['schoolType' => $schoolType, 'guru' => $person->id]) }}"
                                   class="px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.guru.destroy', ['schoolType' => $schoolType, 'guru' => $person->id]) }}"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-on-surface-variant/70">
                            <div class="space-y-2">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant/30">school</span>
                                <p>Belum ada data guru/staff untuk jenjang ini.</p>
                                <a href="{{ route('admin.cms.guru.create', ['schoolType' => $schoolType]) }}"
                                   class="inline-block px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
                                    Tambah Data Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($teacherStaff->hasPages())
        <div class="flex justify-center">
            {{ $teacherStaff->links() }}
        </div>
    @endif
</div>
@endsection





