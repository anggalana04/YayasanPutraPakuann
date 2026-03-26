<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
        $data['last_updated_by'] = auth()->user()->name ?? 'admin';
        $page->update($data);
        return redirect()->route('admin.cms.pages.index')->with('success', 'Page updated successfully.');
    }
}
