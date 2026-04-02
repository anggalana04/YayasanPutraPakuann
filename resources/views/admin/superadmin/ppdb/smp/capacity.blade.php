@extends('layouts.admin.app')

@section('title', 'Manajemen Kapasitas PPDB - ' . ($school->name ?? ''))

@section('content')
<div class="p-8 max-w-7xl mx-auto w-full space-y-6">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">Kapasitas PPDB</h2>
            <p class="text-on-surface-variant">Sekolah: {{ $school->name }} | Tahun Ajaran: {{ $year }}</p>
        </div>
        <a href="{{ route('admin.ppdb.management', ['school' => $school->slug, 'year' => $year]) }}" class="px-5 py-2 rounded-xl bg-primary text-on-primary font-bold hover:bg-primary/90">Kembali ke PPDB Management</a>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-100 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-100 text-rose-800 border border-rose-200">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-3xl p-6 border border-outline">
        <h3 class="text-xl font-bold mb-3">Perbarui Kapasitas Siswa</h3>
        <p class="text-sm text-on-surface-variant mb-4">SMP Putra Pakuan menerima siswa baru sebagai siswa regular tanpa pembagian jurusan/program khusus.</p>
        <form method="POST" action="{{ route('admin.ppdb.management.capacity.store', ['school' => $school->slug]) }}" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-on-surface-variant mb-1">Tahun Ajaran</label>
                <input type="text" name="year" value="{{ old('year', $year) }}" class="w-full p-3 border rounded-xl bg-surface-container-low" disabled>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-on-surface-variant mb-1">Total Kapasitas Siswa</label>
                <input type="number" name="capacity" min="1" value="{{ old('capacity', $totalCapacity ?? 0) }}" class="w-full p-3 border rounded-xl" required>
            </div>
            <div>
                <button type="submit" class="w-full px-4 py-3 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary/90">Simpan</button>
            </div>
        </form>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl p-6 border border-outline">
        <h3 class="text-xl font-bold mb-4">Statistik Pendaftaran</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-blue-50 rounded-2xl p-4 border border-blue-200">
                <p class="text-xs uppercase text-blue-700 font-bold mb-1">Total Pendaftar</p>
                <p class="text-3xl font-bold text-blue-800">{{ $totalApplicants ?? 0 }}</p>
            </div>
            <div class="bg-green-50 rounded-2xl p-4 border border-green-200">
                <p class="text-xs uppercase text-green-700 font-bold mb-1">Diterima</p>
                <p class="text-3xl font-bold text-green-800">{{ $acceptedCount ?? 0 }}</p>
            </div>
            <div class="bg-amber-50 rounded-2xl p-4 border border-amber-200">
                <p class="text-xs uppercase text-amber-700 font-bold mb-1">Kapasitas</p>
                <p class="text-3xl font-bold text-amber-800">{{ $totalCapacity ?? 0 }}</p>
            </div>
            <div class="bg-purple-50 rounded-2xl p-4 border border-purple-200">
                <p class="text-xs uppercase text-purple-700 font-bold mb-1">Sisa Kuota</p>
                <p class="text-3xl font-bold text-purple-800">{{ max(0, ($totalCapacity ?? 0) - ($acceptedCount ?? 0)) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 rounded-3xl p-6 border border-blue-200">
        <h3 class="text-lg font-bold text-blue-900 mb-2">Catatan untuk SMP</h3>
        <p class="text-sm text-blue-800">SMP Putra Pakuan menerima siswa dalam satu jalur umum tanpa pembagian program/jurusan. Semua siswa yang diterima akan ditempatkan secara regular sesuai dengan kapasitas kelas yang telah ditentukan.</p>
    </div>
</div>
@endsection





