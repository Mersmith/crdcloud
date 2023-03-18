<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EspecialidadSedeEstadisticaOdontologoCantidadPagina extends Component
{
    public $especialidad_odontologo_cantidad;

    public function mount()
    {
        $sedeId = Auth::user()->encargado->sede->id;

        $this->especialidad_odontologo_cantidad = DB::table('especialidads')
        ->leftJoin('odontologos', function ($join) {
            $join->on('especialidads.id', '=', 'odontologos.especialidad_id')
                ->where('odontologos.rol', '=', 'odontologo'); // agregamos la condición aquí
        })
        ->leftJoin('odontologo_sede', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
        ->select('especialidads.id', 'especialidads.nombre', DB::raw('COUNT(DISTINCT odontologos.id) as cantidad'))
        ->where('odontologo_sede.sede_id', '=', $sedeId) // agregamos la condición de la sede
        ->groupBy('especialidads.id', 'especialidads.nombre')
        ->orderBy('cantidad', 'asc')
        ->get();
    }

    public function render()
    {
        return view('livewire.encargado.especialidad-sede.especialidad-sede-estadistica-odontologo-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
