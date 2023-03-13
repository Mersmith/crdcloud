<?php

namespace App\Http\Livewire\Administrador\Venta;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VentaEstadisticaVentaMesesAnoActualCantidadPagina extends Component
{
    public $cantidad_ventas_anio_actual;

    public function mount()
    {
        $this->cantidad_ventas_anio_actual = DB::table('ventas')
            ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as cantidad_registros'))
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-estadistica-venta-meses-ano-actual-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
