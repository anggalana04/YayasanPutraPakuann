<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\School;
use App\Traits\ResolvesSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryAdminController extends Controller
{
    use ResolvesSchool;
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

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
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        return view('admin.superadmin.cms.unit.galeri.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $this->storeGalleryImage($request->file('image'), strtolower($schoolType));
        }

        $publishedAt = $validated['status'] === 'published' ? now() : null;

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

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.galeri.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(string $schoolType, int $id)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
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
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        $item = GalleryItem::where('school_id', $school->id)->findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $item->title = $validated['title'];
        $item->description = $validated['description'] ?? null;
        $item->status = $validated['status'];

        if ($request->hasFile('image')) {
            $this->deleteOldCmsFile($item->image_url);
            $item->image_url = $this->storeGalleryImage($request->file('image'), strtolower($schoolType));
        }

        if ($validated['status'] === 'published') {
            $item->published_at = $item->published_at ?? now();
        } else {
            $item->published_at = null;
        }
        $item->updated_by = auth('admin')->user()->name ?? 'admin';
        $item->save();

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.galeri.edit', ['schoolType' => strtolower($schoolType), 'id' => $item->id])
            ->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $id)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        $item = GalleryItem::where('school_id', $school->id)->findOrFail($id);
        $this->deleteOldCmsFile($item->image_url);
        $item->delete();

        $this->flushSchoolCache($school);

        return redirect()->route('admin.cms.galeri.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Item galeri berhasil dihapus.');
    }

    private function deleteOldCmsFile(?string $url): void
    {
        if (!$url) return;
        if (!str_starts_with($url, '/images/cms/')) return;
        $path = public_path(ltrim($url, '/'));
        if (file_exists($path)) {
            @unlink($path);
        }
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

    private function abortUnlessAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }
    }
}
