<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
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
        if (!auth()->user()) {
            return response()->json(['message' => 'no activado'], 403);
        }
        $role = Role::where('id', '=', $request->user()->role_id)->first();
        $permissions = $role->permissions;

        if (in_array($route, $permissions)) {
            return response()->json(['message' => 'unauthorized'], 403);
        }

        return $next($request);
    }
}
