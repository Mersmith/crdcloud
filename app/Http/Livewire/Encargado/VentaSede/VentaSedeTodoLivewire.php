<?php

namespace App\Http\Livewire\Encargado\VentaSede;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VentaSedeTodoLivewire extends Component
{
    use WithPagination;
    public $sede_id;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function mount()
    {
        $this->sede_id = Auth::user()->encargado->sede->id;
    }

    public function render()
    {
        $sedeId = $this->sede_id;
        //$ventas = Venta::query()->orderBy('created_at', 'desc');
        $ventas = Venta::query();

        $ventas->where('sede_id', $sedeId);

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

        $pendiente = Venta::where('sede_id', $sedeId)->where('estado', 1)->count();
        $pagado = Venta::where('sede_id', $sedeId)->where('estado', 2)->count();
        $anulado = Venta::where('sede_id', $sedeId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.encargado.venta-sede.venta-sede-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
