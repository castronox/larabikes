<?php

namespace App\Http\Controllers;

use App\Events\FirstBikeCreated;
use App\Models\Bike;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BikeRequest;
use App\Http\Requests\BikeUpdateRequest;
use App\Http\Requests\BikeDeleteRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

#use App\Http\Controllers\URL;
class BikeController extends Controller
{

    public function __construct(){
        # Ponemos el middleware auth a todos los metodos excepto:
        # Lista de motos
        # Detalles de la moto
        # Busqueda de motos
        $this->middleware('auth')->except('index', 'show', 'search');

        $this->middleware('throttle:3,1')->only('create');

        $this->middleware('verified')->except('index', 'show', 'search');

        $this->middleware('password.confirm')->only('destroy');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Recupera las motos de la BBDD usando el modelo
        # Ordenado por id descendente y paginación de 10 resultados por página
        $bikes = Bike::orderBy('id', 'DESC')->paginate(config('pagination.bikes', 10));

        # Total de motos en la BBDD ( para mostrar )
        # $total = Bike::count(); // Lo trsladamos a un viewcomposer

        #Carga la vista para el listado
        # La vista se llamará list.blade.php y que se encontrará en la carpeta bikes
        # a las vistas hay que pasarles los datos a modo de array asociativo
        return view('bikes.list', ['bikes'=>$bikes]);
    }

