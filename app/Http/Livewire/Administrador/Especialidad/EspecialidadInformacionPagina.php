<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Livewire\Component;

class EspecialidadInformacionPagina extends Component
{
    public $especialidad;
    public $cantidad_total_odontologos;
    public $cantidad_total_clinicas;

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;
        $this->cantidad_total_odontologos = $especialidad->odontologos()->where('rol', '=', 'odontologo')->count();
        $this->cantidad_total_clinicas = $especialidad->odontologos()->where('rol', '=', 'clinica')->count();
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-informacion-pagina')->layout('layouts.administrador.index');
    }
}
