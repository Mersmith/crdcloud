<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Clinica;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaPacienteTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 10;

    public $clinica;
    public $pacientes_cantidad_total;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Clinica $clinica)
    {
        $this->clinica = $clinica;

        $this->pacientes_cantidad_total = $clinica->pacientes()->count();
    }

    public function render()
    {
        $pacientes = $this->clinica->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.clinica.clinica-paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
