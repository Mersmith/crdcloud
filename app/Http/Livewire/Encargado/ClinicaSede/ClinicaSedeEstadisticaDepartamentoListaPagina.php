<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClinicaSedeEstadisticaDepartamentoListaPagina extends Component
{
    public $odontologos_departamentos, $odontologos_provincias_cantidad;

    public function mount(Departamento $departamento)
    {
        $sede = Auth::user()->encargado->sede;

        $departamento_id = $departamento->id;

        $this->odontologos_provincias_cantidad = DB::table('provincias')
            ->leftJoin('departamentos', 'provincias.departamento_id', '=', 'departamentos.id')
            ->leftJoin('direccions', 'provincias.id', '=', 'direccions.provincia_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->join('odontologo_sede', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
            ->where('odontologos.rol', '=', 'clinica')
            ->where('departamentos.id', '=', $departamento_id)
            ->where('odontologo_sede.sede_id', '=', $sede->id)
            ->select('provincias.id', 'provincias.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->groupBy('provincias.id', 'provincias.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.encargado.clinica-sede.clinica-sede-estadistica-departamento-lista-pagina')->layout('layouts.administrador.index');
    }
}
