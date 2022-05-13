<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
   
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists('role')) {
            $value = $request->session()->get('role');
            if($value == 0)
                return $next($request);
        }
        return redirect('login');
    }
}
