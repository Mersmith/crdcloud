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

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_odontologos = Odontologo::where('rol', '=', 'odontologo')->count();
    }

    public function render()
    {
        $odontologos = Odontologo::where('rol', '=', 'odontologo')
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarOdontologo . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->buscarOdontologo . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.administrador.odontologo.odontologo-todo-pagina', compact('odontologos'))->layout('layouts.encargado.index');
    }
}
