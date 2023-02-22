<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Paciente;
use Livewire\Component;

class PacienteInformacionPagina extends Component
{
    public $paciente;
    public $usuario_paciente;
    public $odontologos;
    public $clinicas;

    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;
        $this->usuario_paciente = $paciente->user;
        $this->odontologos = $paciente->odontologos()->limit(10)->get();
        $this->clinicas = $paciente->clinicas()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-informacion-pagina')->layout('layouts.administrador.index');
    }
}
