<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use Livewire\Component;

class OdontologoInformacionPagina extends Component
{
    protected $listeners = ['desasignarPaciente'];

    public $odontologo;
    public $usuario_odontologo;
    public $especialidad;
    public $direccion;
    public $paciente;
    public $sedes;
    public $imagen;
    public $sede;

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo = $odontologo;
        $this->usuario_odontologo = $odontologo->user;
        $this->especialidad = Especialidad::find($odontologo->especialidad_id);
        $this->direccion = $odontologo->user->direccion;

        $this->paciente = Paciente::where('user_id', $odontologo->user->id)->get()->first();

        $this->sedes = $odontologo->sedes->pluck('nombre', 'id')->toArray();

        $this->imagen = $this->odontologo->imagenPerfil ? $this->odontologo->imagenPerfil->imagen_perfil_ruta : null;
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

        $this->usuario_odontologo->paciente->sedes()->attach(array_flip($this->sedes));

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

            if ($this->paciente->direccion) {
                $this->paciente->direccion->delete();
            }

            $this->paciente->sedes()->detach();

            $this->paciente->odontologos()->detach();

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
