@extends('layouts.admin.app')

@section('title', 'Manajemen Pengguna - Putra Pakuan CMS')

@section('content')

@php
    $schools = [
        'smk_admin' => [
            'label'   => 'SMK',
            'full'    => 'SMK Putra Pakuan',
            'icon'    => 'engineering',
            'accent'  => '#6c5a00',
            'bg'      => '#fbd51d',
            'textBg'  => '#1c190d',
        ],
        'smp_admin' => [
            'label'   => 'SMP',
            'full'    => 'SMP Putra Pakuan',
            'icon'    => 'menu_book',
            'accent'  => '#605b4c',
            'bg'      => '#eae2ce',
            'textBg'  => '#433f31',
        ],
        'sd_admin'  => [
            'label'   => 'SD / SDIT',
            'full'    => 'SD / SDIT Putra Pakuan',
            'icon'    => 'child_care',
            'accent'  => '#605c49',
            'bg'      => '#f8f1d8',
            'textBg'  => '#4c4836',
        ],
    ];
@endphp

@php
    $reopenModal = $errors->any();
    $reopenMode  = old('_method') === 'PATCH' ? 'edit' : 'add';
    $reopenForm  = [
        'id'    => (int) old('_user_id', 0) ?: 'null',
        'name'  => addslashes(old('name', '')),
        'email' => addslashes(old('email', '')),
        'admin_role' => old('admin_role', ''),
        'password' => '',
        'password_confirmation' => '',
    ];
@endphp

<div
    x-data="{
        /* -- modal state -- */
        showModal: {{ $reopenModal ? 'true' : 'false' }},
        showDelete: false,
        mode: '{{ $reopenModal ? $reopenMode : 'add' }}',
        showPassword: false,
        showConfirm: false,

        /* form fields */
        form: { id: {{ $reopenModal ? ($reopenForm['id'] === 'null' ? 'null' : $reopenForm['id']) : 'null' }}, name: '{{ $reopenModal ? $reopenForm['name'] : '' }}', email: '{{ $reopenModal ? $reopenForm['email'] : '' }}', password: '', password_confirmation: '', admin_role: '{{ $reopenModal ? $reopenForm['admin_role'] : '' }}' },
        deleteUser: { id: null, name: '' },

        /* open Add */
        openAdd(role) {
            this.mode = 'add';
            this.showPassword = false;
            this.showConfirm = false;
            this.form = { id: null, name: '', email: '', password: '', password_confirmation: '', admin_role: role };
            this.showModal = true;
        },

        /* open Edit */
        openEdit(user) {
            this.mode = 'edit';
            this.showPassword = false;
            this.showConfirm = false;
            this.form = { id: user.id, name: user.name, email: user.email, password: '', password_confirmation: '', admin_role: user.admin_role };
            this.showModal = true;
        },

        /* open Delete */
        openDelete(user) {
            this.deleteUser = { id: user.id, name: user.name };
            this.showDelete = true;
        },

        /* submit form action: set the hidden _method and submit */
        submitForm() {
            this.$refs.modalForm.submit();
        },
        submitDelete() {
            this.$refs.deleteForm.submit();
        },

        /* role label helper */
        roleLabel(role) {
            const map = { smk_admin: 'SMK Admin', smp_admin: 'SMP Admin', sd_admin: 'SD Admin' };
            return map[role] ?? role;
        }
    }"
    class="w-full"
