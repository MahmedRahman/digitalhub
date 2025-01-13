<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->type !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'غير مصرح لك بالوصول إلى هذه الصفحة'], 403);
            }
            return redirect()->route('home')->with('error', 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}
