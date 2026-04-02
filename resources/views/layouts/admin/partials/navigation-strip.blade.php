@php
    $segments = request()->segments();
    $breadcrumbs = [];
    $currentLabel = preg_replace('/\s*-\s*Putra Pakuan CMS$/', '', trim($__env->yieldContent('title', 'Admin')));

    $labelFor = static function (?string $segment): ?string {
        if ($segment === null || $segment === '') {
            return null;
        }

        $map = [
            'cms' => 'CMS',
            'ppdb' => 'PPDB',
            'schools' => 'Pilih Sekolah',
            'pages' => 'Halaman Yayasan',
            'management' => 'Manajemen',
            'applicants' => 'Pendaftar',
            'capacity' => 'Kapasitas',
            'berita' => 'Berita',
            'galeri' => 'Galeri',
            'carousel' => 'Carousel',
            'prestasi' => 'Prestasi',
            'guru' => 'Guru & Staf',
            'create' => 'Tambah',
            'edit' => 'Ubah',
            'detail' => 'Detail',
            'user-management' => 'Manajemen Pengguna',
            'users' => 'Pengguna',
            'yayasan' => 'Yayasan',
            'sd' => 'SD',
            'smp' => 'SMP',
            'smk' => 'SMK',
        ];

        return $map[$segment] ?? str($segment)->replace(['-', '_'], ' ')->title()->toString();
    };

    $breadcrumbs[] = ['label' => 'Admin', 'url' => url('/admin')];
    $backUrl = url('/admin');

    if (($segments[1] ?? null) === 'cms') {
        $breadcrumbs[] = ['label' => 'CMS', 'url' => $cmsLink !== '#' ? $cmsLink : url('/admin/cms')];

        $third = $segments[2] ?? null;
        $fourth = $segments[3] ?? null;
        $fifth = $segments[4] ?? null;
        $sixth = $segments[5] ?? null;

        if ($third === 'schools') {
            $currentLabel = 'Pilih Sekolah';
        } elseif ($third === 'pages') {
            $breadcrumbs[] = ['label' => 'Halaman Yayasan', 'url' => url('/admin/cms/pages')];
            $backUrl = url('/admin/cms/pages');
            if ($fifth === 'edit') {
                $currentLabel = 'Ubah';
            } else {
                $currentLabel = 'Halaman Yayasan';
            }
        } elseif ($third) {
            $schoolUrl = url('/admin/cms/' . $third);
            $breadcrumbs[] = ['label' => $labelFor($third), 'url' => $schoolUrl];
            $backUrl = $schoolUrl;

            if ($fourth) {
                $sectionUrl = $schoolUrl . '/' . $fourth;
                if (!is_numeric($fourth)) {
                    $breadcrumbs[] = ['label' => $labelFor($fourth), 'url' => $sectionUrl];
                    $backUrl = $sectionUrl;
                }

                if ($fifth === 'create') {
                    $currentLabel = 'Tambah';
                } elseif ($sixth === 'edit') {
                    $currentLabel = 'Ubah';
                } elseif ($fifth && !is_numeric($fifth)) {
                    $currentLabel = $labelFor($fifth);
                } else {
                    $currentLabel = $labelFor($fourth);
                }
            } else {
                $currentLabel = $labelFor($third);
            }
        }
    } elseif (($segments[1] ?? null) === 'ppdb') {
        $breadcrumbs[] = ['label' => 'PPDB', 'url' => $ppdbLink !== '#' ? $ppdbLink : url('/admin/ppdb/schools')];

        $third = $segments[2] ?? null;
        $fourth = $segments[3] ?? null;
        $fifth = $segments[4] ?? null;

        if ($third === 'schools') {
            $currentLabel = 'Pilih Sekolah';
        } elseif ($third === 'management' && $fourth) {
            $managementUrl = url('/admin/ppdb/management/' . $fourth);
            $breadcrumbs[] = ['label' => $labelFor($fourth), 'url' => $managementUrl];
            $backUrl = $managementUrl;
            $currentLabel = $fifth ? $labelFor($fifth) : 'Manajemen';
        } elseif ($third === 'applicants' && $fourth) {
            $applicantUrl = url('/admin/ppdb/applicants/' . $fourth);
            $breadcrumbs[] = ['label' => 'Pendaftar', 'url' => $applicantUrl];
            $backUrl = $applicantUrl;
            $currentLabel = ($fifth && is_numeric($fifth)) ? 'Detail Pendaftar' : $labelFor($fourth);
        }
    } elseif (($segments[1] ?? null) === 'user-management' || ($segments[1] ?? null) === 'users') {
        $breadcrumbs[] = ['label' => 'Manajemen Pengguna', 'url' => url('/admin/user-management')];
        $backUrl = url('/admin/user-management');
        $currentLabel = ($segments[1] ?? null) === 'user-management' ? 'Manajemen Pengguna' : ($labelFor($segments[2] ?? null) ?? 'Pengguna');
    } elseif (($segments[1] ?? null) === 'archive') {
        $archiveIndexUrl = url('/admin/archive');
        $breadcrumbs[] = ['label' => 'Arsip Digital', 'url' => $archiveIndexUrl];
        $backUrl = $archiveIndexUrl;

        $third  = $segments[2] ?? null; // school slug e.g. smk
        $fourth = $segments[3] ?? null; // year e.g. 2026-2027
        $fifth  = $segments[4] ?? null; // student id or 'export'

        if ($third && $fourth) {
            $yearDisplay = str_replace('-', '/', $fourth);
            $schoolLabel = $labelFor($third);
            $yearUrl     = url("/admin/archive/{$third}/{$fourth}");
            $breadcrumbs[] = ['label' => $schoolLabel . ' – ' . $yearDisplay, 'url' => $yearUrl];
            $backUrl = $yearUrl;

            if ($fifth && is_numeric($fifth)) {
                $currentLabel = 'Detail Siswa';
            } elseif ($fifth === 'export') {
                $currentLabel = 'Ekspor';
            } else {
                $currentLabel = $schoolLabel . ' – ' . $yearDisplay;
                array_pop($breadcrumbs);
                $backUrl = $archiveIndexUrl;
            }
        } elseif ($third) {
            $currentLabel = $labelFor($third);
        } else {
            $currentLabel = 'Arsip Digital';
            array_pop($breadcrumbs);
        }
    } elseif (($segments[1] ?? null) === 'students') {
        $breadcrumbs[] = ['label' => 'Arsip Digital', 'url' => url('/admin/archive')];
        $backUrl = url('/admin/archive');
        $currentLabel = 'Siswa';
    }

    if (count($breadcrumbs) > 1) {
        $backUrl = $breadcrumbs[count($breadcrumbs) - 1]['url'] === request()->url()
            ? ($breadcrumbs[count($breadcrumbs) - 2]['url'] ?? url('/admin'))
            : ($backUrl ?: url('/admin'));
    }
@endphp

<div class="mb-6 rounded-2xl border border-[#1c190d]/8 bg-white/80 px-5 py-4 shadow-sm">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-4">
        <a href="{{ $backUrl }}"
           data-admin-nav
           class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-primary/20 bg-surface-container-low px-4 py-2 text-sm font-bold text-[#1c190d] transition-colors hover:bg-primary-container">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali</span>
        </a>

        <div class="flex min-w-0 flex-wrap items-center gap-2 text-sm text-on-surface-variant">
        @foreach ($breadcrumbs as $breadcrumb)
            <a href="{{ $breadcrumb['url'] }}" data-admin-nav class="font-semibold transition-colors hover:text-primary">{{ $breadcrumb['label'] }}</a>
            <span class="material-symbols-outlined text-base text-outline">chevron_right</span>
        @endforeach
        <span class="min-w-0 truncate font-bold text-[#1c190d]">{{ $currentLabel }}</span>
        </div>
    </div>
</div>