>

    {{-- -- Flash Messages -- --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
        class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-3 text-sm font-medium shadow-sm">
        <span class="material-symbols-outlined text-emerald-500 text-lg">check_circle</span>
        {{ session('success') }}
        <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-700">
            <span class="material-symbols-outlined text-base">close</span>
        </button>
    </div>
    @endif
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
        class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-3 text-sm font-medium shadow-sm">
        <span class="material-symbols-outlined text-red-500 text-lg">error</span>
        {{ session('error') }}
        <button @click="show = false" class="ml-auto text-red-400 hover:text-red-700">
            <span class="material-symbols-outlined text-base">close</span>
        </button>
    </div>
    @endif

    {{-- -- Validation Errors -- --}}
    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-4 text-sm shadow-sm">
        <p class="font-bold mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-red-500">warning</span> Terdapat kesalahan input:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    {{-- -- Page Header -- --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-[#1c190d]">Manajemen Pengguna</h2>
            <p class="text-on-surface-variant mt-1 text-sm">Kelola akun admin untuk setiap unit sekolah (SMK, SMP, SD/SDIT).</p>
        </div>
        <div class="flex items-center gap-2 bg-surface-container-low rounded-2xl px-4 py-2 text-xs text-on-surface-variant font-medium">
            <span class="material-symbols-outlined text-base text-primary">group</span>
            Total: <strong class="text-on-surface ml-1">{{ $allAdmins->flatten()->count() }} admin</strong>
        </div>
    </div>

    {{-- -- School Columns -- --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($schools as $roleKey => $school)
        @php $users = $allAdmins->get($roleKey, collect()); @endphp

        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">

            {{-- Card Header --}}
            <div class="p-5 flex items-center justify-between" style="background: {{ $school['bg'] }};">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl flex items-center justify-center shadow-sm" style="background: {{ $school['textBg'] }};">
                        <span class="material-symbols-outlined text-lg" style="color: {{ $school['bg'] }};">{{ $school['icon'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-base leading-tight" style="color: {{ $school['textBg'] }};">{{ $school['full'] }}</h3>
                        <p class="text-xs font-medium opacity-60" style="color: {{ $school['textBg'] }};">{{ $users->count() }} admin terdaftar</p>
                    </div>
                </div>
                <button
                    @click="openAdd('{{ $roleKey }}')"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold shadow-sm transition-all active:scale-95 hover:shadow-md"
                    style="background: {{ $school['textBg'] }}; color: {{ $school['bg'] }};"
                    title="Tambah Admin {{ $school['label'] }}"
                >
                    <span class="material-symbols-outlined text-sm">person_add</span>
                    Tambah
                </button>
            </div>

            {{-- User List --}}
            <div class="flex-1 p-4 space-y-2">
                @forelse($users as $user)
                <div class="flex items-center gap-3 bg-surface-container-low hover:bg-surface-container transition-colors rounded-2xl px-3 py-3 group">
                    {{-- Avatar --}}
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 shadow-sm"
                        style="background: {{ $school['bg'] }}; color: {{ $school['textBg'] }};">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-xs text-on-surface truncate">{{ $user->name }}</p>
                        <p class="text-[11px] text-on-surface-variant truncate">{{ $user->email }}</p>
                    </div>
                    {{-- Actions --}}
                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
                        <button
                            @click="openEdit({ id: {{ $user->id }}, name: '{{ addslashes($user->name) }}', email: '{{ addslashes($user->email) }}', admin_role: '{{ $user->admin_role }}' })"
                            class="w-7 h-7 flex items-center justify-center rounded-xl bg-primary/10 hover:bg-primary/20 text-primary transition-colors"
                            title="Ubah"
                        >
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </button>
                        <button
                            @click="openDelete({ id: {{ $user->id }}, name: '{{ addslashes($user->name) }}' })"
                            class="w-7 h-7 flex items-center justify-center rounded-xl bg-error/10 hover:bg-error/20 text-error transition-colors"
                            title="Hapus"
                        >
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-10 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-4xl mb-2 opacity-30">person_off</span>
                    <p class="text-xs font-medium">Belum ada admin {{ $school['label'] }}</p>
                    <button @click="openAdd('{{ $roleKey }}')"
                        class="mt-3 text-xs font-bold text-primary hover:underline">
                        + Tambah sekarang
                    </button>
                </div>
                @endforelse
            </div>

        </div>
        @endforeach
    </div>

    {{-- ----------------------------------------
         ADD / EDIT MODAL
    ---------------------------------------- --}}
    <div
        x-show="showModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @keydown.escape.window="showModal = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-[#1c190d]/50 backdrop-blur-sm" @click="showModal = false"></div>

        {{-- Panel --}}
        <div class="relative bg-surface-container-lowest rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">

            {{-- Modal Header --}}
            <div class="bg-[#1c190d] px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#1c190d] text-lg" x-text="mode === 'add' ? 'person_add' : 'manage_accounts'"></span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-base" x-text="mode === 'add' ? 'Tambah Admin Baru' : 'Edit Admin'"></h4>
                        <p class="text-white/50 text-xs" x-text="roleLabel(form.admin_role)"></p>
                    </div>
                </div>
                <button @click="showModal = false" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>

            {{-- Form --}}
            <form
                x-ref="modalForm"
                :action="mode === 'add' ? '{{ route('admin.users.store') }}' : '/admin/users/' + form.id"
                method="POST"
                class="px-6 py-6 space-y-4"
            >
                @csrf
                <template x-if="mode === 'edit'">
                    <input type="hidden" name="_method" value="PATCH">
                </template>
                <input type="hidden" name="_user_id" :value="form.id">
                <input type="hidden" name="admin_role" :value="form.admin_role">

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-base">badge</span>
                        <input
                            type="text"
                            name="name"
                            x-model="form.name"
                            placeholder="e.g. Budi Santoso"
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                            required
                        >
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-base">email</span>
                        <input
                            type="email"
                            name="email"
                            x-model="form.email"
                            placeholder="admin@sekolah.sch.id"
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                            required
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1.5">
                        Password <span x-show="mode === 'edit'" class="normal-case font-normal text-outline">(isi untuk ubah)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-base">lock</span>
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            x-model="form.password"
                            placeholder="Min. 8 karakter"
                            :required="mode === 'add'"
                            class="w-full pl-9 pr-10 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                        >
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-base" x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-base">lock_reset</span>
                        <input
                            :type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation"
                            x-model="form.password_confirmation"
                            placeholder="Ulangi password"
                            :required="mode === 'add' || form.password.length > 0"
                            class="w-full pl-9 pr-10 py-2.5 rounded-xl border border-outline-variant/50 bg-surface-container-low text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                        >
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-base" x-text="showConfirm ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showModal = false"
                        class="flex-1 py-2.5 rounded-xl border border-outline-variant/50 text-on-surface-variant text-sm font-semibold hover:bg-surface-container transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-[#1c190d] text-[#fbd51d] text-sm font-bold hover:bg-[#1c190d]/90 transition-colors shadow-sm active:scale-[0.98]">
                        <span x-text="mode === 'add' ? 'Tambah Admin' : 'Simpan Perubahan'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ----------------------------------------
         DELETE CONFIRMATION MODAL
    ---------------------------------------- --}}
    <div
        x-show="showDelete"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @keydown.escape.window="showDelete = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        <div class="absolute inset-0 bg-[#1c190d]/50 backdrop-blur-sm" @click="showDelete = false"></div>

        <div class="relative bg-surface-container-lowest rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-error/10 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-error text-3xl">person_remove</span>
                </div>
                <h4 class="font-bold text-on-surface text-lg mb-1">Hapus Admin?</h4>
                <p class="text-on-surface-variant text-sm mb-6">
                    Akun <strong x-text="deleteUser.name" class="text-on-surface"></strong> akan dihapus secara permanen dan tidak dapat dipulihkan.
                </p>

                <form x-ref="deleteForm" :action="'/admin/users/' + deleteUser.id" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" @click="showDelete = false"
                            class="flex-1 py-2.5 rounded-xl border border-outline-variant/50 text-on-surface-variant text-sm font-semibold hover:bg-surface-container transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 py-2.5 rounded-xl bg-error text-on-error text-sm font-bold hover:bg-error/90 transition-colors shadow-sm active:scale-[0.98]">
                            Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>

@endsection





