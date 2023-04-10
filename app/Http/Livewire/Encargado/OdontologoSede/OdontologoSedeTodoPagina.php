<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use App\Models\Odontologo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OdontologoSedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 30;

    public $sede;
    public $cantidad_odontologos;

    public $filtrar_sede = true;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($this->filtrar_sede) {
            $this->cantidad_odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->count();
        } else {
            $this->cantidad_odontologos = Odontologo::where('rol', '=', 'odontologo')->count();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($value) {
            $this->cantidad_odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->count();
        } else {
            $this->cantidad_odontologos = Odontologo::where('rol', '=', 'odontologo')->count();
        }
    }

    public function render()
    {
        if ($this->filtrar_sede) {
            $odontologos = $this->sede->odontologos()
                ->where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
                ->where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        } else {
            $odontologos = Odontologo::where('nombre', 'LIKE', '%' . $this->buscarOdontologo . '%')
                ->where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        }

        return view('livewire.encargado.odontologo-sede.odontologo-sede-todo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
