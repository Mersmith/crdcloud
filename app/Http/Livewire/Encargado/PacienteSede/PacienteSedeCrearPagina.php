<?php

namespace App\Http\Livewire\Encargado\PacienteSede;

use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PacienteSedeCrearPagina extends Component
{
    public $odontologos;
    public $clinicas;
    public $sedes;
    public $sede;

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

    public
        $buscarOdontologo,
        $buscarClinica;

    public $filtrar_sede = true;

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

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;

        $this->sedesArray = [
            '0' => $this->sede->id,
        ];

        $this->sedes = Sede::all();

        if ($this->filtrar_sede) {
            $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
            $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();
        } else {
            $this->odontologos = Odontologo::where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->get();;
            $this->clinicas = Odontologo::where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;

        $this->sedesArray = [
            '0' => $this->sede->id,
        ];

        if ($value) {
            $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
            $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();
        } else {
            $this->odontologos = Odontologo::where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->get();;
            $this->clinicas = Odontologo::where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->get();
            $this->reset('sedesArray');
        }

        $this->reset(['odontologo_id', 'clinica_id', 'buscarOdontologo', 'buscarClinica']);
    }

    public function updatedOdontologoId()
    {
        $this->reset('clinica_id', 'buscarClinica');
    }

    public function updatedClinicaId()
    {
        $this->reset('odontologo_id', 'buscarOdontologo');
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

            return redirect()->route('encargado.paciente.sede.editar', $usuario->paciente->id);
        } else {
            $this->emit('mensajeError', "Debe seleccionar un odontólogo o una clínica.");
        }
    }

    public function render()
    {
        return view('livewire.encargado.paciente-sede.paciente-sede-crear-pagina')->layout('layouts.administrador.index');
    }
}
