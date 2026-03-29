<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminHasAccess
{
    private function roleMap(): array
    {
        return [
            'smk_admin' => ['cms_type' => 'smk', 'slug' => 'smk-putra-pakuan'],
            'smp_admin' => ['cms_type' => 'smp', 'slug' => 'smp-putra-pakuan'],
            'sd_admin'  => ['cms_type' => 'sd',  'slug' => 'sdit-putra-pakuan'],
        ];
    }

    public function handle(Request $request, Closure $next): mixed
    {
        $user = Auth::guard('admin')->user();

        if (! $user) {
            return $next($request);
        }

        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        $allowed = $this->roleMap()[$user->admin_role] ?? null;

        if (! $allowed) {
            abort(403, 'Peran Anda tidak dikenali. Hubungi Superadmin.');
        }

        if ($request->is('admin/user-management') || $request->routeIs('admin.users.*') || $request->routeIs('admin.user_management')) {
            abort(403, 'Akses ditolak. Hanya Superadmin yang dapat mengelola akun admin.');
        }

        $cmsType = $request->route('schoolType');
        if ($cmsType !== null && $cmsType !== $allowed['cms_type']) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengelola CMS ' . strtoupper($allowed['cms_type']) . '.');
        }

        $schoolSlug = $request->route('school');
        if ($schoolSlug !== null && $schoolSlug !== $allowed['slug']) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengelola PPDB ' . $allowed['slug'] . '.');
        }

        return $next($request);
    }
}
