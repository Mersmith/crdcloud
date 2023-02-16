<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->sentence(2),
            'precio_venta' => $this->faker->randomElement([1000, 1200, 1400, 1500]),
            'descripcion' => $this->faker->text(),
            'puntos_ganar' => $this->faker->randomElement([4, 5, 10, 20, 30]),
            'puntos_canjeo' => $this->faker->randomElement([100, 200, 300, 400, 500]),
        ];
    }
}
