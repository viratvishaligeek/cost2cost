<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $domain = $request->header('X-Tenant');

        if (!$domain) {
            return response()->json([
                'status' => 400,
                'message' => 'X-Tenant header missing',
            ], 400);
        }

        // Normalize header: lowercase, remove trailing slash, remove www.
        $normalizedDomain = strtolower($domain);
        $normalizedDomain = preg_replace('#^https?://#', '', $normalizedDomain); // remove http/https
        $normalizedDomain = preg_replace('#^www\.#', '', $normalizedDomain); // remove www
        $normalizedDomain = rtrim($normalizedDomain, '/'); // remove trailing slash

        // Fetch tenant from DB and normalize DB domains the same way
        $tenant = Tenant::get()->first(function ($t) use ($normalizedDomain) {
            $dbDomain = strtolower($t->domain);
            $dbDomain = preg_replace('#^https?://#', '', $dbDomain);
            $dbDomain = preg_replace('#^www\.#', '', $dbDomain);
            $dbDomain = rtrim($dbDomain, '/');
            return $dbDomain === $normalizedDomain;
        });

        if (!$tenant) {
            return response()->json([
                'status' => 404,
                'message' => 'Tenant not found',
            ], 404);
        }

        $request->merge(['tenant_id' => $tenant->id]);
        return $next($request);
    }
}
