<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;

class OdontologoCrearPagina extends Component
{
    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-crear-pagina')->layout('layouts.administrador.index');
    }
}
