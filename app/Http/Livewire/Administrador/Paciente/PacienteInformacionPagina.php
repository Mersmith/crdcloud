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
    public $direccion;

    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;

        $this->usuario_paciente = $paciente->user;
        $this->odontologos = $paciente->odontologos()->where('rol', '=', 'odontologo')->limit(10)->get();
        $this->clinicas = $paciente->odontologos()->where('rol', '=', 'clinica')->limit(10)->get();

        $this->direccion = $paciente->user->direccion;
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-informacion-pagina')->layout('layouts.administrador.index');
    }
}
