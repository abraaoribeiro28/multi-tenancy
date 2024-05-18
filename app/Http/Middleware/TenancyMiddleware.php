<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenancy;
use App\Tenancy\Connect;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenancyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenancy = Tenancy::whereDomain($request->tenancy.'.multi-tenancy.test')->firstOrFail();

        (new Connect($tenancy))->setDefault();

        return $next($request);
    }
}
