<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Administrador 1
        $usuario1 = User::create([
            'email' => 'master@crd.com',
            'username' => 'master',
            'password' => Hash::make('123456789'),
            'rol' => 'administrador',
        ]);

        Administrador::create([
            'user_id' => $usuario1->id,
            'nombre' => 'Tae',
            'apellido' => 'Young Kim',
            'email' => $usuario1->email,
            'rol' => 'administrador',
        ]);

        //Administrador 2
        $usuario2 = User::create([
            'email' => 'webmaster@crd.com',
            'username' => 'webmaster',
            'password' => Hash::make('123456789'),
            'rol' => 'administrador',
        ]);

        Administrador::create([
            'user_id' => $usuario2->id,
            'nombre' => 'Emerson Smith',
            'apellido' => 'Huallpa Zanabria',
            'email' => $usuario2->email,
            'rol' => 'administrador',
        ]);

        //Administrador 3
        $usuario3 = User::create([
            'email' => 'coordinador@crd.com',
            'username' => 'coordinador',
            'password' => Hash::make('123456789'),
            'rol' => 'administrador',
        ]);

        Administrador::create([
            'user_id' => $usuario3->id,
            'nombre' => 'Frank',
            'apellido' => 'Torres',
            'email' => $usuario3->email,
            'rol' => 'administrador',
        ]);
    }
}
