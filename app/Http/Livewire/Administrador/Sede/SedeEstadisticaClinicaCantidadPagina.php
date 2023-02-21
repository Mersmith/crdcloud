<?php

namespace App\Http\Livewire\Administrador\Sede;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SedeEstadisticaClinicaCantidadPagina extends Component
{
    public $sede_clinica_cantidad;

    public function mount()
    {
        $this->sede_clinica_cantidad = DB::table('sedes')
            ->leftJoin('clinicas', 'sedes.id', '=', 'clinicas.sede_id')
            ->select('sedes.id', 'sedes.nombre', DB::raw('count(clinicas.id) as cantidad'))
            ->groupBy('sedes.id', 'sedes.nombre')
            ->orderBy('cantidad', 'asc')
            ->get();            
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-clinica-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
