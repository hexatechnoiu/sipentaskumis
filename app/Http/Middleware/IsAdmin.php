<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role !== 'Admin') {
            return redirect()->route('home')->with('kesalahan', "Pelanggaran <br>Anda tidak dapat mengakses halaman Admin!");
        }

        return $next($request);
    }
}
