<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Replace the denormalized school_type string column with a proper school_id FK.
     *
     * Steps:
     *  1. Add school_id (nullable) alongside school_type.
     *  2. Populate school_id by joining schools on type = school_type.
     *  3. Drop the old school_type-based composite indexes.
     *  4. Make school_id NOT NULL, add FK constraint and replacement indexes.
     *  5. Drop school_type column.
     */
    public function up(): void
    {
        // Step 1 – add nullable column next to application_id
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->nullable()->after('application_id');
        });

        // Step 2 – populate via JOIN (handles SDIT / SMP / SMK automatically)
        DB::statement('
            UPDATE ppdb_applications pa
            INNER JOIN schools s ON UPPER(s.type) = UPPER(pa.school_type)
            SET pa.school_id = s.id
        ');

        // Step 3 – drop the old school_type-keyed indexes before touching the column
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropIndex('idx_ppdb_school_status_created_at');
            $table->dropIndex('idx_ppdb_school_created_at');
            $table->dropIndex('idx_ppdb_school_admission_date');
        });

        // Step 4 – enforce NOT NULL, add FK, add replacement indexes
        DB::statement('ALTER TABLE ppdb_applications MODIFY school_id BIGINT UNSIGNED NOT NULL');

        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->foreign('school_id', 'fk_ppdb_applications_school_id')
                ->references('id')
                ->on('schools')
                ->restrictOnDelete();

            $table->index(['school_id', 'status', 'created_at'], 'idx_ppdb_school_status_created_at');
            $table->index(['school_id', 'created_at'],           'idx_ppdb_school_created_at');
            $table->index(['school_id', 'admission_date'],       'idx_ppdb_school_admission_date');
        });

        // Step 5 – remove the now-redundant string column
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn('school_type');
        });
    }

    public function down(): void
    {
        // Restore school_type from the school relationship
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->string('school_type')->nullable()->after('application_id');
        });

        DB::statement('
            UPDATE ppdb_applications pa
            INNER JOIN schools s ON s.id = pa.school_id
            SET pa.school_type = s.type
        ');

        DB::statement('ALTER TABLE ppdb_applications MODIFY school_type VARCHAR(255) NOT NULL');

        // Drop new FK and indexes, restore old indexes
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropIndex('idx_ppdb_school_status_created_at');
            $table->dropIndex('idx_ppdb_school_created_at');
            $table->dropIndex('idx_ppdb_school_admission_date');
            $table->dropForeign('fk_ppdb_applications_school_id');
            $table->dropColumn('school_id');

            $table->index(['school_type', 'status', 'created_at'], 'idx_ppdb_school_status_created_at');
            $table->index(['school_type', 'created_at'],           'idx_ppdb_school_created_at');
            $table->index(['school_type', 'admission_date'],       'idx_ppdb_school_admission_date');
        });
    }
};
