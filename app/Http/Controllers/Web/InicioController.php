<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Distrito;
use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function __invoke()
    {
        /*$distritosConUsuarios = Distrito::with('direcciones.user')->get();

        foreach ($distritosConUsuarios as $distrito) {
            echo "Distrito: " . $distrito->nombre . PHP_EOL;
            echo "Usuarios: " . PHP_EOL;
            foreach ($distrito->direcciones as $direccion) {
                echo $direccion->user->nombre . PHP_EOL;
            }
        }*/

        $provincia_id = 1; // ID de la provincia de interés

$usuarios = User::whereHas('direcciones', function($query) use ($provincia_id) {
    $query->whereHas('distrito', function($query) use ($provincia_id) {
        $query->where('provincia_id', $provincia_id);
    });
})->with('direcciones.distrito', 'direcciones.usuarios')->get();


        return (dump($usuarios));
        //return view('web.inicio.index', compact('elementos'));
    }
}
