<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedeClinicaTodoPagina extends Component
{
    use WithPagination;
    public $buscarClinica;
    protected $paginate = 30;

    public $sede;
    public $cantidad_clinicas;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->cantidad_clinicas = $sede->odontologos()->where('rol', '=', 'clinica')->count();
    }

    public function render()
    {
        $clinicas = $this->sede->odontologos()
            ->where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
            ->where('rol', '=', 'clinica')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.administrador.sede.sede-clinica-todo-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
