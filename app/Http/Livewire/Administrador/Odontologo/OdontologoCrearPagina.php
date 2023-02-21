<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OdontologoCrearPagina extends Component
{
    public $especialidades;

    public
        $especialidad_id = "",
        $sede_id_administrador,
        $nombre = null,
        $apellido = null,
        $email = null,
        $password = null,
        $dni = null,
        $cop = null,
        $celular = null,
        $fecha_nacimiento = null,
        $genero = "hombre",
        $puntos = 0;

    protected $rules = [
        'especialidad_id' => 'required',
        'sede_id_administrador' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'dni' => 'required|digits:7|unique:users',
        'cop' => 'required|digits:6|unique:users',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
        'puntos' => 'required',
    ];

    protected $validationAttributes = [
        'especialidad_id' => 'especialidad',
        'sede_id_administrador' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'cop' => 'COP',
        'celular' => 'celular',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'genero' => 'genero',
        'puntos' => 'puntos',
    ];

    protected $messages = [
        'especialidad_id.required' => 'La :attribute es requerido.',
        'sede_id_administrador.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'password.required' => 'La :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 7 dígitos.',
        'cop.unique' => 'El :attribute ya existe.',
        'cop.required' => 'El :attribute es requerido.',
        'cop.digits' => 'El :attribute acepta 6 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
        'puntos.required' => 'Los :attribute son requerido.',
    ];

    public function mount()
    {
        $this->especialidades = Especialidad::all();

        $this->sede_id_administrador = Auth()->user()->administrador->sede->id;
    }

    public function crearOdontologo()
    {
        $this->validate();

        $usuario = new User();
        $usuario->email = $this->email;
        $usuario->password = Hash::make($this->password);
        $usuario->dni = $this->dni;
        $usuario->cop = $this->cop;
        $usuario->rol = "odontologo";
        $usuario->save();

        $usuario->odontologo()->create(
            [
                'especialidad_id' => $this->especialidad_id,
                'sede_id' => $this->sede_id_administrador,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'puntos' => $this->puntos,
            ]
        );

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.odontologo.editar', $usuario->odontologo->id);
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-crear-pagina')->layout('layouts.administrador.index');
    }
}
