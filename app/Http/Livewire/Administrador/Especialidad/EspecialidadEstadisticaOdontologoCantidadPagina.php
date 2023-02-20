<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EspecialidadEstadisticaOdontologoCantidadPagina extends Component
{
    public $especialidad_odontologo_cantidad;
    public function render()
    {
        $this->especialidad_odontologo_cantidad = DB::table('especialidads')
            ->leftJoin('odontologos', 'especialidads.id', '=', 'odontologos.especialidad_id')
            ->select('especialidads.id', 'especialidads.nombre', DB::raw('COUNT(odontologos.id) as cantidad'))
            ->groupBy('especialidads.id', 'especialidads.nombre')
            ->get();

            return view('livewire.administrador.especialidad.especialidad-estadistica-odontologo-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
