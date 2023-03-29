<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use Livewire\Component;

class CanjeoOdontologoInformacionLivewire extends Component
{
    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-informacion-livewire')->layout('layouts.administrador.index');
    }
}
