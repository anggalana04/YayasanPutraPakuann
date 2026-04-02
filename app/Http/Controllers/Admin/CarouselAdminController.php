<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use App\Models\GalleryItem;
use App\Models\School;
use App\Traits\ResolvesSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CarouselAdminController extends Controller
{
    use ResolvesSchool;
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        if ($this->isYayasan($schoolType)) {
            $carouselImages = GalleryItem::where('school_id', $school->id)
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->paginate(10);

            return view('admin.superadmin.cms.unit.carousel.index', [
                'schoolType' => strtolower($schoolType),
                'school' => $school,
                'carouselImages' => $carouselImages,
                'isFacilityMode' => true,
            ]);
        }

        $carouselImages = CarouselImage::where('school_id', $school->id)
            ->ordered()
            ->paginate(10);

        return view('admin.superadmin.cms.unit.carousel.index', [
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'carouselImages' => $carouselImages,
            'isFacilityMode' => false,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        return view('admin.superadmin.cms.unit.carousel.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => null,
            'isFacilityMode' => $this->isYayasan($schoolType),
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        if ($this->isYayasan($schoolType)) {
            $validated = $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'nullable|string|max:350',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            GalleryItem::create([
                'school_id' => $school->id,
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'image_url' => $this->uploadFacilityImage($request->file('image'), strtolower($schoolType)),
                'status' => 'published',
                'published_at' => now(),
                'created_by' => auth('admin')->user()->name ?? 'System',
                'updated_by' => auth('admin')->user()->name ?? 'System',
            ]);

            $this->flushYayasanFacilityCache($school);

            return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
                ->with('success', 'Fasilitas Yayasan berhasil ditambahkan.');
        }

        $request->validate([
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:350',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:102400',
            'video_url' => 'nullable|url',
        ]);

        // At least one media source is required.
        if (!$request->hasFile('images') && !$request->hasFile('image') && !$request->hasFile('video') && !$request->input('video_url')) {
            return back()->withErrors(['media' => 'Silakan unggah gambar atau video atau masukkan video URL.']);
        }

        $baseData = [
            'title' => $request->input('title', 'Carousel Image'),
            'description' => $request->input('description', null),
            'sort_order' => $request->input('sort_order', 0),
            'status' => 'active',
            'video_url' => null,
            'image_url' => null,
        ];

        $baseData['school_id'] = $school->id;
        $baseData['created_by'] = auth('admin')->user()->name ?? 'System';

        if ($request->hasFile('video')) {
            $baseData['video_url'] = $this->uploadVideo($request->file('video'), $schoolType);
            $baseData['school_id'] = $school->id;
            $baseData['created_by'] = auth('admin')->user()->name ?? 'System';
            CarouselImage::create($baseData);
        } elseif ($request->input('video_url')) {
            $baseData['video_url'] = $request->input('video_url');
            $baseData['school_id'] = $school->id;
            $baseData['created_by'] = auth('admin')->user()->name ?? 'System';
            CarouselImage::create($baseData);
        } elseif ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $entry = $baseData;
                $entry['image_url'] = $this->uploadImage($file, $schoolType);
                $entry['sort_order'] = $index;
                $entry['school_id'] = $school->id;
                $entry['created_by'] = auth('admin')->user()->name ?? 'System';
                CarouselImage::create($entry);
            }
        } elseif ($request->hasFile('image')) {
            $baseData['image_url'] = $this->uploadImage($request->file('image'), $schoolType);
            $baseData['school_id'] = $school->id;
            $baseData['created_by'] = auth('admin')->user()->name ?? 'System';
            CarouselImage::create($baseData);
        }

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Gambar carousel berhasil ditambahkan.');
    }

    public function edit(string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        if ($this->isYayasan($schoolType)) {
            $item = GalleryItem::where('school_id', $school->id)->findOrFail($carousel);

            return view('admin.superadmin.cms.unit.carousel.form', [
                'mode' => 'edit',
                'schoolType' => strtolower($schoolType),
                'school' => $school,
                'item' => $item,
                'isFacilityMode' => true,
            ]);
        }

        $item = CarouselImage::findOrFail($carousel);

        // Ensure the carousel image belongs to the correct school
        if ($item->school_id !== $school->id) {
            abort(404);
        }

        return view('admin.superadmin.cms.unit.carousel.form', [
            'mode' => 'edit',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => $item,
            'isFacilityMode' => false,
        ]);
    }

    public function update(Request $request, string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        if ($this->isYayasan($schoolType)) {
            $item = GalleryItem::where('school_id', $school->id)->findOrFail($carousel);

            $validated = $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'nullable|string|max:350',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $item->title = $validated['title'];
            $item->description = $validated['description'] ?? null;
            $item->updated_by = auth('admin')->user()->name ?? 'System';
            $item->status = 'published';
            $item->published_at = $item->published_at ?? now();

            if ($request->hasFile('image')) {
                $this->deleteOldCmsFile($item->image_url);
                $item->image_url = $this->uploadFacilityImage($request->file('image'), strtolower($schoolType));
            }

            $item->save();
            $this->flushYayasanFacilityCache($school);

            return redirect()->route('admin.cms.carousel.edit', [
                'schoolType' => strtolower($schoolType),
                'carousel' => $item->id,
            ])->with('success', 'Fasilitas Yayasan berhasil diperbarui.');
        }

        $item = CarouselImage::findOrFail($carousel);

        // Ensure the carousel image belongs to the correct school
        if ($item->school_id !== $school->id) {
            abort(404);
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:20480',
            'video_url' => 'nullable|url',
        ]);

        $data = [
            'title' => $request->input('title') ?? $item->title ?? 'Carousel Image',
            'description' => $request->input('description') ?? $item->description,
            'updated_by' => auth('admin')->user()->name ?? 'System',
        ];

        if ($request->hasFile('video')) {
            $this->deleteOldCmsFile($item->video_url);
            $this->deleteOldCmsFile($item->image_url);
            $data['video_url'] = $this->uploadVideo($request->file('video'), $schoolType);
            $data['image_url'] = null;
        } elseif ($request->input('video_url')) {
            $this->deleteOldCmsFile($item->video_url);
            $this->deleteOldCmsFile($item->image_url);
            $data['video_url'] = $request->input('video_url');
            $data['image_url'] = null;
        } elseif ($request->hasFile('image')) {
            $this->deleteOldCmsFile($item->image_url);
            $this->deleteOldCmsFile($item->video_url);
            $data['image_url'] = $this->uploadImage($request->file('image'), $schoolType);
            $data['video_url'] = null;
        }

        $item->update($data);

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.carousel.edit', [
            'schoolType' => strtolower($schoolType),
            'carousel' => $item->id
        ])->with('success', 'Gambar carousel berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        if ($this->isYayasan($schoolType)) {
            $item = GalleryItem::where('school_id', $school->id)->findOrFail($carousel);
            $this->deleteOldCmsFile($item->image_url);
            $item->delete();
            $this->flushYayasanFacilityCache($school);

            return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
                ->with('success', 'Fasilitas Yayasan berhasil dihapus.');
        }

        $item = CarouselImage::findOrFail($carousel);

        // Ensure the carousel image belongs to the correct school
        if ($item->school_id !== $school->id) {
            abort(404);
        }

        $this->deleteOldCmsFile($item->image_url);
        $this->deleteOldCmsFile($item->video_url);
        $item->delete();

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Gambar carousel berhasil dihapus.');
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

    private function uploadImage($file, $schoolType)
    {
        $filename = 'carousel_' . $schoolType . '_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

        $targetDir = public_path('images/cms/' . $schoolType . '/carousel');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolType . '/carousel/' . $filename;
    }

    private function uploadFacilityImage($file, $schoolType)
    {
        $filename = 'fasilitas_' . $schoolType . '_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

        $targetDir = public_path('images/cms/' . $schoolType . '/fasilitas');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolType . '/fasilitas/' . $filename;
    }

    private function uploadVideo($file, $schoolType)
    {
        $filename = 'carousel_video_' . $schoolType . '_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

        $targetDir = public_path('videos/cms/' . $schoolType . '/carousel');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/videos/cms/' . $schoolType . '/carousel/' . $filename;
    }

    private function abortUnlessAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }
    }

    private function isYayasan(string $schoolType): bool
    {
        return strtolower($schoolType) === 'yayasan';
    }

    private function flushYayasanFacilityCache(School $school): void
    {
        Cache::forget('yayasan.fasilitas.items.' . $school->id);
    }
}
