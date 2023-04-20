<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use App\Models\Odontologo;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OdontologoSedeVentaTodoPagina extends Component
{
    use WithPagination;
    public $odontologo, $odontologo_id;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo_id = $odontologo->id;
        $this->odontologo = $odontologo;
    }

    public function render()
    {
        $odontologoId = $this->odontologo_id;
        $ventas = DB::table('ventas')
            ->leftJoin('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->leftJoin('servicios', 'venta_detalles.servicio_id', '=', 'servicios.id')
            ->leftJoin('pacientes', 'ventas.paciente_id', '=', 'pacientes.id')
            ->select('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre'), 'pacientes.nombre as nombre_paciente', 'pacientes.apellido as apellido_paciente')
            ->where('ventas.odontologo_id', $odontologoId);

        if ($this->estado) {
            $ventas->where('ventas.estado', $this->estado);
        }

        if ($this->buscarNumeroDeVenta) {
            $ventas->where(function ($query) use ($odontologoId) {
                $query->where('ventas.id', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.nombre', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.apellido', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->where('ventas.odontologo_id', $odontologoId);
            });
        }

        $ventas = $ventas->groupBy('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', 'pacientes.nombre', 'pacientes.apellido')
            ->orderBy('ventas.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Venta::where('odontologo_id', $odontologoId)->where('estado', 1)->count();
        $pagado = Venta::where('odontologo_id', $odontologoId)->where('estado', 2)->count();
        $anulado = Venta::where('odontologo_id', $odontologoId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.encargado.odontologo-sede.odontologo-sede-venta-todo-pagina', compact('ventas', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}