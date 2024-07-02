<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BikeController extends Controller
{
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
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes'
        ]);

        # Creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($request->all());

        # Redirección a los detalles de la moto creada
        return redirect()->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente");
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
    public function edit($bike)
    {
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
    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes'

        ]);


        # Actualiza
        $bike->update($request->all()+['matriculada'=>0]);

        # Carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada satisfactoriamente");
    }



    public function delete( Bike $bike){

        return view('bikes.delete', ['bike' => $bike]);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, Bike $bike)
    {

        # Comporobar la validez de la URL firmada
        if(!$request->hasValidSignature())
            abort (401, 'La firma URL no se pudo validar');

        #La borra de la base de datos 
        $bike->delete();

        # Redirige a la lista de motos
        return redirect ('bikes')
        ->with ('success', "Moto $bike->marca $bike->marca $bike->modelo eliminada.");
    }
}
