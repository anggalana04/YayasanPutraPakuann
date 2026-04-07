<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();

        if ($user && ! $user->isSuperAdmin()) {
            return redirect()->route('admin.ppdb.management', ['school' => $user->getSchoolSlug()]);
        }

        return view('admin.superadmin.dashboard');
    }

    public function cmsIndex()
    {
        return redirect()->route('admin.cms.schools');
    }

    public function cmsSchools()
    {
        $user = Auth::guard('admin')->user();

        if ($user && ! $user->isSuperAdmin()) {
            return redirect(url('/admin/cms/' . $user->getCmsType()));
        }

        $schools = School::all();

        return view('admin.superadmin.cms.schools', compact('schools'));
    }

    public function ppdbSchools()
    {
        $user = Auth::guard('admin')->user();

        if ($user && ! $user->isSuperAdmin()) {
            return redirect()->route('admin.ppdb.management', ['school' => $user->getSchoolSlug()]);
        }

        $schools = School::whereRaw('LOWER(type) != ?', ['yayasan'])->get();

        return view('admin.superadmin.ppdb.schools', compact('schools'));
    }
}
