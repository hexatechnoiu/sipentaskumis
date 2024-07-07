<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVoted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && auth()->user()->vote->where('organisasi', 'OSIS')->count() > 0) {
            if (auth()->user()->vote->where('organisasi', 'MPK')->count() > 0) {
                return redirect(route('gagal'));
            }

            return redirect(route('vote.mpk'));
        }

        return $next($request);
    }
}
