<?php
// Simple script to check applicant status
require 'bootstrap/app.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Now we have Laravel booted
use App\Models\PpdbApplication;
use App\Models\School;

$schoolModel = School::where('type', 'SMK')->first();
echo "School: " . $schoolModel->name . " (ID: " . $schoolModel->id . ")\n";

$applicant = PpdbApplication::where('application_id', 'SPMB-2026-71980')->first();

if (!$applicant) {
    echo "Applicant not found with that ID!\n";
    exit(1);
}

echo "\n=== APPLICANT DETAILS ===\n";
echo "ID: " . $applicant->id . "\n";
echo "Application ID: " . $applicant->application_id . "\n";
echo "Name: " . $applicant->full_name . "\n";
echo "Status: " . $applicant->status . "\n";
echo "Payment Method: " . $applicant->payment_method . "\n";
echo "Unique Code: " . ($applicant->unique_code ?? 'NONE') . "\n";
echo "School ID: " . $applicant->school_id . "\n";

echo "\n=== STATUS HISTORY ===\n";
$history = $applicant->status_history ?? [];
if (!empty($history)) {
    foreach ($history as $h) {
        echo json_encode($h) . "\n";
    }
} else {
    echo "No status history\n";
}

echo "\n=== WHAT VIEW SHOULD SHOW ===\n";
if ($applicant->unique_code) {
    echo "View Status: 'found' (green - Pembayaran Terverifikasi)\n";
} elseif ($applicant->status === 'payment_confirmed' || $applicant->status === 'payment_uploaded') {
    echo "View Status: 'confirmed' (green - Pembayaran Dikonfirmasi)\n";
} else {
    echo "View Status: 'pending' (amber - Pembayaran Sedang Diverifikasi)\n";
}

echo "\nAPPLICANT OBJECT:\n";
print_r($applicant->toArray());
