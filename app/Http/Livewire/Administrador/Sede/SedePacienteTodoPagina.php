<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedePacienteTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 30;

    public $sede;
    public $cantidad_pacientes;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->cantidad_pacientes = $sede->pacientes()->count();
    }

    public function render()
    {
        $pacientes = $this->sede->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.administrador.sede.sede-paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
