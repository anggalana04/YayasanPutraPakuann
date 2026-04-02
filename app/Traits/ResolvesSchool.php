<?php

namespace App\Traits;

use App\Models\School;
use App\Models\SchoolHomepageSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * Shared trait for controllers that need to look up a School and its
 * homepage settings.  Results are cached for 5 minutes to eliminate the
 * repeated `School::whereRaw('LOWER(type) = ?', [...])` pattern.
 */
trait ResolvesSchool
{
    protected function resolveSchoolByType(string $type): ?School
    {
        $key = 'school.type.' . strtolower($type);
        $normalizedType = School::resolveDbType($type);

        return Cache::remember($key, 300, function () use ($normalizedType) {
            if (! Schema::hasTable('schools')) {
                return null;
            }

            return School::where('type', $normalizedType)->first();
        });
    }

    protected function resolveHomepageSettings(int $schoolId): ?SchoolHomepageSetting
    {
        $key = 'school.settings.' . $schoolId;

        return Cache::remember($key, 300, function () use ($schoolId) {
            if (! Schema::hasTable('school_homepage_settings')) {
                return null;
            }

            return SchoolHomepageSetting::where('school_id', $schoolId)->first();
        });
    }

    /**
     * Flush all school-related cache entries after a CMS update.
     * Call this in any controller action that changes School or
     * SchoolHomepageSetting records.
     */
    protected function flushSchoolCache(?School $school = null): void
    {
        if ($school) {
            // Keys used by ResolvesSchool trait itself
            Cache::forget('school.type.' . strtolower($school->type));
            Cache::forget('school.settings.' . $school->id);

            // Keys used by SchoolHomeController (public-facing homepage).
            // SchoolHomeController uses the route slug (e.g. "sd" for SDIT),
            // so we must reverse-map the DB type to the slug here.
            $typeSlug = match (strtoupper($school->type)) {
                'SDIT' => 'sd',
                default => strtolower($school->type),
            };
            $prefix = 'school.home.' . $typeSlug . '.' . $school->id;
            Cache::forget($prefix . '.homepage');
            Cache::forget($prefix . '.latest_news');
            Cache::forget($prefix . '.latest_gallery');
            Cache::forget($prefix . '.carousel');
            Cache::forget($prefix . '.teachers');
            Cache::forget($prefix . '.ppdb');
            Cache::forget($prefix . '.phases');
            Cache::forget($prefix . '.prestasi');
        } else {
            // Flush all known types (both trait keys and public homepage keys)
            foreach (['yayasan', 'sd', 'smp', 'smk'] as $type) {
                Cache::forget('school.type.' . $type);
            }
            // Also flush SDIT's trait key (DB type is "SDIT", not "sd")
            Cache::forget('school.type.sdit');
        }
    }
}
