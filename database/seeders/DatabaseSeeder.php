<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\PpdbManagementPhase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Only create test user if it doesn't exist
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Superadmin user
        User::updateOrCreate([
            'email' => 'superadmin@putrapakuan.sch.id',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('superadmin123'), // Change after first login
            'is_admin' => true,
            'admin_role' => 'superadmin',
        ]);

        // Seed school units
        School::updateOrCreate([
            'slug' => 'smk-putra-pakuan',
        ], [
            'name' => 'SMK Putra Pakuan',
            'type' => 'SMK',
        ]);
        School::updateOrCreate([
            'slug' => 'sdit-putra-pakuan',
        ], [
            'name' => 'SDIT Putra Pakuan',
            'type' => 'SDIT',
        ]);
        School::updateOrCreate([
            'slug' => 'smp-putra-pakuan',
        ], [
            'name' => 'SMP Putra Pakuan',
            'type' => 'SMP',
        ]);
        School::updateOrCreate([
            'slug' => 'yayasan-putra-pakuan',
        ], [
            'name' => 'Yayasan Putra Pakuan',
            'type' => 'Yayasan',
        ]);

        // Seed PPDB Management Phases for each school
        $schools = School::all();
        foreach ($schools as $school) {
            PpdbManagementPhase::updateOrCreate([
                'school_id' => $school->id,
                'phase_name' => 'Early Bird',
            ], [
                'start_date' => '2024-03-01',
                'end_date' => '2024-04-15',
                'status' => 'active',
            ]);
            PpdbManagementPhase::updateOrCreate([
                'school_id' => $school->id,
                'phase_name' => 'Regular',
            ], [
                'start_date' => '2024-04-16',
                'end_date' => '2024-06-30',
                'status' => 'upcoming',
            ]);
            PpdbManagementPhase::updateOrCreate([
                'school_id' => $school->id,
                'phase_name' => 'Late Entry',
            ], [
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-15',
                'status' => 'upcoming',
            ]);
        }
    }
}
