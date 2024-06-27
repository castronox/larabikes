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
Route::resource('bikes', BikeController::class);

Route::get('/',[WelcomeController::class, 'index'])->name('portada');

#Ruta de FALLBACK
Route::fallback([WelcomeController::class, 'index']);

# Formulario de confirmación de eliminación
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete');             // Eliminar moto.php 








