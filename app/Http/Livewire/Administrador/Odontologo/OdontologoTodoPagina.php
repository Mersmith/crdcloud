<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Odontologo;

class OdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    public $cantidad_total_odontologos;
    protected $paginate = 10;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_odontologos = Odontologo::count();
    }

    public function render()
    {

        $odontologos = Odontologo::where('nombre', 'like', '%' . $this->buscarOdontologo . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarOdontologo . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.odontologo.odontologo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
