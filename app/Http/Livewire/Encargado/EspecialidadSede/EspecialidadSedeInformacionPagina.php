<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use App\Models\Especialidad;
use App\Models\Odontologo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EspecialidadSedeInformacionPagina extends Component
{
    public $especialidad;
    public $cantidad_total_odontologos;
    public $cantidad_total_clinicas;

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;

        $sedeId = Auth::user()->encargado->sede->id;

        $this->cantidad_total_odontologos = Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'odontologo');
        })
            ->where('especialidad_id', $especialidad->id)
            ->count();

        $this->cantidad_total_clinicas = Odontologo::whereHas('sedes', function ($query) use ($sedeId) {
            $query->where('sede_id', $sedeId)->where('rol', 'clinica');
        })
            ->where('especialidad_id', $especialidad->id)
            ->count();
    }

    public function render()
    {
        return view('livewire.encargado.especialidad-sede.especialidad-sede-informacion-pagina')->layout('layouts.administrador.index');
    }
}
