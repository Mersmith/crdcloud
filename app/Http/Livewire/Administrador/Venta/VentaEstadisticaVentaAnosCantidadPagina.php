<?php

namespace App\Http\Livewire\Administrador\Venta;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VentaEstadisticaVentaAnosCantidadPagina extends Component
{
    public $cantidad_ventas_por_anio;

    public function render()
    {
        $this->cantidad_ventas_por_anio = DB::table('ventas')
            ->select(DB::raw('YEAR(created_at) as anio'), DB::raw('COUNT(*) as cantidad_registros'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();       

        return view('livewire.administrador.venta.venta-estadistica-venta-anos-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
