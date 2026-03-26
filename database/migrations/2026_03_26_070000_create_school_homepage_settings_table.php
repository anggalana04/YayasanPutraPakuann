<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_homepage_settings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id')->unique();

            $table->string('kepsek_photo_url')->nullable();
            $table->string('kepsek_name')->nullable();
            $table->string('kepsek_title')->nullable();
            $table->longText('kepsek_sambutan')->nullable();

            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_homepage_settings');
    }
};

