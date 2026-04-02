<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SchoolNewsController extends Controller
{
    public function index(Request $request, string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

        $category = $request->query('category');
        $page = max(1, (int) $request->query('page', 1));
        $cacheKey = 'school.news.index.' . strtolower($schoolTypeUpper) . '.' . $schoolModel->id . '.cat.' . md5((string) $category) . '.page.' . $page;

        $news = Cache::remember($cacheKey, 120, function () use ($schoolModel, $category, $page) {
            $query = Schema::hasTable('news')
                ? News::where('school_id', $schoolModel->id)->published()
                : News::whereRaw('1=0');

            if ($category) {
                $query->where('category', $category);
            }

            return $query
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->paginate(9, ['*'], 'page', $page);
        });

        // Derive featured news from the already-fetched page without an extra query
        $featuredNews = $news->getCollection()->firstWhere('featured', true)
            ?? $news->getCollection()->first();

        // If first page didn't have a featured item, do one targeted query
        if (!$featuredNews && $news->currentPage() > 1) {
            $featuredNews = News::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->first();
        }

        $categories = Cache::remember('school.news.categories.' . strtolower($schoolTypeUpper) . '.' . $schoolModel->id, 300, function () use ($schoolModel) {
            if (!Schema::hasTable('news')) {
                return collect();
            }

            return News::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->pluck('category')
                ->filter()
                ->unique()
                ->values();
        });

        $view = strtoupper($school) . '.berita.index';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'news' => $news,
            'featuredNews' => $featuredNews,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }

    public function show(string $school, string $slug)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

        if (!Schema::hasTable('news')) {
            abort(404);
        }

        $newsItem = News::where('school_id', $schoolModel->id)
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $view = strtoupper($school) . '.berita.detail';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'newsItem' => $newsItem,
        ]);
    }
}
