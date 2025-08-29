<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (auth()->check()) {

            // Admin access
            if (auth()->user()->role === 'admin') {
                return $next($request);
            }

            // Customer access (redirect to booking dashboard or booking list)
            if (auth()->user()->role === 'user') {
                return redirect()->route('bookings.create')
                    ->with('success', 'You are logged in as a user.');
            }
        }

        // Not logged in or no access
        return redirect()->route('login')
            ->with('error', 'You do not have admin access.');
    }
}