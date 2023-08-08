<?php

namespace App\Http\Middleware;

use App\Traits\JSONResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    use JSONResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == "SuperAdmin") {
            return $next($request);
        } else {
            return $this->jsonResponse(403, null, 'Unauthorized', null);
        }
    }
}
