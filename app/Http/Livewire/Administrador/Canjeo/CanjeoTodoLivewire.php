<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use Livewire\Component;

class CanjeoTodoLivewire extends Component
{
    public function render()
    {
        return view('livewire.administrador.canjeo.canjeo-todo-livewire')->layout('layouts.administrador.index');
    }
}
