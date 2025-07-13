<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // e.g., team1.bizconnect.test
        $domain = explode('.', $host)[0];

        // Skip if on main domain
        if ($domain === 'bizconnect') {
            return $next($request);
        }

        $tenant = Tenant::where('domain', $domain)->first();

        if (! $tenant) {
            abort(404, 'Tenant not found');
        }

        // Share globally
        app()->instance('currentTenant', $tenant);

        return $next($request);
    }
}
