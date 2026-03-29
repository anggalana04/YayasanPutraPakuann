<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserManagementController extends Controller
{
    public function index()
    {
        $allAdmins = User::where('is_admin', true)
            ->where('admin_role', '!=', 'superadmin')
            ->orderBy('name')
            ->get()
            ->groupBy('admin_role');

        return view('admin.superadmin.user_management', compact('allAdmins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'admin_role' => 'required|in:smk_admin,smp_admin,sd_admin',
        ]);

        User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => bcrypt($validated['password']),
            'is_admin'   => true,
            'admin_role' => $validated['admin_role'],
        ]);

        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.user_management')->with('error', 'Superadmin tidak dapat diubah.');
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = ['name' => $validated['name'], 'email' => $validated['email']];
        if (! empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.user_management')->with('error', 'Superadmin tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil dihapus.');
    }
}
