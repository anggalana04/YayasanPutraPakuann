<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->string('unique_code', 10)->nullable()->unique()->after('application_id');
        });
    }

    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn('unique_code');
        });
    }
};
