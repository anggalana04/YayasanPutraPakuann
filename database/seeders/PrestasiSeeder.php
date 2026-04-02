<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $smk     = School::where('slug', 'smk-putra-pakuan')->first();
        $smp     = School::where('slug', 'smp-putra-pakuan')->first();
        $sdit    = School::where('slug', 'sdit-putra-pakuan')->first();
        $yayasan = School::where('slug', 'yayasan-putra-pakuan')->first();

        $items = [

            // ─── SMK ────────────────────────────────────────────────────────
            [
                'school_id'    => $smk->id,
                'category'     => 'Akademik',
                'featured'     => true,
                'title'        => 'Juara 1 LKS Provinsi Jawa Barat — Bidang IT Network Systems',
                'excerpt'      => 'Tim siswa berhasil meraih posisi teratas Lomba Kompetensi Siswa bidang IT Network Systems Administration mewakili Kabupaten Bogor di tingkat Provinsi Jawa Barat.',
                'content'      => '<p>Pada Lomba Kompetensi Siswa (LKS) Tingkat Provinsi Jawa Barat 2026, tim dari SMK Putra Pakuan yang beranggotakan Rafi Ardian, Dina Aulia, dan M. Fadhil berhasil meraih <strong>Juara 1</strong> dalam bidang IT Network Systems Administration. Kompetisi yang diikuti 32 sekolah dari seluruh Jawa Barat ini membuktikan kualitas pembinaan kompetensi keahlian di SMK Putra Pakuan.</p><p>Tim akan melanjutkan perjuangan di LKS Tingkat Nasional yang akan diadakan di Surabaya.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80',
                'published_at' => '2026-03-21 08:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Akademik',
                'featured'     => true,
                'title'        => 'Juara 2 Kompetisi Desain Web Tingkat Nasional — Kemendikbudristek',
                'excerpt'      => 'Mewakili Provinsi Jawa Barat, siswa jurusan TKJ SMK Putra Pakuan meraih Juara 2 dalam Kompetisi Desain dan Pengembangan Web Nasional yang diselenggarakan oleh Kemendikbudristek.',
                'content'      => '<p>Kompetisi bergengsi yang diikuti lebih dari 200 peserta dari seluruh Indonesia ini membuktikan kemampuan siswa SMK Putra Pakuan di ranah pengembangan web. Siswa peserta, Farhan Maulana (Kelas XII TKJ), berhasil meraih <strong>Juara 2</strong> dengan rancangan website portofolio interaktif berbasis Vue.js dan Laravel yang dinilai sangat inovatif oleh juri.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80',
                'published_at' => '2026-01-15 09:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Olahraga',
                'featured'     => false,
                'title'        => 'Juara 1 Futsal Pelajar Tingkat Kota/Kabupaten Bogor',
                'excerpt'      => 'Tim futsal SMK Putra Pakuan menjuarai turnamen futsal pelajar tingkat Kota/Kabupaten Bogor setelah mengalahkan SMK Negeri 1 Bogor dengan skor 3-1 di babak final.',
                'content'      => '<p>Tim futsal SMK Putra Pakuan meraih <strong>Juara 1</strong> dalam Turnamen Futsal Pelajar yang diselenggarakan oleh Dinas Pendidikan Kabupaten Bogor. Melewati tujuh pertandingan tanpa terkalahkan, tim asuhan Pelatih Eko Prasetyo berhasil mengalahkan SMK Negeri 1 Bogor di babak grand final.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=800&q=80',
                'published_at' => '2025-11-20 14:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Akademik',
                'featured'     => false,
                'title'        => 'Inovasi Siswa TKRO: Prototipe Konversi Sepeda Motor Berbasis Tenaga Surya',
                'excerpt'      => 'Proyek inovasi dari 5 siswa kelas XII TKRO berhasil meraih penghargaan "Best Innovation" dalam ajang Pameran Inovasi Vokasi Jawa Barat.',
                'content'      => '<p>Lima siswa kelas XII TKRO SMK Putra Pakuan — Bagas, Rian, Wahyu, Sari, dan Taufiq — merancang prototipe <strong>sepeda motor konversi bertenaga surya</strong> yang menggunakan panel surya fleksibel dan baterai lithium daur ulang. Karya ini meraih penghargaan <em>Best Innovation Award</em> dalam Pameran Inovasi Vokasi Jawa Barat 2026 yang dihadiri oleh ratusan perwakilan industri dan akademisi.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1473947050642-6196a0db3c2e?w=800&q=80',
                'published_at' => '2026-02-10 10:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Sertifikasi',
                'featured'     => false,
                'title'        => '47 Siswa Lulus Uji Kompetensi Sertifikasi Cisco CCNA',
                'excerpt'      => 'Sebanyak 47 siswa kelas XII TKJ berhasil lulus uji kompetensi dan mendapatkan sertifikasi Cisco CCNA — sertifikasi jaringan komputer bergengsi yang diakui internasional.',
                'content'      => '<p>SMK Putra Pakuan kembali mencetak rekor dengan kelulusan massal sertifikasi internasional. Sebanyak <strong>47 siswa kelas XII TKJ</strong> dinyatakan lulus dalam ujian sertifikasi <em>Cisco Certified Network Associate (CCNA)</em> yang dilaksanakan secara resmi di SMK Putra Pakuan sebagai Cisco Authorized Testing Center.</p><p>Sertifikasi ini meningkatkan nilai jual lulusan secara signifikan di pasar kerja nasional maupun internasional.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80',
                'published_at' => '2025-12-05 09:00:00',
            ],

            // ─── SMP ────────────────────────────────────────────────────────
            [
                'school_id'    => $smp->id,
                'category'     => 'Akademik',
                'featured'     => true,
                'title'        => 'Medali Emas Olimpiade Matematika Tingkat Kabupaten Bogor',
                'excerpt'      => 'Azzam Fawwaz, siswa kelas VIII-A, meraih medali emas dalam Olimpiade Matematika Kabupaten Bogor 2026 dan berhak mewakili daerah ke tingkat provinsi.',
                'content'      => '<p>Azzam Fawwaz, siswa kelas VIII-A SMP Putra Pakuan, berhasil meraih <strong>Medali Emas</strong> dalam Olimpiade Matematika Kabupaten Bogor 2026. Bersama rekan-rekannya yang meraih perak dan perunggu, koleksi tiga medali sekaligus ini menjadi pencapaian bersejarah bagi SMP Putra Pakuan.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80',
                'published_at' => '2026-03-18 09:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Akademik',
                'featured'     => true,
                'title'        => 'Juara 2 Lomba Debat Bahasa Inggris Tingkat SMP se-Bogor Raya',
                'excerpt'      => 'Pasangan debater SMP Putra Pakuan berhasil meraih posisi runners-up dalam perlombaan debat Bahasa Inggris yang diikuti oleh 40 sekolah se-Bogor Raya.',
                'content'      => '<p>Dua siswa kelas IX SMP Putra Pakuan, Kiara Anindya dan Farrel Rizky, tampil memukau dalam <em>Bogor English Debate Championship 2026</em> yang diikuti oleh 40 tim dari berbagai SMP se-Bogor Raya. Pasangan ini berhasil melaju hingga babak final dan meraih posisi <strong>Juara 2</strong> setelah pertandingan sengit melawan SMPN 1 Cibinong.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&q=80',
                'published_at' => '2026-02-20 11:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Seni & Budaya',
                'featured'     => false,
                'title'        => 'Juara 1 Tari Kreasi pada Festival Seni Pelajar Kabupaten Bogor',
                'excerpt'      => 'Tim tari SMP Putra Pakuan tampil memukau dan meraih Juara 1 dalam Festival Seni Pelajar tingkat Kabupaten Bogor dengan garapan tari kreasi bertema keberagaman.',
                'content'      => '<p>Tim tari kreasi SMP Putra Pakuan yang beranggotakan 10 siswi kelas VII dan VIII berhasil memukau juri dan penonton dalam <strong>Festival Seni Pelajar Kabupaten Bogor 2026</strong>. Dengan garapan tari bertema "Nusantara Harmoni" yang memadukan gerak tari dari berbagai daerah, mereka keluar sebagai <em>Juara 1</em> mengalahkan 22 tim lain.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=800&q=80',
                'published_at' => '2025-10-28 13:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Olahraga',
                'featured'     => false,
                'title'        => 'Atlet Bulu Tangkis SMP Putra Pakuan Lolos Kejuaraan Pelajar Provisi Jawa Barat',
                'excerpt'      => 'Dua atlet bulu tangkis tunggal putra dan putri SMP Putra Pakuan berhasil lolos babak kualifikasi dan mewakili Kabupaten Bogor ke tingkat provinsi.',
                'content'      => '<p>Dua atlet bulu tangkis SMP Putra Pakuan, Arjuna Pratama (tunggal putra) dan Siti Rahayu (tunggal putri), berhasil lolos babak kualifikasi dan berhak mewakili Kabupaten Bogor dalam <strong>Kejuaraan Bulu Tangkis Pelajar Jawa Barat 2026</strong>. Keduanya merupakan binaan pelatih Bapak Zainal Abidin yang konsisten menggembleng calon atlet sejak kelas VII.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=800&q=80',
                'published_at' => '2026-01-30 10:00:00',
            ],

            // ─── SDIT ───────────────────────────────────────────────────────
            [
                'school_id'    => $sdit->id,
                'category'     => 'Akademik',
                'featured'     => true,
                'title'        => 'Juara Harapan 1 Olimpiade Sains Nasional Tingkat Kabupaten — Bidang IPA',
                'excerpt'      => 'Alya Nuraini, siswa kelas V SDIT Putra Pakuan, meraih Juara Harapan 1 dalam Olimpiade Sains Nasional bidang IPA tingkat Kabupaten Bogor.',
                'content'      => '<p>Alya Nuraini, siswi kelas V-A SDIT Putra Pakuan, menorehkan prestasi membanggakan dengan meraih <strong>Juara Harapan 1</strong> dalam Olimpiade Sains Nasional (OSN) bidang Ilmu Pengetahuan Alam tingkat Kabupaten Bogor 2026. Pencapaian ini tidak terlepas dari program pembinaan olimpiade yang konsisten diterapkan sekolah sejak kelas IV.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&q=80',
                'published_at' => '2026-03-10 09:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Agama',
                'featured'     => true,
                'title'        => 'Juara 1 Musabaqah Tilawatil Quran (MTQ) Pelajar SD Tingkat Kecamatan',
                'excerpt'      => 'Siswa kelas VI SDIT Putra Pakuan berhasil meraih Juara 1 MTQ cabang Tilawah dan Hafizh dalam ajang MTQ Pelajar tingkat Kecamatan Bogor Tengah.',
                'content'      => '<p>Dua siswa kelas VI SDIT Putra Pakuan — Umar Abdillah (Hafizh) dan Aisyah Muthia (Tilawah) — berhasil meraih <strong>Juara 1</strong> dalam cabang masing-masing pada Musabaqah Tilawatil Quran (MTQ) Pelajar tingkat Kecamatan Bogor Tengah 2026. Keduanya akan mewakili kecamatan ke ajang MTQ tingkat kota.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1585436668783-35c292f5eed7?w=800&q=80',
                'published_at' => '2026-02-14 10:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Seni & Budaya',
                'featured'     => false,
                'title'        => 'Juara 2 Lomba Mewarnai Tingkat SD se-Kota Bogor',
                'excerpt'      => 'Siswa kelas II SDIT Putra Pakuan meraih Juara 2 dalam lomba mewarnai tingkat SD yang diselenggarakan oleh Dinas Pendidikan Kota Bogor.',
                'content'      => '<p>Rizka Amalia, siswi kelas II-B SDIT Putra Pakuan, meraih <strong>Juara 2</strong> dalam Lomba Mewarnai tingkat SD se-Kota Bogor yang diselenggarakan oleh Dinas Pendidikan. Dengan goresan warna yang ekspresif dan kreatif, karya Rizka berhasil memikat hati juri dari kalangan seniman profesional.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=800&q=80',
                'published_at' => '2025-09-22 14:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Olahraga',
                'featured'     => false,
                'title'        => 'Juara 3 O2SN Renang Gaya Bebas Putra Tingkat Kabupaten',
                'excerpt'      => 'Ahmad Ghifari, siswa kelas V SDIT Putra Pakuan, meraih medali perunggu cabang renang gaya bebas 50 meter putra dalam Olimpiade Olahraga Siswa Nasional (O2SN) tingkat kabupaten.',
                'content'      => '<p>Ahmad Ghifari, siswa kelas V SDIT Putra Pakuan, berhasil merebut <strong>medali perunggu</strong> dalam cabang Renang Gaya Bebas 50 Meter Putra pada ajang O2SN tingkat Kabupaten Bogor 2026. Latihan rutin tiga kali seminggu di kolam renang Tirta Pakuan sejak kelas III membuahkan hasil yang membanggakan.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&q=80',
                'published_at' => '2025-10-15 11:00:00',
            ],

            // ─── Yayasan ─────────────────────────────────────────────────────
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Kelembagaan',
                'featured'     => true,
                'title'        => 'Yayasan Putra Pakuan Raih Akreditasi A dari BAN-S/M',
                'excerpt'      => 'Yayasan Putra Pakuan meraih Akreditasi A atas tata kelola lembaga pendidikan yang bermutu, transparan, dan akuntabel.',
                'content'      => '<p>Setelah melalui proses asesmen menyeluruh oleh asesor BAN-S/M, Yayasan Putra Pakuan secara resmi memperoleh <strong>Akreditasi A</strong>. Penilaian mencakup tata kelola organisasi, mutu layanan pendidikan, pengembangan SDM, serta keberlanjutan program pembinaan peserta didik.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80',
                'published_at' => '2026-02-20 10:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Penghargaan',
                'featured'     => true,
                'title'        => 'Penghargaan Lembaga Pendidikan Islam Terbaik Tingkat Jawa Barat',
                'excerpt'      => 'Yayasan Putra Pakuan menerima penghargaan lembaga pendidikan Islam terbaik dari Kanwil Kementerian Agama Provinsi Jawa Barat.',
                'content'      => '<p>Penghargaan ini diberikan atas konsistensi yayasan dalam membangun ekosistem pendidikan terintegrasi dari SDIT, SMP, hingga SMK dengan penguatan karakter, prestasi, dan inovasi pembelajaran.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80',
                'published_at' => '2026-03-15 09:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Pengembangan SDM',
                'featured'     => false,
                'title'        => 'Program Penguatan Kompetensi Guru Lintas Unit Resmi Dituntaskan',
                'excerpt'      => 'Program penguatan kompetensi guru lintas unit Yayasan Putra Pakuan selesai dilaksanakan dan diikuti tenaga pendidik dari SMK, SMP, dan SDIT.',
                'content'      => '<p>Program ini mencakup pelatihan pedagogi diferensiasi, penguatan literasi digital, dan asesmen berbasis kompetensi. Hasil evaluasi menunjukkan peningkatan konsistensi kualitas pembelajaran antarunit.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&q=80',
                'published_at' => '2026-01-10 09:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Sosial',
                'featured'     => false,
                'title'        => 'Program Beasiswa Yayasan Menjangkau 45 Siswa Berprestasi',
                'excerpt'      => 'Sebanyak 45 siswa berprestasi dari keluarga kurang mampu menerima beasiswa pendidikan penuh dari Yayasan Putra Pakuan.',
                'content'      => '<p>Program beasiswa mencakup pembebasan biaya pendidikan, dukungan perlengkapan belajar, dan pendampingan akademik. Inisiatif ini menjadi bagian dari komitmen yayasan terhadap pendidikan inklusif dan berkeadilan.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&q=80',
                'published_at' => '2026-03-01 08:00:00',
            ],
        ];

        foreach ($items as $data) {
            $data['slug']   = Str::slug($data['title']) . '-' . substr(md5($data['title']), 0, 6);
            $data['status'] = 'published';
            Prestasi::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
