<?php

namespace App\Http\Livewire\Encargado\PacienteSede;

use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithPagination;

class PacienteSedeOdontogoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 10;

    public $paciente;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    public function render()
    {
        $odontologos = $this->paciente->odontologos()
        ->where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
        ->where('rol', '=', 'odontologo')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('livewire.encargado.paciente-sede.paciente-sede-odontogo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
