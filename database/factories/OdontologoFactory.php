<?php

namespace Database\Factories;

use App\Models\Especialidad;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Odontologo>
 */
class OdontologoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $especialidad = Especialidad::all()->random();
        $sede = Sede::all()->random();

        return [
            'especialidad_id' => $especialidad->id,
            'sede_id' => $sede->id,
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->randomNumber(),
            'cop' => $this->faker->unique()->randomNumber(),
            'celular' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->dateTimeInInterval('-3 months', '+1 months'),
            'genero' => $this->faker->randomElement(['hombre', 'mujer']),
            'puntos' => $this->faker->randomElement([0, 20, 50, 70, 80, 100, 500]),
            'rol' => "odontologo",
        ];
    }
}
