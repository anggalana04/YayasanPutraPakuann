@extends('layouts.admin.app')

@section('title', ($mode === 'create' ? 'Tambah' : 'Ubah') . ' Guru & Staff - ' . strtoupper($schoolType))

@section('content')
<x-admin.cms-form-shell
    eyebrow="Guru & Staf"
    :title="$mode === 'create' ? 'Tambah Guru & Staf' : 'Ubah Guru & Staf'"
    :subtitle="$school->name . ' (' . strtoupper($schoolType) . ')'"
    :back-url="route('admin.cms.guru.index', ['schoolType' => $schoolType])"
    back-label="Kembali ke daftar"
>
    <form method="POST" action="{{ $mode === 'create' ? route('admin.cms.guru.store', ['schoolType' => $schoolType]) : route('admin.cms.guru.update', ['schoolType' => $schoolType, 'guru' => $item->id]) }}" enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jabatan *</label>
                    <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                           placeholder="Contoh: Guru Matematika, Kepala Sekolah, dll" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Departemen/Jurusan *</label>
                    <select name="department" required class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Pilih Departemen/Jurusan</option>
                        <option value="Teknik Kendaraan Ringan" {{ old('department', $item->department ?? '') === 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan Ringan</option>
                        <option value="Teknik Sepeda Motor" {{ old('department', $item->department ?? '') === 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                        <option value="Teknik Jaringan Komputer" {{ old('department', $item->department ?? '') === 'Teknik Jaringan Komputer' ? 'selected' : '' }}>Teknik Jaringan Komputer</option>
                        <option value="Multimedia/DKV" {{ old('department', $item->department ?? '') === 'Multimedia/DKV' ? 'selected' : '' }}>Multimedia/DKV</option>
                        <option value="Manajemen Perkantoran" {{ old('department', $item->department ?? '') === 'Manajemen Perkantoran' ? 'selected' : '' }}>Manajemen Perkantoran</option>
                        <option value="Akuntansi" {{ old('department', $item->department ?? '') === 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Tipe *</label>
                    <select name="type" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" required>
                        <option value="teacher" {{ old('type', $item->type ?? '') === 'teacher' ? 'selected' : '' }}>Guru</option>
                        <option value="staff" {{ old('type', $item->type ?? '') === 'staff' ? 'selected' : '' }}>Staf</option>
                        <option value="management" {{ old('type', $item->type ?? '') === 'management' ? 'selected' : '' }}>Manajemen</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Email</label>
                    <input type="email" name="email" value="{{ old('email', $item->email ?? '') }}"
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $item->phone ?? '') }}"
                           class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status *</label>
                    <select name="status" class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" required>
                        <option value="active" {{ old('status', $item->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $item->status ?? '') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Foto Profil</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90" />
                @if ($mode === 'edit' && $item->photo_url)
                    <div class="mt-2">
                        <img src="{{ $item->photo_url }}" alt="Current photo" class="w-24 h-24 object-cover rounded-xl border" />
                        <p class="text-xs text-on-surface-variant/70 mt-1">Foto saat ini. Unggah foto baru untuk mengganti.</p>
                    </div>
                @endif
                <p class="text-xs text-on-surface-variant/70">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
            </div>
            </div>
        </div>

        <div class="flex gap-3 pt-6">
            <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all">
                {{ $mode === 'create' ? 'Tambah Data' : 'Simpan Perubahan' }}
            </button>
            <a href="{{ route('admin.cms.guru.index', ['schoolType' => $schoolType]) }}"
               class="px-8 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm">
                Batal
            </a>
        </div>
    </form>
</x-admin.cms-form-shell>
@endsection





