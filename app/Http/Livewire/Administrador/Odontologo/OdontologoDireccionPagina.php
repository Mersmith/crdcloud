<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;

class OdontologoDireccionPagina extends Component
{
    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-direccion-pagina')->layout('layouts.administrador.index');
    }
}
