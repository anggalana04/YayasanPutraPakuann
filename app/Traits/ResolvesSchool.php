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
        $normalizedType = strtoupper($type);

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
            Cache::forget('school.type.' . strtolower($school->type));
            Cache::forget('school.settings.' . $school->id);
        } else {
            // Flush all known types
            foreach (['yayasan', 'sd', 'smp', 'smk'] as $type) {
                Cache::forget('school.type.' . $type);
            }
        }
    }
}
