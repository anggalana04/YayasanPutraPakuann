<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SchoolNewsController extends Controller
{
    public function index(Request $request, string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        $category = $request->query('category');

        $newsQueryBase = Schema::hasTable('news')
            ? News::where('school_id', $schoolModel->id)->published()
            : News::whereRaw('1=0');

        $query = $newsQueryBase;
        if ($category) {
            $query->where('category', $category);
        }

        $news = $query
            ->orderByDesc('featured')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        $featuredNews = News::where('school_id', $schoolModel->id)
            ->where('status', 'published')
            ->where('featured', true)
            ->orderByDesc('published_at')
            ->first();

        if (!$featuredNews) {
            $featuredNews = News::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->first();
        }

        $categories = collect();
        if (Schema::hasTable('news')) {
            $categories = News::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->pluck('category')
                ->filter()
                ->unique()
                ->values();
        }

        $view = strtoupper($school) . '.berita.index';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'news' => $news,
            'featuredNews' => $featuredNews,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }

    public function show(string $school, int $news)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        if (!Schema::hasTable('news')) {
            abort(404);
        }

        $newsItem = News::where('school_id', $schoolModel->id)
            ->where('status', 'published')
            ->findOrFail($news);

        $view = strtoupper($school) . '.berita.detail';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'newsItem' => $newsItem,
        ]);
    }
}
