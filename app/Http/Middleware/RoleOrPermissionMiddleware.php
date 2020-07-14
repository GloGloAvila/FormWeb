<?php

namespace App\Http\Middleware;

use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use Closure;

use App\Models\Funcionario;
use App\User;

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

            if (User::find(app('auth:web')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }

            if (Funcionario::find(app('auth:web')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }
        }

        if (!Auth::user()->hasAnyRole($rolesOrPermissions) && !Auth::user()->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }

        return $next($request);
    }
}
