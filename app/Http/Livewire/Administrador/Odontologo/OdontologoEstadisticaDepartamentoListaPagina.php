<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoEstadisticaDepartamentoListaPagina extends Component
{
    public $odontologos_departamentos, $odontologos_provincias_cantidad;

    public function mount(Departamento $departamento)
    {
        $departamento_id = $departamento->id;

        $this->odontologos_provincias_cantidad = DB::table('provincias')
            ->leftJoin('departamentos', 'provincias.departamento_id', '=', 'departamentos.id')
            ->leftJoin('direccions', 'provincias.id', '=', 'direccions.provincia_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->where('odontologos.rol', '=', 'odontologo')
            ->where('departamentos.id', '=', $departamento_id)
            ->select('provincias.id', 'provincias.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->groupBy('provincias.id', 'provincias.nombre')
            ->get();

    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-estadistica-departamento-lista-pagina')->layout('layouts.administrador.index');
    }
}
