<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EspecialidadEstadisticaOdontologoCantidadPagina extends Component
{
    public $especialidad_odontologo_cantidad;

    public function mount()
    {
        $this->especialidad_odontologo_cantidad = DB::table('especialidads')
            ->leftJoin('odontologos', 'especialidads.id', '=', 'odontologos.especialidad_id')
            ->select('especialidads.id', 'especialidads.nombre', DB::raw('COUNT(odontologos.id) as cantidad'))
            ->groupBy('especialidads.id', 'especialidads.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-estadistica-odontologo-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
