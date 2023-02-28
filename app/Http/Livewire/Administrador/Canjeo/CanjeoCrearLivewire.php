<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use Livewire\Component;

class CanjeoCrearLivewire extends Component
{
    public function render()
    {
        return view('livewire.administrador.canjeo.canjeo-crear-livewire')->layout('layouts.administrador.index');
    }
}
