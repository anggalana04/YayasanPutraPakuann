<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function yayasanIndex()
    {
        $this->abortUnlessSuperAdmin();

        $this->ensureDefaultYayasanPages();

        $pages = Page::whereNull('school_id')
            ->where('slug', 'like', 'yayasan-%')
            ->orderBy('title')
            ->get();

        return view('admin.superadmin.cms.pages.index', compact('pages'));
    }

    public function yayasanEdit(Page $page)
    {
        $this->abortUnlessSuperAdmin();
        $this->abortUnlessYayasanPage($page);

        return view('admin.superadmin.cms.pages.edit', compact('page'));
    }

    public function yayasanUpdate(Request $request, Page $page)
    {
        $this->abortUnlessSuperAdmin();
        $this->abortUnlessYayasanPage($page);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_robots' => ['nullable', 'string', 'max:255'],
        ]);

        $data['last_updated_by'] = auth('admin')->user()->name ?? 'superadmin';
        $data['published_at'] = $data['status'] === 'published' ? ($page->published_at ?? now()) : null;

        $page->update($data);

        return redirect()
            ->route('admin.cms.yayasan.index')
            ->with('success', 'Konten halaman Yayasan berhasil diperbarui.');
    }

    public function index(Request $request)
    {
        $schoolType = $request->query('school');
        $pages = Page::when($schoolType, function ($query, $schoolType) {
            return $query->whereHas('school', function ($q) use ($schoolType) {
                $q->where('type', strtoupper($schoolType));
            });
        })->get();
        return view('admin.superadmin.cms.pages.index', compact('pages', 'schoolType'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.superadmin.cms.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'nullable',
            'status' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_robots' => 'nullable',
        ]);
        $data['last_updated_by'] = auth('admin')->user()->name ?? 'admin';
        $page->update($data);
        return redirect()->route('admin.cms.pages.index')->with('success', 'Page updated successfully.');
    }

    private function ensureDefaultYayasanPages(): void
    {
        $defaultPages = [
            ['title' => 'Beranda Yayasan', 'slug' => 'yayasan-home'],
            ['title' => 'Tentang Yayasan', 'slug' => 'yayasan-about'],
            ['title' => 'Fasilitas Yayasan', 'slug' => 'yayasan-fasilitas'],
            ['title' => 'Akreditasi Yayasan', 'slug' => 'yayasan-akreditasi'],
            ['title' => 'Berita Yayasan', 'slug' => 'yayasan-berita'],
            ['title' => 'Kontak Yayasan', 'slug' => 'yayasan-kontak'],
        ];

        foreach ($defaultPages as $item) {
            Page::firstOrCreate(
                ['slug' => $item['slug']],
                [
                    'school_id' => null,
                    'title' => $item['title'],
                    'content' => null,
                    'status' => 'draft',
                    'last_updated_by' => 'system',
                ]
            );
        }
    }

    private function abortUnlessYayasanPage(Page $page): void
    {
        if (!is_null($page->school_id) || !str_starts_with($page->slug, 'yayasan-')) {
            abort(404);
        }
    }

    private function abortUnlessSuperAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }
    }
}
