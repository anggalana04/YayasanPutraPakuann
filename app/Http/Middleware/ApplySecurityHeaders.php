<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplySecurityHeaders
{
    /**
     * Add conservative security headers. These are disabled by default on local
     * environments to avoid disrupting current development flow.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        if (!config('security.headers_enabled', false)) {
            return $response;
        }

        $response->headers->set('X-Content-Type-Options', (string) config('security.x_content_type_options', 'nosniff'));
        $response->headers->set('X-Frame-Options', (string) config('security.x_frame_options', 'SAMEORIGIN'));
        $response->headers->set('Referrer-Policy', (string) config('security.referrer_policy', 'strict-origin-when-cross-origin'));
        $response->headers->set('Permissions-Policy', (string) config('security.permissions_policy', 'camera=(), microphone=(), geolocation=(), payment=()'));
        $response->headers->set('X-Permitted-Cross-Domain-Policies', (string) config('security.x_permitted_cross_domain_policies', 'none'));

        if ($csp = config('security.content_security_policy')) {
            $headerName = config('security.csp_report_only', false)
                ? 'Content-Security-Policy-Report-Only'
                : 'Content-Security-Policy';
            $response->headers->set($headerName, (string) $csp);
        }

        if ($request->isSecure() && config('security.hsts_enabled', false)) {
            $hsts = 'max-age=' . max(0, (int) config('security.hsts_max_age', 31536000));

            if (config('security.hsts_include_subdomains', true)) {
                $hsts .= '; includeSubDomains';
            }

            if (config('security.hsts_preload', false)) {
                $hsts .= '; preload';
            }

            $response->headers->set('Strict-Transport-Security', $hsts);
        }

        return $response;
    }
}
