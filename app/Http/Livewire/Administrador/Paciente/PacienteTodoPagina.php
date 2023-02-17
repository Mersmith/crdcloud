<?php

namespace App\Http\Livewire\Administrador\Paciente;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;

class PacienteTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 10;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pacientes = Paciente::where('nombre', 'like', '%' . $this->buscarPaciente . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.paciente.paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
