<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClinicaEstadisticaDepartamentoListaPagina extends Component
{
    public $clinicas_provincias_cantidad;

    public function mount(Departamento $departamento)
    {
        $departamento_id = $departamento->id;

        $this->clinicas_provincias_cantidad = DB::table('provincias')
            ->leftJoin('departamentos', 'provincias.departamento_id', '=', 'departamentos.id')
            ->leftJoin('direccions', 'provincias.id', '=', 'direccions.provincia_id')
            ->leftJoin('clinicas', 'direccions.user_id', '=', 'clinicas.user_id')
            ->select('provincias.id', 'provincias.nombre', DB::raw('count(clinicas.user_id) as cantidad'))
            ->where('departamentos.id', '=', $departamento_id)
            ->groupBy('provincias.id', 'provincias.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-estadistica-departamento-lista-pagina')->layout('layouts.administrador.index');
    }
}
