<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->admin) {
            abort(403, 'Acesso negado. Apenas administradores podem acessar esta área.');
        }

        return $next($request);
    }
}
