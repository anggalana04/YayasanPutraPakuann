<?php

namespace App\Http\Controllers;

use App\Models\PpdbApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PpdbAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'application_id' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        $application = PpdbApplication::where('application_id', $request->application_id)->first();

        if (!$application) {
            return back()->withErrors(['application_id' => 'ID Pendaftaran tidak ditemukan.']);
        }

        if (!$application->canLogin()) {
            return back()->withErrors(['application_id' => 'Akun Anda belum dapat diakses.']);
        }

        // Check date of birth
        $inputDob = date('dmY', strtotime($request->date_of_birth));
        if ($application->password !== $inputDob) {
            return back()->withErrors(['date_of_birth' => 'Tanggal lahir tidak sesuai.']);
        }

        // Custom authentication for PPDB
        Auth::guard('ppdb_applications')->login($application);

        return redirect()->route('ppdb.dashboard', ['school' => $request->route('school')]);
    }

    public function logout(Request $request)
    {
        Auth::guard('ppdb_applications')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('school.ppdb', ['school' => $request->route('school')]);
    }

    public function dashboard(Request $request)
    {
        $application = Auth::guard('ppdb_applications')->user();

        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }

        $school = $request->route('school');
        return view('SMK.ppdb.dashboard', compact('application', 'school'));
    }
}
