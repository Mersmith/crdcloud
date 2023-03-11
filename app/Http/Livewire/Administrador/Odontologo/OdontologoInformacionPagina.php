<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use Livewire\Component;

class OdontologoInformacionPagina extends Component
{
    public $odontologo;
    public $usuario_odontologo;
    public $especialidad;
    public $direccion;
    public $paciente;

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo = $odontologo;
        $this->usuario_odontologo = $odontologo->user;
        $this->especialidad = Especialidad::find($odontologo->especialidad_id);
        $this->direccion = $odontologo->user->direccion;

        $this->paciente = Paciente::where('dni', $odontologo->dni)->orWhere('email', $odontologo->email)->get()->first();
    }

    public function asignarPaciente()
    {
        $this->usuario_odontologo->paciente()->create(
            [
                'sede_id' => $this->odontologo->sede_id,
                'nombre' => $this->odontologo->nombre,
                'apellido' => $this->odontologo->apellido,
                'email' => $this->odontologo->email,
                'celular' => $this->odontologo->celular,
                'fecha_nacimiento' => $this->odontologo->fecha_nacimiento,
                'genero' =>  $this->odontologo->genero,
            ]
        );

        $this->usuario_odontologo = $this->usuario_odontologo->fresh();

        $paciente = $this->usuario_odontologo->paciente;

        if ($paciente) {
            $this->paciente = $paciente;

            $this->emit('mensajeCreado', "Asignado.");
        }
    }

    public function desasignarPaciente()
    {
        if ($this->paciente) {
            $this->paciente->delete();

            $this->emit('mensajeEliminado', "Desasignado.");

            $this->reset('paciente');
        }
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-informacion-pagina')->layout('layouts.administrador.index');
    }
}
