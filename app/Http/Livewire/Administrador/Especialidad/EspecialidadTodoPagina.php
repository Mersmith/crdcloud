<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadTodoPagina extends Component
{
    use WithPagination;
    public $buscarEspecialidad;
    public $cantidad_total_especialidades;
    protected $paginate = 10;

    public function updatingBuscarEspecialidad()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_especialidades = Especialidad::count();
    }

    public function render()
    {
        $especialidades = Especialidad::where('nombre', 'like', '%' . $this->buscarEspecialidad . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.especialidad.especialidad-todo-pagina', compact('especialidades'))->layout('layouts.administrador.index');
    }
}
