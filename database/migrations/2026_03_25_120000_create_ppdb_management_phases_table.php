<?php
// database/migrations/2026_03_25_120000_create_ppdb_management_phases_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ppdb_management_phases', function (Blueprint $table) {
            $table->id();
            $table->string('phase_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('upcoming'); // active, upcoming, finished
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_management_phases');
    }
};
