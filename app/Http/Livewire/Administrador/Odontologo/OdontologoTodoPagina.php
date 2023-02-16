<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Odontologo;

class OdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 10;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function render()
    {
        $odontologos = Odontologo::where('nombre', 'like', '%' . $this->buscarOdontologo . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarOdontologo . '%')
            ->paginate(10);

        return view('livewire.administrador.odontologo.odontologo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
