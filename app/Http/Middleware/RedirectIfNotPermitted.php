<?php

namespace Rebuy\Http\Middleware;

use Closure;

class RedirectIfNotPermitted {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->role != $role)
            return redirect('/');
        
        return $next($request);
    }
}
