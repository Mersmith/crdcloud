<?php

namespace App\Http\Livewire\Encargado\VentaSede;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $ventas = DB::table('ventas')
            ->leftJoin('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->leftJoin('servicios', 'venta_detalles.servicio_id', '=', 'servicios.id')
            ->leftJoin('pacientes', 'ventas.paciente_id', '=', 'pacientes.id')
            ->select('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre'), 'pacientes.nombre as nombre_paciente', 'pacientes.apellido as apellido_paciente')
            ->where('ventas.sede_id', $sedeId);

        if ($this->estado) {
            $ventas->where('ventas.estado', $this->estado);
        }

        if ($this->buscarNumeroDeVenta) {
            $ventas->where(function ($query) use ($sedeId) {
                $query->where('ventas.id', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.nombre', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.apellido', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->where('ventas.sede_id', $sedeId);
            });
        }

        $ventas = $ventas->groupBy('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', 'pacientes.nombre', 'pacientes.apellido')
            ->orderBy('ventas.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Venta::where('sede_id', $sedeId)->where('estado', 1)->count();
        $pagado = Venta::where('sede_id', $sedeId)->where('estado', 2)->count();
        $anulado = Venta::where('sede_id', $sedeId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.encargado.venta-sede.venta-sede-todo-livewire', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
