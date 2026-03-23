<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (! $user || ! $user->role) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->role->name === 'Super Admin' || $user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'You do not have access to this resource.');
    }
}
