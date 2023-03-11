<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaPacienteTodoPagina extends Component
{
    use WithPagination;
    public $buscarPaciente;
    protected $paginate = 10;

    public $clinica;
    public $pacientes_cantidad_total;

    public function updatingBuscarPaciente()
    {
        $this->resetPage();
    }

    public function mount(Odontologo $clinica)
    {
        $this->clinica = $clinica;

        $this->pacientes_cantidad_total = $clinica->pacientes()->count();
    }

    public function llenarDatosDesdeVenta()
    {
        $ventas = Venta::whereNotNull('odontologo_id')->get();

        // Iterar sobre los registros de ventas y llenar la tabla odontologo_paciente
        foreach ($ventas as $venta) {
            $paciente_id = $venta->paciente_id;
            $odontologo_id = $venta->odontologo_id;

            // Insertar un registro en la tabla odontologo_paciente para cada combinación única de paciente_id y odontologo_id
            DB::table('odontologo_paciente')
                ->updateOrInsert(
                    ['paciente_id' => $paciente_id, 'odontologo_id' => $odontologo_id],
                    ['created_at' => now(), 'updated_at' => now()]
                );
        }
    }

    public function render()
    {
        $pacientes = $this->clinica->pacientes()
            ->where('nombre', 'LIKE', '%' . $this->buscarPaciente . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.administrador.clinica.clinica-paciente-todo-pagina', compact('pacientes'))->layout('layouts.administrador.index');
    }
}
