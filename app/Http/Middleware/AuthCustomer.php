<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCustomer
{
   
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists('role')) {
            $value = $request->session()->get('role');
            if($value == 2)
                return $next($request);
        }
        return redirect('login');
    }
}
