<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Encargado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserEncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Encargado 1
        $usuario1 = User::create([
            'email' => 'miraflores@centroradiologico.com.pe',
            'username' => 'crdmiraflores',
            'password' => Hash::make('123456789'),
            //'dni' => '48090912',
            'rol' => 'encargado',
        ]);

        Encargado::create([
            'user_id' => $usuario1->id,
            'sede_id' => 1, //Miraflores
            'nombre' => 'Andres',
            'apellido' => 'Flores de la Puente',
            'email' => $usuario1->email,
            'celular' => '997890934',
            'rol' => 'encargado',
        ]);

        //Encargado 2
        $usuario2 = User::create([
            'email' => 'sanisidro@centroradiologico.com.pe',
            'username' => 'crdsanisidro',
            'password' => Hash::make('123456789'),
            //'dni' => '99990919',
            'rol' => 'encargado',
        ]);

        Encargado::create([
            'user_id' => $usuario2->id,
            'sede_id' => 2, //San Isidro
            'nombre' => 'Janury',
            'apellido' => 'Cedeño',
            'email' => $usuario2->email,
            'celular' => '997890434',
            'rol' => 'encargado',
        ]);

        //Encargado 3
        $usuario3 = User::create([
            'email' => 'losolivos@centroradiologico.com.pe',
            'username' => 'crdlosolivos',
            'password' => Hash::make('123456789'),
            //'dni' => '72866990',
            'rol' => 'encargado',
        ]);

        Encargado::create([
            'user_id' => $usuario3->id,
            'sede_id' => 3, //Los Olivos
            'nombre' => 'Ana Milagros',
            'apellido' => 'Solis',
            'email' => $usuario3->email,
            'celular' => '996890434',
            'rol' => 'encargado',
        ]);

        //Encargado 4
        $usuario4 = User::create([
            'email' => 'lamolina@centroradiologico.com.pe',
            'username' => 'crdlamolina',
            'password' => Hash::make('123456789'),
            //'dni' => '74709901',
            'rol' => 'encargado',
        ]);

        Encargado::create([
            'user_id' => $usuario4->id,
            'sede_id' => 4, //La Molina
            'nombre' => 'Sthefanny',
            'apellido' => 'Quillama',
            'email' => $usuario4->email,
            'celular' => '996800434',
            'rol' => 'encargado',
        ]);

        //Encargado 5
        $usuario5 = User::create([
            'email' => 'sjl@centroradiologico.com.pe',
            'username' => 'crdsjl',
            'password' => Hash::make('123456789'),
            //'dni' => '75001476',
            'rol' => 'encargado',
        ]);

        Encargado::create([
            'user_id' => $usuario5->id,
            'sede_id' => 5, //La Molina
            'nombre' => 'Clarita',
            'apellido' => 'Rey',
            'email' => $usuario5->email,
            'celular' => '996800034',
            'rol' => 'encargado',
        ]);
    }
}
