<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Odontologo;
use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithPagination;

class OdontologoPacientePagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 10;

    public $odontologo_id;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo_id = $odontologo->id;
    }

    public function render()
    {
        $pacientes = Paciente::where('odontologo_id', $this->odontologo_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.odontologo.odontologo-paciente-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
