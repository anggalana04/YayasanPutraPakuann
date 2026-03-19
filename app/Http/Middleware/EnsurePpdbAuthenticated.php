<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePpdbAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('ppdb_applications')->check()) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }

        return $next($request);
    }
}
