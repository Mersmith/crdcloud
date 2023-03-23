<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use Livewire\Component;

class OdontologoSedeInformacionPagina extends Component
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

        $this->paciente = Paciente::where('user_id', $odontologo->user->id)->get()->first();
    }

    public function asignarPaciente()
    {
        $this->usuario_odontologo->paciente()->create(
            [
                'nombre' => $this->odontologo->nombre,
                'apellido' => $this->odontologo->apellido,
                'email' => $this->odontologo->email,
                'dni' => $this->odontologo->dni,
                'celular' => $this->odontologo->celular,
                'genero' => $this->odontologo->genero,
                'rol' =>   "paciente",
            ]
        );

        $this->usuario_odontologo->paciente->sedes()->attach(1);

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

            $this->paciente->sedes()->detach();

            $this->paciente->odontologos()->detach();

            $this->paciente->delete();

            $this->emit('mensajeEliminado', "Desasignado.");

            $this->reset('paciente');
        }
    }

    public function render()
    {
        return view('livewire.encargado.odontologo-sede.odontologo-sede-informacion-pagina')->layout('layouts.administrador.index');
    }
}
