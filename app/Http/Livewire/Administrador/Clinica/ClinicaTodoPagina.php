<?php

namespace App\Http\Livewire\Administrador\Clinica;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Clinica;

class ClinicaTodoPagina extends Component
{
    use WithPagination;
    public $buscarClinica;
    public $cantidad_total_clinicas;
    protected $paginate = 10;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_clinicas = Clinica::count();
    }

    public function render()
    {
        $clinicas = Clinica::where('nombre_clinica', 'like', '%' . $this->buscarClinica . '%')
            ->orWhere('email', 'LIKE', '%' . $this->buscarClinica . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.clinica.clinica-todo-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
