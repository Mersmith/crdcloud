<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Tu consulta SQL
         $sql = "INSERT INTO `departamentos` (`id`, `nombre`) VALUES
         (1, 'AMAZONAS'),
         (2, 'ANCASH'),
         (3, 'APURIMAC'),
         (4, 'AREQUIPA'),
         (5, 'AYACUCHO'),
         (6, 'CAJAMARCA'),
         (7, 'CUSCO'),
         (8, 'HUANCAVELICA'),
         (9, 'HUANUCO'),
         (10, 'ICA'),
         (11, 'JUNIN'),
         (12, 'LA LIBERTAD'),
         (13, 'LAMBAYEQUE'),
         (14, 'LIMA'),
         (15, 'LORETO'),
         (16, 'MADRE DE DIOS'),
         (17, 'MOQUEGUA'),
         (18, 'PASCO'),
         (19, 'PIURA'),
         (20, 'PUNO'),
         (21, 'SAN MARTIN'),
         (22, 'TACNA'),
         (23, 'TUMBES'),
         (24, 'UCAYALI');";

        // Ejecutar la consulta
        DB::statement($sql);
    }
}
