<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class UserRolesMiddleware
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
        if ( Auth::user()->role == 'No Access') {
            return redirect('logout');
        }elseif(Auth::user()->role == 'Customer'){
            return redirect('/customer/');
        }else{
        return $next($request);
        }
    }
}
