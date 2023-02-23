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
                'nombre' => 'Anestesiología dental',
            ],
            [
                //'id' => 2,
                'nombre' => 'Odontología de salud pública',
            ],
            [
                //'id' => 3,
                'nombre' => 'Endodoncia',
            ],
            [
                //'id' => 4,
                'nombre' => 'Patología oral y maxilofacial',
            ],
            [
                //'id' => 5,
                'nombre' => 'Radiología oral y maxilofacial',
            ],
            [
                //'id' => 6,
                'nombre' => 'Cirugía oral y maxilofacial',
            ],
            [
                //'id' => 7,
                'nombre' => 'Medicina oral',
            ],
            [
                //'id' => 8,
                'nombre' => 'Ortodoncia',
            ],
            [
                //'id' => 9,
                'nombre' => 'Especialista en dolor orofacial',
            ],
            [
                //'id' => 10,
                'nombre' => 'Odontología pediátrica',
            ],
            [
                //'id' => 11,
                'nombre' => 'Periodoncia',
            ],
            [
                //'id' => 12,
                'nombre' => 'Prostodoncia',
            ],
            [
                //'id' => 13,
                'nombre' => 'Cirugía maxilofacial y oral',
            ],
            [
                //'id' => 14,
                'nombre' => 'Endodoncista o especialista en tratamientos de conducto',
            ],
            [
                //'id' => 15,
                'nombre' => 'Odontopediatría o dentista pediátrico',
            ],
            [
                //'id' => 16,
                'nombre' => 'Odontología general',
            ],
            [
                //'id' => 17,
                'nombre' => 'Ortopedia dentofacial',
            ],
            [
                //'id' => 18,
                'nombre' => 'Odontología protésica',
            ],
        ];

        DB::table('especialidads')->insert($especialidades);
    }
}
