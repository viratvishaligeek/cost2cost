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
        $host = $request->getHost();
        $tenant = Tenant::where('domain', 'LIKE', '%' . $host . '%')->first();
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
