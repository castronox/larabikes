<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, int $minimo)
    {
        $response =  $next($request);

        # Miramos si el usuario es mayor de edad
        if ($request->query('edad')<$minimo)
            abort(403, "Acceso denegado, debes ser mayor de edad para acceder a este contenido");

            # En realidad, cuando trengamnos el modelo User, podríamos comprobar la edad real del usuario:
            # if ($user->edad < 18).....

        return $response;
    }
}
