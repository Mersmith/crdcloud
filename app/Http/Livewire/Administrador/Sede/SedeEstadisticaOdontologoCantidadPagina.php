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
            ->select('sedes.id', 'sedes.nombre', DB::raw('COUNT(odontologo_sede.odontologo_id) as cantidad'))
            ->leftJoin('odontologo_sede', 'sedes.id', '=', 'odontologo_sede.sede_id')
            ->leftJoin('odontologos', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
            ->where('odontologos.rol', '=', 'odontologo')
            ->groupBy('sedes.id', 'sedes.nombre')
            ->orderBy('cantidad', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-odontologo-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
