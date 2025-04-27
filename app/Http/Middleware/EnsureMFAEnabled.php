<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureMFAEnabled
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->google2fa_secret) {
            return redirect()->route('google2fa.setup');
        }

        return $next($request);
    }
}