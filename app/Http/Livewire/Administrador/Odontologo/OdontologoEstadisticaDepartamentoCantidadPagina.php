<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoEstadisticaDepartamentoCantidadPagina extends Component
{
    public $departamentos_odontologos_cantidad;

    public function mount()
    {
        $this->departamentos_odontologos_cantidad = DB::table('departamentos')
            ->leftJoin('direccions', 'departamentos.id', '=', 'direccions.departamento_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->select('departamentos.id', 'departamentos.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->groupBy('departamentos.id', 'departamentos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-estadistica-departamento-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
