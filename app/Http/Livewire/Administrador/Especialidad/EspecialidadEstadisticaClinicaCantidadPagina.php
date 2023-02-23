<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EspecialidadEstadisticaClinicaCantidadPagina extends Component
{
    public $especialidad_clinica_cantidad;

    public function mount()
    {
        $this->especialidad_clinica_cantidad = DB::table('especialidads')
            ->leftJoin('clinicas', 'especialidads.id', '=', 'clinicas.especialidad_id')
            ->select('especialidads.id', 'especialidads.nombre', DB::raw('COUNT(clinicas.id) as cantidad'))
            ->groupBy('especialidads.id', 'especialidads.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-estadistica-clinica-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
