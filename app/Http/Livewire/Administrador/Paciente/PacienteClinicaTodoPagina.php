<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithPagination;

class PacienteClinicaTodoPagina extends Component
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
            ->where('rol', '=', 'clinica')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.paciente.paciente-clinica-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
