<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->string('assigned_major')->nullable()->after('major_2');
        });
    }

    public function down()
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn('assigned_major');
        });
    }
};
