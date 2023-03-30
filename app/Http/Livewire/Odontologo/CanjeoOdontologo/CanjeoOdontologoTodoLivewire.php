<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use App\Models\Canjeo;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CanjeoOdontologoTodoLivewire extends Component
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
        $canjeos = DB::table('canjeos')
            ->leftJoin('canjeo_detalles', 'canjeos.id', '=', 'canjeo_detalles.canjeo_id')
            ->leftJoin('servicios', 'canjeo_detalles.servicio_id', '=', 'servicios.id')
            ->select('canjeos.id', 'canjeos.estado', 'canjeos.nombre', 'canjeos.apellido', 'canjeos.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre_servicio'))
            ->where('canjeos.odontologo_id', $odontologoId);

        if ($this->estado) {
            $canjeos->where('canjeos.estado', $this->estado);
        }

        if ($this->buscarNumeroDeVenta) {
            $canjeos->where('canjeos.id', 'like', '%' . $this->buscarNumeroDeVenta . '%');
        }

        $canjeos = $canjeos->groupBy('canjeos.id', 'canjeos.estado', 'canjeos.nombre', 'canjeos.apellido', 'canjeos.created_at')
            ->orderBy('canjeos.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 1)->count();
        $pagado = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 2)->count();
        $anulado = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-todo-livewire', compact('canjeos', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}