<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\School;

class GalleryController extends Controller
{
    public function index(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        $filter = request('filter', 'all');

        $query = GalleryItem::where('school_id', $schoolModel->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        if ($filter !== 'all' && filled($filter)) {
            $query->where('description', 'like', '%' . $filter . '%');
        }

        $galleryItems = $query->paginate(6);

        $view = strtoupper($school) . '.galeri';

        return view($view, [
            'school' => $school,
            'schoolModel' => $schoolModel,
            'galleryItems' => $galleryItems,
            'filter' => $filter,
        ]);
    }

    public function loadMore(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        $filter = request('filter', 'all');
        $page = request('page', 2);

        $query = GalleryItem::where('school_id', $schoolModel->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        if ($filter !== 'all' && filled($filter)) {
            $query->where('description', 'like', '%' . $filter . '%');
        }

        $galleryItems = $query->paginate(6, ['*'], 'page', $page);

        return response()->json([
            'items' => $galleryItems->items(),
            'hasMore' => $galleryItems->hasMorePages(),
            'nextPage' => $galleryItems->currentPage() + 1,
        ]);
    }
}
