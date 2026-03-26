<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $galleryItems = GalleryItem::where('school_id', $school->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.superadmin.cms.unit.galeri.index', [
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'galleryItems' => $galleryItems,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        return view('admin.superadmin.cms.unit.galeri.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'image' => ['required', 'image', 'max:8192'],
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $this->storeGalleryImage($request->file('image'), strtolower($schoolType));
        }

        $publishedAt = $validated['published_at'] ?? null;
        if ($validated['status'] === 'published' && !$publishedAt) {
            $publishedAt = now();
        }

        GalleryItem::create([
            'school_id' => $school->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image_url' => $imageUrl,
            'status' => $validated['status'],
            'published_at' => $publishedAt,
            'created_by' => auth('admin')->user()->name ?? 'admin',
            'updated_by' => auth('admin')->user()->name ?? 'admin',
        ]);

        return redirect()->route('admin.cms.galeri.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(string $schoolType, int $id)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();
        $item = GalleryItem::where('school_id', $school->id)->findOrFail($id);

        return view('admin.superadmin.cms.unit.galeri.form', [
            'mode' => 'edit',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => $item,
        ]);
    }

    public function update(Request $request, string $schoolType, int $id)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();
        $item = GalleryItem::where('school_id', $school->id)->findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:8192'],
        ]);

        $item->title = $validated['title'];
        $item->description = $validated['description'] ?? null;
        $item->status = $validated['status'];

        if ($request->hasFile('image')) {
            $item->image_url = $this->storeGalleryImage($request->file('image'), strtolower($schoolType));
        }

        $publishedAt = $validated['published_at'] ?? null;
        if ($validated['status'] === 'published' && !$publishedAt) {
            $publishedAt = now();
        }

        $item->published_at = $publishedAt;
        $item->updated_by = auth('admin')->user()->name ?? 'admin';
        $item->save();

        return redirect()->route('admin.cms.galeri.edit', ['schoolType' => strtolower($schoolType), 'id' => $item->id])
            ->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $id)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();
        $item = GalleryItem::where('school_id', $school->id)->findOrFail($id);
        $item->delete();

        return redirect()->route('admin.cms.galeri.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Item galeri berhasil dihapus.');
    }

    private function storeGalleryImage(\Illuminate\Http\UploadedFile $file, string $schoolTypeLower): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = 'galeri_' . $schoolTypeLower . '_' . Str::uuid()->toString() . '.' . $ext;

        $targetDir = public_path('images/cms/' . $schoolTypeLower . '/galeri');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolTypeLower . '/galeri/' . $filename;
    }

    private function abortUnlessSuperAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403);
        }
    }
}
