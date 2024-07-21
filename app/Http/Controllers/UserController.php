<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    # Carga la vista para los uauarios bloqueados
    public function blocked(){
        return view('blocked');
    }
}
