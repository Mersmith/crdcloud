<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Provincia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClinicaEstadisticaProvinciaListaPagina extends Component
{
    public $clinicas_distritos_cantidad;

    public function mount(Provincia $provincia)
    {
        $provincia_id = $provincia->id;

        $this->clinicas_distritos_cantidad = DB::table('distritos')
            ->leftJoin('direccions', 'distritos.id', '=', 'direccions.distrito_id')
            ->leftJoin('clinicas', 'direccions.user_id', '=', 'clinicas.user_id')
            ->select('distritos.id', 'distritos.nombre', DB::raw('count(clinicas.user_id) as cantidad'))
            ->where('distritos.provincia_id', '=', $provincia_id)
            ->groupBy('distritos.id', 'distritos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-estadistica-provincia-lista-pagina')->layout('layouts.administrador.index');
    }
}
