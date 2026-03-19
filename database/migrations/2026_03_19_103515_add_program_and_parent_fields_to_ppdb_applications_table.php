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
            $table->string('first_choice_program')->nullable()->after('nisn');
            $table->string('second_choice_program')->nullable()->after('first_choice_program');
            $table->string('parent_name')->nullable()->after('second_choice_program');
            $table->string('parent_phone')->nullable()->after('parent_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn(['first_choice_program', 'second_choice_program', 'parent_name', 'parent_phone']);
        });
    }
};
