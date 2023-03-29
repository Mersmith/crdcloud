<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use Livewire\Component;

class CanjeoOdontologoCrearLivewire extends Component
{
    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-crear-livewire')->layout('layouts.administrador.index');
    }
}
