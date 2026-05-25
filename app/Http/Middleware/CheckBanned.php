<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout();
            return redirect()->route('login.form')->withErrors([
                'email' => 'Ваш аккаунт заблокирован.',
            ]);
        }

        return $next($request);
    }
}