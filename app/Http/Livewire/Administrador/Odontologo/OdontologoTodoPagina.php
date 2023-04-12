<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Odontologo;

class OdontologoTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    public $cantidad_total_odontologos;
    protected $paginate = 30;

    public $top_puntos = false;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_odontologos = Odontologo::where('rol', '=', 'odontologo')->count();
    }

    public function cambiarTopPuntos()
    {
        $this->top_puntos = !$this->top_puntos;
    }

    public function render()
    {
        $query = Odontologo::where('rol', '=', 'odontologo')
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarOdontologo . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->buscarOdontologo . '%');
            });

        if ($this->top_puntos) {
            $odontologos = $query->orderByDesc('puntos')->paginate(30);
        } else {
            $odontologos = $query->orderBy('created_at', 'desc')->paginate(30);
        }

        return view('livewire.administrador.odontologo.odontologo-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
