<?php

namespace Database\Factories;

use App\Models\Sede;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Encargado>
 */
class EncargadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sedes = Sede::all();
        $sedesUnicas = Collection::make($sedes)->unique()->random(2);

        return [
            'sede_id' => $sedesUnicas->first()->id,
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'celular' => $this->faker->phoneNumber(),
            'rol' => "encargado",
        ];
    }
}
