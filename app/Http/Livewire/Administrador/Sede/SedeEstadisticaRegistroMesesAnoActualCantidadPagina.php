<?php

namespace App\Http\Livewire\Administrador\Sede;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SedeEstadisticaRegistroMesesAnoActualCantidadPagina extends Component
{
    public $cantidad_odontologos_clinicas_anio_actual;

    public function mount()
    {
        $this->cantidad_odontologos_clinicas_anio_actual = DB::table('odontologos')
        ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as cantidad_registros'))
        ->whereRaw('YEAR(created_at) = ?', [date('Y')])
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-estadistica-registro-meses-ano-actual-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
