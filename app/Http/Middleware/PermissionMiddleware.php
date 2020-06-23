<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Log;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {

            if (app('auth')->user()->can($permission)) {
                return $next($request);
            }

            // Se agrega esta condición para validar el tema de los permisos
            if (User::find(app('auth')->user()->id)->permissions()->where('name', $permission)->count()) {
                return $next($request);
            }

        }
        throw UnauthorizedException::forPermissions($permissions);
    }
}
