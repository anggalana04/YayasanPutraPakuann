<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->unsignedBigInteger('ppdb_application_id')->nullable();
            $table->foreign('ppdb_application_id')
                ->references('id')
                ->on('ppdb_applications')
                ->nullOnDelete();

            // Identity
            $table->string('nis', 20)->nullable();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('address')->nullable();
            $table->string('nisn', 20)->nullable();
            $table->string('previous_school')->nullable();

            // Academic
            $table->string('academic_year_entry', 10); // e.g. "2024/2025"
            $table->string('major', 20)->nullable();   // SMK: MPLB, AKL, TKJ, DKV, TKR, TSM
            $table->string('current_class', 10)->nullable(); // X, XI, XII / VII, VIII, IX / 1-6
            $table->string('class_room', 5)->nullable();     // A, B, C

            // Parent info (copied from PPDB on promote)
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('parent_salary_range')->nullable();

            // Status tracking
            $table->enum('enrollment_status', ['active', 'graduated', 'dropped', 'transferred'])
                ->default('active');
            $table->date('enrolled_at')->nullable();
            $table->date('graduated_at')->nullable();
            $table->date('dropped_at')->nullable();
            $table->text('notes')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['school_id', 'nis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
