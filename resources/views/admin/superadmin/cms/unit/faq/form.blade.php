@extends('layouts.admin.app')

@section('title', 'Edit FAQ - ' . strtoupper($schoolType))

@section('content')
<div class="p-10 max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-end gap-4">
        <div>
            <p class="text-primary font-bold tracking-widest text-xs uppercase">FAQ Management</p>
            <h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">Edit FAQ</h2>
            <p class="text-on-surface-variant max-w-2xl">Perbarui pertanyaan dan jawaban FAQ.</p>
        </div>
        <a href="{{ route('admin.cms.faq.index', ['schoolType' => $schoolType]) }}"
           class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
            Kembali ke Daftar FAQ
        </a>
    </div>

    @if ($errors->any())
        <div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
        <form method="POST" action="{{ route('admin.cms.faq.update', ['schoolType' => $schoolType, 'faq' => $faq->id]) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Pertanyaan</label>
                <input type="text" name="question" value="{{ old('question', $faq->question) }}"
                       class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                       required>
            </div>

            <div>
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jawaban</label>
                <textarea name="answer" rows="6"
                          class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                          required>{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="flex items-start gap-6">
                <div class="flex-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}" min="0"
                           class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <p class="text-xs text-on-surface-variant mt-1">Angka lebih kecil tampil lebih atas.</p>
                </div>
                <div class="pt-5 flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active_edit" value="1"
                           {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 accent-primary">
                    <label for="is_active_edit" class="text-sm font-bold text-[#1c190d]">Aktif (tampil di website)</label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.cms.faq.index', ['schoolType' => $schoolType]) }}"
                   class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
