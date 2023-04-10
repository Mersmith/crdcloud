<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Odontologo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaSedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarClinica;
    protected $paginate = 30;

    public $sede;
    public $cantidad_clinicas;

    public $filtrar_sede = true;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($this->filtrar_sede) {
            $this->cantidad_clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->count();
        } else {
            $this->cantidad_clinicas = Odontologo::where('rol', '=', 'clinica')->count();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($value) {
            $this->cantidad_clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->count();
        } else {
            $this->cantidad_clinicas = Odontologo::where('rol', '=', 'clinica')->count();
        }
    }

    public function render()
    {
        if ($this->filtrar_sede) {
            $clinicas = $this->sede->odontologos()
                ->where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
                ->where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        } else {
            $clinicas = Odontologo::where('nombre', 'LIKE', '%' . $this->buscarClinica . '%')
                ->where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        }

        return view('livewire.encargado.clinica-sede.clinica-sede-todo-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
