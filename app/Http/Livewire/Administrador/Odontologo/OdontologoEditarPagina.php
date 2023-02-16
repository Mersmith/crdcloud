<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;

class OdontologoEditarPagina extends Component
{
    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-editar-pagina')->layout('layouts.administrador.index');
    }
}
