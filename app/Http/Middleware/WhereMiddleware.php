<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WhereMiddleware
{

    public function handle(Request $request, Closure $next)
    {
       // return response()->json(['status' => 'ngga'], 401);
        //передача следующему посреднику
        return $next($request);
    }
}
