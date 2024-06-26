<?php

namespace App\View\Components;

use Illuminate\View\Component;
use PharIo\Manifest\ComponentElement;

class Alert extends Component{

    # Crea un nuevo componente instanciado. 
    public function __construct(){

        //
    }

    # Captura la vista / contiene la representación del Componente 

    public function render (){

        return view ('components.alert');
    }
}