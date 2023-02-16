<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;

class OdontologoVerPagina extends Component
{
    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-ver-pagina')->layout('layouts.administrador.index');
    }
}
