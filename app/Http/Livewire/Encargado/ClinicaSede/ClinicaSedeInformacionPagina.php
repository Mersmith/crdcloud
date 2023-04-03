<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Paciente;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ClinicaSedeInformacionPagina extends Component
{
    protected $listeners = ['desasignarPaciente'];

    public $clinica;
    public $usuario_clinica;
    public $especialidad;
    public $direccion;
    public $paciente;
    public $sedes;
    public $imagen;
    public $sede;

    public function mount(Odontologo $clinica)
    {
        $this->sede = Auth::user()->encargado->sede;

        $this->clinica = $clinica;
        $this->usuario_clinica = $clinica->user;
        $this->especialidad = Especialidad::find($clinica->especialidad_id);
        $this->direccion = $clinica->user->direccion;

        $this->paciente = Paciente::where('user_id', $clinica->user->id)->get()->first();

        $this->sedes = $clinica->sedes->pluck('nombre')->toArray();

        $this->imagen = $this->clinica->imagenPerfil ? $this->clinica->imagenPerfil->imagen_perfil_ruta : null;
    }

    public function asignarPaciente()
    {
        $this->usuario_clinica->paciente()->create(
            [
                'nombre' => $this->clinica->nombre,
                'apellido' => $this->clinica->apellido,
                'email' => $this->clinica->email,
                'dni' => $this->clinica->dni,
                'celular' => $this->clinica->celular,
                'genero' => $this->clinica->genero,
                'rol' =>   "paciente",
            ]
        );

        $this->usuario_clinica->paciente->sedes()->attach($this->sede->id);

        $this->usuario_clinica = $this->usuario_clinica->fresh();

        $paciente = $this->usuario_clinica->paciente;

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

            //$this->emit('mensajeEliminado', "Desasignado.");

            $this->reset('paciente');
        }
    }

    public function render()
    {
        return view('livewire.encargado.clinica-sede.clinica-sede-informacion-pagina')->layout('layouts.administrador.index');
    }
}
