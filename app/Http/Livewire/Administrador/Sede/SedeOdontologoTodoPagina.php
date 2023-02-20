<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedeOdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 10;

    public $sede;
    public $cantidad_odontologos;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->cantidad_odontologos = $sede->odontologos()->count();
    }

    public function render()
    {
        $odontologos = $this->sede->odontologos()
            ->where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.sede.sede-odontologo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
