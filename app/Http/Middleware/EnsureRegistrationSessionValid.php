<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationSessionValid
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->expectsJson() && session()->missing('registration_data')) {
            return redirect()->route('register');
        }

        return $next($request);
    }
}
