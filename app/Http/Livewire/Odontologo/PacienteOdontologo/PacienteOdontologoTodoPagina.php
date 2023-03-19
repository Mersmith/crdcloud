<?php

namespace App\Http\Livewire\Odontologo\PacienteOdontologo;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PacienteOdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 30;

    public $odontologo;
    public $pacientes_cantidad_total;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->odontologo = Auth::user()->odontologo;

        $this->pacientes_cantidad_total = $this->odontologo->pacientes()->count();
    }

    public function render()
    {
        $pacientes = $this->odontologo->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.odontologo.paciente-odontologo.paciente-odontologo-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
