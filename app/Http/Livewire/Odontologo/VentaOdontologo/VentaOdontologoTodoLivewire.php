<?php

namespace App\Http\Livewire\Odontologo\VentaOdontologo;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VentaOdontologoTodoLivewire extends Component
{
    use WithPagination;
    public $odontologo_id;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function mount()
    {
        $this->odontologo_id = Auth::user()->odontologo->id;
    }

    public function render()
    {
        $odontologoId = $this->odontologo_id;
        $ventas = Venta::query()->orderBy('created_at', 'desc');
        //$ventas = Venta::query();

        $ventas->where('odontologo_id', $odontologoId);

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

        $pendiente = Venta::where('odontologo_id', $odontologoId)->where('estado', 1)->count();
        $pagado = Venta::where('odontologo_id', $odontologoId)->where('estado', 2)->count();
        $anulado = Venta::where('odontologo_id', $odontologoId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.odontologo.venta-odontologo.venta-odontologo-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
