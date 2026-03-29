<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarouselAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        $carouselImages = CarouselImage::where('school_id', $school->id)
            ->ordered()
            ->paginate(10);

        return view('admin.superadmin.cms.unit.carousel.index', [
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'carouselImages' => $carouselImages,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        return view('admin.superadmin.cms.unit.carousel.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

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

        return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Gambar carousel berhasil ditambahkan.');
    }

    public function edit(string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

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
        ]);
    }

    public function update(Request $request, string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        $item = CarouselImage::findOrFail($carousel);

        // Ensure the carousel image belongs to the correct school
        if ($item->school_id !== $school->id) {
            abort(404);
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:102400',
            'video_url' => 'nullable|url',
        ]);

        $data = [
            'title' => $request->input('title', $item->title),
            'description' => $request->input('description', $item->description),
            'updated_by' => auth('admin')->user()->name ?? 'System',
        ];

        if ($request->hasFile('video')) {
            $data['video_url'] = $this->uploadVideo($request->file('video'), $schoolType);
            $data['image_url'] = null;
        } elseif ($request->input('video_url')) {
            $data['video_url'] = $request->input('video_url');
            $data['image_url'] = null;
        } elseif ($request->hasFile('image')) {
            $data['image_url'] = $this->uploadImage($request->file('image'), $schoolType);
            $data['video_url'] = null;
        }

        $item->update($data);

        return redirect()->route('admin.cms.carousel.edit', [
            'schoolType' => strtolower($schoolType),
            'carousel' => $item->id
        ])->with('success', 'Gambar carousel berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $carousel)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        $item = CarouselImage::findOrFail($carousel);

        // Ensure the carousel image belongs to the correct school
        if ($item->school_id !== $school->id) {
            abort(404);
        }

        $item->delete();

        return redirect()->route('admin.cms.carousel.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Gambar carousel berhasil dihapus.');
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
}
