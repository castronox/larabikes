<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Bike;

class BikeComposer {

    # Método que vincula la información a la vista

    public function compose(View $view){
        $view->with('total', Bike::count());
    }
}
