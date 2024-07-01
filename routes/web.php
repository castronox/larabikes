<?php
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


#CRUD DE MOTOS
# Para buscar motos por marca y / o modelo
Route::get('/bikes/search/{marca?}/{modelo?}',[BikeController::class, 'search'])
    ->name('bikes.search');

Route::resource('bikes', BikeController::class);

Route::get('/',[WelcomeController::class, 'index'])->name('portada');

# Formulario de confirmación de eliminación
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete');             // Eliminar moto.php 

    // #Ruta de FALLBACK
Route::fallback([WelcomeController::class, 'index']);


    #ZONA DE PRUEBAS

        // #Ruta con parametros variables
        // Route::get('test/{nombre}/{edad}', function ($nombre, $edad){
        //     return "Hola $nombre, tienes $edad años.";
        // });

        // #Ruta con parámetro variable
        // Route::get('test/{nombre}', function ($nombre){

        //     return "Hola $nombre, bienvenido al curso";
        // });


        // Route::get('test/create', function(){
        //     return "Intentas crear una nueva moto";
        // });


        // Route::get('test/{id}', function($id){
        //     return "Intentas visualizar la moto $id";
        // });


        // use App\Models\Bike;
        // # Ruta con dos parametros opcionales
        // Route::get(
        //     'bikes/search/{marca?}/{modelo?}',
        //     function($marca = '', $modelo=''){

        //         # Busca las motos con esa marca y modelo
        //         $bikes = Bike::where('marca', 'like', '%' .$marca . '%')
        //         ->where('modelo', 'like', '%' . $modelo . '%')
        //         ->paginate(config('pagination.bikes'));

        //         return view('bikes.list', ['bikes' => $bikes]);

        //     }
        // );


        // Route::get('test/{id}', function($id){
        //     return "Has accedido a la primera ruta";
        // })->where('id', '^\d{1,11}$'); // REGEX Para delimitar de uno a 11 dígitos

        // Route::get('test/{dni}', function($dni){
        //     return "Has accedido a la segunda ruta";
        // })->where('dni','^[\dXYZ]\d{7}[A-Z]$');     # REGEX para el dni.

        // Route::get('test/{otro}', function($otro){
        //     return "$otro no es un numero ni un DNI";
        // });

        
        
        // Route::get('test', function(){

        //     dd(Route::current());

        //     return "Aquí no vamos a llegar porque hay un dd antes";
        // });

        // Route::get('/bikes/chollos/{precio}', function($precio){
        //     return view ('bikes.list', ['bikes' => $precio]);
        // });