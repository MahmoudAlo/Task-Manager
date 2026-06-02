<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\json;

class CheckUsersRole
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role === 'admin')
            return $next($request);

        return response()->json(['masseg' => 'access dinay'], 403);

    }
}
