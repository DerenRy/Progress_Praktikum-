<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        foreach ($roles as $role) {
            if (Auth::check() && Auth::user()->role == $role) {
                return $next($request);
            }
        }
        // Tambahkan ini
        return redirect('/')->with('error', 'Unauthorized access');
    }
}