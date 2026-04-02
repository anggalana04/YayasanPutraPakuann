<?php

namespace Database\Seeders;

use App\Models\SchoolHomepageSetting;
use App\Models\School;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        $smk     = School::where('slug', 'smk-putra-pakuan')->first();
        $smp     = School::where('slug', 'smp-putra-pakuan')->first();
        $sdit    = School::where('slug', 'sdit-putra-pakuan')->first();
        $yayasan = School::where('slug', 'yayasan-putra-pakuan')->first();

        $settings = [
            // ── SMK ────────────────────────────────────────────────────────
            [
                'school_id'        => $smk->id,
                'kepsek_photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80',
                'kepsek_name'      => 'Drs. Ahmad Sujana, M.Pd.',
                'kepsek_title'     => 'Kepala SMK Putra Pakuan',
                'kepsek_sambutan'  => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Selamat datang di website resmi <strong>SMK Putra Pakuan</strong>. Atas nama seluruh keluarga besar SMK Putra Pakuan, kami mengucapkan selamat datang kepada seluruh pengunjung yang ingin mengenal lebih dekat institusi kami.</p><p>SMK Putra Pakuan berdiri di atas semangat untuk mencetak tenaga kerja terampil, berkarakter, dan siap bersaing di era industri 4.0. Kami berkomitmen memberikan pendidikan vokasi berkualitas tinggi melalui kurikulum yang relevan dengan kebutuhan industri, didukung fasilitas modern, dan tenaga pengajar berkompetensi tinggi.</p><p>Melalui program unggulan seperti kemitraan industri, sertifikasi kompetensi internasional, dan pembelajaran berbasis proyek nyata, kami memastikan setiap lulusan SMK Putra Pakuan siap menapaki karir dan masa depan yang cerah.</p><p>Kami mengundang putra-putri terbaik bangsa untuk bergabung dan bertumbuh bersama kami. Bersama SMK Putra Pakuan, raih masa depan yang <em>unggul, kompeten, dan berkarakter</em>.</p><p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
                'contact_whatsapp' => '6281234567890',
                'contact_email'    => 'info@smk-putrapakuan.sch.id',
                'contact_phone'    => '(0251) 555-0101',
                'contact_address'  => 'Jl. Raya Tajur No. 123, Kel. Sindangsari, Kec. Bogor Tengah, Kota Bogor, Jawa Barat 16143',
                'contact_map_url'  => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1!2d106.8!3d-6.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c!2sSMK%20Putra%20Pakuan!5e0!3m2!1sid!2sid!4v1',
                'yayasan_principals' => [
                    ['unit' => 'SMK Putra Pakuan', 'name' => 'Drs. Ahmad Sujana, M.Pd.', 'title' => 'Kepala SMK Putra Pakuan', 'description' => 'Memimpin penguatan pendidikan vokasi berbasis industri 4.0.', 'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SMP Putra Pakuan', 'name' => 'Dra. Sri Mulyani, M.Pd.', 'title' => 'Kepala SMP Putra Pakuan', 'description' => 'Mendorong pendidikan karakter dan prestasi akademik berimbang.', 'photo_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SDIT Putra Pakuan', 'name' => 'Hj. Fatimah Azzahra, S.Ag., M.Pd.', 'title' => 'Kepala SDIT Putra Pakuan', 'description' => 'Mengintegrasikan kurikulum nasional dengan nilai-nilai Islam dan tahfizh.', 'photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80', 'video_url' => ''],
                ],
            ],
            // ── SMP ────────────────────────────────────────────────────────
            [
                'school_id'        => $smp->id,
                'kepsek_photo_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80',
                'kepsek_name'      => 'Dra. Sri Mulyani, M.Pd.',
                'kepsek_title'     => 'Kepala SMP Putra Pakuan',
                'kepsek_sambutan'  => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Salam sejahtera bagi kita semua. Dengan penuh rasa syukur, saya menyambut Anda di website resmi <strong>SMP Putra Pakuan</strong>.</p><p>SMP Putra Pakuan hadir sebagai lembaga pendidikan yang tidak hanya fokus pada capaian akademik, tetapi juga pada pembentukan karakter dan kepribadian mulia. Kami percaya bahwa pendidikan sejati adalah yang mampu menumbuhkan potensi utuh setiap anak — intelektual, emosional, sosial, dan spiritual.</p><p>Program unggulan kami meliputi kelas olimpiade, pembinaan seni budaya, kepramukaan berstandar nasional, serta pendidikan karakter terintegrasi yang diterapkan dalam setiap aspek kehidupan sekolah. Kami bangga dengan lingkungan sekolah yang ramah anak, inklusif, dan kondusif untuk tumbuh kembang optimal.</p><p>Kepercayaan orang tua kepada kami adalah amanah yang kami jaga sungguh-sungguh. Mari bersama kami wujudkan generasi muda yang <em>cerdas, berkarakter, dan berdaya saing</em>.</p><p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
                'contact_whatsapp' => '6281298765432',
                'contact_email'    => 'info@smp-putrapakuan.sch.id',
                'contact_phone'    => '(0251) 555-0202',
                'contact_address'  => 'Jl. Sholeh Iskandar No. 45, Kel. Menteng, Kec. Bogor Barat, Kota Bogor, Jawa Barat 16116',
                'contact_map_url'  => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.2!2d106.79!3d-6.58!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69d!2sSMP%20Putra%20Pakuan!5e0!3m2!1sid!2sid!4v1',
                'yayasan_principals' => [
                    ['unit' => 'SMK Putra Pakuan', 'name' => 'Drs. Ahmad Sujana, M.Pd.', 'title' => 'Kepala SMK Putra Pakuan', 'description' => 'Memimpin penguatan pendidikan vokasi berbasis industri 4.0.', 'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SMP Putra Pakuan', 'name' => 'Dra. Sri Mulyani, M.Pd.', 'title' => 'Kepala SMP Putra Pakuan', 'description' => 'Mendorong pendidikan karakter dan prestasi akademik berimbang.', 'photo_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SDIT Putra Pakuan', 'name' => 'Hj. Fatimah Azzahra, S.Ag., M.Pd.', 'title' => 'Kepala SDIT Putra Pakuan', 'description' => 'Mengintegrasikan kurikulum nasional dengan nilai-nilai Islam dan tahfizh.', 'photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80', 'video_url' => ''],
                ],
            ],
            // ── SDIT ───────────────────────────────────────────────────────
            [
                'school_id'        => $sdit->id,
                'kepsek_photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80',
                'kepsek_name'      => 'Hj. Fatimah Azzahra, S.Ag., M.Pd.',
                'kepsek_title'     => 'Kepala SDIT Putra Pakuan',
                'kepsek_sambutan'  => '<p>Bismillahirrahmanirrahim,</p><p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Puji syukur kehadirat Allah Subhanahu Wa Ta\'ala atas segala rahmat dan karunia-Nya kepada kita semua. Selamat datang di website resmi <strong>SDIT Putra Pakuan</strong>.</p><p>SDIT Putra Pakuan adalah sekolah dasar Islam terpadu yang mengemban misi mulia: mencetak generasi Qurani yang berilmu, berakhlak mulia, dan siap menjadi pemimpin masa depan bangsa dan ummat.</p><p>Kami mengintegrasikan kurikulum nasional dengan nilai-nilai Islam secara holistik. Program Tahfizh Al-Quran kami menjadi keunggulan utama — setiap siswa dibimbing menghafal Al-Quran dengan tartil dan memahami maknanya sejak kelas satu. Selain itu, program sains, seni, bahasa, dan kewirausahaan kami rancang agar anak tumbuh dengan kepercayaan diri yang tinggi.</p><p>Kami mengundang orang tua yang memiliki visi serupa untuk bersama kami menitipkan buah hati dalam lingkungan yang <em>islami, ilmiah, dan penuh kasih sayang</em>.</p><p>Jazakumullahu khairan katsiran. Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
                'contact_whatsapp' => '6281311223344',
                'contact_email'    => 'info@sdit-putrapakuan.sch.id',
                'contact_phone'    => '(0251) 555-0303',
                'contact_address'  => 'Jl. Paledang No. 8, Kel. Batutulis, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16133',
                'contact_map_url'  => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.0!2d106.81!3d-6.62!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e!2sSDIT%20Putra%20Pakuan!5e0!3m2!1sid!2sid!4v1',
                'yayasan_principals' => [
                    ['unit' => 'SMK Putra Pakuan', 'name' => 'Drs. Ahmad Sujana, M.Pd.', 'title' => 'Kepala SMK Putra Pakuan', 'description' => 'Memimpin penguatan pendidikan vokasi berbasis industri 4.0.', 'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SMP Putra Pakuan', 'name' => 'Dra. Sri Mulyani, M.Pd.', 'title' => 'Kepala SMP Putra Pakuan', 'description' => 'Mendorong pendidikan karakter dan prestasi akademik berimbang.', 'photo_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SDIT Putra Pakuan', 'name' => 'Hj. Fatimah Azzahra, S.Ag., M.Pd.', 'title' => 'Kepala SDIT Putra Pakuan', 'description' => 'Mengintegrasikan kurikulum nasional dengan nilai-nilai Islam dan tahfizh.', 'photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80', 'video_url' => ''],
                ],
            ],

            // ── Yayasan ───────────────────────────────────────────────────
            [
                'school_id'        => $yayasan->id,
                'kepsek_photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80',
                'kepsek_name'      => 'H. Mujtaba Fauzi, S.H., M.M.',
                'kepsek_title'     => 'Ketua Yayasan Putra Pakuan',
                'kepsek_sambutan'  => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Puji syukur kehadirat Allah Subhanahu Wa Ta\'ala atas kepercayaan masyarakat kepada <strong>Yayasan Putra Pakuan</strong> dalam mendidik generasi penerus bangsa.</p><p>Selama lebih dari dua dekade, kami berkomitmen menghadirkan layanan pendidikan yang unggul melalui sinergi tiga unit sekolah: SMK, SMP, dan SDIT Putra Pakuan. Kami meyakini pendidikan yang bermakna harus menumbuhkan kompetensi, karakter, serta nilai-nilai keislaman dalam satu kesatuan yang utuh.</p><p>Melalui penguatan kualitas guru, pengembangan sarana-prasarana, digitalisasi layanan pendidikan, serta program beasiswa untuk peserta didik berprestasi, kami terus berupaya memperluas akses pendidikan berkualitas bagi seluruh lapisan masyarakat.</p><p>Kami mengundang seluruh orang tua, alumni, dan mitra strategis untuk berjalan bersama membangun ekosistem pendidikan yang maju, inklusif, dan berkelanjutan.</p><p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
                'contact_whatsapp' => '6281211112233',
                'contact_email'    => 'info@yayasanputrapakuan.or.id',
                'contact_phone'    => '(0251) 555-0000',
                'contact_address'  => 'Jl. Raya Tajur No. 123, Kel. Sindangsari, Kec. Bogor Tengah, Kota Bogor, Jawa Barat 16143',
                'contact_map_url'  => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1!2d106.8!3d-6.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c!2sYayasan%20Putra%20Pakuan!5e0!3m2!1sid!2sid!4v1',
                'yayasan_principals' => [
                    ['unit' => 'SMK Putra Pakuan', 'name' => 'Drs. Ahmad Sujana, M.Pd.', 'title' => 'Kepala SMK Putra Pakuan', 'description' => 'Memimpin penguatan pendidikan vokasi berbasis industri 4.0.', 'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SMP Putra Pakuan', 'name' => 'Dra. Sri Mulyani, M.Pd.', 'title' => 'Kepala SMP Putra Pakuan', 'description' => 'Mendorong pendidikan karakter dan prestasi akademik berimbang.', 'photo_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80', 'video_url' => ''],
                    ['unit' => 'SDIT Putra Pakuan', 'name' => 'Hj. Fatimah Azzahra, S.Ag., M.Pd.', 'title' => 'Kepala SDIT Putra Pakuan', 'description' => 'Mengintegrasikan kurikulum nasional dengan nilai-nilai Islam dan tahfizh.', 'photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80', 'video_url' => ''],
                ],
            ],
        ];

        foreach ($settings as $s) {
            SchoolHomepageSetting::firstOrCreate(
                ['school_id' => $s['school_id']],
                $s
            );
        }
    }
}
