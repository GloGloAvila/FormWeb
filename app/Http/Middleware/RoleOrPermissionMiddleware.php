<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Log;

class RoleOrPermissionMiddleware
{
    public function handle($request, Closure $next, $roleOrPermission)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        // Se agrega este ciclo para validar el tema de los permisos
        foreach ($rolesOrPermissions as $permission) {
            if (User::find(app('auth')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }
        }

        if (!Auth::user()->hasAnyRole($rolesOrPermissions) && !Auth::user()->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }


        return $next($request);
    }
}
