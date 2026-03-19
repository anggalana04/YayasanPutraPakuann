@extends('layouts.SMK.app')

@section('content')
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <main class="mx-auto w-full max-w-7xl px-6 lg:px-10">
        <!-- Hero Section -->
        <section class="py-12 lg:py-20">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center">
                <div class="flex flex-col gap-8">
                    <div class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-charcoal">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-primary"></span>
                        </span>
                        Pendaftaran Dibuka
                    </div>
                    <h1 class="text-5xl font-black leading-tight tracking-tight text-charcoal dark:text-slate-50 lg:text-7xl">
                        PPDB 2024 <br/>
                        <span class="text-primary">SMK Putra Pakuan</span>
                    </h1>
                    <p class="max-w-135 text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                        Wujudkan masa depan gemilang dengan pendidikan vokasi berkualitas. Pendaftaran Peserta Didik Baru Tahun Ajaran 2024/2025 telah resmi dibuka. Bergabunglah bersama kami!
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <button class="flex h-14 items-center justify-center rounded-xl bg-primary px-8 text-base font-bold text-charcoal transition-transform hover:scale-[1.02] active:scale-95"
                            onclick="window.location.href='{{ route('ppdb.dashboard', ['school' => request()->route('school')]) }}'">
                            Daftar Sekarang
                        </button>
                        <button class="flex h-14 items-center justify-center rounded-xl border-2 border-charcoal/10 px-8 text-base font-bold text-charcoal transition-colors hover:bg-charcoal/5 dark:border-slate-800 dark:text-slate-200"
                            onclick="window.location.href='{{ route('school.ppdb', ['school' => request()->route('school')]) }}'">
                            Lihat Panduan
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square w-full overflow-hidden rounded-3xl bg-slate-200 dark:bg-slate-800" data-alt="Group of high school students smiling together in school uniform" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBa4uzdr5vaJT2tAK7b-Hb-Y2LBsWqZYRRdddAXCQODG77Hyd3o1doEeDWxkfqZou7Wl0H3AhO0LKOjIUMB1v2x9YbhYnlpSY-mbGqKX7iYlPJUR3af5QBeTjdZ2uXC1NlseTRtAGNDJrODXrSoA_WEEES9114GKHxtPnjGfeeOVs1KGC1zzN0rF_1i7ucZ1WGBtWxqqyHa3TumbnRsx0IcTS89TSjdflVpIPTdb75NvcgPlXEZ5tauc9X2rWyR5OheFf9j2DRRoQ'); background-size: cover; background-position: center;"></div>
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-800 lg:p-8">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-charcoal">
                                <span class="material-symbols-outlined">groups</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-charcoal dark:text-white">1,200+</p>
                                <p class="text-xs font-medium text-slate-500">Pendaftar Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Admission Steps -->
        <section class="py-16">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-black text-charcoal dark:text-slate-100 lg:text-4xl">Alur Pendaftaran</h2>
                <p class="mx-auto mt-4 max-w-2xl text-slate-600 dark:text-slate-400">Ikuti langkah-langkah mudah berikut untuk menjadi bagian dari keluarga besar SMK Putra Pakuan.</p>
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="group flex flex-col h-full relative rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">app_registration</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">1. Registrasi Online</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Isi formulir pendaftaran melalui website resmi kami secara lengkap.</p>
                </div>
                <div class="group flex flex-col h-full relative rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">upload_file</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">2. Upload Berkas</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Unggah dokumen persyaratan seperti Ijazah, KK, dan Akta Kelahiran.</p>
                </div>
                <div class="group flex flex-col h-full relative rounded-2xl bg-white p-8 shadow-sm transition-all hover:shadow-md dark:bg-slate-900/50">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-charcoal">
                        <span class="material-symbols-outlined text-3xl">verified</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">3. Daftar Ulang</h3>
                    <p class="text-sm leading-relaxed text-slate-500">Lakukan konfirmasi dan administrasi akhir setelah dinyatakan lolos.</p>
                </div>
            </div>
        </section>
        <!-- Important Dates -->
        <section class="rounded-3xl bg-charcoal p-8 text-white lg:p-16">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                <div>
                    <h2 class="mb-6 text-3xl font-black lg:text-4xl">Jadwal Penting</h2>
                    <p class="mb-10 text-slate-400">Catat tanggal-tanggal penting agar tidak terlewat proses seleksinya.</p>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center rounded-lg bg-primary/20 p-3 text-primary">
                                <span class="text-xs font-bold uppercase">Jan</span>
                                <span class="text-xl font-black">02</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold">Gelombang I Dimulai</h4>
                                <p class="text-sm text-slate-400">Pendaftaran Early Bird dengan potongan biaya pangkal.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center rounded-lg bg-slate-800 p-3 text-slate-400">
                                <span class="text-xs font-bold uppercase">Mar</span>
                                <span class="text-xl font-black">15</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold">Gelombang II Dimulai</h4>
                                <p class="text-sm text-slate-400">Pendaftaran reguler untuk semua program keahlian.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center rounded-lg bg-slate-800 p-3 text-slate-400">
                                <span class="text-xs font-bold uppercase">Mei</span>
                                <span class="text-xl font-black">20</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold">Gelombang III Dimulai</h4>
                                <p class="text-sm text-slate-400">Pendaftaran terakhir (jika kuota masih tersedia).</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Requirements Grid -->
                <div class="rounded-2xl bg-white/5 p-8 backdrop-blur-sm">
                    <h3 class="mb-6 text-xl font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">fact_check</span>
                        Persyaratan Dokumen
                    </h3>
                    <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Fotokopi Ijazah/SKL
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Akta Kelahiran
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Kartu Keluarga
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Pas Foto 3x4 (4 lembar)
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Rapor Semester 1-5
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            Sertifikat Prestasi (Opsional)
                        </li>
                    </ul>
                    <div class="mt-8 rounded-xl bg-primary p-4 text-charcoal">
                        <p class="text-xs font-bold uppercase tracking-wide opacity-70">Info Penting</p>
                        <p class="text-sm font-medium mt-1">Seluruh berkas fisik dikumpulkan ke sekretariat PPDB saat verifikasi tatap muka.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Registration Form CTA Section -->
        <section class="py-20">
            <div class="flex flex-col items-center text-center">
                <h2 class="mb-4 text-3xl font-black text-charcoal dark:text-slate-100 lg:text-5xl">Siap Bergabung?</h2>
                <p class="mb-10 max-w-2xl text-lg text-slate-600 dark:text-slate-400">Jangan tunda lagi, kuota terbatas untuk setiap jurusan. Daftar sekarang dan amankan kursimu!</p>
                <div class="w-full max-w-lg rounded-2xl border-2 border-primary/20 bg-white p-8 shadow-2xl shadow-primary/10 dark:bg-slate-900">
                    <form class="flex flex-col gap-4 text-left">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Nama Lengkap Siswa</label>
                            <input class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="Contoh: Budi Santoso" type="text"/>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Asal Sekolah (SMP/MTs)</label>
                            <input class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="Contoh: SMP Negeri 1 Bogor" type="text"/>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Nomor WhatsApp</label>
                                <input class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800" placeholder="0812..." type="tel"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Pilihan Jurusan</label>
                                <select class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 px-4 focus:border-primary focus:ring-primary dark:border-slate-800 dark:bg-slate-800">
                                    <option>Pilih Jurusan</option>
                                    <option>Teknik Komputer Jaringan</option>
                                    <option>Multimedia</option>
                                    <option>Akuntansi</option>
                                    <option>Perkantoran</option>
                                </select>
                            </div>
                        </div>
                        <button class="mt-4 flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-primary text-base font-black text-charcoal transition-all hover:scale-[1.01] active:scale-95">
                            Mulai Registrasi Online
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        <p class="text-center text-[10px] text-slate-400">Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan pendaftaran SMK Putra Pakuan.</p>
                    </form>
                </div>
            </div>
        </section>
        <!-- Floating WhatsApp Button -->
        <a class="fixed bottom-6 right-6 z-[60] flex h-16 w-16 items-center justify-center rounded-full bg-[#25D366] text-white shadow-2xl transition-transform hover:scale-110 active:scale-95" href="#">
            <svg class="h-8 w-8" fill="currentColor" viewbox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.938 3.659 1.432 5.63 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path>
            </svg>
        </a>
    </main>
</div>
@endsection
