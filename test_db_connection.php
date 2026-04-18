<?php
// Quick database connectivity test
require_once 'bootstrap/app.php';

try {
    // Boot Laravel
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

    // Test database connection
    $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Database connection: SUCCESS\n";

    // Test applicant query
    $applicant = \App\Models\PpdbApplication::where('application_id', 'SPMB-2026-71980')->first();

    if (!$applicant) {
        echo "❌ Applicant SPMB-2026-71980: NOT FOUND\n";
        exit(1);
    }

    echo "✅ Applicant found: " . $applicant->full_name . "\n";
    echo "   ID: " . $applicant->id . "\n";
    echo "   Status: " . $applicant->status . "\n";
    echo "   School ID: " . $applicant->school_id . "\n";
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
