<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

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
        $username = null,
        $email = null,
        $password = null,
        $dni = null,
        $celular = null,
        $genero = "hombre";

    protected $rules = [
        'sedesArray' => 'required|array|min:1',
        'sedesArray.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'username' => 'required|unique:users',
        //'password' => 'required',
        'dni' => 'required|digits:8|unique:pacientes',
        'celular' => 'required|digits:9',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'sedesArray' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'username' => 'nombre de usuario',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
        'genero' => 'genero',
    ];

    protected $messages = [
        'sedesArray.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'username.required' => 'El :attribute es requerido.',
        'username.unique' => 'El :attribute ya existe.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
       'password.required' => 'La :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function generarUsername($nombre, $apellido)
    {
        $nombre_sin_espacios = preg_replace('/[^A-Za-z0-9\-]/', '', $nombre);
        $apellido_sin_espacios = preg_replace('/[^A-Za-z0-9\-]/', '', $apellido);

        $nombre_abreviado = substr($nombre_sin_espacios, 0, 2);
        $apellido_abreviado = substr($apellido_sin_espacios, 0, 2);

        $resto_username = str_shuffle($nombre_sin_espacios . $apellido_sin_espacios);
        $resto_username = substr($resto_username, 0, 6);

        $username = Str::lower($nombre_abreviado . $apellido_abreviado . $resto_username);
        $username = substr($username, 0, 8);
        $username;

        return $username;
    }

    public function updatedNombre()
    {
        $this->username = $this->generarUsername($this->nombre, $this->apellido);
    }

    public function updatedApellido()
    {

        $this->username = $this->generarUsername($this->nombre, $this->apellido);
    }

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

            $usuario = new User();
            $usuario->email = $this->email;
            $usuario->username = $this->username;
            $usuario->password = Hash::make($this->dni);
            $usuario->rol = "paciente";
            $usuario->save();

            $usuario->paciente()->create(
                [
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'email' => $this->email,
                    'dni' => $this->dni,
                    'celular' => $this->celular,
                    'genero' => $this->genero,
                    'rol' => "paciente",
                ]
            );

            $usuario->paciente->sedes()->attach($this->sedesArray);

            if ($this->odontologo_id) {
                $usuario->paciente->odontologos()->attach($this->odontologo_id);
            } elseif ($this->clinica_id) {
                $usuario->paciente->odontologos()->attach($this->clinica_id);
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
