<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use App\Traits\ResolvesSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    use ResolvesSchool;
    public function index(string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        $isYayasan = strtolower($schoolTypeUpper) === 'yayasan';
        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $this->abortUnlessSuperAdmin();

        $homepage = SchoolHomepageSetting::where('school_id', $school->id)->first();
        if (!$homepage) {
            $contactDefaults = $this->defaultContactData();
            $homepage = new SchoolHomepageSetting([
                'school_id' => $school->id,
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
                'contact_whatsapp' => $contactDefaults['contact_whatsapp'],
                'contact_email' => $contactDefaults['contact_email'],
                'contact_phone' => $contactDefaults['contact_phone'],
                'contact_address' => $contactDefaults['contact_address'],
                'contact_map_url' => $contactDefaults['contact_map_url'],
                'yayasan_principals' => $isYayasan ? $this->defaultYayasanPrincipals() : null,
            ]);
        }

        $yayasanPrincipals = $isYayasan
            ? $this->normalizeYayasanPrincipals($homepage->yayasan_principals)
            : [];

        // Show a small snapshot of latest news on the same page
        $latestNews = News::where('school_id', $school->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.superadmin.cms.unit.index', [
            'schoolType' => strtolower($schoolTypeUpper),
            'school' => $school,
            'homepage' => $homepage,
            'yayasanPrincipals' => $yayasanPrincipals,
            'latestNews' => $latestNews,
        ]);
    }

    public function updateKepsek(Request $request, string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $this->abortUnlessSuperAdmin();

        $validated = $request->validate([
            'kepsek_photo' => ['nullable', 'image', 'max:1024'],
            'kepsek_name' => ['required', 'string', 'max:255'],
            'kepsek_title' => ['required', 'string', 'max:255'],
            'kepsek_sambutan' => ['required', 'string'],
        ]);

        $homepage = SchoolHomepageSetting::firstOrCreate(
            ['school_id' => $school->id],
            [
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => $validated['kepsek_name'],
                'kepsek_title' => $validated['kepsek_title'],
                'kepsek_sambutan' => $validated['kepsek_sambutan'],
            ]
        );

        $homepage->kepsek_name = $validated['kepsek_name'];
        $homepage->kepsek_title = $validated['kepsek_title'];
        $homepage->kepsek_sambutan = $validated['kepsek_sambutan'];

        if ($request->hasFile('kepsek_photo')) {
            $this->deleteOldCmsFile($homepage->kepsek_photo_url);
            $file = $request->file('kepsek_photo');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'kepsek_' . $schoolTypeUpper . '_' . Str::uuid()->toString() . '.' . $ext;

            $targetDir = public_path('images/cms/' . strtolower($schoolTypeUpper));
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $homepage->kepsek_photo_url = '/images/cms/' . strtolower($schoolTypeUpper) . '/' . $filename;
        }

        $homepage->save();

        $this->flushSchoolCache($school);

        return redirect()
            ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolTypeUpper)])
            ->with('success', 'Konten Kepala Sekolah berhasil diperbarui.');
    }

    public function updateContactInfo(Request $request, string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $this->abortUnlessSuperAdmin();

        $validated = $request->validate([
            'contact_whatsapp' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:1000'],
            'contact_map_url' => ['nullable', 'url', 'starts_with:https://', 'max:1000'],
        ]);

        $contactDefaults = $this->defaultContactData();

        $homepage = SchoolHomepageSetting::firstOrCreate(
            ['school_id' => $school->id],
            [
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
                'contact_whatsapp' => $contactDefaults['contact_whatsapp'],
                'contact_email' => $contactDefaults['contact_email'],
                'contact_phone' => $contactDefaults['contact_phone'],
                'contact_address' => $contactDefaults['contact_address'],
                'contact_map_url' => $contactDefaults['contact_map_url'],
            ]
        );

        if (array_key_exists('contact_whatsapp', $validated)) {
            $homepage->contact_whatsapp = $validated['contact_whatsapp'] ?? '';
        }
        if (array_key_exists('contact_email', $validated)) {
            $homepage->contact_email = $validated['contact_email'] ?? '';
        }
        if (array_key_exists('contact_phone', $validated)) {
            $homepage->contact_phone = $validated['contact_phone'] ?? '';
        }
        if (array_key_exists('contact_address', $validated)) {
            $homepage->contact_address = $validated['contact_address'] ?? '';
        }
        if (array_key_exists('contact_map_url', $validated)) {
            $homepage->contact_map_url = $validated['contact_map_url'] ?? '';
        }
        $homepage->save();

        $this->flushSchoolCache($school);

        return redirect()
            ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolTypeUpper)])
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    public function updateYayasanPrincipals(Request $request, string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        if (strtolower($schoolTypeUpper) !== 'yayasan') {
            abort(404);
        }

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        $this->abortUnlessSuperAdmin();

        $validated = $request->validate([
            'principals' => ['required', 'array', 'min:1'],
            'principals.*.unit' => ['required', 'string', 'max:100'],
            'principals.*.name' => ['required', 'string', 'max:255'],
            'principals.*.title' => ['required', 'string', 'max:255'],
            'principals.*.description' => ['required', 'string', 'max:500'],
            'principals.*.photo_existing' => ['nullable', 'string', 'max:1000'],
            'principals.*.video_existing' => ['nullable', 'string', 'max:1000'],
            'principals.*.photo' => ['nullable', 'image', 'max:1024'],
            'principals.*.video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg,video/quicktime', 'max:20480'],
        ]);

        $homepage = SchoolHomepageSetting::firstOrCreate(
            ['school_id' => $school->id],
            [
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
                'yayasan_principals' => $this->defaultYayasanPrincipals(),
            ]
        );

        $principalsPayload = collect($validated['principals'])
            ->map(function ($item, $index) use ($request) {
                $photoUrl = trim((string)($item['photo_existing'] ?? ''));
                $videoUrl = trim((string)($item['video_existing'] ?? ''));

                if ($request->hasFile("principals.$index.photo")) {
                    $this->deleteOldCmsFile($photoUrl);
                    $file = $request->file("principals.$index.photo");
                    $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
                    $filename = 'principal_photo_' . Str::uuid()->toString() . '.' . $ext;

                    $targetDir = public_path('images/cms/yayasan/principals');
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0755, true);
                    }

                    $file->move($targetDir, $filename);
                    $photoUrl = '/images/cms/yayasan/principals/' . $filename;
                }

                if ($request->hasFile("principals.$index.video")) {
                    $this->deleteOldCmsFile($videoUrl);
                    $file = $request->file("principals.$index.video");
                    $ext = strtolower($file->getClientOriginalExtension() ?: 'mp4');
                    $filename = 'principal_video_' . Str::uuid()->toString() . '.' . $ext;

                    $targetDir = public_path('video/cms/yayasan/principals');
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0755, true);
                    }

                    $file->move($targetDir, $filename);
                    $videoUrl = '/video/cms/yayasan/principals/' . $filename;
                }

                return [
                    'unit' => trim((string)($item['unit'] ?? '')),
                    'name' => trim((string)($item['name'] ?? '')),
                    'title' => trim((string)($item['title'] ?? '')),
                    'description' => trim((string)($item['description'] ?? '')),
                    'photo_url' => $photoUrl,
                    'video_url' => $videoUrl,
                ];
            })
            ->filter(fn($item) => $item['unit'] !== '' && $item['name'] !== '' && $item['photo_url'] !== '')
            ->values()
            ->all();

        if (count($principalsPayload) === 0) {
            return redirect()
                ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolTypeUpper)])
                ->withErrors(['principals' => 'Minimal satu data pimpinan harus memiliki unit, nama, dan foto.'])
                ->withInput();
        }

        $homepage->yayasan_principals = $this->normalizeYayasanPrincipals($principalsPayload);
        $homepage->save();

        $this->flushSchoolCache($school);

        return redirect()
            ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolTypeUpper)])
            ->with('success', 'Daftar pimpinan Yayasan berhasil diperbarui.');
    }

    private function defaultKepsekPhotoUrl(string $schoolTypeUpper): string
    {
        return match ($schoolTypeUpper) {
            'SMK' => '/images/KEPSEK_SMK.png',
            'SMP' => '/images/KEPSEK_SMP.png',
            'SD' => '/images/KEPSEK_SDIT.jpg',
            'YAYASAN' => '/images/logo-putrapakuan.png',
            default => '/images/KEPSEK_SMK.png',
        };
    }

    private function defaultContactData(): array
    {
        return [
            'contact_whatsapp' => '6282112345678',
            'contact_email' => 'info@putrapakuan.sch.id',
            'contact_phone' => '+62 21 1234 5678',
            'contact_address' => 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129',
            'contact_map_url' => 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor',
        ];
    }

    private function defaultYayasanPrincipals(): array
    {
        return [
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
    }

    private function normalizeYayasanPrincipals($principals): array
    {
        $source = collect(is_array($principals) ? $principals : [])
            ->map(function ($item) {
                return [
                    'unit' => trim((string)($item['unit'] ?? '')),
                    'name' => trim((string)($item['name'] ?? '')),
                    'title' => trim((string)($item['title'] ?? '')),
                    'description' => trim((string)($item['description'] ?? '')),
                    'photo_url' => trim((string)($item['photo_url'] ?? '')),
                    'video_url' => trim((string)($item['video_url'] ?? '')),
                ];
            })
            ->filter(fn($item) => $item['unit'] !== '' && $item['name'] !== '' && $item['photo_url'] !== '')
            ->values();

        $normalizeUnitKey = function (?string $unit): string {
            $value = strtoupper(trim((string) $unit));

            return match (true) {
                str_contains($value, 'PAUD') => 'PAUD',
                str_contains($value, 'PKBM') => 'PKBM',
                str_contains($value, 'SDIT'), $value === 'SD' => 'SDIT',
                str_contains($value, 'SMP') => 'SMP',
                str_contains($value, 'SMK') => 'SMK',
                default => $value,
            };
        };

        $sourceByUnit = $source->keyBy(fn($item) => $normalizeUnitKey($item['unit'] ?? ''));

        $merged = collect($this->defaultYayasanPrincipals())
            ->map(function ($defaultItem) use ($sourceByUnit, $normalizeUnitKey) {
                $unitKey = $normalizeUnitKey($defaultItem['unit'] ?? '');
                $savedItem = $sourceByUnit->get($unitKey);

                return $savedItem
                    ? array_merge($defaultItem, $savedItem)
                    : $defaultItem;
            });

        $extraItems = $source
            ->filter(function ($item) use ($normalizeUnitKey) {
                return ! collect($this->defaultYayasanPrincipals())
                    ->contains(fn($defaultItem) => $normalizeUnitKey($defaultItem['unit'] ?? '') === $normalizeUnitKey($item['unit'] ?? ''));
            })
            ->values();

        return $merged
            ->concat($extraItems)
            ->values()
            ->all();
    }

    private function deleteOldCmsFile(?string $url): void
    {
        if (!$url) return;
        if (!str_starts_with($url, '/images/cms/') && !str_starts_with($url, '/videos/cms/') && !str_starts_with($url, '/video/cms/')) return;
        $path = public_path(ltrim($url, '/'));
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    private function abortUnlessSuperAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }
    }

    public function updatePaymentSettings(Request $request, string $schoolType)
    {
        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        $this->abortUnlessSuperAdmin();

        $validated = $request->validate([
            'payment_bank_name'         => ['nullable', 'string', 'max:100'],
            'payment_bank_account'      => ['nullable', 'string', 'max:50'],
            'payment_bank_holder'       => ['nullable', 'string', 'max:255'],
            'payment_ewallet_gopay'     => ['nullable', 'string', 'max:50'],
            'payment_ewallet_dana'      => ['nullable', 'string', 'max:50'],
            'payment_ewallet_ovo'       => ['nullable', 'string', 'max:50'],
            'payment_ewallet_shopee'    => ['nullable', 'string', 'max:50'],
            'payment_registration_fee'  => ['nullable', 'numeric', 'min:0'],
        ]);

        $homepage = SchoolHomepageSetting::firstOrCreate(['school_id' => $school->id]);
        $homepage->fill($validated);
        $homepage->save();

        $this->flushSchoolCache($school);

        if ($request->input('_redirect_to') === 'ppdb_management') {
            return redirect()
                ->route('admin.ppdb.management', ['school' => $school->slug])
                ->with('success', 'Pengaturan pembayaran PPDB berhasil diperbarui.');
        }

        return redirect()
            ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Pengaturan pembayaran PPDB berhasil diperbarui.');
    }
}
