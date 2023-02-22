<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserAdministradorSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(DistritoSeeder::class);
        //$this->call(SedeSeeder::class);
        //$this->call(EspecialidadSeeder::class);
        //$this->call(UserSeeder::class);
        /*$this->call(ClinicaPacienteSeeder::class);
        $this->call(OdontologoPacienteSeeder::class);*/

        /*$this->call(DireccionSeeder::class);
        $this->call(ServicioSeeder::class);*/
    }
}
