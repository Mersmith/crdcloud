<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadEstadisticaClinicaListaPagina extends Component
{
    use WithPagination;
    public $especialidad;
    public $buscarClinica;
    public $cantidad_total_clinicas;
    protected $paginate = 30;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;
        $this->cantidad_total_clinicas = $especialidad->odontologos()->where('rol', '=', 'clinica')->count();
    }

    public function render()
    {
        $clinicas =  $this->especialidad->odontologos()->where('rol', '=', 'clinica')
            ->where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
            ->paginate(30);

        return view('livewire.administrador.especialidad.especialidad-estadistica-clinica-lista-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
