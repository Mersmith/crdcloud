<?php

namespace App\Http\Livewire\Administrador\Encargado;

use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class EncargadoCrearPagina extends Component
{
    public $sedes;

    public
        $sede_id = "",
        $nombre = null,
        $apellido = null,
        $username = null,
        $email = null,
        $password = null,
        $celular = null;

    protected $rules = [
        'sede_id' => 'required|unique:encargados',
        'nombre' => 'required',
        'username' => 'required|unique:users',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'celular' => 'required|digits:9',
    ];

    protected $validationAttributes = [
        'sede_id' => 'sede',
        'nombre' => 'nombre',
        'username' => 'nombre de usuario',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'celular' => 'celular',
    ];

    protected $messages = [
        'sede_id.required' => 'La :attribute es requerido.',
        'sede_id.unique' => 'La :attribute ya esta asignado a otro encargado.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'username.required' => 'El :attribute es requerido.',
        'username.unique' => 'El :attribute ya existe.',
        'password.required' => 'La :attribute es requerido.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
    ];

    public function mount()
    {
        $this->sedes = Sede::all();
    }

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

    public function crearEncargado()
    {
        $this->validate();

        $usuario = new User();
        $usuario->email = $this->email;
        $usuario->username = $this->username;
        $usuario->password = Hash::make($this->password);
        $usuario->rol = "encargado";
        $usuario->save();

        $usuario->encargado()->create(
            [
                'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
            ]
        );

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.encargado.editar', $usuario->encargado->id);
    }
    public function render()
    {
        return view('livewire.administrador.encargado.encargado-crear-pagina')->layout('layouts.administrador.index');
    }
}
