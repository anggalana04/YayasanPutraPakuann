<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->string('payment_bank_name')->nullable()->after('contact_map_url');
            $table->string('payment_bank_account')->nullable()->after('payment_bank_name');
            $table->string('payment_bank_holder')->nullable()->after('payment_bank_account');
            $table->string('payment_ewallet_gopay')->nullable()->after('payment_bank_holder');
            $table->string('payment_ewallet_dana')->nullable()->after('payment_ewallet_gopay');
            $table->string('payment_ewallet_ovo')->nullable()->after('payment_ewallet_dana');
            $table->string('payment_ewallet_shopee')->nullable()->after('payment_ewallet_ovo');
            $table->decimal('payment_registration_fee', 10, 2)->nullable()->after('payment_ewallet_shopee');
        });
    }

    public function down(): void
    {
        Schema::table('school_homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_bank_name',
                'payment_bank_account',
                'payment_bank_holder',
                'payment_ewallet_gopay',
                'payment_ewallet_dana',
                'payment_ewallet_ovo',
                'payment_ewallet_shopee',
                'payment_registration_fee',
            ]);
        });
    }
};
