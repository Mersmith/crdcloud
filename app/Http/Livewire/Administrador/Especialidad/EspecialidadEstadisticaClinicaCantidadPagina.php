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
            ->leftJoin('odontologos', 'especialidads.id', '=', 'odontologos.especialidad_id')
            ->select('especialidads.id', 'especialidads.nombre', DB::raw('COUNT(odontologos.id) as cantidad'))
            ->where('odontologos.rol', '=', 'clinica')
            ->groupBy('especialidads.id', 'especialidads.nombre')
            ->orderBy('cantidad', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-estadistica-clinica-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
