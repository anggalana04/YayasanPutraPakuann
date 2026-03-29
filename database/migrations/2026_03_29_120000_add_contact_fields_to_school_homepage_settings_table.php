<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->string('contact_whatsapp')->nullable()->after('kepsek_sambutan');
            $table->string('contact_email')->nullable()->after('contact_whatsapp');
            $table->string('contact_phone')->nullable()->after('contact_email');
            $table->text('contact_address')->nullable()->after('contact_phone');
            $table->string('contact_map_url')->nullable()->after('contact_address');
        });
    }

    public function down(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_whatsapp',
                'contact_email',
                'contact_phone',
                'contact_address',
                'contact_map_url',
            ]);
        });
    }
};
