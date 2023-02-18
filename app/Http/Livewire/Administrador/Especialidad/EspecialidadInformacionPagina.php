<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Livewire\Component;

class EspecialidadInformacionPagina extends Component
{
    public $especialidad;

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;

        //Muestra todos los odontologos por una especialidad
        dd($this->especialidad->odontologos);
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-informacion-pagina')->layout('layouts.administrador.index');
    }
}
