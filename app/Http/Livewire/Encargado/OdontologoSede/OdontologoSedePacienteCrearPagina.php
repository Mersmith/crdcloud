<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use App\Models\Odontologo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OdontologoSedePacienteCrearPagina extends Component
{
    public $odontologo;

    public
        $sede_id = "",
        $odontologo_id = "",
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
        'dni' => 'required|digits:8|unique:users',
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
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;

        $this->odontologo = $odontologo;
        $this->sede_id = $odontologo->sede->id;
        $this->odontologo_id = $odontologo->id;
    }

    public function crearPaciente()
    {
        $this->validate();

        $usuario = new User();
        $usuario->email = $this->email;
        $usuario->password = Hash::make($this->password);
        $usuario->dni = $this->dni;
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

        $usuario->paciente->odontologos()->attach($this->odontologo_id);

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.odontologo.paciente.editar', ['odontologo' => $this->odontologo_id, 'paciente' => $usuario->paciente->id]);
    }

    public function render()
    {
        return view('livewire.encargado.odontologo-sede.odontologo-sede-paciente-crear-pagina')->layout('layouts.administrador.index');
    }
}
