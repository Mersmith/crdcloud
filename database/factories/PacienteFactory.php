<?php

namespace Database\Factories;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sede = Sede::all()->random();

        /*$odontologos_ids = DB::table('odontologos')->pluck('id')->toArray();
        $clinicas_ids = DB::table('clinicas')->pluck('id')->toArray();

        if ($this->faker->boolean()) {
            $odontologos_id = $this->faker->randomElement($odontologos_ids);
            $clinicas_id = null;
        }else{
            $odontologos_id = null;
            $clinicas_id = $this->faker->randomElement($clinicas_ids);
        }*/

        return [
            'sede_id' => $sede->id,
            //'odontologo_id' => $odontologos_id,
            //'clinica_id' => $clinicas_id,
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'celular' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->dateTimeInInterval('-3 months', '+1 months'),
            'genero' => $this->faker->randomElement(['hombre', 'mujer']),
            'rol' => "paciente",
        ];
    }
}
