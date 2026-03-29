<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Normalize legacy values so index-friendly equality filters remain correct.
        DB::table('ppdb_applications')
            ->whereNotNull('school_type')
            ->update(['school_type' => DB::raw('UPPER(school_type)')]);

        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->index(['school_type', 'status', 'created_at'], 'idx_ppdb_school_status_created_at');
            $table->index(['school_type', 'created_at'], 'idx_ppdb_school_created_at');
            $table->index(['school_type', 'admission_date'], 'idx_ppdb_school_admission_date');
            $table->index(['email'], 'idx_ppdb_email');
            $table->index(['nisn'], 'idx_ppdb_nisn');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->index(['school_id', 'status', 'featured', 'published_at'], 'idx_news_school_status_featured_pub');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->index(['school_id', 'status', 'published_at', 'created_at'], 'idx_gallery_school_status_pub_created');
        });

        Schema::table('prestasis', function (Blueprint $table) {
            $table->index(['school_id', 'status', 'featured', 'published_at'], 'idx_prestasi_school_status_featured_pub');
        });

        Schema::table('teacher_staff', function (Blueprint $table) {
            $table->index(['school_id', 'status', 'type', 'sort_order'], 'idx_teacher_school_status_type_sort');
        });

        Schema::table('carousel_images', function (Blueprint $table) {
            $table->index(['school_id', 'status', 'sort_order'], 'idx_carousel_school_status_sort');
        });

        Schema::table('ppdb_management_phases', function (Blueprint $table) {
            $table->index(['school_id', 'start_date', 'end_date'], 'idx_phase_school_dates');
            $table->index(['school_id', 'is_live', 'status'], 'idx_phase_school_live_status');
        });
    }

    public function down(): void
    {
        Schema::table('ppdb_management_phases', function (Blueprint $table) {
            $table->dropIndex('idx_phase_school_live_status');
            $table->dropIndex('idx_phase_school_dates');
        });

        Schema::table('carousel_images', function (Blueprint $table) {
            $table->dropIndex('idx_carousel_school_status_sort');
        });

        Schema::table('teacher_staff', function (Blueprint $table) {
            $table->dropIndex('idx_teacher_school_status_type_sort');
        });

        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropIndex('idx_prestasi_school_status_featured_pub');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropIndex('idx_gallery_school_status_pub_created');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('idx_news_school_status_featured_pub');
        });

        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropIndex('idx_ppdb_nisn');
            $table->dropIndex('idx_ppdb_email');
            $table->dropIndex('idx_ppdb_school_admission_date');
            $table->dropIndex('idx_ppdb_school_created_at');
            $table->dropIndex('idx_ppdb_school_status_created_at');
        });
    }
};
