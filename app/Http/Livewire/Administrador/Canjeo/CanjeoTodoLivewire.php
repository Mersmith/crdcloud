<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use App\Models\Canjeo;
use Livewire\Component;
use Livewire\WithPagination;

class CanjeoTodoLivewire extends Component
{
    use WithPagination;
    public $buscarNumeroDeVenta;
    protected $paginate = 10;

    public $estado;
    protected $queryString = ['estado'];

    public function render()
    {
        $ventas = Canjeo::query()->orderBy('updated_at', 'desc');

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

        $ventas = $ventas->paginate(10)->withQueryString();

        $pendiente = Canjeo::where('estado', 1)->count();
        $pagado = Canjeo::where('estado', 2)->count();
        $anulado = Canjeo::where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.administrador.canjeo.canjeo-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
