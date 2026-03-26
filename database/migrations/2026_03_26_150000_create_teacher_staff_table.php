<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->string('name');
            $table->string('title'); // jabatan
            $table->string('department')->nullable(); // departemen/jurusan
            $table->text('bio')->nullable(); // biografi singkat
            $table->string('photo_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('type', ['teacher', 'staff', 'management'])->default('teacher'); // guru, staf, manajemen
            $table->integer('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_staff');
    }
};
