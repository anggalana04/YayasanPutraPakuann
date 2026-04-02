<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn(['average_grade', 'interview_date', 'interview_notes']);
        });
    }

    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->decimal('average_grade', 5, 2)->nullable()->after('nisn');
            $table->timestamp('interview_date')->nullable()->after('payment_date');
            $table->text('interview_notes')->nullable()->after('interview_date');
        });
    }
};
