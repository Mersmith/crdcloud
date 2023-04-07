<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class VentaEstadisticaVentaMesActualListaPagina extends Component
{
    use WithPagination;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function render()
    {
        $ventas = Venta::query()->orderBy('created_at', 'desc');

        $ventas->whereMonth('created_at', '=', date('m'));
        $ventas->whereYear('created_at', '=', date('Y'));

        if ($this->estado) {
            $ventas->where('estado', $this->estado);
            if ($this->buscarNumeroDeVenta) {
                $ventas->where('id', 'like', '%' . $this->buscarNumeroDeVenta . '%');
            }
        } else {
            if ($this->buscarNumeroDeVenta) {
                $ventas->where('id', 'like', '%' . $this->buscarNumeroDeVenta . '%');
            }
        }

        $ventas = $ventas->paginate(30)->withQueryString();

        $pendiente = Venta::where('estado', 1)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        $pagado = Venta::where('estado', 2)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        $anulado = Venta::where('estado', 3)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.administrador.venta.venta-estadistica-venta-mes-actual-lista-pagina', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
