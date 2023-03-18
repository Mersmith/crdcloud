<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use App\Models\Especialidad;
use App\Models\Odontologo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadSedeEstadisticaOdontologoListaPagina extends Component
{
    use WithPagination;
    public $especialidad;
    public $sede_id;
    public $buscarOdontologo;
    public $cantidad_total_odontologos;
    protected $paginate = 30;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount(Especialidad $especialidad)
    {
        $this->sede_id = Auth::user()->encargado->sede->id;
        $this->especialidad = $especialidad;

        $sedeId = $this->sede_id;

        $this->cantidad_total_odontologos = Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'odontologo');
        })
            ->where('especialidad_id', $especialidad->id)
            ->count();
    }

    public function render()
    {
        $sedeId = $this->sede_id;

        $odontologos =  Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'odontologo');
        })
            ->where('especialidad_id', $this->especialidad->id)
            ->where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
            ->paginate(30);

        return view('livewire.encargado.especialidad-sede.especialidad-sede-estadistica-odontologo-lista-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
