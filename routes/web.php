<?php
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
#use App\Http\Middleware\EdgeRules;
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

Route::resource('bikes', BikeController::class);


# Para buscar motos por marca y / o modelo
Route::get('/bikes/search/{marca?}/{modelo?}',[BikeController::class, 'search'])
    ->name('bikes.search');

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


        # LARAVEL DIAPOSITIVA 15 PÁGINA 15
        // Route::get('test', function(){
        //         # Retorna el texto que se convertira en una response completa.
        //         return 'Hola mundo!!';
        // });


        # Laravel 15 | pág 17-18
        // Route::get('test', function(){
        //     # Retorna un array que se convertirá en una response JSON completa
        //     return [
        //         'nombre' => 'Cristian',
        //         'apellido' => 'Castro',
        //         'edad' => NULL,
        //         'vehiculo' => 'bicicleta',
        //         'dorsal' => 32
        //     ];
        // });

        
        
        # Laravel 15 | pág 28 
        // Route::get('test', function(){

        //     # Retorna un respuesta de texto, con código 200,
        //     # Y con múltiples encabezados
        //         return response('Anexando header', 200)

        //             ->withHeaders([

        //                 'Content-Type' => 'text/plain',
        //                 'From' => 'Cristian Castro',
        //                 'Place' => ' CIFO Sabadell',
        //                 'Year' => ' 2024'

        //             ]);

        // });

        
        
        # Laravel 15 | pág 32
        // Route::get('test',function(){

        //         return response()->make('Hola Mundo!', 200);

        // });


        # Laravel 15 | pág 33

        // Route::get('test', function(){
        //     # Retorna respuesta sin contenido.
        //     return response()->noContent(200);
        // });

        
        # Laravel 15 | pág 35
        // Route::get('test', function(){

        //     #Equivale a return view 
        //     return response()->view('welcome');

        // });

        
        
        // # Laravel 15 | pág 38-39
        // Route::get('test{bike}', function(App\Models\Bike $bike){

        //     return response()->json($bike);

        // });



        # Laravel 14 pág 54-55

        // Route::get('test', function(){

        //     return response()->download(
        //         public_path('images/bikes/moto_recien_estrenada.jpg'),
        //     );
        // });



        # Laravel 14 pág 56-57

        // Route::get('test', function(){

        //     return response()->download(
        //         storage_path('doc/IFCD45.pdf'),
        //         'programa.pdf',
        //         ['Content-type' => 'applicattion/pdf']
        //     );

        // });

        
        
        # Laravel 14  pág: 60-61
        // Route::get('test', function(){

        //     return response()->file(
        //         public_path('images/bikes/moto_recien_estrenada.jpg'),
        //         ['Content-type' => 'image/jpg']
        //     );

        // });



        
