<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdb_management_phases', function (Blueprint $table) {
            $table->boolean('is_live')->default(false)->after('status')->comment('Whether PPDB is accepting applications for this year');
        });
    }

    public function down(): void
    {
        Schema::table('ppdb_management_phases', function (Blueprint $table) {
            $table->dropColumn('is_live');
        });
    }
};
