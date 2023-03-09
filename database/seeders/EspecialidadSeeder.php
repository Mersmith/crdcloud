<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Data falsa con Factory
        //Especialidad::factory(1)->create();

        $especialidades = [
            [
                //'id' => 1,
                'nombre' => 'Ninguno',
            ],
            [
                //'id' => 2,
                'nombre' => 'Anestesiología dental',
            ],
            [
                //'id' => 3,
                'nombre' => 'Odontología de salud pública',
            ],
            [
                //'id' => 4,
                'nombre' => 'Endodoncia',
            ],
            [
                //'id' => 5,
                'nombre' => 'Patología oral y maxilofacial',
            ],
            [
                //'id' => 6,
                'nombre' => 'Radiología oral y maxilofacial',
            ],
            [
                //'id' => 7,
                'nombre' => 'Cirugía oral y maxilofacial',
            ],
            [
                //'id' => 8,
                'nombre' => 'Medicina oral',
            ],
            [
                //'id' => 9,
                'nombre' => 'Ortodoncia',
            ],
            [
                //'id' => 10,
                'nombre' => 'Especialista en dolor orofacial',
            ],
            [
                //'id' => 11,
                'nombre' => 'Odontología pediátrica',
            ],
            [
                //'id' => 12,
                'nombre' => 'Periodoncia',
            ],
            [
                //'id' => 13,
                'nombre' => 'Prostodoncia',
            ],
            [
                //'id' => 14,
                'nombre' => 'Cirugía maxilofacial y oral',
            ],
            [
                //'id' => 15,
                'nombre' => 'Endodoncista o especialista en tratamientos de conducto',
            ],
            [
                //'id' => 16,
                'nombre' => 'Odontopediatría o dentista pediátrico',
            ],
            [
                //'id' => 17,
                'nombre' => 'Odontología general',
            ],
            [
                //'id' => 18,
                'nombre' => 'Ortopedia dentofacial',
            ],
            [
                //'id' => 19,
                'nombre' => 'Odontología protésica',
            ],
            [
                //'id' => 50,
                'nombre' => 'Otro',
            ],
        ];

        DB::table('especialidads')->insert($especialidades);
    }
}
