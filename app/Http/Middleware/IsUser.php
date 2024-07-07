<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'Admin') {
            return abort(403, 'Admin dilarang vote');
        }

        return $next($request);
    }
}
