<?php

/**
 * Direct database audit script for SPMB-2026-71980
 * Run with: php artisan tinker < audit_71980.php
 */

use App\Models\PpdbApplication;
use App\Models\School;

// Find the applicant
$applicant = PpdbApplication::where('application_id', 'SPMB-2026-71980')->first();

if (!$applicant) {
    echo "ERROR: Applicant SPMB-2026-71980 not found in database!\n";
    exit(1);
}

echo "=== APPLICANT DATABASE AUDIT ===\n";
echo "ID: {$applicant->id}\n";
echo "Application ID: {$applicant->application_id}\n";
echo "Full Name: {$applicant->full_name}\n";
echo "Phone: {$applicant->phone}\n";
echo "School ID: {$applicant->school_id}\n";

$school = School::find($applicant->school_id);
echo "School Name: {$school?->name}\n";
echo "School Type: {$school?->type}\n";

echo "\n=== PAYMENT STATUS ===\n";
echo "Current Status Column: [{$applicant->status}]\n";
echo "Payment Method: {$applicant->payment_method}\n";
echo "Unique Code: " . ($applicant->unique_code ?: 'NONE') . "\n";
echo "Payment Date: " . ($applicant->payment_date?->format('Y-m-d H:i:s') ?: 'NULL') . "\n";

echo "\n=== STATUS HISTORY ===\n";
$history = $applicant->status_history ?: [];
if (empty($history)) {
    echo "No history entries\n";
} else {
    foreach ($history as $idx => $entry) {
        echo "Entry $idx: " . json_encode($entry) . "\n";
    }
}

echo "\n=== WHAT CEK-KODE PAGE WOULD SHOW ===\n";
if ($applicant->unique_code) {
    echo "View Status: 'found' (green - Pembayaran Terverifikasi)\n";
    echo "Shows ID Pendaftaran and unique code\n";
} elseif ($applicant->status === 'payment_confirmed' || $applicant->status === 'payment_uploaded') {
    echo "View Status: 'confirmed' (green - Pembayaran Dikonfirmasi)\n";
    echo "Shows 'Pembayaran Dikonfirmasi!' message\n";
} else {
    echo "View Status: 'pending' (amber - Pembayaran Sedang Diverifikasi)\n";
    echo "Shows 'Pembayaran Sedang Diverifikasi' message\n";
}

echo "\n=== MANUAL FIX TEST ===\n";
echo "If you need to manually fix this, run:\n";
echo "UPDATE ppdb_applications SET status='payment_confirmed' WHERE id={$applicant->id};\n";
