<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SmkJurusan;
use Illuminate\Database\Seeder;

class SmkJurusanSeeder extends Seeder
{
    /** Slugs that are valid; anything else gets deleted. */
    private const VALID_SLUGS = [
        'teknik-komputer-jaringan',
        'akuntansi-dan-keuangan-lembaga',
        'manajemen-perkantoran-dan-layanan-bisnis',
        'desain-komunikasi-visual',
        'teknik-kendaraan-ringan',
        'teknik-sepeda-motor',
    ];

    public function run(): void
    {
        $school = School::where('type', 'SMK')->first();

        if (! $school) {
            $this->command->warn('SMK school not found. Run DatabaseSeeder first.');
            return;
        }

        // Remove stale jurusan not in the real list
        SmkJurusan::where('school_id', $school->id)
            ->whereNotIn('slug', self::VALID_SLUGS)
            ->delete();

        $jurusans = [
            [
                'name'         => 'Teknik Komputer Jaringan',
                'short_name'   => 'TKJ',
                'slug'         => 'teknik-komputer-jaringan',
                'tagline'      => 'Cetak Teknisi Jaringan & Keamanan Siber Masa Depan',
                'description'  => 'Program keahlian yang membekali siswa dengan kemampuan instalasi, konfigurasi, dan pemeliharaan jaringan komputer serta keamanan informasi berbasis industri.',
                'content'      => $this->contentTkj(),
                'icon'         => 'router',
                'accent_color' => '#3b82f6',
                'order_column' => 1,
                'is_active'    => true,
            ],
            [
                'name'         => 'Akuntansi dan Keuangan Lembaga',
                'short_name'   => 'AKL',
                'slug'         => 'akuntansi-dan-keuangan-lembaga',
                'tagline'      => 'Ahli Keuangan & Akuntansi Siap Industri',
                'description'  => 'Program keahlian yang mencetak tenaga ahli akuntansi dan keuangan yang kompeten, mampu mengelola pembukuan, laporan keuangan, dan perpajakan sesuai standar PSAK terkini.',
                'content'      => $this->contentAkl(),
                'icon'         => 'account_balance',
                'accent_color' => '#8b5cf6',
                'order_column' => 2,
                'is_active'    => true,
            ],
            [
                'name'         => 'Manajemen Perkantoran dan Layanan Bisnis',
                'short_name'   => 'MPLB',
                'slug'         => 'manajemen-perkantoran-dan-layanan-bisnis',
                'tagline'      => 'Profesional Administrasi & Layanan Bisnis Modern',
                'description'  => 'Program keahlian yang mendidik calon tenaga administrasi profesional dengan kemampuan manajemen perkantoran, layanan bisnis, korespondensi, dan customer service berstandar tinggi.',
                'content'      => $this->contentMplb(),
                'icon'         => 'business_center',
                'accent_color' => '#ef4444',
                'order_column' => 3,
                'is_active'    => true,
            ],
            [
                'name'         => 'Desain Komunikasi Visual',
                'short_name'   => 'DKV',
                'slug'         => 'desain-komunikasi-visual',
                'tagline'      => 'SMK Pusat Keunggulan Nasional — Kreasi Visual Berkelas Dunia',
                'description'  => 'Program unggulan berstatus SMK Pusat Keunggulan Nasional yang membekali siswa dengan keahlian desain grafis, ilustrasi digital, branding, dan produksi media kreatif profesional.',
                'content'      => $this->contentDkv(),
                'icon'         => 'palette',
                'accent_color' => '#f59e0b',
                'order_column' => 4,
                'is_active'    => true,
            ],
            [
                'name'         => 'Teknik Kendaraan Ringan',
                'short_name'   => 'TKR',
                'slug'         => 'teknik-kendaraan-ringan',
                'tagline'      => 'Teknisi Otomotif Handal Siap Industri',
                'description'  => 'Program keahlian yang mempersiapkan siswa menjadi teknisi kendaraan ringan profesional yang kompeten dalam perawatan, perbaikan, dan diagnosa kendaraan berbahan bakar maupun kendaraan listrik.',
                'content'      => $this->contentTkr(),
                'icon'         => 'directions_car',
                'accent_color' => '#10b981',
                'order_column' => 5,
                'is_active'    => true,
            ],
            [
                'name'         => 'Teknik Sepeda Motor',
                'short_name'   => 'TSM',
                'slug'         => 'teknik-sepeda-motor',
                'tagline'      => 'Ahli Mekanik Sepeda Motor Berstandar Bengkel Resmi',
                'description'  => 'Program keahlian yang mencetak mekanik sepeda motor profesional dengan kompetensi perawatan, perbaikan, dan servis kendaraan roda dua berbahan bakar konvensional maupun berbasis listrik.',
                'content'      => $this->contentTsm(),
                'icon'         => 'two_wheeler',
                'accent_color' => '#64748b',
                'order_column' => 6,
                'is_active'    => true,
            ],
        ];

        foreach ($jurusans as $data) {
            SmkJurusan::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['school_id' => $school->id])
            );
        }

        $this->command->info('SMK Jurusan seeded successfully (' . count($jurusans) . ' program keahlian).');
    }

    private function contentTkj(): string
    {
        return <<<HTML
<h2>Tentang Program TKJ</h2>
<p>Teknik Komputer Jaringan (TKJ) adalah program keahlian unggulan SMK Putra Pakuan yang mempersiapkan siswa menjadi teknisi handal di bidang infrastruktur teknologi informasi. Program ini dirancang sesuai kebutuhan industri teknologi modern dan didukung fasilitas laboratorium jaringan berstandar Cisco.</p>

<h2>Kompetensi yang Dipelajari</h2>
<ul>
<li>Instalasi dan konfigurasi jaringan komputer LAN, WAN, dan WLAN</li>
<li>Administrasi server Linux dan Windows Server</li>
<li>Konfigurasi router dan switch Cisco (CCNA ready)</li>
<li>Keamanan siber dan pengelolaan firewall</li>
<li>Pemrograman jaringan dasar (Python, Bash scripting)</li>
<li>Cloud computing dan virtualisasi (VMware, VirtualBox)</li>
<li>Troubleshooting jaringan dan sistem operasi</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li><strong>Network Engineer</strong> di perusahaan telekomunikasi dan ISP</li>
<li><strong>System Administrator</strong> di berbagai instansi pemerintah dan swasta</li>
<li><strong>IT Support Specialist</strong> di perusahaan multinasional</li>
<li><strong>Cybersecurity Analyst</strong> di lembaga keuangan dan teknologi</li>
<li>Wirausaha mandiri di bidang jasa instalasi dan pemeliharaan jaringan</li>
</ul>

<h2>Fasilitas Laboratorium</h2>
<ul>
<li>Laboratorium Jaringan dengan perangkat Cisco Catalyst asli</li>
<li>Server rack aktif untuk praktik administrasi server nyata</li>
<li>Simulator jaringan Packet Tracer berlisensi resmi Cisco</li>
<li>Koneksi internet fiber optik dedicated 100 Mbps</li>
</ul>

<blockquote>
"Kami tidak hanya mengajar teori, kami melatih siswa langsung pada infrastruktur jaringan nyata agar siap bekerja sejak hari pertama lulus."<br><strong>— Koordinator Program TKJ</strong>
</blockquote>
HTML;
    }

    private function contentAkl(): string
    {
        return <<<HTML
<h2>Tentang Program AKL</h2>
<p>Akuntansi dan Keuangan Lembaga (AKL) merupakan program keahlian yang mempersiapkan siswa menjadi tenaga profesional di bidang akuntansi, keuangan, dan perpajakan. Kurikulum program ini selaras dengan standar kompetensi BNSP dan kebutuhan nyata dunia usaha dan industri (DUDI).</p>

<h2>Mata Pelajaran Kejuruan Utama</h2>
<ul>
<li>Akuntansi dasar dan siklus akuntansi perusahaan jasa, dagang, dan manufaktur</li>
<li>Perpajakan: PPh, PPN, e-SPT, dan e-Faktur</li>
<li>Laporan keuangan berbasis SAK ETAP dan PSAK</li>
<li>Spreadsheet akuntansi: Microsoft Excel lanjutan</li>
<li>Software akuntansi: MYOB, Accurate, dan Zahir</li>
<li>Perbankan dasar dan manajemen kas</li>
<li>Audit internal dan pengendalian keuangan</li>
</ul>

<h2>Sertifikasi yang Dapat Diraih</h2>
<ul>
<li>Sertifikasi Kompetensi BNSP Akuntansi</li>
<li>Sertifikat Pajak Brevet A &amp; B (persiapan)</li>
<li>Sertifikat penguasaan MYOB/Accurate resmi</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li>Staf Akuntansi di perusahaan swasta dan BUMN</li>
<li>Junior Auditor di kantor akuntan publik</li>
<li>Staf Pajak dan Administrasi Keuangan</li>
<li>Teller dan Staf Operasional Perbankan</li>
<li>Wirausaha mandiri bidang jasa akuntansi dan konsultasi pajak UMKM</li>
</ul>

<blockquote>
"Kepercayaan klien dibangun dari kompetensi yang kuat. Kami mendidik generasi akuntan yang tidak hanya cakap secara teknis, tapi juga berintegritas tinggi."<br><strong>— Koordinator Program AKL</strong>
</blockquote>
HTML;
    }

    private function contentMplb(): string
    {
        return <<<HTML
<h2>Tentang Program MPLB</h2>
<p>Manajemen Perkantoran dan Layanan Bisnis (MPLB) adalah program keahlian yang mencetak tenaga profesional administrasi perkantoran modern dan layanan bisnis. Di era transformasi digital, lulusan MPLB dibekali kemampuan mengelola kantor secara efisien menggunakan teknologi terkini dan etika kerja profesional berstandar industri.</p>

<h2>Kompetensi Keahlian</h2>
<ul>
<li>Pengelolaan dokumen dan kearsipan digital (e-Document Management)</li>
<li>Korespondensi bisnis Bahasa Indonesia dan Inggris</li>
<li>Otomatisasi perkantoran: Microsoft Office 365, Google Workspace</li>
<li>Manajemen rapat, perjalanan dinas, dan protokoler</li>
<li>Layanan pelanggan (customer service) dan public relations dasar</li>
<li>Pengelolaan kas kecil dan administrasi keuangan kantor</li>
<li>Humas dan keprotokolan lembaga pemerintah/swasta</li>
</ul>

<h2>Keunggulan Program</h2>
<ul>
<li>Praktek kerja lapangan (PKL) di instansi pemerintah dan perusahaan besar</li>
<li>Pelatihan etika dan grooming profesional</li>
<li>Kemampuan bilingual (Bahasa Indonesia dan Inggris bisnis)</li>
<li>Sertifikasi kompetensi BNSP Administrasi Perkantoran</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li>Sekretaris dan Personal Assistant eksekutif</li>
<li>Staf Administrasi dan HRD</li>
<li>Front Office Officer di hotel, rumah sakit, atau perusahaan</li>
<li>Staf Humas dan Protokoler instansi pemerintah</li>
<li>Office Manager di perusahaan skala kecil-menengah</li>
</ul>

<blockquote>
"Seorang profesional administrasi adalah tulang punggung operasional kantor. Kami mendidik bukan hanya keterampilan, tapi juga karakter pelayan yang unggul."<br><strong>— Koordinator Program MPLB</strong>
</blockquote>
HTML;
    }

    private function contentDkv(): string
    {
        return <<<HTML
<h2>Tentang Program DKV</h2>
<p>Desain Komunikasi Visual (DKV) adalah program unggulan SMK Putra Pakuan yang telah mendapatkan status <strong>SMK Pusat Keunggulan Nasional</strong>. Program ini membekali siswa dengan keahlian desain grafis, ilustrasi digital, branding, dan produksi media kreatif yang siap bersaing di industri kreatif global.</p>

<h2>Bidang Keahlian</h2>
<ul>
<li><strong>Desain Grafis:</strong> Adobe Photoshop, Illustrator, InDesign, Canva Pro</li>
<li><strong>Ilustrasi Digital:</strong> Procreate, Clip Studio Paint, teknik digital painting</li>
<li><strong>Branding &amp; Identitas Visual:</strong> perancangan logo, brand guideline, kemasan produk</li>
<li><strong>Videografi &amp; Motion Graphics:</strong> Adobe Premiere Pro, After Effects</li>
<li><strong>Desain UI/UX:</strong> Figma, prototyping, user research dasar</li>
<li><strong>Percetakan &amp; Pre-press:</strong> teknik persiapan file cetak profesional</li>
</ul>

<h2>Program Pusat Keunggulan</h2>
<p>Sebagai SMK Pusat Keunggulan Nasional, DKV SMK Putra Pakuan memiliki keistimewaan:</p>
<ul>
<li>Dukungan langsung Kemendikbudristek dalam pengembangan kurikulum dan fasilitas</li>
<li>Kemitraan dengan industri kreatif dan agensi desain terkemuka</li>
<li>Peralatan desain berstandar industri (komputer grafis, tablet wacom, printer large format)</li>
<li>Pameran karya siswa tahunan bertaraf nasional</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li>Graphic Designer di agensi kreatif dan perusahaan media</li>
<li>Illustrator dan Concept Artist</li>
<li>Motion Graphics Designer &amp; Video Editor</li>
<li>UI/UX Designer di perusahaan teknologi</li>
<li>Brand Designer dan Creative Director</li>
<li>Content Creator dan Social Media Visual Specialist</li>
</ul>

<blockquote>
"DKV bukan sekadar jurusan menggambar. Kami mendidik komunikator visual yang mampu menyampaikan pesan bermakna melalui estetika yang kuat."<br><strong>— Koordinator Program DKV</strong>
</blockquote>
HTML;
    }

    private function contentTkr(): string
    {
        return <<<HTML
<h2>Tentang Program TKR</h2>
<p>Teknik Kendaraan Ringan (TKR) adalah program keahlian yang mempersiapkan siswa menjadi teknisi otomotif profesional. Program ini memberikan kompetensi komprehensif dalam perawatan, perbaikan, dan diagnosa kendaraan ringan (mobil) sesuai standar bengkel resmi ATPM (Agen Tunggal Pemegang Merek).</p>

<h2>Kompetensi yang Dipelajari</h2>
<ul>
<li>Perawatan dan perbaikan mesin kendaraan bensin dan diesel</li>
<li>Sistem kelistrikan kendaraan dan diagnosa menggunakan scanner OBD-II</li>
<li>Sistem transmisi manual dan otomatis (CVT, DCT, AT)</li>
<li>Sistem rem ABS, power steering, dan suspensi</li>
<li>Sistem AC dan pendingin mesin</li>
<li>Pengenalan kendaraan listrik (EV) dan hybrid</li>
<li>Welding dan body repair dasar</li>
</ul>

<h2>Fasilitas Workshop</h2>
<ul>
<li>Workshop otomotif lengkap dengan unit mobil praktik</li>
<li>Alat diagnosa elektronik (scanner OBD, multimeter, oscilloscope)</li>
<li>Lift kendaraan hidrolik untuk praktik bawah kendaraan</li>
<li>Engine stand dan chassis mock-up untuk pembelajaran teori praktis</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li>Mekanik di bengkel resmi (dealer Toyota, Honda, Daihatsu, dsb.)</li>
<li>Service Advisor dan Technical Lead di bengkel</li>
<li>Teknisi Quality Control di industri manufaktur otomotif</li>
<li>Wirausaha bengkel kendaraan ringan mandiri</li>
<li>Lanjut ke Politeknik Manufaktur / Teknik Otomotif</li>
</ul>

<blockquote>
"Mesin bisa berbicara kepada mereka yang tahu cara mendengarnya. Kami melatih teknisi yang tidak hanya bisa memperbaiki, tapi juga mencegah kerusakan."<br><strong>— Koordinator Program TKR</strong>
</blockquote>
HTML;
    }

    private function contentTsm(): string
    {
        return <<<HTML
<h2>Tentang Program TSM</h2>
<p>Teknik Sepeda Motor (TSM) adalah program keahlian yang mencetak mekanik sepeda motor profesional berstandar bengkel resmi. Dengan jumlah pengguna sepeda motor terbesar di dunia, Indonesia membutuhkan teknisi TSM yang kompeten — dan SMK Putra Pakuan hadir untuk memenuhi kebutuhan tersebut.</p>

<h2>Kompetensi yang Dipelajari</h2>
<ul>
<li>Perawatan berkala dan servis rutin sepeda motor 2-tak dan 4-tak</li>
<li>Perbaikan sistem bahan bakar injeksi (PGM-FI, FI, EFI)</li>
<li>Sistem kelistrikan sepeda motor dan diagnosa menggunakan Honda/Yamaha diagnostic tools</li>
<li>Sistem transmisi otomatis (CVT) dan manual</li>
<li>Sistem pengereman CBS, ABS, dan dual-disc brake</li>
<li>Pengenalan sepeda motor listrik dan baterai EV</li>
<li>Perawatan sasis, suspensi, dan velg sepeda motor</li>
</ul>

<h2>Kerjasama Industri</h2>
<ul>
<li>Magang di bengkel resmi AHASS (Honda), Yamaha, dan bengkel terkemuka Bogor</li>
<li>Kunjungan industri ke pabrik perakitan sepeda motor</li>
<li>Uji kompetensi sertifikasi BNSP Teknik Sepeda Motor</li>
</ul>

<h2>Prospek Karier</h2>
<ul>
<li>Mekanik di bengkel resmi AHASS (Honda), YIMM (Yamaha), Suzuki, dsb.</li>
<li>Service Advisor bengkel resmi</li>
<li>Teknisi Quality Control industri perakitan sepeda motor</li>
<li>Wirausaha bengkel sepeda motor mandiri</li>
<li>Instruktur pelatihan mekanik</li>
</ul>

<blockquote>
"Setiap sepeda motor yang berjalan dengan baik adalah hasil kerja seorang mekanik yang terlatih dan berdedikasi. Itulah yang kami cetak di setiap lulusan TSM."<br><strong>— Koordinator Program TSM</strong>
</blockquote>
HTML;
    }
}
