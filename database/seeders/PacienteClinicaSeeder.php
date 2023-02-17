<?php

namespace Database\Seeders;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = Paciente::all();
        $clinica = Clinica::all();

        foreach ($pacientes as $paciente) {
            $paciente->clinicas()->attach($clinica->random(rand(1,2))->pluck('id')->toArray());
        }
    }
}
