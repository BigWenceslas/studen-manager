<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // User role
        $role = auth()->user()->roles()->pluck('name')[0];        
        
        // Check user role
        if($role == 'etudiant'){
            return abort(401);
        }
        return $next($request);
    }
}
