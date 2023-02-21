<?php

namespace App\Http\Livewire\Administrador\Administrador;

use App\Models\Administrador;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdministradorCrearPagina extends Component
{
    public $sedes;

    public
    $sede_id = "",
    $nombre = null,
    $apellido = null,
    $email = null,
    $password = null,
    $dni = null,
    $celular = null;

    protected $rules = [
        'sede_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'dni' => 'required|digits:8|unique:users',
        'celular' => 'required|digits:9',
    ];

    protected $validationAttributes = [
        'sede_id' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
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
    ];

    public function mount()
    {
        $this->sedes = Sede::all();
    }

    public function crearAdministrador()
    {
        $this->validate();

        $usuario = new User();
        $usuario->email = $this->email;
        $usuario->password = Hash::make($this->password);
        $usuario->dni = $this->dni;
        $usuario->rol = "administrador";
        $usuario->save();

        $usuario->administrador()->create(
            [
                'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
            ]
        );

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.administrador.editar', $usuario->administrador->id);
    }

    public function render()
    {
        return view('livewire.administrador.administrador.administrador-crear-pagina')->layout('layouts.administrador.index');
    }
}
