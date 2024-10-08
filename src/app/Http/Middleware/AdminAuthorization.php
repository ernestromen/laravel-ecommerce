<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userTypeId = Auth::user() ?  Auth::user()->roles()->first()->id : '';
        if(!is_null($user = Auth::user()) && $userTypeId == '1'){
            return $next($request);
        }else{
            return redirect("/");
        }
    }
}