<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VentaTodoLivewire extends Component
{
    use WithPagination;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function render()
    {
        $ventas = DB::table('ventas')
            ->leftJoin('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->leftJoin('servicios', 'venta_detalles.servicio_id', '=', 'servicios.id')
            ->select('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre'));

        if ($this->estado) {
            $ventas->where('ventas.estado', $this->estado);
        }

        if ($this->buscarNumeroDeVenta) {
            $ventas->where('ventas.id', 'like', '%' . $this->buscarNumeroDeVenta . '%');
        }

        $ventas = $ventas->groupBy('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at')
            ->orderBy('ventas.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Venta::where('estado', 1)->count();
        $pagado = Venta::where('estado', 2)->count();
        $anulado = Venta::where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;


        return view('livewire.administrador.venta.venta-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
