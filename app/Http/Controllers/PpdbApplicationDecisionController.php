<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpdbApplication;
use Illuminate\Support\Facades\Validator;

class PpdbApplicationDecisionController extends Controller
{
    public function decide(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted_major_1,accepted_major_2,rejected',
            'note' => 'nullable|string|max:1000',
        ]);

        $applicant = PpdbApplication::findOrFail($id);
        $assignedMajor = null;
        if ($request->status === 'accepted_major_1') {
            $applicant->status = 'accepted';
            $assignedMajor = $applicant->major_1;
        } elseif ($request->status === 'accepted_major_2') {
            $applicant->status = 'accepted';
            $assignedMajor = $applicant->major_2;
        } elseif ($request->status === 'rejected') {
            $applicant->status = 'rejected';
            $assignedMajor = null;
        }
        $applicant->assigned_major = $assignedMajor;
        $applicant->admission_date = $applicant->status === 'accepted' ? now() : null;
        $applicant->save();
        // Optionally, save note to status_history or another field
        return response()->json([
            'success' => true,
            'status' => $applicant->status,
            'assigned_major' => $applicant->assigned_major,
            'admission_date' => $applicant->admission_date,
        ]);
    }
}
