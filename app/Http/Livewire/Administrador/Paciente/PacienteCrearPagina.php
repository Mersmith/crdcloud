<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Odontologo;
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
        $username = null,
        $email = null,
        $password = null,
        $dni = null,
        $carnet_extranjeria = null,
        $edad = null,
        $celular = null,
        $genero = "hombre";

    public $es_extranjero = false;

    protected $rules = [
        'sedesArray' => 'required|array|min:1',
        'sedesArray.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'unique:users',
        'username' => 'required|unique:users',
        'edad' => 'required',
        'genero' => 'required',
        'password' => 'required',
    ];

    protected $validationAttributes = [
        'sedesArray' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'username' => 'nombre de usuario',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'carnet_extranjeria' => 'carnet de extranjería',
        'edad' => 'edad',
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
        'carnet_extranjeria.unique' => 'El :attribute ya existe.',
        'edad.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    /*public function generarUsername($nombre, $apellido)
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
    }*/

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

            if ($this->es_extranjero) {
                $rules['carnet_extranjeria'] = 'unique:pacientes';
                $this->reset('dni');
                $documentoIdentidad = $this->carnet_extranjeria;
            } else {
                $rules['dni'] = 'digits:8|unique:pacientes';
                $this->reset('carnet_extranjeria');
                $documentoIdentidad = $this->dni;
            }

            if ($this->email) {
                $email = $this->email;
            } else {
                $email = $documentoIdentidad . '@crd.com';
            }

            $this->username = $documentoIdentidad;
            $this->password = $documentoIdentidad;

            $this->validate($rules);

            $usuario = new User();
            $usuario->email = $email;
            $usuario->username = $this->username;
            $usuario->password = Hash::make($this->password);
            $usuario->rol = "paciente";
            $usuario->save();

            $usuario->paciente()->create(
                [
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'dni' => $this->dni,
                    'carnet_extranjeria' => $this->carnet_extranjeria,
                    'edad' => $this->edad,
                    'email' => $email,
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
