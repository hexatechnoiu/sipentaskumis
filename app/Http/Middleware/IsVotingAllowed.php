<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsVotingAllowed
{
    public function handle(Request $request, Closure $next): Response
    {
        if ((cache('settings')['is_voting_ended']['value'] ?? 'false') === 'true') {
            return redirect(route('vote_closed'));
        }

        return $next($request);
    }
}
