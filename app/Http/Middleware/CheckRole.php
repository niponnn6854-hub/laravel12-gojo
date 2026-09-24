<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{

    public function handle($request, Closure $next, ...$roles)
    {
        // GET YOUR ROLE
        $your_role = $request->user()->role; 
        if (! in_array($your_role, $roles ,True)) {
            // Redirect if not allowed ...
            // return redirect('/');  
            // แสดงหน้า 403 เมื่อไม่มีสิทธิ์
            abort(403); 
        }

        return $next($request);

    }
}
