<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use Livewire\Component;

class CanjeoOdontologoTodoLivewire extends Component
{
    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-todo-livewire')->layout('layouts.administrador.index');
    }
}