    public function search(Request $request, $marca = null, $modelo = null){

        #Toma los valores que llegan para marca y modelo 
        #Pueden llegar via URL o via Query STRING 
        #Por defecto le asignameros ''
        $marca = $marca ?? $request->input('marca', '');
        $modelo = $modelo ?? $request->input('modelo', '');


        #Recupera los resultados, se añade marca y modelo al paginador
        #Para que mantenga el filtro al pasar de página
        $bikes = Bike::where('marca', 'like', "%$marca%")
                    ->where('modelo', 'like', "%$modelo%")
                    ->paginate(config('paginator.bikes',5))
                    ->appends(['marca' => $marca, 'modelo' => $modelo]);
                    
        
        return view('bikes.list', [

            'bikes' => $bikes,
            'marca' => $marca,  # Para rellenar el input 'marca'
            'modelo' => $modelo # Para rellenar 'modelo'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bikes.create');
    }

    /**
     *Almacenar un recurso recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request)
    {

        # Recuperar datos del formulario excepto la imagen
        $datos = $request->only(['marca','modelo','precio','kms','matriculada', 'matricula', 'color']);

        # El valor por defecto para la imagen será NULL
        $datos +=['imagen' => NULL];

        # Recuperación de la imagen
        if($request->hasFile('imagen')){
                # Sube la imagen al directorio indicado en el fichero de config
                $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

                # Nos quedamos solo con el nombre del ficheropara añadirlo a la base de datos
                $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        # Recupera el id del usuario identificado y lo guarda en el user_id de la moto
        $datos['user_id'] = $request->user()->id; 

        
        # Creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($datos);

        # Si es la primera vez que se crea un moto el usuario
        # Para hacerlo bien, se debería hacer un campo en la BDD, puesto que así
        # cada vez que borre y cree la primera moto de activara este evento

        if($request->user()->bikes->count() == 1)
            FirstBikeCreated::dispatch($bike, $request->user());

        # Redirección a los detalles de la moto creada
        return redirect()
            ->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente.")
            ->cookie('lastInsertID', $bike->id, 0 );  # Adjuntamos una cookie.
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bike)
    {
        # Carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike' => $bike]);
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bike $bike)
    {

        # Autorización mediante policy 
        if ($request->user()->cant('update', $bike))
        abort(401, 'No puedes actualizar una moto que no es tuya');


        # Carga la vista con el formulario para modificar la moto
        return view('bikes.update', ['bike'=>$bike]);
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike)
    {
        // $request->validate([
        //     'marca' => 'required|max:255',
        //     'modelo' => 'required|max:255',
        //     'precio' => 'required|numeric',
        //     'kms' => 'required|integer',
        //     'matriculada' => 'required_with:matricula',
        //     'matricula' => 'required_if:matriculada,1|nullable|regex:/^\d{4}[B-Z]{3}$/i|unique:bikes|confirmed',
        //     'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
        //     'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:4096'

        // ]);

        // # Autorización mediante policy 
        //     if ($request->user()->cant('update', $bike))
        //         abort(401, 'No puedes actualizar una moto que no es tuya');

        # Toma los datos del formulario
        $datos = $request->only('marca', 'modelo' , 'kms', 'precio');
        
        # Estos datos no se pueden tomar directamente.
        $datos['matriculada'] = $request->has('matriculada') ? 1:0;
        $datos['matricula'] = $request->has('matriculada')? $request->input('matricula') : NULL;
        $datos['color'] = $request->input('color') ?? NULL;

        if($request->hasFile('imagen')){
            # Marcamos la imagen antigua para ser borrada si el update va bien
            if($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir') . '/' .$bike->imagen;

            # Sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            # Nos quedamos solo con el nombre de fichero para añadirlo a la BBDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);

        }

        # En caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarimagen') && $bike->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
        }

        # Al actualizar debemos tener en cuenta varias cosas:
        if($bike->update($datos)){
            if(isset($aBorrar))
                Storage::delete($aBorrar);  # Borramos foto antigua
        }else{ # Si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); # Borramos la foto nueva    
        }

        # Carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada satisfactoriamente");
    }



    public function delete(BikeDeleteRequest $request, Bike $bike){

        # Autorización mediante una GATE
        # Luego la comentaremos para hacer policy
        // if(Gate::denies('borrarMoto', $bike))
        //     abort(401, 'No puede borrar una moto que no es tuya.');

                # Autorización mediante policy 
                // if ($request->user()->cant('delete', $bike))
                // abort(401, 'No puedes borrar una moto que no es tuya');

        Session::put('returnTo', URL::previous());

        return view('bikes.delete', ['bike' => $bike]);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Bike $bike)
    {   

        # Parámetro : Request $request,
        # Comporobar la validez de la URL firmada
        // if(!$request->hasValidSignature())
        //     abort (401, 'La firma URL no se pudo validar');

        // if (Gate::denies('borrarMoto' , $bike))
        //     abort(401, 'No puedes borrar una moto que no es tuya.');

        # Autorización mediante policy 
        if ($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');

            $bike->delete();
        #La borra de la base de datos 
        #if( $bike->delete() && $bike->imagen)
        #Elimina el fichero
        #Storage::delete(config('filesystems.bikesImageDir'). '/' . $bike->imagen);

        # Redirige a la lista de motos
        #return redirect ('/bikes')
        #->with ('success', "Moto $bike->marca $bike->marca $bike->modelo eliminada.");

        # Comprobamos si hay que retornar a algún sitio en concreto
        $redirect = Session::has('returnTo') ?
                redirect(Session::get('returnTo')) :        # Por URL
                redirect()->route('bikes.index');           # Por nombre de ruta
    

    # Usaremos las url si hay parametros adicionales a tener en cuenta
    # por ejemplo, con la paginación va el número de la página y si usamos el nombre
    # Iremos al inicio de la lista y no a la página actual.

    Session::remove('returnTo');   # Borramos la var de session si la hubiera

    # Redirige a la operación anterior
    return $redirect->with('success', "Moto $bike->marca $bike->modelo eliminada.");
}

    public function restore(Request $request, int $id){

        # Recuperar la moto borrada
        $bike = Bike::withTrashed()->findOrFail($id);

        if($request->user()->cant('restore', $bike))
            throw new AuthorizationException("You shall not pass !!!");

            $bike->restore();   #Restaura la moto

        return back()->with(
            'success',
            "Moto $bike->marca $bike->modelo resturada correctamente"
        );    
    }

    public function purge(Request $request){
        
        # Recuperar la moto borrada
        $bike = Bike::withTrashed()->findOrFail($request->input('bike_id'));



        # Comprobar los permisos mediante la policy
        if($request->user()->cant('delete', $bike))
            throw new  AuthorizationException('No tienes permiso');

        # Si consigue eliminar definitivamente la moto y ésta tiene foto...
        if($bike->forceDelete() && $bike->imagen)
            # Borra también la foto
            Storage::delete(config('filesystems.bikesImageDir'). '/' . $bike->imagen);
        
        return back()->with(
            'success',
            "Moto $bike->marca $bike->modelo eliminada correctamente."
        );

    }

    

}
