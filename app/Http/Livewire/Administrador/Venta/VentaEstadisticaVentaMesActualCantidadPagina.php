<?php

namespace App\Http\Livewire\Administrador\Venta;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VentaEstadisticaVentaMesActualCantidadPagina extends Component
{
    public $cantidad_ventas_mes_actual;

    public function mount()
    {
        $this->cantidad_ventas_mes_actual = DB::table('ventas')
            ->select(DB::raw('DAY(created_at) as fecha'), DB::raw('COUNT(*) as cantidad_registros'))
            ->whereRaw('MONTH(created_at) = ?', [date('m')])
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-estadistica-venta-mes-actual-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
