<?php

namespace App\Http\Livewire\Administrador\Administrador;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Administrador;

class AdministradorTodoPagina extends Component
{
    use WithPagination;
    public $buscarAdministrador;
    public $cantidad_total_administradores;
    protected $paginate = 10;

    public function updatingBuscarAdministrador()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_administradores = Administrador::count();
    }

    public function render()
    {
        $administradores = Administrador::where('nombre', 'like', '%' . $this->buscarAdministrador . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarAdministrador . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.administrador.administrador-todo-pagina', compact('administradores'))->layout('layouts.administrador.index');
    }
}
