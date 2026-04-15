@extends('layouts.admin.app')

@section('title')
Detail Siswa – {{ $student->full_name }}
@endsection

@section('content')
@php
    $slug      = strtolower($schoolModel->type === 'SDIT' ? 'sd' : $schoolModel->type);
    $app       = $student->ppdbApplication;
    $isSmk     = strtoupper($schoolModel->type) === 'SMK';

    $statusBadge = [
        'active'      => 'bg-green-100 text-green-800 border-green-200',
        'graduated'   => 'bg-blue-100 text-blue-800 border-blue-200',
        'dropped'     => 'bg-red-100 text-red-800 border-red-200',
        'transferred' => 'bg-orange-100 text-orange-800 border-orange-200',
    ][$student->enrollment_status] ?? 'bg-surface-container text-on-surface border-outline-variant';

    $berkas = $app ? [
        ['label' => 'Kartu Keluarga',   'icon' => 'family_restroom', 'path' => $app->kk_file],
        ['label' => 'Ijazah / SKL',     'icon' => 'workspace_premium','path' => $app->ijazah_file],
        ['label' => 'Foto Siswa',       'icon' => 'photo_camera',    'path' => $app->photo_file],
        ['label' => 'Akta Kelahiran',   'icon' => 'badge',           'path' => $app->akta_kelahiran_file],
        ['label' => 'Sertifikat Prestasi', 'icon' => 'emoji_events', 'path' => $app->prestasi_file],
        ['label' => 'Bukti Pembayaran', 'icon' => 'receipt_long',    'path' => $app->payment_proof],
    ] : [];
@endphp

