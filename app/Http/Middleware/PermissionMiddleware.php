<?php

namespace App\Http\Middleware;

use Spatie\Permission\Exceptions\UnauthorizedException;
use Closure;

use App\Models\Funcionario;
use App\User;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth:web,funcionario')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {

            if (app('auth:web,funcionario')->user()->can($permission)) {
                return $next($request);
            }

            // Se agrega esta condición para validar el tema de los permisos
            if (User::find(app('auth:web')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }

            if (Funcionario::find(app('auth:funcionario')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }

        }
        throw UnauthorizedException::forPermissions($permissions);
    }
}
