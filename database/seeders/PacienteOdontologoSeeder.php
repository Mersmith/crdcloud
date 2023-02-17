<?php

namespace Database\Seeders;

use App\Models\Odontologo;
use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteOdontologoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = Paciente::all();
        $odontologo = Odontologo::all();

        foreach ($pacientes as $paciente) {
            $paciente->odontologos()->attach($odontologo->random(rand(1,2))->pluck('id')->toArray());
        }
    }
}
