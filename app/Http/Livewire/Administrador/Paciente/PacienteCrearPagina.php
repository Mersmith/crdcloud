<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PacienteCrearPagina extends Component
{
    public $odontologos;
    public $clinicas;

    public
        $sede_id = "",
        $odontologo_id = "",
        $clinica_id = "",
        $nombre = null,
        $apellido = null,
        $email = null,
        $password = null,
        $dni = null,
        $celular = null,
        $fecha_nacimiento = null,
        $genero = "hombre";

    protected $rules = [
        'sede_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'dni' => 'required|digits:7|unique:users',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'sede_id' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'genero' => 'genero',
    ];

    protected $messages = [
        'sede_id.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'password.required' => 'La :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 7 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function mount()
    {
        $this->odontologos = Odontologo::all();
        $this->clinicas = Clinica::all();
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

                $odontologo = Odontologo::find($this->odontologo_id);
                $this->sede_id = $odontologo->sede->id;

                $rules['odontologo_id'] = 'required';
                $rules['sede_id'] = 'required';
                $this->reset('clinica_id');
            } elseif ($this->clinica_id) {

                $clinica = Clinica::find($this->odontologo_id);
                $this->sede_id = $clinica->sede->id;

                $rules['clinica_id'] = 'required';
                $rules['sede_id'] = 'required';
                $this->reset('odontologo_id');
            }

            $this->validate($rules);

            $usuario = new User();
            $usuario->email = $this->email;
            $usuario->password = Hash::make($this->password);
            $usuario->dni = $this->dni;
            $usuario->rol = "paciente";
            $usuario->save();

            $usuario->paciente()->create(
                [
                    'sede_id' => $this->sede_id,
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'email' => $this->email,
                    'celular' => $this->celular,
                    'fecha_nacimiento' => $this->fecha_nacimiento,
                    'genero' => $this->genero,
                ]
            );

            if ($this->odontologo_id) {
                $usuario->paciente->odontologos()->attach($this->odontologo_id);
            } elseif ($this->clinica_id) {
                $usuario->paciente->clinicas()->attach($this->clinica_id);
            }

            $this->emit('mensajeCreado', "Creado.");

            return redirect()->route('administrador.paciente.editar', $usuario->paciente->id);
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-crear-pagina')->layout('layouts.administrador.index');
    }
}
