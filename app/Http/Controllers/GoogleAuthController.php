<?php

namespace App\Http\Controllers;

use App\Models\PpdbApplication;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth.
     * Works for both the generic /auth/google/redirect (school defaults to 'smk')
     * and the per-school /{school}/auth/google/redirect routes.
     */
    public function redirect(?string $school = null): \Illuminate\Http\RedirectResponse
    {
        session(['ppdb_school' => $school ?? 'smk']);

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the OAuth callback.
     * Merged from two previously duplicated closures.
     */
    public function callback(?string $school = null): \Illuminate\Http\RedirectResponse
    {
        $school = $school ?? session('ppdb_school', 'smk');
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User',
                    'password' => bcrypt(uniqid()),
                ]
            );

            Auth::login($user);

            $generatedPpdbId = 'SPMB-' . date('Y') . '-' . strtoupper(substr(md5($user->email . $school), 0, 6));
            $generatedLoginToken = PpdbApplication::generateLoginToken();
            $ppdb = PpdbApplication::firstOrCreate(
                [
                    'email'     => $user->email,
                    'school_id' => $schoolModel->id,
                ],
                [
                    'full_name'      => $user->name,
                    'status'         => 'draft',
                    'application_id' => $generatedPpdbId,
                    'login_token'    => $generatedLoginToken,
                    'password'       => bcrypt(uniqid()),
                    'unique_code'    => $generatedPpdbId,
                    'assigned_major' => null,
                ]
            );

            if (! $ppdb->full_name)              $ppdb->full_name = $user->name;
            if (! $ppdb->application_id)         $ppdb->application_id = $generatedPpdbId;
            if (! $ppdb->login_token)            $ppdb->login_token = $generatedLoginToken;
            if (! $ppdb->password)               $ppdb->password = bcrypt(uniqid());
            if (! $ppdb->status)                 $ppdb->status = 'draft';
            if (! $ppdb->last_registration_step) $ppdb->last_registration_step = 'biodata';
            $ppdb->save();

            Auth::guard('ppdb_applications')->login($ppdb);

            $nextStep = $ppdb->last_registration_step;
            if (! $nextStep && $ppdb->status === 'draft') {
                $nextStep = 'biodata';
            }

            if ($nextStep && $nextStep !== 'done') {
                return match ($nextStep) {
                    'jurusan_berkas' => redirect()->route('ppdb.berkas',  ['school' => $school]),
                    default          => redirect()->route('ppdb.biodata', ['school' => $school]),
                };
            }

            return redirect()->route('ppdb.dashboard', ['school' => $school]);
        } catch (\Exception $e) {
            Log::error('Google OAuth callback error (school=' . $school . '): ' . $e->getMessage());

            return redirect()
                ->route('ppdb.login', ['school' => $school])
                ->withErrors(['google' => 'Gagal login dengan Google. Silakan coba lagi atau gunakan metode lain.']);
        }
    }
}
