<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarSede;
    protected $paginate = 10;

    public function updatingBuscarSede()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sedes = Sede::where('nombre', 'like', '%' . $this->buscarSede . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.sede.sede-todo-pagina', compact('sedes'))->layout('layouts.administrador.index');
    }
}
