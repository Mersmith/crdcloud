<?php

namespace App\Http\Livewire\Administrador\Sede;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SedeEstadisticaRegistroAnosCantidadPagina extends Component
{
    public $cantidad_odontologos_clinicas_anios;

    public function mount()
    {
        $this->cantidad_odontologos_clinicas_anios = DB::table(DB::raw("
        (
            SELECT created_at, 'clinicas' as tipo_registro
            FROM clinicas
            UNION ALL
            SELECT created_at, 'odontologos' as tipo_registro
            FROM odontologos
        ) as subquery
    "))
            ->select(DB::raw('YEAR(created_at) as anio'), DB::raw('COUNT(*) as cantidad_registros'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();
    }


    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-registro-anos-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
