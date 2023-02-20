<?php

namespace App\Http\Livewire\Administrador\Sede;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SedeEstadisticaOdontologoCantidadPagina extends Component
{
    public $sede_odontologo_cantidad;

    public function mount()
    {
        $this->sede_odontologo_cantidad = DB::table('sedes')
        ->leftJoin('odontologos', 'sedes.id', '=', 'odontologos.sede_id')
        ->select('sedes.id', 'sedes.nombre', DB::raw('count(odontologos.id) as cantidad'))
        ->groupBy('sedes.id', 'sedes.nombre')
        ->get();
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-odontologo-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
