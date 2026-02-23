<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && empty(auth()->user()->role)) {
            return response()->view('waiting-approval');
        }

        return $next($request);
    }
}
