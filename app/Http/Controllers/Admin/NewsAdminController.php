<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $news = News::where('school_id', $school->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.superadmin.cms.unit.news.index', [
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'news' => $news,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();

        return view('admin.superadmin.cms.unit.news.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'newsItem' => null,
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
            $imageUrl = $this->storeNewsImage($request->file('image'), strtolower($schoolType), $slug);
        }

        $publishedAt = $validated['status'] === 'published' ? now() : null;

        News::create([
            'school_id' => $school->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'] ?? null,
            'image_url' => $imageUrl,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'status' => $validated['status'],
            'published_at' => $publishedAt,
            'featured' => $validated['featured'] ?? false,
            'created_by' => auth('admin')->user()->name ?? 'admin',
            'updated_by' => auth('admin')->user()->name ?? 'admin',
        ]);

        return redirect()
            ->route('admin.cms.berita.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function edit(string $schoolType, int $news)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $newsItem = News::where('school_id', $school->id)->findOrFail($news);

        return view('admin.superadmin.cms.unit.news.form', [
            'mode' => 'edit',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'newsItem' => $newsItem,
        ]);
    }

    public function update(Request $request, string $schoolType, int $news)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $newsItem = News::where('school_id', $school->id)->findOrFail($news);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $newsItem->title = $validated['title'];
        $newsItem->category = $validated['category'] ?? null;
        $newsItem->excerpt = $validated['excerpt'] ?? null;
        $newsItem->content = $validated['content'];
        $newsItem->status = $validated['status'];
        $newsItem->featured = $validated['featured'] ?? false;

        $newsItem->slug = $this->generateUniqueSlug($validated['title'], $school->id, $newsItem->id);

        if ($request->hasFile('image')) {
            $newsItem->image_url = $this->storeNewsImage($request->file('image'), strtolower($schoolType), $newsItem->slug);
        }

        if ($validated['status'] === 'published') {
            $newsItem->published_at = $newsItem->published_at ?? now();
        } else {
            $newsItem->published_at = null;
        }
        $newsItem->updated_by = auth('admin')->user()->name ?? 'admin';
        $newsItem->save();

        return redirect()
            ->route('admin.cms.berita.edit', ['schoolType' => strtolower($schoolType), 'news' => $newsItem->id])
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $news)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $newsItem = News::where('school_id', $school->id)->findOrFail($news);

        $newsItem->delete();

        return redirect()
            ->route('admin.cms.berita.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleFeatured(string $schoolType, int $news)
    {
        $this->abortUnlessAdmin();

        $school = School::whereRaw('LOWER(type) = ?', [strtolower($schoolType)])->firstOrFail();
        $newsItem = News::where('school_id', $school->id)->findOrFail($news);

        $newsItem->featured = !$newsItem->featured;
        $newsItem->updated_by = auth('admin')->user()->name ?? 'admin';
        $newsItem->save();

        return redirect()
            ->route('admin.cms.berita.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Status fitur berita berhasil diperbarui.');
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
            News::where('school_id', $schoolId)
            ->where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    private function storeNewsImage(\Illuminate\Http\UploadedFile $file, string $schoolTypeLower, string $slug): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = 'news_' . $schoolTypeLower . '_' . Str::uuid()->toString() . '_' . $slug . '.' . $ext;

        $targetDir = public_path('images/cms/' . $schoolTypeLower . '/news');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolTypeLower . '/news/' . $filename;
    }
}
