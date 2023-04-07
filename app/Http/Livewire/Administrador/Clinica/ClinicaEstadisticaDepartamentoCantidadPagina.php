<?php

namespace App\Http\Livewire\Administrador\Clinica;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClinicaEstadisticaDepartamentoCantidadPagina extends Component
{
    public $departamentos_clinicas_cantidad;

    public function mount()
    {
        $this->departamentos_clinicas_cantidad = DB::table('departamentos')
            ->leftJoin('direccions', 'departamentos.id', '=', 'direccions.departamento_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->select('departamentos.id', 'departamentos.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->where('odontologos.rol', '=', 'clinica')
            ->groupBy('departamentos.id', 'departamentos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-estadistica-departamento-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
