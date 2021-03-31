<?php

namespace App\Http\Middleware\RequireJson;

use Closure;
use Illuminate\Http\Request;

class v3
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept','application/json');
        return $next($request);
    }
}
