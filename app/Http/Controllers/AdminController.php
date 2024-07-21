<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    # Muestra la lista de usuarios
    public function userList()
    {
        $users = User::orderBy('name', 'ASC')
            ->paginate(config('pagination.users', 10));
        return view('admin.users.list', ['users' => $users]);
    }

    # Muestra un usuario
    public function userShow(User $user)
    {
        $bikes = $user->bikes; // Asumiendo que tienes una relación definida entre User y Bikes
        return view('admin.users.show', ['user' => $user, 'bikes' => $bikes]);
    }

    # Método para buscar usuarios 
    public function userSearch(Request $request)
    {
        $request->validate(['name' => 'max:32', 'email' => 'max:32']);

        # Toma todos los valores que llegan para nombre y email
        $name = $request->input('name', '');
        $email = $request->input('email', '');

        # Recupera los resultados, añadimos marca y modelo al paginador
        # para que haga bien los enlaces y se mantenga el filtro al pasar de página
        $users = User::orderBy('name', 'ASC')
            ->where('name', 'like', "%$name%")
            ->where('email', 'like', "%$name%")
            ->paginate(config('pagination.users'))
            ->appends(['name' => $name, 'email' => $email]);

        # Retorna la vista del filtro aplicado
        return view('admin.users.list', ['users' => $users, 'name' => $name, 'email' => $email]);
    }


    # Método para añadir roles a un usuario
    public function setRole(Request $request){

        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

        # Intenta añadir el rol
        try{
            $user->roles()->attach($role->id,[
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return back()
                ->with('success', "Rol $role->role añadido a $user->name correctamente");
        
        # Si no lo consigue, (use Illuminate\Database\QueryException)
        }catch(QueryException $e){
            return back()
                ->withErrors(" No se pudo añadir el rol de $role->role a $user->name.
                            Es posible que ya lo tenga.");
        }
    }



    public function deletedBikes()
    {

        # Recupera las motos
        $bikes = Bike::onlyTrashed()
            ->paginate(config('pagination.bikes', 10));

        # Carga la vista
        return view('admin.bikes.deleted', ['bikes' => $bikes]);

    }
}
