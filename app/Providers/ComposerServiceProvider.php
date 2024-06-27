<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\BikeComposer;

class ComposerServiceProvider extends ServiceProvider {
    // SERVICIO DE REGISTRO
    public function register(){
        //
    }

    public function boot(){
        // Vincula el ViewComposer a la lista de listado
        View::composer('*', BikeComposer::class);
    }


}