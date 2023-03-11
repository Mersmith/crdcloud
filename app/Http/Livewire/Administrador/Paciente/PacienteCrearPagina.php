<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PacienteCrearPagina extends Component
{
    public $odontologos;
    public $clinicas;
    public $sedes;

    public
        $sedesArray = [],
        $odontologo_id = "",
        $clinica_id = "",
        $nombre = null,
        $apellido = null,
        $email = null,
        $dni = null,
        $celular = null,
        $genero = "hombre";

    protected $rules = [
        'sedesArray' => 'required|array|min:1',
        'sedesArray.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'dni' => 'required|digits:8|unique:pacientes',
        'celular' => 'required|digits:9',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'sedesArray' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'dni' => 'DNI',
        'celular' => 'celular',
        'genero' => 'genero',
    ];

    protected $messages = [
        'sedesArray.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function mount()
    {
        $this->odontologos = Odontologo::where('rol', 'odontologo')->get();
        $this->clinicas = Odontologo::where('rol', 'clinica')->get();
        $this->sedes = Sede::all();
    }

    public function updatedOdontologoId()
    {
        $this->reset('clinica_id');
    }

    public function updatedClinicaId()
    {
        $this->reset('odontologo_id');
    }

    public function crearPaciente()
    {
        if ($this->odontologo_id || $this->clinica_id) {
            $rules = $this->rules;

            if ($this->odontologo_id) {
                $rules['odontologo_id'] = 'required';
                $this->reset('clinica_id');
            } elseif ($this->clinica_id) {
                $rules['clinica_id'] = 'required';
                $this->reset('odontologo_id');
            }

            $this->validate($rules);

            $paciente = new Paciente();
            $paciente->nombre = $this->nombre;
            $paciente->apellido = $this->apellido;
            $paciente->dni = $this->dni;
            $paciente->email = $this->email;
            $paciente->celular = $this->celular;
            $paciente->genero = $this->genero;
            $paciente->rol = "paciente";
            $paciente->save();

            $paciente->sedes()->attach($this->sedesArray);

            if ($this->odontologo_id) {
                $paciente->odontologos()->attach($this->odontologo_id);
            } elseif ($this->clinica_id) {
                $paciente->odontologos()->attach($this->clinica_id);
            }

            $this->emit('mensajeCreado', "Creado.");

            return redirect()->route('administrador.paciente.editar', $paciente->id);
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-crear-pagina')->layout('layouts.administrador.index');
    }
}
