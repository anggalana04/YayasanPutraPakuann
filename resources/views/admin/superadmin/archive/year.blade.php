@extends('layouts.admin.app')

@section('title')
Arsip {{ $schoolModel->name }} &ndash; {{ $year }}
@endsection

@section('content')
@php
    $isSmk = strtoupper($schoolModel->type) === 'SMK';
    $slug  = strtolower($schoolModel->type === 'SDIT' ? 'sd' : $schoolModel->type);
    $smkMajors = \App\Models\Student::getSmkMajors();

    $statusColors = [
        'active'      => 'bg-green-100 text-green-800',
        'graduated'   => 'bg-blue-100 text-blue-800',
        'dropped'     => 'bg-red-100 text-red-800',
        'transferred' => 'bg-orange-100 text-orange-800',
    ];
@endphp

<div
    class="pt-8 pb-16"
    x-data="{
        selectedIds: [],
        bulkVisible: false,
        showAddModal: false,
        toggleSelect(id) {
            const i = this.selectedIds.indexOf(id);
            if (i === -1) this.selectedIds.push(id);
            else this.selectedIds.splice(i, 1);
            this.bulkVisible = this.selectedIds.length > 0;
        },
        selectAll() {
            const boxes = document.querySelectorAll('.student-checkbox');
            if (this.selectedIds.length === boxes.length) {
                this.selectedIds = [];
            } else {
                this.selectedIds = [...boxes].map(b => parseInt(b.value));
            }
            this.bulkVisible = this.selectedIds.length > 0;
        }
    }">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-6 flex-wrap">
        <a href="{{ route('admin.archive.index') }}" class="hover:text-primary transition-colors">Arsip Digital</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="font-medium text-on-surface">{{ $schoolModel->name }}</span>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="font-bold text-primary">{{ $year }}</span>
    </nav>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-bold font-headline text-on-surface tracking-tight">{{ $schoolModel->name }}</h1>
            <p class="text-on-surface-variant text-sm mt-1">Tahun Ajaran <span class="font-bold text-on-surface">{{ $year }}</span></p>
        </div>
        <div class="flex flex-wrap gap-3">
            <button @click="showAddModal = true"
                class="flex items-center gap-2 px-5 py-2.5 rounded-3xl bg-primary text-on-primary font-bold text-sm shadow hover:shadow-lg transition-all active:scale-95">
                <span class="material-symbols-outlined text-sm">person_add</span>
                Tambah Siswa
            </button>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @php
            $totalStudentsCount = $students->count();
            $activeCount    = $students->where('enrollment_status', 'active')->count();
            $ppdbTotal      = $ppdb->total ?? 0;
            $ppdbAccepted   = $ppdb->accepted ?? 0;
            $unpromotedCount = $unpromoted->count();
        @endphp
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Total Pendaftar PPDB</p>
            <p class="text-4xl font-black text-on-surface">{{ $ppdbTotal }}</p>
            <p class="text-xs text-on-surface-variant mt-1">{{ $ppdbAccepted }} diterima</p>
        </div>
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Total Siswa Terdaftar</p>
            <p class="text-4xl font-black text-on-surface">{{ $totalStudentsCount }}</p>
            <p class="text-xs text-on-surface-variant mt-1">{{ $activeCount }} aktif</p>
        </div>
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Belum Dipromosikan</p>
            <p class="text-4xl font-black {{ $unpromotedCount > 0 ? 'text-orange-600' : 'text-on-surface' }}">{{ $unpromotedCount }}</p>
            <p class="text-xs text-on-surface-variant mt-1">dari {{ $ppdbAccepted }} diterima</p>
        </div>
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Tingkat Diterima</p>
            <p class="text-4xl font-black text-primary">{{ $ppdbTotal > 0 ? round(($ppdbAccepted / $ppdbTotal) * 100) : 0 }}%</p>
            <p class="text-xs text-on-surface-variant mt-1">dari total pendaftar</p>
        </div>
    </div>

    {{-- SMK Major Breakdown --}}
    @if($isSmk && !empty($majorBreakdown))
        <div class="bg-surface-container-lowest rounded-3xl p-6 mb-8 shadow-sm">
            <h3 class="text-sm font-bold text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-primary">bar_chart</span>
                Distribusi Per Jurusan
            </h3>
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                @foreach($smkMajors as $maj)
                    @php $count = $majorBreakdown[$maj] ?? 0; @endphp
                    <a href="{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $year)."?major={$maj}") }}"
                       class="flex flex-col items-center bg-surface-container rounded-2xl p-4 hover:bg-primary-container/30 transition-colors text-center group">
                        <span class="text-2xl font-black text-on-surface group-hover:text-primary transition-colors">{{ $count }}</span>
                        <span class="text-[10px] font-bold text-on-surface-variant uppercase mt-1">{{ $maj }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        {{-- Main student table --}}
        <div class="xl:col-span-8 space-y-4">

            {{-- Search & Filters --}}
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant text-sm">search</span>
                    <input name="search" value="{{ $search }}"
                           placeholder="Cari nama, NIS, NISN..."
                           class="w-full pl-11 pr-4 py-3 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface placeholder:text-outline-variant focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors">
                </div>
                @if($isSmk)
                    <select name="major"
                            class="px-4 py-3 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors">
                        <option value="all" {{ $majorFilter === 'all' ? 'selected' : '' }}>Semua Jurusan</option>
                        @foreach($smkMajors as $maj)
                            <option value="{{ $maj }}" {{ $majorFilter === $maj ? 'selected' : '' }}>{{ $maj }}</option>
                        @endforeach
                    </select>
                @endif
                <select name="status"
                        class="px-4 py-3 rounded-2xl border border-outline-variant bg-surface text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors">
                    <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="active"      {{ $statusFilter === 'active'      ? 'selected' : '' }}>Aktif</option>
                    <option value="graduated"   {{ $statusFilter === 'graduated'   ? 'selected' : '' }}>Lulus</option>
                    <option value="dropped"     {{ $statusFilter === 'dropped'     ? 'selected' : '' }}>Keluar</option>
                    <option value="transferred" {{ $statusFilter === 'transferred' ? 'selected' : '' }}>Pindah</option>
                </select>
                <button type="submit"
                        class="px-6 py-3 rounded-2xl bg-primary text-on-primary font-bold text-sm hover:opacity-90 transition-opacity">
                    Filter
                </button>
                @if($search || $majorFilter !== 'all' || $statusFilter !== 'all')
                    <a href="{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $year)) }}"
                       class="px-6 py-3 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">close</span>Reset
                    </a>
                @endif
            </form>

            {{-- Bulk action bar --}}
            <div x-show="bulkVisible"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-primary text-on-primary rounded-2xl px-5 py-3 flex items-center gap-4 flex-wrap"
                 style="display: none;">
                <span class="font-bold text-sm" x-text="selectedIds.length + ' siswa dipilih'"></span>
                <div class="flex-1"></div>
                <a :href="`{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $year)."/export/excel") }}?ids=` + selectedIds.join(',')"
                   target="_blank"
                   class="flex items-center gap-1.5 bg-white/20 hover:bg-white/30 text-on-primary font-bold text-xs px-4 py-2 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-sm">download</span> Export Excel
                </a>
                <a :href="`{{ url("/admin/archive/{$slug}/".str_replace('/', '-', $year)."/export/zip") }}?ids=` + selectedIds.join(',')"
                   target="_blank"
                   class="flex items-center gap-1.5 bg-white/20 hover:bg-white/30 text-on-primary font-bold text-xs px-4 py-2 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-sm">folder_zip</span> Berkas ZIP
                </a>
                <button @click="selectedIds = []; bulkVisible = false"
                        class="flex items-center gap-1 bg-white/10 hover:bg-white/20 text-on-primary font-bold text-xs px-4 py-2 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span> Batal
                </button>
            </div>

            {{-- Table --}}
            <div class="bg-surface-container-lowest rounded-3xl shadow-sm overflow-hidden">
                @if($students->isEmpty())
                    <div class="flex flex-col items-center py-16 gap-4 text-center">
                        <span class="material-symbols-outlined text-5xl text-outline-variant">person_search</span>
                        <p class="text-on-surface-variant font-medium">
                            @if($search || $majorFilter !== 'all' || $statusFilter !== 'all')
                                Tidak ada siswa yang cocok dengan filter.
                            @else
                                Belum ada siswa terdaftar untuk tahun ajaran ini.
                            @endif
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-outline-variant/30">
                                    <th class="px-4 py-4 text-left">
                                        <input type="checkbox"
                                               class="rounded border-outline-variant"
                                               @change="selectAll()">
                                    </th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">NIS</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Siswa</th>
                                    @if($isSmk)
                                        <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Jurusan</th>
                                    @endif
                                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Kelas</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-on-surface-variant uppercase tracking-wider">Bergabung</th>
                                    <th class="px-4 py-4 text-right text-xs font-bold text-on-surface-variant uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/20">
                                @foreach($students as $student)
                                    <tr class="hover:bg-surface-container-low/50 transition-colors group">
                                        <td class="px-4 py-3">
                                            <input type="checkbox"
                                                   class="student-checkbox rounded border-outline-variant"
                                                   value="{{ $student->id }}"
                                                   @change="toggleSelect({{ $student->id }})">
                                        </td>
                                        <td class="px-4 py-3 font-mono text-on-surface-variant">{{ $student->nis ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                @if($student->photoUrl)
                                                    <img src="{{ $student->photoUrl }}" alt="" class="w-9 h-9 rounded-full object-cover shrink-0">
                                                @else
                                                    <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-sm shrink-0">{{ $student->initial }}</div>
                                                @endif
                                                <div>
                                                    <p class="font-semibold text-on-surface">{{ $student->full_name }}</p>
                                                    <p class="text-xs text-on-surface-variant">{{ $student->email ?? '' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        @if($isSmk)
                                            <td class="px-4 py-3">
                                                <span class="bg-primary-container/40 text-on-primary-container text-xs font-bold px-2.5 py-1 rounded-full">{{ $student->major ?? '—' }}</span>
                                            </td>
                                        @endif
                                        <td class="px-4 py-3 text-on-surface">{{ trim(($student->current_class ?? '') . ' ' . ($student->class_room ?? '')) ?: '—' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $statusColors[$student->enrollment_status] ?? 'bg-surface-container text-on-surface' }}">
                                                {{ \App\Models\Student::getStatusLabel($student->enrollment_status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $student->enrolled_at ? $student->enrolled_at->format('d M Y') : '—' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('admin.archive.student', ['school' => $slug, 'year' => $year, 'student' => $student->id]) }}"
                                               class="inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline px-3 py-1.5 rounded-full bg-primary-container/30 hover:bg-primary-container/60 transition-colors">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-outline-variant/20 text-xs text-on-surface-variant">
                        Menampilkan {{ $students->count() }} siswa
                    </div>
                @endif
            </div>
        </div>

        {{-- Side panel: unpromoted applicants --}}
        <div class="xl:col-span-4">
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm sticky top-24">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-orange-600 text-sm" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-on-surface text-sm">Belum Dipromosikan</h3>
                        <p class="text-xs text-on-surface-variant">Diterima, belum jadi siswa</p>
                    </div>
                    @if($unpromoted->count() > 0)
                        <span class="ml-auto bg-orange-500 text-white text-xs font-black w-6 h-6 rounded-full flex items-center justify-center">{{ $unpromoted->count() }}</span>
                    @endif
                </div>

                @if($unpromoted->isEmpty())
                    <div class="flex flex-col items-center py-8 text-center gap-3">
                        <span class="material-symbols-outlined text-3xl text-green-500" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <p class="text-sm text-on-surface-variant">Semua pendaftar yang diterima sudah dipromosikan.</p>
                    </div>
                @else
                    <div class="space-y-3 max-h-[480px] overflow-y-auto pr-1">
                        @foreach($unpromoted as $app)
                            <div class="bg-surface-container rounded-2xl p-4"
                                 x-data="{ showPromote: false }">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-sm shrink-0">
                                        {{ strtoupper(substr($app->full_name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-on-surface text-sm truncate">{{ $app->full_name }}</p>
                                        @if($isSmk)
                                            <p class="text-xs text-on-surface-variant">{{ $app->assigned_major ?? $app->major_1 ?? '—' }}</p>
                                        @else
                                            <p class="text-xs text-on-surface-variant">{{ $app->nisn ? 'NISN: '.$app->nisn : 'ID: '.$app->application_id }}</p>
                                        @endif
                                    </div>
                                </div>

                                <button @click="showPromote = !showPromote"
                                        class="w-full text-xs font-bold text-primary bg-primary-container/30 hover:bg-primary-container/60 py-2 rounded-xl transition-colors flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">add_circle</span>
                                    Promosikan ke Siswa
                                </button>

                                {{-- Inline promote form --}}
                                <div x-show="showPromote"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 -translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="mt-3 space-y-2"
                                     style="display: none;">
                                    <input type="text"
                                           x-ref="nis_{{ $app->id }}"
                                           placeholder="NIS (opsional)"
                                           class="w-full px-3 py-2 text-xs rounded-xl border border-outline-variant focus:outline-none focus:border-primary bg-surface text-on-surface">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text"
                                               x-ref="class_{{ $app->id }}"
                                               placeholder="Kelas (X/VII/1)"
                                               class="px-3 py-2 text-xs rounded-xl border border-outline-variant focus:outline-none focus:border-primary bg-surface text-on-surface">
                                        <input type="text"
                                               x-ref="room_{{ $app->id }}"
                                               placeholder="Ruang (A/B)"
                                               class="px-3 py-2 text-xs rounded-xl border border-outline-variant focus:outline-none focus:border-primary bg-surface text-on-surface">
                                    </div>
                                    <button
                                        @click="
                                            fetch('{{ route('admin.students.promote') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    ppdb_application_id: {{ $app->id }},
                                                    nis: $refs.nis_{{ $app->id }}.value,
                                                    current_class: $refs.class_{{ $app->id }}.value,
                                                    class_room: $refs.room_{{ $app->id }}.value,
                                                    academic_year_entry: '{{ $year }}'
                                                })
                                            })
                                            .then(r => r.json())
                                            .then(data => {
                                                if (data.success) {
                                                    const t = document.createElement('div');
                                                    t.style.cssText = 'position:fixed;top:24px;right:24px;z-index:9999;background:#14532d;color:#fff;font-weight:700;font-size:13px;padding:14px 22px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.25);display:flex;align-items:center;gap:10px;transition:opacity 0.4s';
                                                    t.innerHTML = '<span style="font-size:18px;line-height:1">&#x2713;</span> ' + (data.message || 'Siswa berhasil dipromosikan.');
                                                    document.body.appendChild(t);
                                                    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 400); }, 2500);
                                                    setTimeout(() => window.location.reload(), 1200);
                                                } else {
                                                    alert(data.message);
                                                }
                                            })
                                            .catch(() => alert('Terjadi kesalahan. Coba lagi.'))
                                        "
                                        class="w-full bg-primary text-on-primary text-xs font-bold py-2 rounded-xl hover:opacity-90 transition-opacity">
                                        Simpan & Promosikan
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Add Student Modal --}}
<div x-show="showAddModal"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
     @click.self="showAddModal = false"
     style="display: none;">
    <div class="bg-surface rounded-3xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-y-auto"
         @click.stop>
        <div class="sticky top-0 bg-surface px-6 py-5 border-b border-outline-variant/30 flex items-center justify-between">
            <h2 class="text-lg font-bold font-headline text-on-surface">Tambah Siswa Manual</h2>
            <button @click="showAddModal = false" class="text-outline hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.students.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="school_id" value="{{ $schoolModel->id }}">
            <input type="hidden" name="academic_year_entry" value="{{ $year }}">

            <div>
                <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Nama Lengkap *</label>
                <input name="full_name" required
                       class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">NIS</label>
                    <input name="nis"
                           class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">NISN</label>
                    <input name="nisn"
                           class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Jenis Kelamin</label>
                    <select name="gender"
                            class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                        <option value="">Pilih...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Tanggal Lahir</label>
                    <input name="date_of_birth" type="date"
                           class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @if($isSmk)
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Jurusan</label>
                        <select name="major"
                                class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                            <option value="">Pilih...</option>
                            @foreach($smkMajors as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Kelas</label>
                    <input name="current_class" placeholder="{{ $isSmk ? 'X / XI / XII' : 'VII / VIII / IX' }}"
                           class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Ruang</label>
                    <input name="class_room" placeholder="A / B / C"
                           class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-on-surface-variant uppercase mb-1.5">Tanggal Masuk</label>
                <input name="enrolled_at" type="date" value="{{ now()->toDateString() }}"
                       class="w-full px-4 py-3 rounded-2xl border border-outline-variant bg-surface-container-low text-sm text-on-surface focus:outline-none focus:border-primary transition-colors">
            </div>

            <div class="pt-2 flex gap-3">
                <button type="button" @click="showAddModal = false"
                        class="flex-1 py-3 rounded-2xl border border-outline-variant text-on-surface font-bold text-sm hover:bg-surface-container-low transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 rounded-2xl bg-primary text-on-primary font-bold text-sm hover:opacity-90 transition-opacity active:scale-95">
                    Simpan Siswa
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
