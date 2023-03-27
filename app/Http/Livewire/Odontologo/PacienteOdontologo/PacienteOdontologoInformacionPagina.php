<?php

namespace App\Http\Livewire\Odontologo\PacienteOdontologo;

use App\Models\Paciente;
use Livewire\Component;

class PacienteOdontologoInformacionPagina extends Component
{
    public $paciente;
    public $usuario_paciente;
    public $odontologos;
    public $clinicas;
    public $direccion;
    public $sedes;
    public $ventas;

    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;

        $this->usuario_paciente = $paciente->user;

        $this->odontologos = $paciente->odontologos()->where('rol', '=', 'odontologo')->limit(10)->get();

        $this->clinicas = $paciente->odontologos()->where('rol', '=', 'clinica')->limit(10)->get();

        $this->direccion = $paciente->user->direccion;

        $this->sedes = $paciente->sedes->pluck('nombre')->toArray();

        $this->ventas = $paciente->ventas;
    }

    public function render()
    {
        return view('livewire.odontologo.paciente-odontologo.paciente-odontologo-informacion-pagina')->layout('layouts.administrador.index');
    }
}
