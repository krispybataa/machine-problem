<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return response('Middleware is working!');
    }
}
