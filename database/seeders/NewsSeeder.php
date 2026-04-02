<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
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
                'category'     => 'Prestasi',
                'featured'     => true,
                'title'        => 'SMK Putra Pakuan Raih Juara 1 LKS Tingkat Provinsi Jawa Barat',
                'excerpt'      => 'Tim siswa SMK Putra Pakuan berhasil meraih juara pertama dalam Lomba Kompetensi Siswa (LKS) bidang IT Network Systems Administration tingkat Provinsi Jawa Barat yang diselenggarakan di Bandung.',
                'content'      => '<p>Bogor – Tim siswa SMK Putra Pakuan kembali mengharumkan nama sekolah di kancah kompetisi pendidikan. Pada ajang <strong>Lomba Kompetensi Siswa (LKS) Tingkat Provinsi Jawa Barat</strong> yang digelar di SMK Negeri 1 Bandung, Rabu–Jumat (18–20 Maret 2026), kontingen SMK Putra Pakuan berhasil merebut posisi teratas dalam bidang <em>IT Network Systems Administration</em>.</p><p>Diwakili oleh tiga siswa terbaik kelas XII TKJ — Rafi Ardian, Dina Aulia, dan M. Fadhil — tim ini unggul atas 32 sekolah lain dari seluruh wilayah Jawa Barat. Kompetisi tahun ini berfokus pada kemampuan konfigurasi jaringan berbasis cloud, keamanan siber tingkat dasar, dan troubleshooting infrastruktur enterprise.</p><blockquote>"Kami berlatih hampir setiap hari selama dua bulan di laboratorium TKJ. Guru pembimbing kami, Pak Hendra, selalu memberikan soal-soal yang lebih sulit dari standar LKS agar kami terbiasa," ujar Rafi Ardian, ketua tim.</blockquote><p>Kepala SMK Putra Pakuan, Bapak Drs. Ahmad Sujana, M.Pd., menyampaikan rasa bangganya. "Prestasi ini bukan hanya milik para siswa, tetapi juga buah dari kerja keras seluruh guru dan dukungan orang tua. Kami akan terus mendorong potensi siswa agar mampu bersaing di tingkat nasional," tuturnya saat menyambut kepulangan tim.</p><p>Dengan kemenangan ini, SMK Putra Pakuan berhak mewakili Jawa Barat dalam LKS Tingkat Nasional yang akan berlangsung di Surabaya pada bulan Mei mendatang. Sekolah telah menyiapkan program latihan intensif bagi ketiga siswa tersebut.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=900&q=80',
                'published_at' => '2026-03-21 08:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Kegiatan',
                'featured'     => true,
                'title'        => 'Kunjungan Industri Siswa TKRO ke PT. Astra Honda Motor Karawang',
                'excerpt'      => 'Sebanyak 120 siswa kelas XI jurusan Teknik Kendaraan Ringan Otomotif (TKRO) SMK Putra Pakuan mengikuti kunjungan industri ke fasilitas produksi PT. Astra Honda Motor di Karawang.',
                'content'      => '<p>Rabu, 11 Maret 2026 – Sebanyak 120 siswa kelas XI jurusan <strong>Teknik Kendaraan Ringan Otomotif (TKRO)</strong> SMK Putra Pakuan mengikuti kunjungan industri ke fasilitas produksi PT. Astra Honda Motor (AHM) di Karawang, Jawa Barat. Kegiatan berlangsung selama satu hari penuh dan menjadi pengalaman berharga bagi para siswa untuk melihat langsung proses manufaktur kendaraan bermotor skala industri.</p><p>Rombongan tiba pukul 08.30 WIB dan langsung disambut oleh tim HRD PT. AHM. Para siswa mendapat kesempatan mengikuti tur pabrik, melihat lini produksi body stamping, welding, painting, hingga assembling sepeda motor. Teknologi robotik dan automasi yang digunakan di pabrik tersebut membuat banyak siswa terkesima.</p><p>"Sungguh menakjubkan. Teori yang kami pelajari di kelas kini kami lihat langsung dalam skala besar. Robot las yang bekerja otomatis sangat berbeda dari yang kami bayangkan," kata Hendra Saputra, siswakelas XI TKRO 2.</p><p>Agenda dilanjutkan dengan sesi tanya-jawab dengan teknisi senior AHM, serta pemaparan peluang program magang dan rekrutmen lulusan SMK. Pihak AHM menyampaikan bahwa mereka membuka jalur rekrutmen langsung untuk lulusan SMK dengan kompetensi teknik otomotif yang terstandar.</p><p>Kepala Kompetensi Keahlian TKRO, Bapak Sugeng Prayitno, S.T., berharap kunjungan ini memotivasi siswa untuk belajar lebih sungguh-sungguh. "Link and match antara dunia industri dan sekolah adalah kunci agar lulusan SMK kita langsung terserap di dunia kerja," ujarnya.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=900&q=80',
                'published_at' => '2026-03-12 07:30:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Pengumuman',
                'featured'     => false,
                'title'        => 'Jadwal Ujian Akhir Semester Genap Tahun Ajaran 2025/2026',
                'excerpt'      => 'SMK Putra Pakuan mengumumkan jadwal Ujian Akhir Semester (UAS) Genap Tahun Ajaran 2025/2026. Ujian akan dilaksanakan mulai tanggal 4 hingga 14 Juni 2026.',
                'content'      => '<p>Diberitahukan kepada seluruh siswa SMK Putra Pakuan Tahun Ajaran 2025/2026 bahwa <strong>Ujian Akhir Semester (UAS) Genap</strong> akan dilaksanakan dengan ketentuan sebagai berikut:</p><h3>Jadwal Pelaksanaan</h3><ul><li>Kelas X: 4 – 10 Juni 2026</li><li>Kelas XI: 4 – 10 Juni 2026</li><li>Kelas XII: Ujian Kompetensi Keahlian dilaksanakan 20 – 25 April 2026</li></ul><h3>Ketentuan Peserta</h3><ol><li>Siswa hadir 15 menit sebelum ujian dimulai.</li><li>Membawa kartu ujian yang telah distempel oleh wali kelas.</li><li>Berpakaian seragam lengkap sesuai hari yang ditentukan.</li><li>Tidak diperkenankan membawa perangkat elektronik ke ruang ujian.</li></ol><h3>Materi Ujian</h3><p>Materi ujian meliputi seluruh kompetensi dasar yang telah diajarkan pada semester genap. Kisi-kisi soal dapat diunduh melalui portal siswa atau meminta langsung ke masing-masing guru mata pelajaran.</p><p>Informasi lebih lanjut dapat menghubungi bagian Tata Usaha SMK Putra Pakuan.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=900&q=80',
                'published_at' => '2026-03-25 09:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Kegiatan',
                'featured'     => false,
                'title'        => 'Workshop Keamanan Siber bersama BSSN untuk Siswa TKJ',
                'excerpt'      => 'Badan Siber dan Sandi Negara (BSSN) mengadakan workshop keamanan siber khusus untuk siswa jurusan Teknik Jaringan Komputer dan Telekomunikasi (TKJ) SMK Putra Pakuan.',
                'content'      => '<p>Bogor, 5 Maret 2026 – SMK Putra Pakuan kembali mendapat kehormatan menjadi tuan rumah kegiatan bertajuk <strong>"Generasi Muda Tangguh Siber"</strong> yang diselenggarakan oleh <em>Badan Siber dan Sandi Negara (BSSN)</em>. Workshop sehari penuh ini dikhususkan bagi 80 siswa pilihan jurusan TKJ kelas X, XI, dan XII.</p><p>Dipandu oleh dua praktisi dari Direktorat Keamanan Siber BSSN, peserta diajak memahami ancaman siber terkini seperti phishing, ransomware, dan serangan DDoS. Sesi praktik dilakukan menggunakan platform latihan virtual yang disediakan BSSN sehingga siswa dapat mengalami simulasi serangan secara langsung.</p><p>"Kegiatan seperti ini sangat relevan mengingat kebutuhan tenaga ahli keamanan siber di Indonesia terus meningkat. Kami ingin siswa SMK menjadi garda terdepan," ujar Rizky Firmansyah, pemateri dari BSSN.</p><p>Setelah workshop, tiga siswa terbaik mendapat sertifikat penghargaan dan akses gratis kursus daring keamanan siber senilai Rp 2 juta dari BSSN. Kepala Sekolah menyatakan akan mendorong pelaksanaan kegiatan serupa secara rutin setiap semester.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=900&q=80',
                'published_at' => '2026-03-06 10:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Prestasi',
                'featured'     => false,
                'title'        => 'Tiga Siswa SMK Putra Pakuan Lolos Program Magang di Perusahaan Multinasional',
                'excerpt'      => 'Keberhasilan siswa SMK Putra Pakuan berlanjut dengan terpilihnya tiga siswa kelas XII dalam program magang bergengsi di PT. Samsung Electronics Indonesia dan PT. Schneider Electric.',
                'content'      => '<p>Tiga siswa kelas XII SMK Putra Pakuan berhasil lolos seleksi ketat program magang industri di dua perusahaan multinasional ternama: <strong>PT. Samsung Electronics Indonesia</strong> dan <strong>PT. Schneider Electric Manufacturing Batam</strong>. Proses seleksi berlangsung mulai Januari hingga pertengahan Februari 2026, dengan tahapan ujian tertulis, tes kompetensi teknis, dan wawancara panel.</p><p>Mereka adalah Naufal Hakim (TKJ) yang diterima di Samsung, serta Laila Fitriani dan Ade Kurniawan (keduanya dari TKRO) yang ditempatkan di Schneider Electric. Ketiga siswa akan menjalani magang selama enam bulan mulai April 2026.</p><p>"Program magang ini bukan sekadar pengalaman kerja. Kami akan langsung terlibat dalam proyek nyata dan mendapat bimbingan dari engineer senior," kata Naufal dengan penuh semangat.</p><p>SMK Putra Pakuan aktif menjalin kemitraan dengan lebih dari 25 perusahaan nasional dan multinasional untuk menjamin penyerapan lulusan. Data internal sekolah menunjukkan 87% lulusan tahun 2025 terserap di dunia kerja atau melanjutkan pendidikan dalam enam bulan setelah kelulusan.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=900&q=80',
                'published_at' => '2026-02-28 08:00:00',
            ],
            [
                'school_id'    => $smk->id,
                'category'     => 'Kegiatan',
                'featured'     => false,
                'title'        => 'Peringatan Hari Pendidikan Nasional 2026 SMK Putra Pakuan',
                'excerpt'      => 'SMK Putra Pakuan menyelenggarakan upacara dan serangkaian kegiatan apresiasi pendidikan dalam rangka memperingati Hari Pendidikan Nasional (Hardiknas) 2 Mei 2026.',
                'content'      => '<p>Dalam semangat memperingati <strong>Hari Pendidikan Nasional (Hardiknas) 2026</strong>, SMK Putra Pakuan menyelenggarakan serangkaian kegiatan yang meriah dan penuh makna. Tema nasional tahun ini, <em>"Pendidikan Bermutu, Indonesia Maju"</em>, menjadi roh seluruh rangkaian acara yang berlangsung pada Jumat, 2 Mei 2026.</p><p>Pagi hari dimulai dengan upacara bendera khidmat di lapangan utama sekolah, dipimpin oleh Kepala Sekolah dan diikuti oleh seluruh warga sekolah. Dalam amanat upacara, Bapak Kepala Sekolah menekankan pentingnya semangat belajar sepanjang hayat dan relevansi pendidikan vokasi dalam era industri 4.0.</p><p>Setelah upacara, kegiatan dilanjutkan dengan pameran karya siswa di aula sekolah. Berbagai proyek inovatif dipamerkan, mulai dari prototipe kendaraan listrik mini karya siswa TKRO, sistem smart home berbasis IoT dari siswa TKJ, hingga desain grafis dan media promosi dari siswa jurusan Multimedia.</p><p>Hari ditutup dengan pertunjukan seni budaya yang menampilkan tari tradisional, musikalisasi puisi, dan penghargaan bagi siswa dan guru berprestasi tahun ajaran 2025/2026.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=900&q=80',
                'published_at' => '2026-05-02 14:00:00',
            ],

            // ─── SMP ────────────────────────────────────────────────────────
            [
                'school_id'    => $smp->id,
                'category'     => 'Prestasi',
                'featured'     => true,
                'title'        => 'Siswa SMP Putra Pakuan Raih Medali Olimpiade Matematika Tingkat Kabupaten Bogor',
                'excerpt'      => 'Kebanggaan kembali hadir dari SMP Putra Pakuan. Tiga siswa kelas VIII berhasil meraih medali emas, perak, dan perunggu dalam Olimpiade Matematika tingkat Kabupaten Bogor.',
                'content'      => '<p>Keberhasilan gemilang kembali ditorehkan SMP Putra Pakuan. Dalam ajang <strong>Olimpiade Matematika Kabupaten Bogor 2026</strong> yang berlangsung di SMP Negeri 1 Cibinong, tiga perwakilan sekolah berhasil meraih tiga medali sekaligus — emas, perak, dan perunggu — sebuah pencapaian yang belum pernah diraih sekolah ini sebelumnya.</p><p>Ketiga peraih medali adalah Azzam Fawwaz (Kelas VIII-A) meraih emas, Nabila Rizky (Kelas VIII-C) meraih perak, dan Daffa Ramadhan (Kelas VII-B) yang masih duduk di kelas VII berhasil meraih perunggu di antara peserta kelas VIII.</p><p>"Saya tidak menyangka bisa juara 1. Yang paling membantu adalah latihan soal olimpiade setiap Sabtu pagi bersama Pak Irfan. Beliau selalu sabar dan penuh semangat," ujar Azzam dengan wajah sumringah.</p><p>Guru pembimbing, Bapak Irfan Maulana, S.Pd., menyatakan bahwa program olimpiade sekolah telah berjalan secara terstruktur sejak dua tahun lalu. "Kami memilih siswa potensial sejak kelas VII, kemudian membina mereka secara konsisten. Hasilnya bisa dilihat sekarang," jelasnya.</p><p>Dengan perolehan ini, Azzam Fawwaz berhak mewakili Kabupaten Bogor dalam Olimpiade Matematika Tingkat Provinsi Jawa Barat pada bulan September 2026.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=900&q=80',
                'published_at' => '2026-03-18 09:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Kegiatan',
                'featured'     => true,
                'title'        => 'Gebyar Seni dan Olahraga SMP Putra Pakuan 2026',
                'excerpt'      => 'SMP Putra Pakuan sukses menyelenggarakan Gebyar Seni dan Olahraga (GSO) 2026, sebuah festival tahunan yang menjadi ajang unjuk bakat dan semangat sportivitas seluruh warga sekolah.',
                'content'      => '<p>Sabtu, 15 Maret 2026 – Lapangan dan aula SMP Putra Pakuan dipenuhi keceriaan. Festival tahunan <strong>Gebyar Seni dan Olahraga (GSO) 2026</strong> resmi dibuka oleh Kepala Sekolah, Ibu Dra. Sri Mulyani, M.Pd., disaksikan oleh ratusan siswa, guru, dan orang tua yang hadir untuk memberikan dukungan.</p><p>GSO tahun ini mengusung tema <em>"Satu Jiwa, Satu Karya: Bersatu dalam Bakat"</em> dan berlangsung selama dua hari penuh. Di hari pertama, berbagai cabang olahraga dipertandingkan meliputi futsal antarkelas, bulu tangkis, tenis meja, dan lari estafet. Pertandingan berlangsung seru dan penuh semangat dengan sorak-sorai dari para pendukung.</p><p>Hari kedua menjadi puncak festival seni. Penampilan tari kreasi, paduan suara, pertunjukan drama musikal, dan pameran karya lukis siswa memenuhi panggung dan aula. Penampilan andalan tahun ini adalah drama musikal bertema perjuangan yang dimainkan siswa kelas IX yang menuai standing ovation.</p><p>Juara umum GSO 2026 diraih oleh Kelas IX-B yang berhasil mengumpulkan poin tertinggi dari gabungan olahraga dan seni. Hadiah berupa piala tetap dan uang pembinaan diserahkan langsung oleh Ketua Komite Sekolah.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=900&q=80',
                'published_at' => '2026-03-17 08:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Pengumuman',
                'featured'     => false,
                'title'        => 'Informasi PPDB Online SMP Putra Pakuan Tahun Ajaran 2026/2027',
                'excerpt'      => 'SMP Putra Pakuan membuka Penerimaan Peserta Didik Baru (PPDB) secara online untuk Tahun Ajaran 2026/2027. Pendaftaran dibuka 1 April hingga 30 Juni 2026.',
                'content'      => '<p>Selamat datang kepada calon peserta didik baru SMP Putra Pakuan! Kami dengan bangga mengumumkan pembukaan <strong>Penerimaan Peserta Didik Baru (PPDB) Online Tahun Ajaran 2026/2027</strong>.</p><h3>Jadwal PPDB</h3><table><thead><tr><th>Kegiatan</th><th>Tanggal</th></tr></thead><tbody><tr><td>Pendaftaran Online</td><td>1 April – 30 Juni 2026</td></tr><tr><td>Seleksi Berkas</td><td>1 – 5 Juli 2026</td></tr><tr><td>Pengumuman Hasil</td><td>8 Juli 2026</td></tr><tr><td>Daftar Ulang</td><td>9 – 14 Juli 2026</td></tr><tr><td>Masa Orientasi Siswa</td><td>15 – 17 Juli 2026</td></tr></tbody></table><h3>Persyaratan Pendaftaran</h3><ul><li>Fotokopi Ijazah / Surat Keterangan Lulus SD/Sederajat</li><li>Fotokopi Kartu Keluarga (KK)</li><li>Pas foto terbaru 3x4 (2 lembar)</li><li>Fotokopi Akta Kelahiran</li><li>NISN yang valid</li></ul><h3>Biaya Pendaftaran</h3><p>Biaya formulir pendaftaran sebesar <strong>Rp 150.000</strong> dapat dibayarkan melalui transfer bank atau langsung ke kantor TU sekolah.</p><p>Informasi lengkap dan link pendaftaran tersedia di halaman PPDB website ini. Untuk bantuan, hubungi kami di (0251) 555-0123.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=900&q=80',
                'published_at' => '2026-04-01 07:00:00',
            ],
            [
                'school_id'    => $smp->id,
                'category'     => 'Kegiatan',
                'featured'     => false,
                'title'        => 'Kegiatan Pramuka SMP Putra Pakuan: Perkemahan Sabtu-Minggu di Gunung Salak Endah',
                'excerpt'      => 'Gugus depan Pramuka SMP Putra Pakuan mengadakan Persami (Perkemahan Sabtu-Minggu) di Bumi Perkemahan Gunung Salak Endah. Lebih dari 200 siswa ambalan ikut serta.',
                'content'      => '<p>Sekitar 220 anggota Pramuka SMP Putra Pakuan mengikuti kegiatan <strong>Persami (Perkemahan Sabtu-Minggu)</strong> yang berlangsung pada 22–23 Maret 2026 di Bumi Perkemahan Gunung Salak Endah, Bogor. Kegiatan ini merupakan bagian dari program tahunan gugus depan dalam rangka pembinaan karakter dan jiwa kepemimpinan siswa.</p><p>Beragam kegiatan mengisi dua hari perkemahan tersebut. Di antaranya adalah penjelajahan lintas alam dengan jarak tempuh 8 km, latihan pioneering (membangun jembatan bambu), scouting skill, hingga malam api unggun yang diselingi penampilan seni dari tiap regu.</p><p>Ketua Pembina Pramuka, Kakak Rian Permana, S.Pd., menjelaskan bahwa Persami bukan sekadar rekreasi. "Kami menanamkan nilai disiplin, kerja sama, dan kemandirian. Anak-anak belajar mendirikan tenda sendiri, memasak, dan bertanggung jawab atas kerapihan kemah mereka," jelasnya.</p><p>Puncak acara adalah pembaretan bagi 45 anggota baru yang telah menyelesaikan serangkaian ujian kecakapan. Mereka resmi menjadi anggota penuh gugus depan SMP Putra Pakuan dan menerima tanda kecakapan dari Kakak Pembina.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=900&q=80',
                'published_at' => '2026-03-24 11:00:00',
            ],

            // ─── SDIT ───────────────────────────────────────────────────────
            [
                'school_id'    => $sdit->id,
                'category'     => 'Prestasi',
                'featured'     => true,
                'title'        => 'Siswa SDIT Putra Pakuan Juara Harapan 1 Olimpiade Sains Nasional Tingkat Kabupaten',
                'excerpt'      => 'Kebanggaan bertambah di SDIT Putra Pakuan. Salah satu siswa kelas V berhasil meraih Juara Harapan 1 dalam Olimpiade Sains Nasional (OSN) bidang IPA tingkat Kabupaten Bogor.',
                'content'      => '<p>Tidak hanya siswa SMP dan SMK, siswa SDIT Putra Pakuan pun tak kalah bersinar. <strong>Alya Nuraini</strong>, siswi kelas V-A yang baru berusia 11 tahun, berhasil meraih <em>Juara Harapan 1</em> dalam Olimpiade Sains Nasional tingkat Kabupaten Bogor, bidang Ilmu Pengetahuan Alam.</p><p>Kompetisi yang diikuti oleh ratusan siswa SD se-Kabupaten Bogor ini menguji pemahaman sains yang jauh melampaui kurikulum standar. Alya mengaku mempersiapkan diri sejak kelas IV dengan membaca buku-buku ensiklopedia sains dan berlatih soal olimpiade bersama guru pendampingnya, Ibu Neni Kurniasih, S.Pd.</p><p>"Alya memang memiliki rasa ingin tahu yang sangat tinggi. Setiap kali ada pertanyaan di luar materi buku, beliau langsung mencari tahu sendiri," cerita Ibu Neni bangga.</p><p>Orang tua Alya turut hadir dalam penyerahan piagam dan piala di aula sekolah. Kepala SDIT Putra Pakuan, Ibu Hj. Fatimah Azzahra, S.Ag., M.Pd., memberikan apresiasi dan bingkisan kepada Alya sebagai bentuk penghargaan atas dedikasinya.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=900&q=80',
                'published_at' => '2026-03-10 09:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Kegiatan',
                'featured'     => true,
                'title'        => 'Wisuda dan Haflah Al-Quran SDIT Putra Pakuan 2026',
                'excerpt'      => 'SDIT Putra Pakuan menyelenggarakan Wisuda Kelas VI dan Haflah Al-Quran yang mengharukan di Gedung Serbaguna. 52 siswa melepas masa SD dengan capaian hafalan Al-Quran yang membanggakan.',
                'content'      => '<p>Suasana haru dan bahagia menyelimuti Gedung Serbaguna Putra Pakuan pada Sabtu, 14 Juni 2026. Acara <strong>Wisuda Kelas VI dan Haflah Tahfizh Al-Quran SDIT Putra Pakuan 2026</strong> dihadiri oleh ratusan orang tua wali, guru, dan tamu undangan. Sebanyak 52 siswa kelas VI secara resmi menutup babak belajar mereka di tingkat sekolah dasar.</p><p>Yang paling membanggakan, seluruh wisudawan tahun ini telah menyelesaikan hafalan minimal 3 juz Al-Quran, sementara 8 anak di antaranya berhasil menghafal 10 juz. Pencapaian ini menjadi bukti nyata program Tahfizh Intensif yang telah diterapkan sejak kelas I.</p><p>Momen puncak acara adalah prosesi peletakan toga wisuda oleh orang tua kepada putra-putri mereka, diiringi lantunan doa dan sholawat. Banyak orang tua tak kuasa menahan haru saat menyaksikan anak mereka membacakan ayat-ayat Al-Quran dengan fasih di atas panggung.</p><p>Kepala SDIT Putra Pakuan berpesan kepada para wisudawan untuk terus menjaga hafalan dan mengamalkan nilai-nilai Islam dalam kehidupan. "Kalian adalah generasi Qurani yang akan membangun bangsa. Hafizh bukan sekadar jumlah juz, tapi tentang akhlak dan karakter yang kalian bawa sepanjang hidup," tuturnya.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=900&q=80',
                'published_at' => '2026-06-15 10:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Kegiatan',
                'featured'     => false,
                'title'        => 'Kegiatan Market Day SDIT Putra Pakuan: Belajar Kewirausahaan Sejak Dini',
                'excerpt'      => 'SDIT Putra Pakuan kembali menggelar Market Day untuk mengenalkan kewirausahaan kepada siswa. Kali ini diikuti oleh 38 kelompok usaha dari kelas III hingga VI.',
                'content'      => '<p>Halaman SDIT Putra Pakuan berubah menjadi pasar mini yang ceria dan ramai pada hari Jumat, 7 Maret 2026. Kegiatan <strong>Market Day</strong> yang sudah menjadi tradisi tahunan sekolah kembali digelar, kali ini melibatkan 38 kelompok usaha yang dikelola oleh siswa kelas III hingga VI.</p><p>Setiap kelompok beranggotakan 5–7 siswa dan wajib menjual produk hasil kreativitas mereka sendiri. Produk yang dipasarkan sangat beragam — mulai dari kue tradisional, minuman segar, kerajinan tangan daur ulang, lukisan kartu ucapan, hingga aksesoris dari bahan alam. Seluruh produk dibuat sendiri oleh siswa dengan bimbingan guru dan orang tua.</p><p>"Anak-anak belajar menghitung modal, menentukan harga jual, melayani pembeli, dan mengelola uang kembalian. Ini semua kecakapan hidup yang sangat penting," jelas Ibu Dewi Lestari, koordinator kegiatan.</p><p>Antusias pembeli pun mengalir deras. Orang tua, guru, bahkan warga sekitar turut berbelanja. Stand yang paling ramai dikunjungi adalah kelompok yang menjual es krim gerobak buatan sendiri dan stand yang menawarkan tato henna.</p><p>Keuntungan penjualan sepenuhnya menjadi hak kelompok dan dialokasikan untuk berbagai keperluan, termasuk donasi sosial kelas masing-masing.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=900&q=80',
                'published_at' => '2026-03-08 13:00:00',
            ],
            [
                'school_id'    => $sdit->id,
                'category'     => 'Pengumuman',
                'featured'     => false,
                'title'        => 'PPDB SDIT Putra Pakuan 2026/2027 Resmi Dibuka',
                'excerpt'      => 'SDIT Putra Pakuan dengan bangga mengumumkan pembukaan PPDB Online untuk Tahun Ajaran 2026/2027. Kuota sangat terbatas, daftarkan putra-putri Anda sekarang.',
                'content'      => '<p>Assalamu\'alaikum warahmatullahi wabarakatuh,</p><p>Kepada Yth. Bapak/Ibu Wali Murid yang terhormat, dengan penuh kegembiraan kami mengumumkan bahwa <strong>Penerimaan Peserta Didik Baru (PPDB) SDIT Putra Pakuan Tahun Ajaran 2026/2027</strong> telah resmi dibuka.</p><h3>Mengapa Memilih SDIT Putra Pakuan?</h3><ul><li>Program Tahfizh Al-Quran terintegrasi sejak kelas I</li><li>Kurikulum Merdeka dengan pendekatan Islami</li><li>Lingkungan belajar kondusif dan berkarakter</li><li>Tenaga pendidik berpengalaman dan bersertifikat</li><li>Fasilitas lengkap: laboratorium sains, perpustakaan digital, lapangan olahraga</li></ul><h3>Informasi Penerimaan</h3><ul><li>Kuota kelas 1: 3 rombongan belajar (@28 siswa)</li><li>Usia masuk: minimal 6 tahun per 1 Juli 2026</li><li>Pendaftaran online: 1 April – 31 Mei 2026</li></ul><p>Daftarkan segera karena kuota terbatas! Kunjungi halaman PPDB di website ini atau hubungi sekretariat sekolah.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=900&q=80',
                'published_at' => '2026-04-01 06:00:00',
            ],

            // ─── Yayasan ─────────────────────────────────────────────────────
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Kegiatan',
                'featured'     => true,
                'title'        => 'Rapat Kerja Tahunan Yayasan Putra Pakuan 2026 Digelar',
                'excerpt'      => 'Yayasan Putra Pakuan menyelenggarakan rapat kerja tahunan untuk menyusun prioritas program strategis lintas unit sekolah.',
                'content'      => '<p>Rapat Kerja Tahunan 2026 dihadiri oleh pengurus yayasan, kepala sekolah unit, dan perwakilan komite. Agenda utama adalah sinkronisasi target mutu, penguatan layanan pendidikan, serta strategi pengembangan sarana dan SDM.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=900&q=80',
                'published_at' => '2026-02-09 08:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Pengumuman',
                'featured'     => true,
                'title'        => 'PPDB Terpadu Yayasan Putra Pakuan Tahun Ajaran 2026/2027 Dibuka',
                'excerpt'      => 'PPDB terpadu untuk unit SMK, SMP, dan SDIT Putra Pakuan resmi dibuka dengan informasi jadwal dan kuota masing-masing unit.',
                'content'      => '<p>Yayasan Putra Pakuan membuka PPDB terpadu untuk tiga unit sekolah. Masyarakat dapat mengakses informasi jalur pendaftaran, persyaratan, dan tahapan seleksi melalui kanal resmi sekolah masing-masing.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=900&q=80',
                'published_at' => '2026-04-01 06:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Kegiatan',
                'featured'     => false,
                'title'        => 'Milad ke-25 Yayasan Putra Pakuan Dirayakan Bersama Alumni dan Warga Sekolah',
                'excerpt'      => 'Perayaan milad ke-25 berlangsung dengan rangkaian doa bersama, bakti sosial, dan peluncuran program wakaf pendidikan.',
                'content'      => '<p>Milad ke-25 menjadi momentum refleksi perjalanan yayasan dalam mengabdi pada dunia pendidikan. Rangkaian kegiatan menekankan nilai syukur, kepedulian sosial, dan penguatan kolaborasi dengan alumni.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=900&q=80',
                'published_at' => '2026-03-18 07:00:00',
            ],
            [
                'school_id'    => $yayasan->id,
                'category'     => 'Sosial',
                'featured'     => false,
                'title'        => 'Yayasan Putra Pakuan Salurkan Bantuan Pendidikan untuk Korban Bencana',
                'excerpt'      => 'Yayasan menyalurkan bantuan perlengkapan sekolah untuk anak-anak terdampak bencana sebagai bagian dari program Putra Pakuan Peduli.',
                'content'      => '<p>Bantuan berupa perlengkapan belajar, buku, dan seragam disalurkan melalui relawan lintas unit. Program ini memperkuat nilai gotong royong serta kepedulian sosial warga sekolah.</p>',
                'image_url'    => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=900&q=80',
                'published_at' => '2026-02-23 09:00:00',
            ],
        ];

        foreach ($items as $data) {
            $data['slug']   = Str::slug($data['title']) . '-' . substr(md5($data['title']), 0, 6);
            $data['status'] = 'published';
            News::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
