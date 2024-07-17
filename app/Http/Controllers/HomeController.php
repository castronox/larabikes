<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        # Recuperar las motos no borradas del usuario
        $bikes = $request->user()->bikes()
            ->paginate(config('pagination.bikes', 10));

        # Recuperar las motos borradas del usuario
        $deletedBikes = $request->user()->bikes()->onlyTrashed()->get();

        # Carga la vista de home pasándole las motos
        return view('home', ['bikes' => $bikes, 'deletedBikes' => $deletedBikes]);
    }
}
