<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            // Remove unique constraint on application_id since login_token is now the unique auth key
            $table->dropUnique('ppdb_applications_application_id_unique');
            // Add index for faster lookups without uniqueness
            $table->index('application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropIndex('ppdb_applications_application_id_index');
            $table->unique('application_id');
        });
    }
};
