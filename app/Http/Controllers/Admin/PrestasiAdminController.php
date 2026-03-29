<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrestasiAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $prestasi = Prestasi::where('school_id', $school->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.superadmin.cms.unit.prestasi.index', compact('schoolType', 'school', 'prestasi'));
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        return view('admin.superadmin.cms.unit.prestasi.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'prestasiItem' => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $slug = $this->generateUniqueSlug($validated['title'], $school->id);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $this->storeImage($request->file('image'), strtolower($schoolType), $slug);
        }

        $publishedAt = $validated['status'] === 'published' ? now() : null;

        Prestasi::create([
            'school_id' => $school->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'] ?? null,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'status' => $validated['status'],
            'published_at' => $publishedAt,
            'featured' => $validated['featured'] ?? false,
            'image_url' => $imageUrl,
            'created_by' => auth('admin')->user()->name ?? 'admin',
            'updated_by' => auth('admin')->user()->name ?? 'admin',
        ]);

        return redirect()->route('admin.cms.prestasi.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Prestasi berhasil dibuat.');
    }

    public function edit(string $schoolType, int $prestasi)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $prestasiItem = Prestasi::where('school_id', $school->id)->findOrFail($prestasi);

        return view('admin.superadmin.cms.unit.prestasi.form', [
            'mode' => 'edit',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'prestasiItem' => $prestasiItem,
        ]);
    }

    public function update(Request $request, string $schoolType, int $prestasi)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $prestasiItem = Prestasi::where('school_id', $school->id)->findOrFail($prestasi);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $prestasiItem->title = $validated['title'];
        $prestasiItem->category = $validated['category'] ?? null;
        $prestasiItem->excerpt = $validated['excerpt'] ?? null;
        $prestasiItem->content = $validated['content'];
        $prestasiItem->status = $validated['status'];
        $prestasiItem->featured = $validated['featured'] ?? false;
        $prestasiItem->slug = $this->generateUniqueSlug($validated['title'], $school->id, $prestasiItem->id);

        if ($request->hasFile('image')) {
            $prestasiItem->image_url = $this->storeImage($request->file('image'), strtolower($schoolType), $prestasiItem->slug);
        }

        if ($validated['status'] === 'published') {
            $prestasiItem->published_at = $prestasiItem->published_at ?? now();
        } else {
            $prestasiItem->published_at = null;
        }
        $prestasiItem->updated_by = auth('admin')->user()->name ?? 'admin';
        $prestasiItem->save();

        return redirect()->route('admin.cms.prestasi.edit', ['schoolType' => strtolower($schoolType), 'prestasi' => $prestasiItem->id])
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $prestasi)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $prestasiItem = Prestasi::where('school_id', $school->id)->findOrFail($prestasi);
        $prestasiItem->delete();

        return redirect()->route('admin.cms.prestasi.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    private function abortUnlessAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }
    }

    private function generateUniqueSlug(string $title, int $schoolId, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $i = 1;

        while (
            Prestasi::where('school_id', $schoolId)
            ->where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    private function storeImage($file, string $schoolTypeLower, string $slug): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = 'prestasi_' . $schoolTypeLower . '_' . Str::uuid()->toString() . '_' . $slug . '.' . $ext;

        $targetDir = public_path('images/cms/' . $schoolTypeLower . '/prestasi');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolTypeLower . '/prestasi/' . $filename;
    }
}
