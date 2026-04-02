<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smk_jurusans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->string('name');
            $table->string('short_name', 50)->nullable();
            $table->string('slug')->unique();
            $table->string('tagline', 500)->nullable();
            $table->text('description')->nullable(); // short for cards
            $table->longText('content')->nullable();  // Quill rich HTML
            $table->string('cover_image_url', 1000)->nullable();
            $table->string('icon', 100)->default('school');
            $table->string('accent_color', 50)->default('#f2cc0d');
            $table->unsignedInteger('order_column')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['school_id', 'is_active', 'order_column']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smk_jurusans');
    }
};
