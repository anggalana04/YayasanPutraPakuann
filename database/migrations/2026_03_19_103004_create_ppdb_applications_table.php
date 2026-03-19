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
        Schema::create('ppdb_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique(); // e.g., PPDB-2024-0001
            $table->string('school_type'); // sd, smp, smk
            $table->string('password'); // for login authentication

            // Personal Information
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->date('date_of_birth');
            $table->text('address');

            // Program Choices
            $table->string('first_choice_program')->nullable();
            $table->string('second_choice_program')->nullable();

            // Parent/Guardian Information
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();

            // Status tracking
            $table->enum('status', ['draft', 'biodata_completed', 'documents_uploaded', 'payment_pending', 'payment_completed', 'verified', 'interview_scheduled', 'accepted', 'rejected'])->default('draft');
            $table->json('status_history')->nullable(); // Track status changes

            // Documents
            $table->json('uploaded_documents')->nullable(); // Store document paths

            // Payment
            $table->decimal('payment_amount', 15, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable(); // Path to payment proof
            $table->timestamp('payment_date')->nullable();

            // Interview/Admission
            $table->timestamp('interview_date')->nullable();
            $table->text('interview_notes')->nullable();
            $table->timestamp('admission_date')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['school_type', 'status']);
            $table->index('application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_applications');
    }
};
