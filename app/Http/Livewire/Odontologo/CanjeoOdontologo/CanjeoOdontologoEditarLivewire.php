<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use Livewire\Component;

class CanjeoOdontologoEditarLivewire extends Component
{
    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-editar-livewire')->layout('layouts.administrador.index');
    }
}
