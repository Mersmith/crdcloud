<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;

class OdontologoPacientePagina extends Component
{
    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-paciente-pagina')->layout('layouts.administrador.index');
    }
}