<div class="pt-8 pb-16"
     x-data="{
        activeTab: 'biodata',
        editMode: false,
        showDeleteConfirm: false,
        autoSaveNotes() {
            const notes = document.getElementById('student-notes').value;
            fetch('{{ route('admin.students.update', $student->id) }}', {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify({ notes })
            }).then(r => r.json()).then(d => {
                const el = document.getElementById('notes-saved-badge');
                if (el) { el.classList.remove('opacity-0'); setTimeout(() => el.classList.add('opacity-0'), 2000); }
            });
        }
     }">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-6 flex-wrap">
        <a href="{{ route('admin.archive.index') }}" class="hover:text-primary transition-colors">Arsip Digital</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a href="{{ url('/admin/archive/'.$slug.'/'.str_replace('/', '-', $year)) }}" class="hover:text-primary transition-colors">{{ $schoolModel->name }} – {{ $year }}</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="font-bold text-primary">{{ $student->full_name }}</span>
    </nav>

    {{-- Hero Card --}}
    <div class="bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Avatar --}}
            <div class="shrink-0">
                @if($student->photoUrl)
                    <img src="{{ $student->photoUrl }}" alt="{{ $student->full_name }}"
                         class="w-28 h-28 rounded-3xl object-cover shadow-md border-4 border-surface">
                @else
                    <div class="w-28 h-28 rounded-3xl bg-primary-container flex items-center justify-center text-on-primary-container font-black text-4xl shadow-md border-4 border-surface">
                        {{ $student->initial }}
                    </div>
                @endif
            </div>
            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="text-xs font-black text-on-surface-variant uppercase tracking-widest">{{ $schoolModel->name }}</span>
                    <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                    <span class="text-xs font-bold text-on-surface-variant">{{ $year }}</span>
                    @if($student->nis)
                        <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                        <span class="text-xs font-mono text-on-surface-variant">NIS: {{ $student->nis }}</span>
                    @endif
                    @if($student->nisn)
                        <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                        <span class="text-xs font-mono text-on-surface-variant">NISN: {{ $student->nisn }}</span>
                    @endif
                </div>
                <h1 class="text-3xl font-bold font-headline text-on-surface tracking-tight mb-2">{{ $student->full_name }}</h1>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="border text-xs font-bold px-3 py-1 rounded-full {{ $statusBadge }}">
                        {{ \App\Models\Student::getStatusLabel($student->enrollment_status) }}
                    </span>
                    @if($student->current_class || $student->major || $student->class_room)
                        <span class="bg-surface-container text-on-surface text-xs font-bold px-3 py-1 rounded-full">
                            {{ trim(($student->current_class ?? '') . ($isSmk && $student->major ? ' ' . $student->major : '') . ($student->class_room ? ' ' . $student->class_room : '')) }}
                        </span>
                    @endif
                    @if($student->gender)
                        <span class="bg-surface-container text-on-surface-variant text-xs px-3 py-1 rounded-full">{{ $student->gender }}</span>
                    @endif
                </div>
            </div>
            {{-- Quick Edit bar --}}
            <div class="shrink-0 flex flex-col gap-2 self-start">
                <button @click="editMode = !editMode"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-sm" x-text="editMode ? 'close' : 'edit'">edit</span>
                    <span x-text="editMode ? 'Batal' : 'Edit Data'">Edit Data</span>
                </button>
                <a href="{{ url('/admin/archive/'.$slug.'/'.str_replace('/', '-', $year).'/'.$student->id.'/print') }}"
                   target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-sm">print</span> Cetak Kartu
                </a>
                @if($app)
                    <a href="{{ url('/admin/archive/'.$slug.'/'.str_replace('/', '-', $year).'/export/zip') }}"
                       class="flex items-center gap-2 px-4 py-2.5 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-sm">folder_zip</span> Berkas
                    </a>
                @endif
            </div>
        </div>

        {{-- Quick edit form (inline) --}}
        <div x-show="editMode"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mt-6 pt-6 border-t border-outline-variant/30"
             style="display:none;">
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST"
                  class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @csrf @method('PATCH')
                <div>
                    <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">NIS</label>
                    <input name="nis" value="{{ $student->nis }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Kelas</label>
                    <input name="current_class" value="{{ $student->current_class }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Ruang</label>
                    <input name="class_room" value="{{ $student->class_room }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Status</label>
                    <select name="enrollment_status"
                            class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                        <option value="active"      @selected($student->enrollment_status === 'active')>Aktif</option>
                        <option value="graduated"   @selected($student->enrollment_status === 'graduated')>Lulus</option>
                        <option value="dropped"     @selected($student->enrollment_status === 'dropped')>Keluar</option>
                        <option value="transferred" @selected($student->enrollment_status === 'transferred')>Pindah</option>
                    </select>
                </div>
                @if($isSmk)
                    <div>
                        <label class="text-xs font-bold text-on-surface-variant uppercase block mb-1.5">Jurusan</label>
                        <select name="major"
                                class="w-full px-4 py-2.5 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                            @foreach(\App\Models\Student::getSmkMajors() as $m)
                                <option value="{{ $m }}" @selected($student->major === $m)>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col-span-2 sm:col-span-4 flex gap-3 pt-2">
                    <button type="submit"
                            class="px-6 py-3 rounded-2xl bg-primary text-on-primary font-bold text-sm hover:opacity-90 transition-opacity active:scale-95">
                        Simpan Perubahan
                    </button>
                    <button type="button" @click="editMode = false"
                            class="px-6 py-3 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                        Batal
                    </button>
                    <div class="flex-1"></div>
                    <button type="button"
                            @click="showDeleteConfirm = true"
                            class="px-6 py-3 rounded-2xl bg-error-container text-error font-bold text-sm hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-sm align-middle mr-1">delete</span>Hapus Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete confirmation modal --}}
    <div x-show="showDeleteConfirm"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click.self="showDeleteConfirm = false"
         style="display:none;">
        <div class="bg-surface rounded-3xl shadow-2xl w-full max-w-sm p-8 text-center" @click.stop>
            <span class="material-symbols-outlined text-5xl text-error mb-4" style="font-variation-settings: 'FILL' 1;">warning</span>
            <h3 class="text-xl font-bold font-headline text-on-surface mb-2">Hapus Data Siswa?</h3>
            <p class="text-on-surface-variant text-sm mb-6">Data siswa akan dipindahkan ke tempat sampah. Tindakan ini dapat dipulihkan.</p>
            <div class="flex gap-3">
                <button @click="showDeleteConfirm = false"
                        class="flex-1 py-3 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                    Batal
                </button>
                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-3 rounded-2xl bg-error text-on-error font-bold text-sm hover:opacity-90 transition-opacity">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="mb-6">
        <div class="flex gap-1 bg-surface-container rounded-2xl p-1 w-fit flex-wrap">
            @foreach([
                ['id' => 'biodata',    'label' => 'Data Diri',         'icon' => 'person'],
                ['id' => 'berkas',     'label' => 'Berkas Dokumen',    'icon' => 'folder_open'],
                ['id' => 'riwayat',   'label' => 'Riwayat Status',    'icon' => 'history'],
                ['id' => 'catatan',   'label' => 'Catatan Admin',     'icon' => 'sticky_note_2'],
            ] as $tab)
                <button @click="activeTab = '{{ $tab['id'] }}'"
                        :class="activeTab === '{{ $tab['id'] }}' ? 'bg-surface-container-lowest shadow text-on-surface' : 'text-on-surface-variant hover:text-on-surface'"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-sm transition-all">
                    <span class="material-symbols-outlined text-sm">{{ $tab['icon'] }}</span>
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- TAB: Data Diri --}}
    <div x-show="activeTab === 'biodata'" class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $fields = [
                    ['label' => 'Nama Lengkap',        'value' => $student->full_name],
                    ['label' => 'Jenis Kelamin',        'value' => $student->gender],
                    ['label' => 'Tempat Lahir',         'value' => $student->place_of_birth],
                    ['label' => 'Tanggal Lahir',        'value' => $student->date_of_birth?->format('d MMMM Y')],
                    ['label' => 'NIS',                  'value' => $student->nis],
                    ['label' => 'NISN',                 'value' => $student->nisn],
                    ['label' => 'Email',                'value' => $student->email],
                    ['label' => 'No. HP',               'value' => $student->phone],
                    ['label' => 'Alamat',               'value' => $student->address],
                    ['label' => 'Sekolah Asal',         'value' => $student->previous_school],
                    ['label' => 'Tahun Ajaran Masuk',   'value' => $student->academic_year_entry],
                    ['label' => 'Jurusan',              'value' => $student->major],
                    ['label' => 'Kelas',                'value' => $student->class_label],
                    ['label' => 'Tanggal Masuk',        'value' => $student->enrolled_at?->format('d M Y')],
                    ['label' => 'Nama Ayah',            'value' => $student->father_name],
                    ['label' => 'Pekerjaan Ayah',       'value' => $student->father_occupation],
                    ['label' => 'Nama Ibu',             'value' => $student->mother_name],
                    ['label' => 'Pekerjaan Ibu',        'value' => $student->mother_occupation],
                    ['label' => 'Penghasilan Orang Tua','value' => $student->parent_salary_range],
                ];
            @endphp
            @foreach($fields as $field)
                @if($field['value'])
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-outline-variant uppercase tracking-wide">{{ $field['label'] }}</label>
                        <p class="text-on-surface font-medium text-sm">{{ $field['value'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- TAB: Berkas Dokumen --}}
    <div x-show="activeTab === 'berkas'"
         x-data="{ previewUrl: null, previewType: null }"
         class="space-y-4">
        @if(!$app)
            <div class="bg-surface-container rounded-3xl p-12 flex flex-col items-center gap-4 text-center">
                <span class="material-symbols-outlined text-4xl text-outline-variant">folder_off</span>
                <p class="text-on-surface-variant">Siswa ini tidak terhubung ke pendaftaran SPMB. Berkas tidak tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($berkas as $item)
                    @php
                        $hasFile  = !empty($item['path']);
                        $url      = $hasFile ? \Illuminate\Support\Facades\Storage::url($item['path']) : null;
                        $ext      = $hasFile ? strtolower(pathinfo($item['path'], PATHINFO_EXTENSION)) : null;
                        $isImage  = $hasFile && in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                    @endphp
                    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm border border-outline-variant/20 {{ $hasFile ? 'hover:shadow-md transition-shadow' : 'opacity-50' }}">
                        {{-- Preview area --}}
                        <div class="h-36 bg-surface-container flex items-center justify-center relative">
                            @if($hasFile && $isImage)
                                <img src="{{ $url }}" alt="{{ $item['label'] }}" class="w-full h-full object-cover">
                            @elseif($hasFile)
                                <span class="material-symbols-outlined text-5xl text-outline-variant">picture_as_pdf</span>
                            @else
                                <span class="material-symbols-outlined text-5xl text-outline-variant/50">folder_off</span>
                            @endif
                        </div>
                        {{-- Info --}}
                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined text-sm text-primary" style="font-variation-settings: 'FILL' 1;">{{ $item['icon'] }}</span>
                                <p class="font-bold text-on-surface text-sm">{{ $item['label'] }}</p>
                            </div>
                            @if($hasFile)
                                <div class="flex gap-2">
                                    <button @click="previewUrl = '{{ $url }}'; previewType = '{{ $isImage ? 'image' : 'pdf' }}'"
                                            class="flex-1 text-xs font-bold py-2 rounded-xl bg-primary-container/40 text-primary hover:bg-primary-container/70 transition-colors flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">visibility</span> Lihat
                                    </button>
                                    <a href="{{ $url }}" download
                                       class="flex-1 text-xs font-bold py-2 rounded-xl border border-outline-variant text-on-surface hover:bg-surface-container-low transition-colors flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">download</span> Unduh
                                    </a>
                                </div>
                            @else
                                <p class="text-xs text-on-surface-variant italic text-center py-2">Belum diunggah</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- File preview modal --}}
            <div x-show="previewUrl"
                 @click.self="previewUrl = null"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                 style="display:none;">
                <div class="max-w-4xl max-h-full w-full relative">
                    <button @click="previewUrl = null"
                            class="absolute -top-10 right-0 text-white hover:text-yellow-400 transition-colors flex items-center gap-1 font-bold">
                        <span class="material-symbols-outlined">close</span> Tutup
                    </button>
                    <template x-if="previewType === 'image'">
                        <img :src="previewUrl" class="max-h-[85vh] max-w-full mx-auto rounded-2xl shadow-2xl object-contain">
                    </template>
                    <template x-if="previewType === 'pdf'">
                        <iframe :src="previewUrl" class="w-full h-[85vh] rounded-2xl shadow-2xl" frameborder="0"></iframe>
                    </template>
                </div>
            </div>
        @endif
    </div>

    {{-- TAB: Riwayat Status --}}
    <div x-show="activeTab === 'riwayat'" class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
        <h3 class="font-bold text-on-surface text-sm mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm text-primary">timeline</span>
            Riwayat Perjalanan Siswa
        </h3>
        <div class="relative">
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-outline-variant/30"></div>
            <div class="space-y-6">
                {{-- SPMB status history --}}
                @if($app && $app->status_history)
                    @php
                        $ppdbLabels = ['draft'=>'Mendaftar SPMB','pending'=>'Berkas Dikirim','payment_uploaded'=>'Bukti Bayar Diunggah','verified'=>'Diverifikasi','accepted'=>'Diterima','rejected'=>'Ditolak'];
                        $ppdbColors = ['draft'=>'text-outline-variant','pending'=>'text-blue-600','payment_uploaded'=>'text-purple-600','verified'=>'text-indigo-600','accepted'=>'text-green-600','rejected'=>'text-red-600'];
                    @endphp
                    @foreach($app->status_history as $h)
                        <div class="flex items-start gap-6 pl-10 relative">
                            <div class="absolute left-2 w-4 h-4 rounded-full border-2 border-surface shadow-sm
                                {{ match($h['status'] ?? '') { 'accepted' => 'bg-green-500', 'rejected' => 'bg-red-400', 'pending' => 'bg-blue-400', 'payment_uploaded' => 'bg-purple-500', 'verified' => 'bg-indigo-500', default => 'bg-outline-variant' } }}"></div>
                            <div>
                                <p class="font-bold text-sm text-on-surface">{{ $ppdbLabels[$h['status'] ?? ''] ?? ucfirst($h['status'] ?? '') }}</p>
                                @if(!empty($h['notes']))
                                    <p class="text-xs text-on-surface-variant">{{ $h['notes'] }}</p>
                                @endif
                                <p class="text-xs text-outline mt-0.5">{{ isset($h['changed_at']) ? \Carbon\Carbon::parse($h['changed_at'])->format('d M Y H:i') : '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Promoted to student --}}
                <div class="flex items-start gap-6 pl-10 relative">
                    <div class="absolute left-2 w-4 h-4 rounded-full border-2 border-surface shadow-sm bg-primary"></div>
                    <div>
                        <p class="font-bold text-sm text-primary">Dipromosikan ke Data Siswa</p>
                        <p class="text-xs text-on-surface-variant">NIS: {{ $student->nis ?? 'Belum ditetapkan' }} • Oleh: {{ $student->created_by ?? 'System' }}</p>
                        <p class="text-xs text-outline mt-0.5">{{ $student->created_at ? $student->created_at->format('d M Y H:i') : '' }}</p>
                    </div>
                </div>

                {{-- Status changes --}}
                @if($student->enrollment_status !== 'active')
                    @php $statusDate = $student->graduated_at ?? $student->dropped_at ?? $student->updated_at; @endphp
                    <div class="flex items-start gap-6 pl-10 relative">
                        <div class="absolute left-2 w-4 h-4 rounded-full border-2 border-surface shadow-sm
                            {{ $student->enrollment_status === 'graduated' ? 'bg-blue-500' : 'bg-orange-500' }}"></div>
                        <div>
                            <p class="font-bold text-sm text-on-surface">{{ \App\Models\Student::getStatusLabel($student->enrollment_status) }}</p>
                            <p class="text-xs text-on-surface-variant">Diperbarui oleh: {{ $student->updated_by ?? 'System' }}</p>
                            <p class="text-xs text-outline mt-0.5">{{ $statusDate ? (is_string($statusDate) ? $statusDate : $statusDate->format('d M Y')) : '' }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- TAB: Catatan Admin --}}
    <div x-show="activeTab === 'catatan'" class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-on-surface text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-primary">sticky_note_2</span>
                Catatan Internal
            </h3>
            <span id="notes-saved-badge"
                  class="opacity-0 transition-opacity text-xs text-green-700 bg-green-100 px-3 py-1 rounded-full font-bold flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">check_circle</span> Tersimpan
            </span>
        </div>
        <textarea id="student-notes"
                  rows="10"
                  @change.debounce.1000ms="autoSaveNotes()"
                  placeholder="Tambahkan catatan tentang siswa ini (disimpan otomatis)..."
                  class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface placeholder:text-outline-variant focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors resize-none">{{ $student->notes }}</textarea>
    </div>

</div>
@endsection
