<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class VentaTodoLivewire extends Component
{
    use WithPagination;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function render()
    {
        //$ventas = Venta::query()->orderBy('created_at', 'desc');
        $ventas = Venta::query();

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

        $pendiente = Venta::where('estado', 1)->count();
        $pagado = Venta::where('estado', 2)->count();
        $anulado = Venta::where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.administrador.venta.venta-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
