<!-- Educational Units Section -->
<div class="w-full bg-slate-50 dark:bg-background-dark py-20 flex justify-center">
    <div class="max-w-[1280px] w-full px-4 md:px-10 flex flex-col gap-12">
        <div class="flex flex-col items-center text-center gap-4">
            <h2 class="text-slate-900 dark:text-white text-3xl md:text-5xl font-black tracking-tight">
                Unit Pendidikan Kami
            </h2>
            <div class="w-24 h-1.5 bg-[#FDB913] rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-3xl">
                Pilih jenjang yang ingin Anda jelajahi. Setiap unit memiliki tombol aksi yang jelas agar mudah diakses oleh orang tua maupun calon peserta didik.
            </p>
        </div>

        @php
            $unitCards = collect($unitSchools ?? [])->map(function ($unit) {
                $type = strtoupper((string) ($unit->type ?? ''));

                $badge = match ($type) {
                    'SD' => 'Sekolah Dasar Islam Terpadu',
                    'SMP' => 'Sekolah Menengah Pertama',
                    'SMK' => 'Sekolah Menengah Kejuruan',
                    default => 'Unit Pendidikan',
                };

                $routePath = match ($type) {
                    'SD' => '/sd',
                    'SMP' => '/smp',
                    'SMK' => '/smk',
                    default => null,
                };

                $logoPath = match ($type) {
                    'SD' => 'images/logo-sdit-putrapakuan.png',
                    'SMP' => 'images/yayasan-logo.jfif',
                    'SMK' => 'images/logo-putrapakuan.png',
                    default => 'images/yayasan-logo.jfif',
                };

                return [
                    'name' => $unit->name ?? $type,
                    'type' => $type === 'SD' ? 'SDIT' : $type,
                    'badge' => $badge,
                    'logo_path' => $logoPath,
                    'route_path' => $routePath,
                    'available' => !empty($routePath),
                ];
            })->values();

            // Ensure PAUD IT and PKBM always appear even without dedicated subdomain.
            if (! $unitCards->contains(fn ($item) => strtoupper((string) ($item['type'] ?? '')) === 'PAUD')) {
                $unitCards->prepend([
                    'name' => 'PAUD IT Putra Pakuan',
                    'type' => 'PAUD',
                    'badge' => 'Pendidikan Anak Usia Dini',
                    'logo_path' => 'images/yayasan-logo.jfif',
                    'route_path' => null,
                    'available' => false,
                ]);
            }

            if (! $unitCards->contains(fn ($item) => strtoupper((string) ($item['type'] ?? '')) === 'PKBM')) {
                $unitCards->push([
                    'name' => 'PKBM Putra Pakuan',
                    'type' => 'PKBM',
                    'badge' => 'Pusat Kegiatan Belajar Masyarakat',
                    'logo_path' => 'images/yayasan-logo.jfif',
                    'route_path' => null,
                    'available' => false,
                ]);
            }

            $unitOrder = [
                'PAUD' => 1,
                'SDIT' => 2,
                'SMP' => 3,
                'SMK' => 4,
                'PKBM' => 5,
            ];

            $unitCards = $unitCards
                ->sortBy(fn ($item) => $unitOrder[strtoupper((string) ($item['type'] ?? ''))] ?? 99)
                ->values();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @forelse ($unitCards as $card)
                <article class="flex flex-col bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 min-h-[270px] shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center mb-4 overflow-hidden">
                        <img
                            src="{{ asset($card['logo_path'] ?? 'images/yayasan-logo.jfif') }}"
                            alt="Logo {{ $card['name'] }}"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <div class="flex flex-col gap-2 flex-grow">
                        <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-snug">{{ $card['name'] }}</h3>
                        <p class="text-xs text-[#C58A00] font-bold uppercase tracking-wider">{{ $card['badge'] }}</p>
                    </div>

                    <div class="mt-5">
                        @if ($card['available'])
                            <a
                                href="{{ url($card['route_path']) }}"
                                hx-boost="false"
                                class="w-full inline-flex items-center justify-center rounded-lg h-11 px-4 bg-[#FDB913] hover:bg-[#E5A800] text-slate-900 text-sm font-bold transition-colors"
                            >
                                Buka Halaman
                            </a>
                        @else
                            <button
                                type="button"
                                disabled
                                class="w-full inline-flex items-center justify-center rounded-lg h-11 px-4 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-300 text-sm font-bold cursor-not-allowed"
                            >
                                Segera Hadir
                            </button>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center text-slate-500">Data unit pendidikan belum tersedia saat ini.</div>
            @endforelse
        </div>

        <div class="flex justify-center mt-2">
            <a href="{{ route('daftar') }}" class="inline-flex items-center justify-center rounded-xl h-12 px-8 border-2 border-[#FDB913] text-[#A66F00] hover:bg-[#FDB913] hover:text-slate-900 text-base font-bold transition-colors">
                Lihat Info Penerimaan
            </a>
        </div>
    </div>
</div>
