<?php

namespace App\Http\Livewire\Encargado\PacienteSede;

use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PacienteSedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 30;

    public $sede;
    public $cantidad_pacientes;

    public $filtrar_sede = true;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($this->filtrar_sede) {
            $this->cantidad_pacientes = $this->sede->pacientes()->count();
        } else {
            $this->cantidad_pacientes = Paciente::count();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;

        if ($value) {
            $this->cantidad_pacientes = $this->sede->pacientes()->count();
        } else {
            $this->cantidad_pacientes = Paciente::count();
        }
    }

    public function render()
    {
        if ($this->filtrar_sede) {
            $pacientes = $this->sede->pacientes()
                ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        } else {
            $pacientes = Paciente::where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        }

        return view('livewire.encargado.paciente-sede.paciente-sede-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
