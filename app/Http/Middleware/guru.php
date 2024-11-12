<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class guru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         //kalo blm login langsung ke halaman login
         if (!Auth::check()) {
            return redirect()->route('login');
        }  

        $userRole = Auth::user()->role;

        //Admin
        if ($userRole == 1) {
            return redirect()->route('admin.dashboard');
        } 
        //Guru
        elseif ($userRole == 2) {
            return $next($request);
        }
        //Murid
        elseif ($userRole == 3) {
            return redirect()->route('dashboard');
        }
    }
}
