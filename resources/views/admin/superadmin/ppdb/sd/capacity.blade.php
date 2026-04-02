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
        <h3 class="text-xl font-bold mb-3">Tambahkan / Perbarui Kapasitas</h3>
        <form method="POST" action="{{ route('admin.ppdb.management.capacity.store', ['school' => $school->slug]) }}" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-on-surface-variant mb-1">Tahun</label>
                <input type="text" name="year" value="{{ old('year', $year) }}" class="w-full p-2 border rounded-xl" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-on-surface-variant mb-1">Kategori</label>
                <input type="text" name="major" value="{{ old('major') }}" class="w-full p-2 border rounded-xl" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-on-surface-variant mb-1">Kapasitas</label>
                <input type="number" name="capacity" min="0" value="{{ old('capacity', 0) }}" class="w-full p-2 border rounded-xl" required>
            </div>
            <div>
                <button type="submit" class="w-full px-4 py-2 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary/90">Simpan</button>
            </div>
        </form>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl p-6 border border-outline">
        <h3 class="text-xl font-bold mb-4">Daftar Kapasitas Kategori</h3>
        <form method="POST" action="{{ route('admin.ppdb.management.capacity.store', ['school' => $school->slug]) }}">
            @csrf
            <input type="hidden" name="year" value="{{ $year }}">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-on-surface-variant text-left uppercase text-xs">
                        <tr>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Kapasitas</th>
                            <th class="py-2 px-3">Terisi (Diterima)</th>
                            <th class="py-2 px-3">Sisa</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline">
                        @forelse($capacities as $capacity)
                            <tr class="bg-white">
                                <td class="py-2 px-3 font-semibold">{{ $capacity->major }}</td>
                                <td class="py-2 px-3">
                                    <input type="number" name="capacities[{{ $capacity->id }}]" min="0" value="{{ $capacity->capacity }}" class="w-24 p-2 border rounded-md" required>
                                </td>
                                @php
                                    $capacityKey = Illuminate\Support\Str::lower(trim($capacity->major));
                                    $filledCount = $applicantCountByMajor[$capacityKey] ?? 0;
                                @endphp
                                <td class="py-2 px-3">{{ $filledCount }}</td>
                                <td class="py-2 px-3">{{ max(0, $capacity->capacity - $filledCount) }}</td>
                                <td class="py-2 px-3 flex gap-2">
                                    <button type="button" class="px-3 py-2 text-xs bg-rose-600 text-white rounded-md" onclick="confirmDeleteCapacity({{ $capacity->id }}, '{{ $school->slug }}', '{{ $capacity->year }}')">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 px-3 text-center text-on-surface-variant">Belum ada data kapasitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($capacities->isNotEmpty())
                <div class="mt-4 flex justify-end gap-3">
                    <button type="submit" class="px-5 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700">Simpan Semua Perubahan</button>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
function confirmDeleteCapacity(id, school, year) {
    if (!confirm('Hapus data kapasitas ini?')) {
        return;
    }

    const csrfToken = document.querySelector('input[name="_token"]').value;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/ppdb/management/${school}/capacity/${id}`;

    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = csrfToken;

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';

    const yearInput = document.createElement('input');
    yearInput.type = 'hidden';
    yearInput.name = 'year';
    yearInput.value = year;

    form.appendChild(tokenInput);
    form.appendChild(methodInput);
    form.appendChild(yearInput);

    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection




