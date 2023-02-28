<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use Livewire\Component;

class CanjeoEditarLivewire extends Component
{
    public function render()
    {
        return view('livewire.administrador.canjeo.canjeo-editar-livewire')->layout('layouts.administrador.index');
    }
}
