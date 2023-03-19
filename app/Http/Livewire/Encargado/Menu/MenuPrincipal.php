<?php

namespace App\Http\Livewire\Encargado\Menu;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MenuPrincipal extends Component
{
    public $usuario;

    public function mount()
    {
        $usuario = Auth::user();

        $this->usuario = $usuario->encargado;
    }

    public function render()
    {
        return view('livewire.encargado.menu.menu-principal');
    }
}
