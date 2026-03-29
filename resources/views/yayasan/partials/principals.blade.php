<!-- Principals Section -->
<div class="w-full bg-white dark:bg-background-dark py-20 flex justify-center">
    @php
        $defaultLeaders = [
            [
                'unit' => 'PAUD IT',
                'name' => 'Lady Syafira W, S. Pd',
                'title' => 'Kepala Sekolah',
                'description' => 'Membangun fondasi karakter islami sejak dini',
                'photo_url' => '/images/KEPSEK_PAUDIT.jpg',
                'video_url' => asset('video/talking.mp4'),
            ],
            [
                'unit' => 'SDIT',
                'name' => 'Kepala Sekolah SDIT',
                'title' => 'Kepala Sekolah',
                'description' => 'Membentuk generasi qurani yang berprestasi',
                'photo_url' => '/images/KEPSEK_SDIT.jpg',
                'video_url' => 'https://storage.coverr.co/videos/R9xqTFSMaTDQ02AOSqDxgFaVe2OJ9hk4kT?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI',
            ],
            [
                'unit' => 'SMP',
                'name' => 'Kepala Sekolah SMP',
                'title' => 'Kepala Sekolah',
                'description' => 'Kembangkan pemimpin masa depan berakhlak',
                'photo_url' => '/images/KEPSEK_SMP.jpg',
                'video_url' => 'https://storage.coverr.co/videos/coverr-a-teacher-teaching-students-1829?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI',
            ],
            [
                'unit' => 'SMK',
                'name' => 'Kepala Sekolah SMK',
                'title' => 'Kepala Sekolah',
                'description' => 'Mencetak profesional muda siap kerja',
                'photo_url' => '/images/KEPSEK_SMK.png',
                'video_url' => 'https://storage.coverr.co/videos/coverr-professional-man-on-a-video-call-2705?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI',
            ],
            [
                'unit' => 'PKBM',
                'name' => 'Kepala Program PKBM',
                'title' => 'Kepala Program',
                'description' => 'Pendidikan inklusif untuk semua kalangan',
                'photo_url' => '/images/KEPSEK_PKBM.jpg',
                'video_url' => 'https://storage.coverr.co/videos/coverr-woman-in-a-video-call-1805?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFNkVCRjY2RDMwREU5M0VGIiwiaWF0IjoxNjUzMzk4NzQ1fQ.RyOQKdT_VTYlTKPNRJ0D9-SXYmXp0jbR8FchGd2ppHI',
            ],
        ];

        $leaders = (isset($yayasanPrincipals) && is_array($yayasanPrincipals) && count($yayasanPrincipals) > 0)
            ? $yayasanPrincipals
            : $defaultLeaders;
    @endphp

    <div class="max-w-[1920px] w-full px-4 md:px-10 flex flex-col gap-12">
        <div class="flex flex-col items-center text-center gap-4">
            <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                Kepala Sekolah & Program
            </h2>
            <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl">
                Para pemimpin yang berdedikasi membimbing setiap jenjang pendidikan di Yayasan Putra Pakuan.
            </p>
        </div>

        <!-- Grid of Principals -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-0 shadow-2xl rounded-xl overflow-hidden">
            @foreach ($leaders as $leader)
                @php
                    $photoValue = trim((string)($leader['photo_url'] ?? ''));
                    $videoValue = trim((string)($leader['video_url'] ?? ''));
                    $imageSrc = $photoValue === ''
                        ? asset('images/logo-putrapakuan.png')
                        : ((\Illuminate\Support\Str::startsWith($photoValue, ['http://', 'https://', '/'])) ? $photoValue : asset($photoValue));
                    $hasVideo = $videoValue !== '';
                @endphp
                <div class="group relative h-[500px] cursor-pointer overflow-hidden md:h-[600px] lg:h-[700px]"
                     onmouseenter="const v=this.querySelector('video'); if(v){v.play();}"
                     onmouseleave="const v=this.querySelector('video'); if(v){v.pause(); v.currentTime = 0;}">
                    <img
                        src="{{ $imageSrc }}"
                        alt="{{ $leader['unit'] ?? 'Pimpinan Yayasan' }}"
                        class="absolute inset-0 h-full w-full object-cover object-[50%_18%] md:object-center transition-opacity duration-300 {{ $hasVideo ? 'group-hover:opacity-0' : '' }}"
                    />

                    @if ($hasVideo)
                        <video
                            class="absolute inset-0 h-full w-full object-cover object-[50%_18%] md:object-center opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                            muted
                            loop
                            playsinline
                        >
                            <source src="{{ $videoValue }}" type="video/mp4">
                        </video>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/60 to-slate-900/30"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                        <h3 class="mb-2 text-3xl font-black md:text-4xl">{{ $leader['unit'] ?? '-' }}</h3>
                        <p class="mb-1 text-base font-semibold opacity-90 md:text-lg">{{ $leader['name'] ?? '-' }}</p>
                        <p class="mb-4 text-xs uppercase tracking-wider opacity-80">{{ $leader['title'] ?? 'Kepala Sekolah' }}</p>
                        <p class="text-sm leading-relaxed opacity-90 md:text-base">{{ $leader['description'] ?? '-' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
