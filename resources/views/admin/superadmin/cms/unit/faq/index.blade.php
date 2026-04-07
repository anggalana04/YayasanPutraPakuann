@extends('layouts.admin.app')

@section('title', 'CMS FAQ - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-5xl mx-auto space-y-6" x-data="{ showAddForm: false }">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">FAQ Management</p>
            <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">{{ strtoupper($schoolType) }}</h2>
            <p class="text-on-surface-variant max-w-2xl">Tambah, ubah, dan hapus pertanyaan yang sering diajukan (FAQ) di halaman kontak.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cms.by_school', ['schoolType' => $schoolType]) }}"
               class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                Kembali ke CMS
            </a>
            <button @click="showAddForm = !showAddForm"
                    class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                + Tambah FAQ
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ── Add FAQ Form (collapsible) ──────────────────────────────── --}}
    <div x-show="showAddForm" x-cloak x-transition class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
        <h3 class="text-lg font-bold text-[#1c190d] mb-4">Tambah FAQ Baru</h3>
        <form method="POST" action="{{ route('admin.cms.faq.store', ['schoolType' => $schoolType]) }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Pertanyaan</label>
                <input type="text" name="question" value="{{ old('question') }}"
                       class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                       placeholder="Contoh: Bagaimana cara mendaftar SPMB?" required>
            </div>
            <div>
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jawaban</label>
                <textarea name="answer" rows="4"
                          class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                          placeholder="Tulis jawaban lengkap di sini..." required>{{ old('answer') }}</textarea>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <p class="text-xs text-on-surface-variant mt-1">Angka lebih kecil tampil lebih atas.</p>
                </div>
                <div class="pt-5 flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active_new" value="1" checked class="h-4 w-4 accent-primary">
                    <label for="is_active_new" class="text-sm font-bold text-[#1c190d]">Aktif (tampil di website)</label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                    Simpan FAQ
                </button>
                <button type="button" @click="showAddForm = false"
                        class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                    Batal
                </button>
            </div>
        </form>
    </div>

    {{-- ── FAQ List ──────────────────────────────────────────────── --}}
    <div class="bg-surface-container-lowest rounded-3xl p-5 shadow-sm ring-1 ring-[#1c190d]/5 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 w-8">#</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Pertanyaan</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
                    <th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1c190d]/5">
                @forelse ($faqs as $faq)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-4 py-4 text-xs text-on-surface-variant font-mono">{{ $faq->sort_order }}</td>
                        <td class="px-4 py-4">
                            <p class="font-bold text-[#1c190d] text-sm">{{ Str::limit($faq->question, 100) }}</p>
                            <p class="text-xs text-on-surface-variant mt-1">{{ Str::limit(strip_tags($faq->answer), 80) }}</p>
                        </td>
                        <td class="px-4 py-4">
                            @if ($faq->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-wider rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2 items-center">
                                <a href="{{ route('admin.cms.faq.edit', ['schoolType' => $schoolType, 'faq' => $faq->id]) }}"
                                   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.cms.faq.destroy', ['schoolType' => $schoolType, 'faq' => $faq->id]) }}" onsubmit="return confirm('Hapus FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-[#1c190d] text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant">Belum ada FAQ. Klik "+ Tambah FAQ" untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
