<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Data falsa con Factory
        //Sede::factory(2)->create();

        $sedes = [
            [
                //'id' => 1,
                'nombre' => 'Miraflores',
                'direccion' => 'Av. José Pardo N° 138 Piso 3 Of. 306'
            ],
            [
                //'id' => 2,
                'nombre' => 'San Isidro',
                'direccion' => 'Av. Rivera Navarrete 765 Piso 4 Of. 41'
            ],
            [
                //'id' => 3,
                'nombre' => 'Los Olivos',
                'direccion' => 'Av Antúnez de Mayolo 1290 Piso 2 Of 202'
            ],
            [
                //'id' => 4,
                'nombre' => 'La Molina',
                'direccion' => 'Av. Javier Prado N° 5250 Piso 2 Of. 205'
            ],
            [
                //'id' => 5,
                'nombre' => 'San Juan de Lurigancho',
                'direccion' => 'Av. Gran Chimu N° 681 Piso 3 Of. 301'
            ],
        ];

        DB::table('sedes')->insert($sedes);
    }
}
