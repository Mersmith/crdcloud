<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Clinica;
use App\Models\Especialidad;
use Livewire\Component;

class ClinicaInformacionPagina extends Component
{
    public $clinica;
    public $usuario_clinica;
    public $especialidad;
    public $sede;
    public $direccion;

    public function mount(Clinica $clinica)
    {
        $this->clinica = $clinica;
        $this->usuario_clinica = $clinica->user;
        $this->especialidad = Especialidad::find($clinica->especialidad_id);
        $this->sede = $clinica->sede;

        $this->direccion = $clinica->user->direccion;
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-informacion-pagina')->layout('layouts.administrador.index');
    }
}
