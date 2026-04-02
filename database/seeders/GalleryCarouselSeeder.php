<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\CarouselImage;
use App\Models\School;
use Illuminate\Database\Seeder;

class GalleryCarouselSeeder extends Seeder
{
    public function run(): void
    {
        $smk     = School::where('slug', 'smk-putra-pakuan')->first();
        $smp     = School::where('slug', 'smp-putra-pakuan')->first();
        $sdit    = School::where('slug', 'sdit-putra-pakuan')->first();
        $yayasan = School::where('slug', 'yayasan-putra-pakuan')->first();

        // ─── CAROUSEL SLIDES ─────────────────────────────────────────────
        $carousels = [
            // SMK
            [
                'school_id'   => $smk->id,
                'title'       => 'Selamat Datang di SMK Putra Pakuan',
                'description' => 'Mencetak generasi vokasi unggul, berkarakter, dan siap kerja di era industri 4.0.',
                'image_url'   => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=85',
                'button_text' => 'Daftar Sekarang',
                'button_url'  => '/ppdb/smk',
                'sort_order'  => 1,
                'status'      => 'active',
            ],
            [
                'school_id'   => $smk->id,
                'title'       => 'Laboratorium Komputer Modern',
                'description' => 'Fasilitas lab jaringan & komputer berstandar industri untuk mendukung kompetensi keahlian TKJ.',
                'image_url'   => 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=1400&q=85',
                'button_text' => 'Lihat Fasilitas',
                'button_url'  => '/smk/fasilitas',
                'sort_order'  => 2,
                'status'      => 'active',
            ],
            [
                'school_id'   => $smk->id,
                'title'       => 'Juara LKS Provinsi Jawa Barat 2026',
                'description' => 'SMK Putra Pakuan kembali mengharumkan nama Kabupaten Bogor di kompetisi kompetensi siswa tingkat provinsi.',
                'image_url'   => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=1400&q=85',
                'button_text' => 'Selengkapnya',
                'button_url'  => '/smk/berita',
                'sort_order'  => 3,
                'status'      => 'active',
            ],
            // SMP
            [
                'school_id'   => $smp->id,
                'title'       => 'Selamat Datang di SMP Putra Pakuan',
                'description' => 'Bersama kami, kembangkan potensi akademik, karakter, dan bakat terbaik putra-putri Anda.',
                'image_url'   => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1400&q=85',
                'button_text' => 'Daftar PPDB',
                'button_url'  => '/ppdb/smp',
                'sort_order'  => 1,
                'status'      => 'active',
            ],
            [
                'school_id'   => $smp->id,
                'title'       => 'Lingkungan Belajar yang Kondusif & Menyenangkan',
                'description' => 'Ruang kelas modern dengan pendekatan pembelajaran aktif mendorong siswa tumbuh percaya diri.',
                'image_url'   => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1400&q=85',
                'button_text' => 'Tentang Kami',
                'button_url'  => '/smp/tentang',
                'sort_order'  => 2,
                'status'      => 'active',
            ],
            [
                'school_id'   => $smp->id,
                'title'       => 'Prestasi Gemilang di Berbagai Bidang',
                'description' => 'Dari olimpiade sains hingga seni budaya — siswa SMP Putra Pakuan terus berprestasi di tingkat kabupaten dan provinsi.',
                'image_url'   => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=1400&q=85',
                'button_text' => 'Lihat Prestasi',
                'button_url'  => '/smp/prestasi',
                'sort_order'  => 3,
                'status'      => 'active',
            ],
            // SDIT
            [
                'school_id'   => $sdit->id,
                'title'       => 'Selamat Datang di SDIT Putra Pakuan',
                'description' => 'Madrasah digital berbasis Islam — membentuk generasi cerdas, beriman, dan berakhlak mulia.',
                'image_url'   => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=1400&q=85',
                'button_text' => 'Daftar PPDB',
                'button_url'  => '/ppdb/sd',
                'sort_order'  => 1,
                'status'      => 'active',
            ],
            [
                'school_id'   => $sdit->id,
                'title'       => 'Program Tahfizh Al-Quran Terintegrasi',
                'description' => 'Setiap siswa dibimbing menghafal Al-Quran secara terprogram sejak kelas 1, dipandu ustadz berpengalaman.',
                'image_url'   => 'https://images.unsplash.com/photo-1585436668783-35c292f5eed7?w=1400&q=85',
                'button_text' => 'Program Unggulan',
                'button_url'  => '/sd/program',
                'sort_order'  => 2,
                'status'      => 'active',
            ],
            [
                'school_id'   => $sdit->id,
                'title'       => 'Belajar Sains Menyenangkan dengan Laboratorium Anak',
                'description' => 'Laboratorium sains anak yang ramah dan interaktif membuat eksplorasi ilmu pengetahuan menjadi pengalaman yang menakjubkan.',
                'image_url'   => 'https://images.unsplash.com/photo-1596495578065-6e0763fa1178?w=1400&q=85',
                'button_text' => 'Lihat Fasilitas',
                'button_url'  => '/sd/fasilitas',
                'sort_order'  => 3,
                'status'      => 'active',
            ],
            // Yayasan
            [
                'school_id'   => $yayasan->id,
                'title'       => 'Yayasan Putra Pakuan — Pendidikan Berkualitas Berbasis Nilai',
                'description' => 'Membina generasi unggul melalui sinergi SMK, SMP, dan SDIT Putra Pakuan dalam satu ekosistem pendidikan terpadu.',
                'image_url'   => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1400&q=85',
                'button_text' => 'Tentang Yayasan',
                'button_url'  => '/yayasan/tentang',
                'sort_order'  => 1,
                'status'      => 'active',
            ],
            [
                'school_id'   => $yayasan->id,
                'title'       => 'Sinergi Tiga Unit Sekolah Unggulan',
                'description' => 'Yayasan Putra Pakuan menghadirkan jalur pendidikan berkelanjutan dari dasar hingga vokasi untuk masa depan peserta didik.',
                'image_url'   => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=85',
                'button_text' => 'Unit Sekolah',
                'button_url'  => '/yayasan/unit-sekolah',
                'sort_order'  => 2,
                'status'      => 'active',
            ],
            [
                'school_id'   => $yayasan->id,
                'title'       => 'Program Beasiswa dan Wakaf Pendidikan',
                'description' => 'Komitmen yayasan memperluas akses pendidikan berkualitas melalui beasiswa berkelanjutan dan program sosial pendidikan.',
                'image_url'   => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1400&q=85',
                'button_text' => 'Program Sosial',
                'button_url'  => '/yayasan/program',
                'sort_order'  => 3,
                'status'      => 'active',
            ],
        ];

        foreach ($carousels as $c) {
            CarouselImage::updateOrCreate(
                ['school_id' => $c['school_id'], 'title' => $c['title']],
                $c
            );
        }

        // ─── GALLERY ITEMS ───────────────────────────────────────────────
        $galleries = [
            // SMK gallery
            [
                'school_id'    => $smk->id,
                'title'        => 'Upacara Pembukaan Tahun Ajaran Baru 2025/2026',
                'description'  => 'Seluruh siswa dan guru SMK Putra Pakuan berkumpul di lapangan utama untuk upacara pembukaan resmi tahun ajaran baru.',
                'image_url'    => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2025-07-15 08:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Praktik Jaringan Komputer di Lab TKJ',
                'description'  => 'Siswa kelas XI TKJ sedang melakukan praktik konfigurasi router dan switch dalam sesi pembelajaran berbasis proyek.',
                'image_url'    => 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-10 10:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Kunjungan Industri ke Pabrik Otomotif',
                'description'  => 'Siswa jurusan TKRO antusias mengamati lini produksi kendaraan bermotor dalam kunjungan industri ke Karawang.',
                'image_url'    => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-12 07:30:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Penerimaan Piala LKS Provinsi Jawa Barat',
                'description'  => 'Momen membanggakan saat tim LKS SMK Putra Pakuan menerima piala Juara 1 dari Kepala Dinas Pendidikan Provinsi Jawa Barat.',
                'image_url'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-22 11:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Workshop Keamanan Siber bersama BSSN',
                'description'  => 'Peserta workshop berfoto bersama pemateri dari BSSN setelah sesi praktik keamanan jaringan.',
                'image_url'    => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-06 15:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Pameran Karya Siswa Hari Pendidikan Nasional',
                'description'  => 'Pengunjung mengamati pameran proyek inovatif siswa dalam rangka memperingati Hardiknas 2026.',
                'image_url'    => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-05-02 14:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Suasana Perpustakaan dan Ruang Belajar',
                'description'  => 'Perpustakaan SMK Putra Pakuan yang nyaman dan lengkap mendukung budaya membaca dan belajar mandiri.',
                'image_url'    => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-01-20 09:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'title'        => 'Kegiatan Olahraga Pagi Siswa SMK',
                'description'  => 'Siswa SMK Putra Pakuan berolah raga pagi sebagai bagian dari program kesehatan jasmani sekolah.',
                'image_url'    => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-05 07:00:00',
            ],

            // SMP gallery
            [
                'school_id'    => $smp->id,
                'title'        => 'Upacara Hari Kemerdekaan Republik Indonesia',
                'description'  => 'Seluruh siswa, guru, dan staf SMP Putra Pakuan melaksanakan upacara bendera dalam rangka HUT RI ke-80.',
                'image_url'    => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2025-08-17 08:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Gebyar Seni dan Olahraga 2026',
                'description'  => 'Kemeriahan Gebyar Seni dan Olahraga SMP Putra Pakuan menampilkan penampilan seni terbaik dari seluruh kelas.',
                'image_url'    => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-16 14:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Kegiatan Pramuka Persami Gunung Salak Endah',
                'description'  => 'Para siswa anggota Pramuka SMP Putra Pakuan mendirikan tenda dan bersiap menghadapi malam api unggun.',
                'image_url'    => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-23 18:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Olimpiade Matematika — Peraih Medali Emas',
                'description'  => 'Azzam Fawwaz berfoto dengan piala dan medali emas Olimpiade Matematika Kabupaten Bogor didampingi Kepala Sekolah dan guru pembimbing.',
                'image_url'    => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-19 10:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Sesi Belajar di Luar Kelas',
                'description'  => 'Guru mengadakan pembelajaran kontekstual di taman sekolah, menciptakan pengalaman belajar yang lebih hidup dan berkesan.',
                'image_url'    => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-14 10:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Lomba Debat Bahasa Inggris Antarkelas',
                'description'  => 'Kompetisi debat bahasa Inggris antarkelas menjadi ajang melatih kepercayaan diri dan kemampuan berpikir kritis siswa.',
                'image_url'    => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-01-25 13:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'title'        => 'Kegiatan Cooking Class & Prakarya Siswa',
                'description'  => 'Siswi kelas VIII mengikuti kegiatan cooking class sebagai bagian dari mata pelajaran prakarya dan kewirausahaan.',
                'image_url'    => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-05 11:00:00',
            ],

            // SDIT gallery
            [
                'school_id'    => $sdit->id,
                'title'        => 'Wisuda dan Haflah Al-Quran Kelas VI 2026',
                'description'  => 'Para wisudawan kelas VI SDIT Putra Pakuan dalam balutan toga, momen bersejarah yang membanggakan keluarga.',
                'image_url'    => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-06-14 10:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'title'        => 'Market Day — Belajar Berwirausaha Sejak Kecil',
                'description'  => 'Siswa menjajal kemampuan berdagang dalam kegiatan Market Day yang penuh semangat dan kreativitas.',
                'image_url'    => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-07 13:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'title'        => 'Eksperimen Sains di Laboratorium Anak',
                'description'  => 'Siswa kelas IV melakukan eksperimen sederhana mengenai reaksi kimia di laboratorium sains yang ramah anak.',
                'image_url'    => 'https://images.unsplash.com/photo-1596495578065-6e0763fa1178?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-20 09:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'title'        => 'Kegiatan Tahfizh Pagi Sebelum Belajar',
                'description'  => 'Setiap pagi sebelum pelajaran dimulai, siswa SDIT Putra Pakuan melaksanakan muraja\'ah dan setoran hafalan Al-Quran.',
                'image_url'    => 'https://images.unsplash.com/photo-1585436668783-35c292f5eed7?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-01-10 07:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'title'        => 'Pesta Literasi: Pekan Membaca Nasional',
                'description'  => 'Siswa bersemangat memilih buku bacaan pilihan dalam rangka memperingati Pekan Membaca Nasional di perpustakaan sekolah.',
                'image_url'    => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2025-11-14 10:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'title'        => 'Keceriaan di Hari Olahraga Sekolah',
                'description'  => 'Para siswa SDIT penuh senyum dan semangat saat mengikuti senam pagi dan berbagai permainan tradisional dalam Hari Olahraga Sekolah.',
                'image_url'    => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2025-10-09 08:00:00',
            ],

            // Yayasan gallery
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Gedung Sekretariat Yayasan Putra Pakuan',
                'description'  => 'Sekretariat Yayasan Putra Pakuan sebagai pusat koordinasi program, tata kelola, dan pengembangan lembaga pendidikan.',
                'image_url'    => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-01-05 09:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Rapat Kerja Tahunan Pengurus Yayasan 2026',
                'description'  => 'Pengurus yayasan dan kepala unit sekolah menyusun prioritas kerja tahunan untuk peningkatan mutu pendidikan.',
                'image_url'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-09 09:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Perayaan Milad ke-25 Yayasan Putra Pakuan',
                'description'  => 'Momen kebersamaan keluarga besar Yayasan Putra Pakuan bersama alumni, orang tua, dan mitra pendidikan.',
                'image_url'    => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-17 15:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Penyerahan Beasiswa Pendidikan Yayasan 2026',
                'description'  => 'Yayasan menyerahkan beasiswa kepada siswa berprestasi sebagai dukungan keberlanjutan pendidikan.',
                'image_url'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-05 10:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Program Putra Pakuan Peduli untuk Korban Bencana',
                'description'  => 'Relawan yayasan menyalurkan perlengkapan pendidikan bagi anak-anak terdampak bencana.',
                'image_url'    => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-02-22 12:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'title'        => 'Yayasan Putra Pakuan Terima Penghargaan Pendidikan Tingkat Provinsi',
                'description'  => 'Penghargaan diterima atas kontribusi yayasan dalam penguatan mutu pendidikan berbasis karakter dan nilai keislaman.',
                'image_url'    => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80',
                'status'       => 'published',
                'published_at' => '2026-03-16 11:00:00',
            ],
        ];

        foreach ($galleries as $g) {
            GalleryItem::updateOrCreate(
                ['school_id' => $g['school_id'], 'title' => $g['title']],
                $g
            );
        }
    }
}
