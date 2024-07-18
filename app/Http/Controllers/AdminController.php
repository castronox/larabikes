<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function deletedBikes(){

        # Recupera las motos
        $bikes = Bike::onlyTrashed()
                    ->paginate(config('pagination.bikes', 10));

        # Carga la vista
        return view('admin.bikes.deleted', ['bikes' => $bikes]);

    }
}
