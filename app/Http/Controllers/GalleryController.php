<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\School;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

        $filter = request('filter', 'all');
        $page = max(1, (int) request('page', 1));
        $cacheKey = 'school.gallery.index.' . strtolower($schoolTypeUpper) . '.' . $schoolModel->id . '.filter.' . md5((string) $filter) . '.page.' . $page;

        $galleryItems = Cache::remember($cacheKey, 120, function () use ($schoolModel, $filter, $page) {
            $query = GalleryItem::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at');

            if ($filter !== 'all' && filled($filter)) {
                $query->where('description', 'like', '%' . $filter . '%');
            }

            return $query->paginate(6, ['*'], 'page', $page);
        });

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
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

        $filter = request('filter', 'all');
        $page = request('page', 2);
        $cacheKey = 'school.gallery.load_more.' . strtolower($schoolTypeUpper) . '.' . $schoolModel->id . '.filter.' . md5((string) $filter) . '.page.' . $page;

        $galleryItems = Cache::remember($cacheKey, 120, function () use ($schoolModel, $filter, $page) {
            $query = GalleryItem::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at');

            if ($filter !== 'all' && filled($filter)) {
                $query->where('description', 'like', '%' . $filter . '%');
            }

            return $query->paginate(6, ['*'], 'page', $page);
        });

        return response()->json([
            'items' => $galleryItems->items(),
            'hasMore' => $galleryItems->hasMorePages(),
            'nextPage' => $galleryItems->currentPage() + 1,
        ]);
    }
}
