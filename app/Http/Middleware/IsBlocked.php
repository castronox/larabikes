<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; // Importar el facade Route

class IsBlocked
{
    # CONFIGURABLE: Nombre de rutas web permitidas para los usuarios bloqueados
    # Podríamos sacarlas hacia el fichero de configuración (p.e /config/users.php)
    # permitiremos las operaciones de contacto, logout y user.blocked (evita loop)

    protected $allowed = ['contacto', 'contacto.email', 'user.blocked', 'user.blocked', 'logout'];

    # Maneja la petición entrante
    public function handle(Request $request, Closure $next){
        $user = $request->user();               # Toma el usuario identificado
        $ruta = Route::currentRouteName();      # Toma el nombre de la ruta

        # Si hay un usuario, está bloqueade e intenta acceder a una ruta no permitida.
        # le llevamos la ruta de bloqueo.

        if($user && $user->hasRole('bloqueado') && !in_array($ruta, $this->allowed))
            return redirect()->route('user.blocked');
        return $next($request);
    }
}
