<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use App\Models\Especialidad;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadSedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarEspecialidad;
    public $cantidad_total_especialidades;
    protected $paginate = 30;

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
            ->paginate(30);

        return view('livewire.encargado.especialidad-sede.especialidad-sede-todo-pagina', compact('especialidades'))->layout('layouts.administrador.index');
    }
}
