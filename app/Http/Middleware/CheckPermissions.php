<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Http\Request;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route)
    {
        if ($request->user()->role != 'superuser') {
            $role = Role::where('name', '=', $request->user()->role)->first();
            $permissions = $role->permissions;

            $permission = in_array($route, array_column($permissions, 'slug'));

            if (!$permission) {
                return response()->json(['message' => 'unauthorized'], 403);
            }
        }

        return $next($request);
    }
}
