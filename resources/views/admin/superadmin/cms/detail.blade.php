@extends('layouts.admin.app')

@section('title', 'Content Management - SMK Putra Pakuan CMS')

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-12">
<!-- Header Section -->
<section class="flex justify-between items-end">
    <div class="space-y-2">
        <p class="text-primary font-bold tracking-widest text-xs uppercase">Editor Suite</p>
        <h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">Web Presence</h2>
    </div>
    <div class="flex gap-3">
        <button class="px-6 py-3 text-primary font-bold hover:bg-primary/10 rounded-full transition-all text-sm bg-white border border-primary/20">Discard Changes</button>
        <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">Publish Updates</button>
    </div>
</section>
<!-- Content Grid (Asymmetric) -->
<div class="grid grid-cols-12 gap-8">
    <!-- Hero Section Management (Large Card) -->
    <div class="col-span-12 lg:col-span-8 space-y-8">
        <!-- Hero Section -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-primary-container text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1c190d]">Hero Section</h3>
                    <p class="text-on-surface-variant text-sm">Slider utama, headline, subheadline, background, dan tombol utama.</p>
                </div>
            </div>
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Slides (Images, Headline, Subheadline, Button)</label>
                    <div class="space-y-4">
                        <!-- Repeatable slide editor UI (for each slide) -->
                        <div class="bg-surface-container-low rounded-xl p-4 flex flex-col gap-4">
                            <input class="w-full bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="SMK PUTRA PAKUAN" placeholder="Headline"/>
                            <textarea class="w-full bg-white border-none rounded-xl p-3 text-sm leading-relaxed focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" rows="2" placeholder="Subheadline">Membentuk tenaga kerja profesional, berkarakter, dan siap bersaing di kancah industri global melalui inovasi pendidikan.</textarea>
                            <input class="w-full bg-white border-none rounded-xl p-3 text-sm focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="https://lh3.googleusercontent.com/aida-public/AB6AXuCXpMjqgfiuKKSUoRdYNiimPNmi33yGSv3H1SaO224yREfseZpcO58hsaQNLTW26k-6h_ReeWKPSDwfwkCeRL47KVJ2OZ7_07xCQIUf_yjDCQTcuI0StKSRBoKdWJ_g40oTEJdFkwC33UMvSCyoruiBd_VRAxai80IG1XSnml39DK0QKzEQefEAJkEs2c6oRqRjrVPzsHQV8CNWeS5RNQQAyen_XVhX3q_tGFyatat2H16LqQ97VODQMhJMqZCeKy2Oa27diTKrcw" placeholder="Background Image URL"/>
                            <input class="w-full bg-white border-none rounded-xl p-3 text-sm focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="Pendaftaran Siswa Baru" placeholder="Button Text"/>
                        </div>
                        <!-- Add more slides as needed -->
                    </div>
                </div>
            </div>
        </div>
        <!-- PPDB Section -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-primary-container text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">edit_note</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1c190d]">PPDB Section</h3>
                    <p class="text-on-surface-variant text-sm">Judul, subjudul, tombol, dan countdown pendaftaran.</p>
                </div>
            </div>
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Judul</label>
                    <input class="w-full bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="PPDB 2024 TELAH DIBUKA"/>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Subjudul</label>
                    <textarea class="w-full bg-white border-none rounded-xl p-3 text-sm leading-relaxed focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" rows="2">Segera daftarkan diri Anda dan menjadi bagian dari keluarga besar SMK Putra Pakuan. Kuota terbatas untuk setiap jurusan!</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Teks Tombol</label>
                    <input class="w-full bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="DAFTAR SEKARANG"/>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Countdown (Hari, Jam, Menit)</label>
                    <div class="flex gap-4">
                        <input class="w-20 bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="number" value="12" placeholder="Hari"/>
                        <input class="w-20 bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="number" value="8" placeholder="Jam"/>
                        <input class="w-20 bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="number" value="45" placeholder="Menit"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sambutan Kepala Sekolah -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-primary-container text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">format_quote</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1c190d]">Sambutan Kepala Sekolah</h3>
                    <p class="text-on-surface-variant text-sm">Foto, nama, jabatan, dan sambutan kepala sekolah.</p>
                </div>
            </div>
            <div class="space-y-6 lg:flex lg:gap-8">
                <div class="space-y-2 lg:w-1/3 shrink-0">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Foto Kepala Sekolah</label>
                    <div class="w-full flex flex-col items-center">
                        <img id="kepsek-preview" src="/images/KEPSEK_SMK.png" alt="Preview Foto Kepala Sekolah" class="w-40 h-40 object-cover rounded-2xl border-4 border-surface-container mb-2" />
                        <input class="w-full bg-white border-none rounded-xl p-3 text-sm focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="/images/KEPSEK_SMK.png" placeholder="URL Foto" oninput="document.getElementById('kepsek-preview').src = this.value"/>
                        <label class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl font-bold text-xs cursor-pointer hover:bg-[#ffe066] transition-all shadow-sm border border-[#e6b800]">
                            <span class="material-symbols-outlined text-base">upload</span>
                            <span>Upload Foto</span>
                            <input type="file" accept="image/*" class="hidden" onchange="if(this.files[0]){const reader=new FileReader();reader.onload=e=>{document.getElementById('kepsek-preview').src=e.target.result;};reader.readAsDataURL(this.files[0]);}" />
                        </label>
                    </div>
                </div>
                <div class="space-y-2 flex-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Nama Kepala Sekolah</label>
                    <input class="w-full bg-white border-none rounded-xl p-3 text-base font-bold focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="Apid Sutarno, S.Kom, Gr."/>
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1 mt-4">Jabatan</label>
                    <input class="w-full bg-white border-none rounded-xl p-3 text-sm focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" type="text" value="Kepala Sekolah"/>
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1 mt-4">Teks Sambutan</label>
                    <textarea class="w-full bg-white border-none rounded-xl p-3 text-sm leading-relaxed focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" rows="6">Bismillahirrahmanirrahim

Assalamualaikum warahmatullahi wabarakatuh

Alhamdulillahi rabbil'alamin kami panjatkan kehadlirat Allah SWT, bahwasannya dengan rahmat dan karunia-nya akhirnya website sekolah ini dengan alamat http://smk.putrapakuan.sch.id/ dapat kami perbaharui.

Kami mengucapkan selamat datang di Website kami Sekolah Menengah Kejuruan Putra Pakuan yang saya tujukan untuk seluruh guru, karyawan dan siswa siswi serta khalayak umum guna dapat mengakses seluruh informasi tentang segala profil, aktivitas/kegiatan serta fasilitas  yang ada di sekolah kami.

Kami berharap, dengan adanya media layanan informasi situs ini semoga dapat mewujudkan hubungan silaturahmi yang lebih erat lagi, menambah wawasan, mempermudah dan mempercepat proses dalam mendapatkan informasi yang dibutuhkan.</textarea>
                </div>
            </div>
        </div>
        <!-- Tulisan Terbaru (Berita) -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-primary-container text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">feed</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1c190d]">Tulisan Terbaru (Berita)</h3>
                    <p class="text-on-surface-variant text-sm">Daftar berita/kegiatan terbaru.</p>
                </div>
            </div>
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Daftar Berita</label>
                    <textarea class="w-full bg-white border-none rounded-xl p-3 text-sm leading-relaxed focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" rows="4">Kunjungan Industri ke Perusahaan Teknologi Nasional
Pemenang Lomba Keterampilan Siswa (LKS) Tingkat Kota
Tips Persiapan Ujian Kompetensi Keahlian bagi Kelas XII</textarea>
                </div>
            </div>
        </div>
        <!-- Galeri & Video Terbaru -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-primary-container text-primary rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">photo_library</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#1c190d]">Galeri & Video Terbaru</h3>
                    <p class="text-on-surface-variant text-sm">Daftar foto dan video terbaru.</p>
                </div>
            </div>
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Daftar Galeri & Video</label>
                    <textarea class="w-full bg-white border-none rounded-xl p-3 text-sm leading-relaxed focus:ring-0 border-b-2 border-transparent focus:border-primary transition-all text-[#1c190d]" rows="4">Kegiatan Praktek Industri Siswa RPL
Liputan Kegiatan Expo SMK
Juara Lomba Desain Grafis Nasional</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Spacing -->
<div class="h-12"></div>
</div>
@endsection
