<?php

namespace App\Http\Livewire\Administrador\Encargado;

use App\Models\Encargado;
use Livewire\Component;
use Livewire\WithPagination;

class EncargadoTodoPagina extends Component
{
    use WithPagination;
    public $buscarEncargado;
    public $cantidad_total_encargados;
    protected $paginate = 10;

    public function updatingBuscarEncargado()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_encargados = Encargado::count();
    }

    public function render()
    {
        $encargados = Encargado::where('nombre', 'like', '%' . $this->buscarEncargado . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarEncargado . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.encargado.encargado-todo-pagina', compact('encargados'))->layout('layouts.administrador.index');
    }
}
