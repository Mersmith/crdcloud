<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Odontologo;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaSedePacienteTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 30;

    public $clinica;
    public $pacientes_cantidad_total;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Odontologo $clinica)
    {
        $this->clinica = $clinica;

        $this->pacientes_cantidad_total = $clinica->pacientes()->count();
    }

    public function render()
    {
        $pacientes = $this->clinica->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.encargado.clinica-sede.clinica-sede-paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
