<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Canjeo;
use App\Models\Odontologo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaSedeCanjeoTodoPagina extends Component
{
    use WithPagination;
    public $clinica, $odontologo_id;
    public $buscarNumeroDeVenta;
    protected $paginate = 30;

    public $estado;
    protected $queryString = ['estado'];

    public function mount(Odontologo $clinica)
    {
        $this->odontologo_id = $clinica->id;
        $this->clinica = $clinica;
    }

    public function render()
    {
        $odontologoId = $this->odontologo_id;
        $canjeos = DB::table('canjeos')
            ->leftJoin('canjeo_detalles', 'canjeos.id', '=', 'canjeo_detalles.canjeo_id')
            ->leftJoin('servicios', 'canjeo_detalles.servicio_id', '=', 'servicios.id')
            ->leftJoin('pacientes', 'canjeos.paciente_id', '=', 'pacientes.id')
            ->select('canjeos.id', 'canjeos.estado', 'canjeos.nombre', 'canjeos.apellido', 'canjeos.created_at', 'pacientes.nombre AS paciente_nombre', 'pacientes.apellido AS paciente_apellido', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre_servicio'))
            ->where('canjeos.odontologo_id', $odontologoId);

        if ($this->estado) {
            $canjeos->where('canjeos.estado', $this->estado);
        }

        if ($this->buscarNumeroDeVenta) {
            $canjeos->where(function ($query) use ($odontologoId) {
                $query->where('canjeos.id', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.nombre', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->orWhere('pacientes.apellido', 'like', '%' . $this->buscarNumeroDeVenta . '%')
                    ->where('canjeos.odontologo_id', $odontologoId);
            });
        }

        $canjeos = $canjeos->groupBy('canjeos.id', 'canjeos.estado', 'canjeos.nombre', 'canjeos.apellido', 'canjeos.created_at', 'pacientes.nombre', 'pacientes.apellido')
            ->orderBy('canjeos.created_at', 'desc')
            ->paginate($this->paginate)
            ->withQueryString();

        $pendiente = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 1)->count();
        $pagado = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 2)->count();
        $anulado = Canjeo::where('odontologo_id', $odontologoId)->where('estado', 3)->count();
        $todos = $pendiente + $pagado + $anulado;

        return view('livewire.encargado.clinica-sede.clinica-sede-canjeo-todo-pagina', compact('canjeos', 'pendiente', 'pagado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
