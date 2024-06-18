<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $bikes = Bike::orderBy('id', 'DESC')->paginate(config('pagnation.bikes', 10));

        # Total de motos en la BBDD ( para mostrar )
        $total = Bike::count();

        #Carga la vista para el listado
        # La vista se llamará list.blade.php y que se encontrará en la carpeta bikes
        # a las vistas hay que pasarles los datos a modo de array asociativo
        return view('bikes.list', ['bikes' => $bikes, 'total' => $total]);
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
    public function show($id)
    {
        # Recupera la moto con el id deseado
        # Si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

        # Carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike' => $bike]);
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # Recupera la moto con el id deseado
        # Si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes'

        ]);

        # Recupera la moto de la BBDD
        $bike = Bike::findOrFail($id);

        # Actualiza
        $bike->update($request->all()+['matriculada'=>0]);

        # Carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada satisfactoriamente");
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # Busca la moto seleccionada 
        $bike = Bike::findOrFail($id);

        #La borra de la base de datos 
        $bike->delete();

        # Redirige a la lista de motos
        return resirect ('bikes')
        ->with ('success', "Moto $bike->marca $bike->marca $bike->modelo eliminada.");
    }
}
