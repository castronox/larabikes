<?php
use App\Http\Controllers\BikeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete');             // Eliminar moto.php 


Route::resource('bikes', BikeController::class);

