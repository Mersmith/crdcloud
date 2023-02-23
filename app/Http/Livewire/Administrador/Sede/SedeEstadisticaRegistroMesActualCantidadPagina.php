<?php

namespace App\Http\Livewire\Administrador\Sede;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SedeEstadisticaRegistroMesActualCantidadPagina extends Component
{
    public $cantidad_odontologos_clinicas_mes_actual;

    public function mount()
    {
        $this->cantidad_odontologos_clinicas_mes_actual = DB::table(DB::raw("
        (
            SELECT created_at, 'clinicas' as tipo_registro
            FROM clinicas
            UNION ALL
            SELECT created_at, 'odontologos' as tipo_registro
            FROM odontologos
        ) as subquery
    "))
            ->select(DB::raw('DAY(created_at) as fecha'), DB::raw('COUNT(*) as cantidad_registros'))
            ->whereRaw('MONTH(created_at) = ?', [date('m')])
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-registro-mes-actual-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
