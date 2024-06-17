<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bike;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        User::factory(50)->create(); // Crea 50 usuarios
        Bike::factory(200)->create(); // Crea 200 motos
    }
}
