<?php

namespace App\Http\Livewire\Encargado\CanjeoSede;

use App\Models\Canjeo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CanjeoSedeTodoLivewire extends Component
{
    use WithPagination;
    public $sede_id;
    public $buscarNumeroDeCanjeo;
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

        $canjeos = DB::table('canjeos')
            ->leftJoin('canjeo_detalles', 'canjeos.id', '=', 'canjeo_detalles.canjeo_id')
            ->leftJoin('servicios', 'canjeo_detalles.servicio_id', '=', 'servicios.id')
            ->select('canjeos.id', 'canjeos.estado', 'canjeos.link', 'canjeos.descargas_imagen', 'canjeos.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre'))
            ->where('canjeos.sede_id', $sedeId);

        if ($this->estado) {
            $canjeos->where('canjeos.estado', $this->estado);
        }

        if ($this->buscarNumeroDeCanjeo) {
            $canjeos->where('canjeos.id', 'like', '%' . $this->buscarNumeroDeCanjeo . '%');
        }

        $canjeos = $canjeos->groupBy('canjeos.id', 'canjeos.estado', 'canjeos.link', 'canjeos.descargas_imagen', 'canjeos.created_at')
            ->orderBy('canjeos.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Canjeo::where('sede_id', $sedeId)->where('estado', 1)->count();
        $pagado = Canjeo::where('sede_id', $sedeId)->where('estado', 2)->count();
        $anulado = Canjeo::where('sede_id', $sedeId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.encargado.canjeo-sede.canjeo-sede-todo-livewire', compact('canjeos', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
