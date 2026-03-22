<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ppdb_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique();
            $table->string('school_type');
            $table->string('password');
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('nisn')->nullable();
            $table->decimal('average_grade', 5, 2)->nullable();
            $table->string('status')->default('draft');
            $table->json('status_history')->nullable();
            $table->json('uploaded_documents')->nullable();
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('interview_date')->nullable();
            $table->text('interview_notes')->nullable();
            $table->timestamp('admission_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('parent_salary_range')->nullable();
            $table->string('major_1')->nullable();
            $table->string('major_2')->nullable();
            $table->string('kk_file')->nullable();
            $table->string('ijazah_file')->nullable();
            $table->string('photo_file')->nullable();
            $table->string('raport_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_applications');
    }
};
