<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Shop::class;
    public function definition()
    {
        return [
            "nombre" => $this->faker->name,
            "poblacion" => $this->faker->randomElement([
                "Arenys de Mar", "Sabadell", "Manresa", "Terrassa", "Tárrega", "Igualada",
                "Castellbell i el Vilar", "Cerdanyola", "Callús"
            ]),
            'telefono' => $this->faker->regexify('[0-9]{10}'),
            'created_at' => now(),
        ];
    }
}
