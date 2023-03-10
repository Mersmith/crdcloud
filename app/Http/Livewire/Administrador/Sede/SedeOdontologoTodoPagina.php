<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedeOdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 30;

    public $sede;
    public $cantidad_odontologos;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->cantidad_odontologos = $sede->odontologos()->where('rol', '=', 'odontologo')->count();
    }

    public function render()
    {
        $odontologos = $this->sede->odontologos()
            ->where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
            ->where('rol', '=', 'odontologo')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.administrador.sede.sede-odontologo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
