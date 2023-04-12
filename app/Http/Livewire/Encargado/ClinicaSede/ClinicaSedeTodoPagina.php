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

    public $top_puntos = false;

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

    public function cambiarTopPuntos()
    {
        $this->top_puntos = !$this->top_puntos;
    }

    public function render()
    {
        if ($this->filtrar_sede) {
            $query = $this->sede->odontologos()
                ->where('rol', '=', 'clinica')
                ->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscarClinica . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->buscarClinica . '%');
                });
        } else {
            $query = Odontologo::where('rol', '=', 'clinica')
                ->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscarClinica . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->buscarClinica . '%');
                });
        }

        if ($this->top_puntos) {
            $clinicas = $query->orderByDesc('puntos')->paginate(30);
        } else {
            $clinicas = $query->orderBy('created_at', 'desc')->paginate(30);
        }

        return view('livewire.encargado.clinica-sede.clinica-sede-todo-pagina', compact('clinicas'))->layout('layouts.administrador.index');
    }
}
