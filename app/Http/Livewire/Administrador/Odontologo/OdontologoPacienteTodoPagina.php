<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Odontologo;
use Livewire\Component;
use Livewire\WithPagination;

class OdontologoPacienteTodoPagina extends Component
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

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo = $odontologo;

        $this->pacientes_cantidad_total = $odontologo->pacientes()->count();
    }

    public function render()
    {
        $pacientes = $this->odontologo->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.administrador.odontologo.odontologo-paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
