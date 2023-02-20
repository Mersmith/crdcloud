<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class SedeClinicaTodoPagina extends Component
{
    use WithPagination;
    public $buscarClinica;
    protected $paginate = 10;

    public $sede;
    public $cantidad_clinicas;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->cantidad_clinicas = $sede->clinicas()->count();
    }

    public function render()
    {
        $clinicas = $this->sede->clinicas()
            ->where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.sede.sede-clinica-todo-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
