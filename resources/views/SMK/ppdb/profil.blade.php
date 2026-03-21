@extends('layouts.SMK.ppdb')

@section('ppdb-content')

<!-- Profile Action Card -->
<div class="bg-white p-6 rounded-xl shadow-[0_4px_20px_rgba(28,25,13,0.04)]">
<div class="flex items-center gap-4 mb-6">
<div class="w-16 h-16 rounded-full bg-brand-yellow/10 flex items-center justify-center overflow-hidden">
<img alt="Profile Picture" class="w-full h-full object-cover" data-alt="Student profile portrait picture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCix3S2dGwgPpGn8Z6mm9KUNBjFnZoEk-bL-0OCQxfc2Fp_OTyXrL2sevXNvsuDFoyrzU-Tp3arjp-K6NKKbbmdU6Zhss5HCge909XfJ0D5jDEDNFhJwHpRE9TcS8zA9RnDpCF1UZ7g5wwXLIb6WYikj8RKMB8aNiZ2Fs4JxC21fjcfcaz2RA0e1YMnasKABQkioci-ySScbs6KjfB6uwrZvpCGhPJ5UpU1V478cZ6YRlSujotZQaAvsld2Ltk692diqCDsdJKO20"/>
</div>
<div>
<h4 class="font-bold text-brand-charcoal">Ahmad Syarifuddin</h4>
<p class="text-xs text-on-surface-variant">Calon Peserta Didik</p>
</div>
</div>
<div class="space-y-3">
<button class="w-full flex items-center justify-between p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-brand-charcoal/60 group-hover:text-brand-yellow" data-icon="person_edit">person_edit</span>
<span class="text-sm font-medium">Lengkapi Profil</span>
</div>
<span class="material-symbols-outlined text-sm text-on-surface-variant" data-icon="chevron_right">chevron_right</span>
</button>
<button class="w-full flex items-center justify-between p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-brand-charcoal/60 group-hover:text-brand-yellow" data-icon="cloud_download">cloud_download</span>
<span class="text-sm font-medium">Unduh Kartu Peserta</span>
</div>
<span class="material-symbols-outlined text-sm text-on-surface-variant" data-icon="chevron_right">chevron_right</span>
</button>
<form method="POST" action="{{ route('ppdb.logout', ['school' => $school]) }}" class="w-full">
    @csrf
    <button type="submit" class="w-full flex items-center justify-between p-4 rounded-xl bg-red-50 hover:bg-red-100 transition-colors group">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-red-500" data-icon="logout">logout</span>
            <span class="text-sm font-medium text-red-700">Keluar</span>
        </div>
        <span class="material-symbols-outlined text-sm text-red-500" data-icon="chevron_right">chevron_right</span>
    </button>
</form>
</div>
</div>


@endsection

@section('ppdb-footer')

@endsection
