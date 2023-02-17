<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Odontologo;
use Illuminate\Pagination\LengthAwarePaginator;

class PacienteOdontologoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 10;

    public $paciente_id;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Paciente $paciente)
    {
        $this->paciente_id = $paciente->id;
    }

    public function render()
    {
        $odontologos_consulta = Paciente::where('id', $this->paciente_id)
            ->with('odontologo')
            ->get()
            ->pluck('odontologo')
            ->unique();

        $perPage = 10;

        $page = request()->get('page', 1);

        $odontologos = new LengthAwarePaginator(
            $odontologos_consulta->forPage($page, $perPage),
            $odontologos_consulta->count(),
            $perPage,
            $page
        );

        return view('livewire.administrador.paciente.paciente-odontologo-pagina', compact('odontologos'))->layout('layouts.administrador.index');
    }
}
