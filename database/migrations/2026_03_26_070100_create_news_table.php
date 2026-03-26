<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id');

            $table->string('title');
            $table->string('slug');
            $table->string('category')->nullable(); // e.g. Akademik, Event, Kebijakan, Kehidupan Siswa

            $table->string('image_url')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();

            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();

            $table->unique(['school_id', 'slug']);
            $table->index(['school_id', 'status', 'published_at']);

            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

