<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpdbApplication;
use App\Models\School;

class PpdbApplicationDecisionController extends Controller
{
    private function applyDecision(PpdbApplication $applicant, string $status, ?string $note = null): array
    {
        $assignedMajor = null;
        $newStatus = null;

        // For SMP (general education), no major assignment
        $isSmp = ($applicant->school?->type ?? '') === 'SMP';

        if ($status === 'accepted_major_1' && !$isSmp) {
            $newStatus = 'accepted';
            $assignedMajor = $applicant->major_1;
        } elseif ($status === 'accepted_major_2' && !$isSmp) {
            $newStatus = 'accepted';
            $assignedMajor = $applicant->major_2;
        } elseif ($status === 'accepted') {
            $newStatus = 'accepted';
            $assignedMajor = null;
        } elseif ($status === 'rejected') {
            $newStatus = 'rejected';
            $assignedMajor = null;
        }

        $statusHistory = $applicant->status_history ?: [];
        $statusHistory[] = [
            'status' => $newStatus,
            'changed_at' => now()->toDateTimeString(),
            'note' => $note,
        ];

        $applicant->status = $newStatus;
        $applicant->assigned_major = $assignedMajor;
        $applicant->admission_date = $newStatus === 'accepted' ? now() : null;
        $applicant->status_history = $statusHistory;
        $applicant->save();

        return [
            'success' => true,
            'status' => $applicant->status,
            'assigned_major' => $applicant->assigned_major,
            'admission_date' => $applicant->admission_date,
        ];
    }

    public function decide(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted_major_1,accepted_major_2,accepted,rejected',
            'note' => 'nullable|string|max:1000',
        ]);

        $applicant = PpdbApplication::findOrFail($id);
        return response()->json($this->applyDecision($applicant, $request->status, $request->note));
    }

    public function decideBySchool(Request $request, string $school, int $id)
    {
        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();

        // SMP accepts only 'accepted' or 'rejected' (no major assignment)
        // SMK can accept 'accepted_major_1', 'accepted_major_2', 'accepted', or 'rejected'
        $allowedStatuses = strtoupper($school) === 'SMP'
            ? 'accepted,rejected'
            : 'accepted_major_1,accepted_major_2,accepted,rejected';

        $request->validate([
            'status' => 'required|in:' . $allowedStatuses,
            'note' => 'nullable|string|max:1000',
        ]);

        $applicant = PpdbApplication::findOrFail($id);

        // Validate that the applicant belongs to this school.
        if ($applicant->school_id !== $schoolModel->id) {
            abort(404);
        }

        return response()->json($this->applyDecision($applicant, $request->status, $request->note));
    }
}
