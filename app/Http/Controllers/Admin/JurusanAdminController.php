<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SmkJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JurusanAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $jurusans = SmkJurusan::where('school_id', $school->id)
            ->orderBy('order_column')
            ->orderBy('id')
            ->get();

        return view('admin.superadmin.cms.unit.jurusan.index', [
            'schoolType' => 'smk',
            'school'     => $school,
            'jurusans'   => $jurusans,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        return view('admin.superadmin.cms.unit.jurusan.form', [
            'mode'       => 'create',
            'schoolType' => 'smk',
            'school'     => $school,
            'jurusan'    => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'short_name'   => ['nullable', 'string', 'max:50'],
            'tagline'      => ['nullable', 'string', 'max:500'],
            'description'  => ['nullable', 'string', 'max:2000'],
            'content'      => ['nullable', 'string'],
            'cover_image'  => ['nullable', 'image', 'max:2048'],
            'icon'         => ['nullable', 'string', 'max:100'],
            'accent_color' => ['nullable', 'string', 'max:50'],
            'order_column' => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $slug = $this->uniqueSlug(Str::slug($data['name']));

        $coverUrl = null;
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('jurusan/covers', 'public');
            $coverUrl = Storage::url($path);
        }

        SmkJurusan::create([
            'school_id'    => $school->id,
            'name'         => $data['name'],
            'short_name'   => $data['short_name'] ?? null,
            'slug'         => $slug,
            'tagline'      => $data['tagline'] ?? null,
            'description'  => $data['description'] ?? null,
            'content'      => $data['content'] ?? null,
            'cover_image_url' => $coverUrl,
            'icon'         => $data['icon'] ?? 'school',
            'accent_color' => $data['accent_color'] ?? '#f2cc0d',
            'order_column' => $data['order_column'] ?? 0,
            'is_active'    => isset($data['is_active']) ? (bool)$data['is_active'] : true,
        ]);

        return redirect()
            ->route('admin.cms.jurusan.index', ['schoolType' => 'smk'])
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(string $schoolType, SmkJurusan $jurusan)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        abort_unless($jurusan->school_id === $school->id, 404);

        return view('admin.superadmin.cms.unit.jurusan.form', [
            'mode'       => 'edit',
            'schoolType' => 'smk',
            'school'     => $school,
            'jurusan'    => $jurusan,
        ]);
    }

    public function update(Request $request, string $schoolType, SmkJurusan $jurusan)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        abort_unless($jurusan->school_id === $school->id, 404);

        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'short_name'   => ['nullable', 'string', 'max:50'],
            'tagline'      => ['nullable', 'string', 'max:500'],
            'description'  => ['nullable', 'string', 'max:2000'],
            'content'      => ['nullable', 'string'],
            'cover_image'  => ['nullable', 'image', 'max:2048'],
            'icon'         => ['nullable', 'string', 'max:100'],
            'accent_color' => ['nullable', 'string', 'max:50'],
            'order_column' => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable'],
        ]);

        if ($jurusan->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug(Str::slug($data['name']), $jurusan->id);
        }

        if ($request->hasFile('cover_image')) {
            // Remove old image
            if ($jurusan->cover_image_url) {
                $oldPath = str_replace('/storage/', '', parse_url($jurusan->cover_image_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('cover_image')->store('jurusan/covers', 'public');
            $data['cover_image_url'] = Storage::url($path);
        }

        $data['is_active'] = $request->boolean('is_active');

        unset($data['cover_image']);

        $jurusan->update($data);

        return redirect()
            ->route('admin.cms.jurusan.index', ['schoolType' => 'smk'])
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(string $schoolType, SmkJurusan $jurusan)
    {
        $this->abortUnlessAdmin();

        abort_unless(strtolower($schoolType) === 'smk', 404);

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        abort_unless($jurusan->school_id === $school->id, 404);

        if ($jurusan->cover_image_url) {
            $oldPath = str_replace('/storage/', '', parse_url($jurusan->cover_image_url, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
        }

        $jurusan->delete();

        return redirect()
            ->route('admin.cms.jurusan.index', ['schoolType' => 'smk'])
            ->with('success', 'Jurusan berhasil dihapus.');
    }

    /**
     * Handle image uploads from the Quill editor (AJAX).
     */
    public function uploadMedia(Request $request)
    {
        $this->abortUnlessAdmin();

        $request->validate([
            'file' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,mp4,webm,ogg,mp3,wav', 'max:20480'],
        ]);

        $path = $request->file('file')->store('jurusan/media', 'public');
        $url  = Storage::url($path);

        return response()->json(['url' => $url]);
    }

    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base;
        $i    = 1;

        while (
            SmkJurusan::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function abortUnlessAdmin(): void
    {
        $user = auth('admin')->user();
        if (! $user || ! $user->is_admin) {
            abort(403);
        }
    }
}
