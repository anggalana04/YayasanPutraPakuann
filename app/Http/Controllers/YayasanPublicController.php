<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\News;
use App\Models\Page;
use App\Models\Prestasi;
use App\Models\School;
use App\Traits\ResolvesSchool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class YayasanPublicController extends Controller
{
    use ResolvesSchool;

    // ---------------------------------------------------------------
    // Private helpers
    // ---------------------------------------------------------------

    private function pageContent(string $slug): ?string
    {
        if (! Schema::hasTable('pages')) {
            return null;
        }

        return Page::whereNull('school_id')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->value('content');
    }

    // ---------------------------------------------------------------
    // Public actions
    // ---------------------------------------------------------------

    public function home()
    {
        // Keep home assembled from partials so view-level updates (hero/principals/unit cards)
        // are reflected immediately instead of being overridden by CMS page HTML.
        $pageContent     = null;
        $yayasanSchool   = $this->resolveSchoolByType('yayasan');
        $homepage        = $yayasanSchool ? $this->resolveHomepageSettings($yayasanSchool->id) : null;

        $yayasanPrincipals = is_array($homepage?->yayasan_principals) ? $homepage->yayasan_principals : [];
        $yayasanPrincipals = collect($yayasanPrincipals)
            ->filter(fn($item) => is_array($item) && !empty($item['unit']))
            ->values()
            ->all();

        // Keep main hero messaging at foundation level (not tied to a specific unit).
        $heroTitle = 'Selamat Datang di Yayasan Putra Pakuan';
        $heroSubtitle = 'Menaungi pendidikan berkualitas dari SD, SMP, hingga SMK untuk membentuk generasi berakhlak, unggul, dan siap menghadapi masa depan.';

        $heroCta = $homepage?->cta_text ?: 'Daftar Sekarang';
        $heroCtaSecondary = $homepage?->cta_secondary_text ?: 'Tonton Video';

        $coreValues = is_array($homepage?->core_values)
            ? $homepage->core_values
            : [
                ['title' => 'Unggul', 'description' => 'Mencapai standar tertinggi dalam prestasi akademik dan karakter.'],
                ['title' => 'Intelektual', 'description' => 'Mengembangkan kemampuan berpikir kritis dan kreatif.'],
                ['title' => 'Bakat Sekolah', 'description' => 'Memupuk potensi dan keahlian unik setiap siswa.'],
            ];

        $unitSchools     = collect();
        $achievementItems = collect();
        $newsItems       = collect();

        if ($yayasanSchool) {
            $unitSchools = Cache::remember('yayasan.home.unit_schools', 300, function () {
                return School::whereRaw('LOWER(type) != ?', ['yayasan'])
                    ->orderBy('name')
                    ->get(['id', 'name', 'slug', 'type']);
            });

            if (Schema::hasTable('prestasis')) {
                $achievementItems = Cache::remember('yayasan.home.achievement_items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                    return Prestasi::where('school_id', $yayasanSchool->id)
                        ->where('status', 'published')
                        ->orderByDesc('featured')
                        ->orderByDesc('published_at')
                        ->take(6)
                        ->get();
                });
            }

            if (Schema::hasTable('news')) {
                $newsItems = Cache::remember('yayasan.home.news_items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                    return News::where('school_id', $yayasanSchool->id)
                        ->where('status', 'published')
                        ->orderByDesc('featured')
                        ->orderByDesc('published_at')
                        ->take(4)
                        ->get();
                });
            }
        }

        return view('yayasan/index', compact(
            'yayasanPrincipals',
            'pageContent',
            'unitSchools',
            'achievementItems',
            'newsItems',
            'homepage',
            'heroTitle',
            'heroSubtitle',
            'heroCta',
            'heroCtaSecondary',
            'coreValues'
        ));
    }

    public function about()
    {
        $pageContent     = $this->pageContent('yayasan-about');
        $yayasanSchool   = $this->resolveSchoolByType('yayasan');
        $homepage        = $yayasanSchool ? $this->resolveHomepageSettings($yayasanSchool->id) : null;
        $yayasanPrincipals = is_array($homepage?->yayasan_principals) ? $homepage->yayasan_principals : [];

        return view('yayasan/about', compact('yayasanPrincipals', 'pageContent'));
    }

    public function fasilitas()
    {
        $pageContent   = $this->pageContent('yayasan-fasilitas');
        $facilityItems = collect();

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        if ($yayasanSchool && Schema::hasTable('gallery_items')) {
            $facilityItems = Cache::remember('yayasan.fasilitas.items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                return GalleryItem::where('school_id', $yayasanSchool->id)
                    ->where('status', 'published')
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at')
                    ->get();
            });
        }

        return view('yayasan/fasilitas', compact('facilityItems', 'pageContent'));
    }

    public function akreditasi()
    {
        $pageContent    = $this->pageContent('yayasan-akreditasi');
        $prestasiItems  = collect();
        $akreditasiItems = collect();

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        if ($yayasanSchool && Schema::hasTable('prestasis')) {
            $prestasiItems = Cache::remember('yayasan.akreditasi.items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                return Prestasi::where('school_id', $yayasanSchool->id)
                    ->where('status', 'published')
                    ->orderByDesc('featured')
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at')
                    ->get();
            });

            $akreditasiItems = $prestasiItems->filter(function ($item) {
                $haystack = strtolower(trim(($item->category ?? '') . ' ' . ($item->title ?? '')));
                return str_contains($haystack, 'akreditasi');
            })->values();
        }

        return view('yayasan/prestasi', compact('prestasiItems', 'akreditasiItems', 'pageContent'));
    }

    public function prestasi()
    {
        $pageContent   = $this->pageContent('yayasan-prestasi');
        $prestasiItems = collect();

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        if ($yayasanSchool && Schema::hasTable('prestasis')) {
            $prestasiItems = Cache::remember('yayasan.prestasi.items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                return Prestasi::where('school_id', $yayasanSchool->id)
                    ->where('status', 'published')
                    ->orderByDesc('featured')
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at')
                    ->get();
            });
        }

        return view('yayasan/prestasi', compact('prestasiItems', 'pageContent'));
    }

    public function prestasiShow(string $slug)
    {
        if (! Schema::hasTable('prestasis')) {
            abort(404);
        }

        $prestasi = Cache::remember('yayasan.prestasi.detail.' . md5($slug), 120, function () use ($slug) {
            return Prestasi::where('slug', $slug)
                ->where('status', 'published')
                ->first();
        });

        if (! $prestasi) {
            abort(404);
        }

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        $related = collect();

        if ($yayasanSchool) {
            $related = Cache::remember('yayasan.prestasi.related.' . $prestasi->id, 120, function () use ($prestasi, $yayasanSchool) {
                $sameCategory = Prestasi::where('school_id', $yayasanSchool->id)
                    ->where('status', 'published')
                    ->where('id', '!=', $prestasi->id)
                    ->where('category', $prestasi->category)
                    ->orderByDesc('published_at')
                    ->limit(3)
                    ->get();

                if ($sameCategory->count() < 3) {
                    $extra = Prestasi::where('school_id', $yayasanSchool->id)
                        ->where('status', 'published')
                        ->where('id', '!=', $prestasi->id)
                        ->whereNotIn('id', $sameCategory->pluck('id'))
                        ->orderByDesc('featured')
                        ->orderByDesc('published_at')
                        ->limit(3 - $sameCategory->count())
                        ->get();
                    return $sameCategory->concat($extra);
                }

                return $sameCategory;
            });
        }

        return view('yayasan/prestasi-detail', compact('prestasi', 'related'));
    }

    public function berita()
    {
        $pageContent  = $this->pageContent('yayasan-berita');
        $newsItems    = collect();
        $featuredNews = null;

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        if ($yayasanSchool && Schema::hasTable('news')) {
            $newsItems = Cache::remember('yayasan.berita.items.' . $yayasanSchool->id, 120, function () use ($yayasanSchool) {
                return News::where('school_id', $yayasanSchool->id)
                    ->where('status', 'published')
                    ->orderByDesc('featured')
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at')
                    ->get();
            });

            $featuredNews = $newsItems->firstWhere('featured', true) ?? $newsItems->first();
        }

        return view('yayasan/berita', compact('newsItems', 'featuredNews', 'pageContent'));
    }

    public function beritaShow(string $slug)
    {
        if (! Schema::hasTable('news')) {
            abort(404);
        }

        $news = Cache::remember('yayasan.berita.detail.' . md5($slug), 120, function () use ($slug) {
            return News::where('slug', $slug)
                ->where('status', 'published')
                ->first();
        });

        if (! $news) {
            abort(404);
        }

        return view('yayasan/berita-detail', compact('news'));
    }

    public function kontak()
    {
        $pageContent = $this->pageContent('yayasan-kontak');
        $contactInfo = [
            'contact_whatsapp' => '6282112345678',
            'contact_email'    => 'info@putrapakuan.sch.id',
            'contact_phone'    => '+62 21 1234 5678',
            'contact_address'  => 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129',
            'contact_map_url'  => 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor',
        ];

        $yayasanSchool = $this->resolveSchoolByType('yayasan');
        $homepage      = $yayasanSchool ? $this->resolveHomepageSettings($yayasanSchool->id) : null;

        if ($homepage) {
            $contactInfo['contact_whatsapp'] = $homepage->contact_whatsapp ?: $contactInfo['contact_whatsapp'];
            $contactInfo['contact_email']    = $homepage->contact_email    ?: $contactInfo['contact_email'];
            $contactInfo['contact_phone']    = $homepage->contact_phone    ?: $contactInfo['contact_phone'];
            $contactInfo['contact_address']  = $homepage->contact_address  ?: $contactInfo['contact_address'];
            $contactInfo['contact_map_url']  = $homepage->contact_map_url  ?: $contactInfo['contact_map_url'];
        }

        $faqs = $yayasanSchool
            ? \App\Models\Faq::where('school_id', $yayasanSchool->id)->active()->orderBy('sort_order')->get()
            : collect();

        return view('yayasan/kontak', compact('pageContent', 'contactInfo', 'faqs'));
    }
}
