<?php

namespace App\Http\Livewire\Administrador\Menu;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MenuPrincipal extends Component
{
    public $usuario;

    public function mount()
    {
        $usuario = Auth::user();
        $this->usuario = $usuario;

        if ($usuario->rol == 'administrador') {
            $this->usuario = $usuario->administrador;
        } elseif ($usuario->rol == 'encargado') {
            $this->usuario = $usuario->encargado;
        } elseif ($usuario->rol == 'odontologo') {
            $this->usuario = $usuario->odontologo;
        } elseif ($usuario->rol == 'paciente') {
            $this->usuario = $usuario->paciente;
        }
    }

    public function render()
    {
        return view('livewire.administrador.menu.menu-principal');
    }
}
