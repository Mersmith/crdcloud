<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ClinicaPacienteCrearPagina extends Component
{
    public $odontologo;
    public $sedes;
    public $sede;

    public
        $sedesArray = [],
        $odontologo_id = "",
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

    public function mount(Odontologo $clinica)
    {
        $this->sedesArray = $clinica->sedes->pluck('id')->toArray();

        $this->odontologo = $clinica;
        $this->odontologo_id = $clinica->id;

        $this->sedes = Sede::all();
    }

    public function crearPaciente()
    {
        $rules = $this->rules;

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

        $usuario->paciente->odontologos()->attach($this->odontologo_id);

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.clinica.paciente.editar', ['clinica' => $this->odontologo_id, 'paciente' => $usuario->paciente->id]);
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-paciente-crear-pagina')->layout('layouts.administrador.index');
    }
}
