<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role1Middleware
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

        $arUser = Auth::user();
        $role = $arUser['id_phanquyen'];

        if($role == 1 ){
            return $next($request);
        }else{
            return redirect('errors.404');
        }
    }
}
