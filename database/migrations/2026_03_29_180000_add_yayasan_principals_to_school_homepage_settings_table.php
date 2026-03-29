<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->json('yayasan_principals')->nullable()->after('contact_map_url');
        });
    }

    public function down(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->dropColumn('yayasan_principals');
        });
    }
};
