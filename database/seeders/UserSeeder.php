<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Clinica;
use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'rol' => 'administrador',
        ])->each(function (User $usuario) {
            Administrador::factory(1)->create([
                'user_id' => $usuario->id,
                'email' => $usuario->email,
            ]);
        });

        User::factory(5)->create([
            'rol' => 'odontologo',
        ])->each(function (User $usuario) {
            Odontologo::factory(1)->create([
                'user_id' => $usuario->id,
                'email' => $usuario->email,
            ]);
        });

        User::factory(5)->create([
            'rol' => 'clinica',
        ])->each(function (User $usuario) {
            Clinica::factory(1)->create([
                'user_id' => $usuario->id,
                'email' => $usuario->email,
            ]);
        });

        User::factory(5)->create([
            'rol' => 'paciente',
        ])->each(function (User $usuario) {
            Paciente::factory(1)->create([
                'user_id' => $usuario->id,
                'email' => $usuario->email,
            ]);
        });
    }
}
