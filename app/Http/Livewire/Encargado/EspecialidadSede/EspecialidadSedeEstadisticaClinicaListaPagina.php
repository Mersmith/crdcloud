<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use App\Models\Especialidad;
use App\Models\Odontologo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadSedeEstadisticaClinicaListaPagina extends Component
{
    use WithPagination;
    public $especialidad;
    public $sede_id;
    public $buscarClinica;
    public $cantidad_total_clinicas;
    protected $paginate = 30;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount(Especialidad $especialidad)
    {
        $this->sede_id = Auth::user()->encargado->sede->id;
        $this->especialidad = $especialidad;

        $sedeId = $this->sede_id;

        $this->cantidad_total_clinicas = Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'clinica');
        })
            ->where('especialidad_id', $especialidad->id)
            ->count();
    }

    public function render()
    {
        $sedeId = $this->sede_id;

        $clinicas =  Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'clinica');
        })
            ->where('especialidad_id', $this->especialidad->id)
            ->where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
            ->paginate(30);

        return view('livewire.encargado.especialidad-sede.especialidad-sede-estadistica-clinica-lista-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
