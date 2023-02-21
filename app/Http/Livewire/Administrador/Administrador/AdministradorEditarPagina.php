<?php

namespace App\Http\Livewire\Administrador\Administrador;

use App\Models\Administrador;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdministradorEditarPagina extends Component
{
    protected $listeners = ['eliminarAdministrador'];

    public $usuario_administrador;
    public $administrador;
    public $sedes;

    public
        $sede_id = "",
        $nombre,
        $apellido,
        $email,
        $password = "contrasenaejemplo",
        $editar_password = null,
        $dni,
        $celular;

    protected $rules = [
        'sede_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'celular' => 'required|digits:9',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'editar_password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'editar_password.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'celular.required' => 'El :attribute es requerido.',
    ];

    public function mount(Administrador $administrador)
    {
        $this->sedes = Sede::all();

        $this->usuario_administrador = $administrador->user;
        $this->administrador = $administrador;

        $this->sede_id = $administrador->sede_id;
        $this->email = $administrador->email;
        $this->nombre = $administrador->nombre;
        $this->apellido = $administrador->apellido;
        $this->dni = $this->usuario_administrador->dni;
        $this->celular = $administrador->celular;
    }

    public function editarAdministrador()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|unique:users,dni,' . $this->usuario_administrador->id;
        $rules['email'] = 'required|unique:users,email,' . $this->usuario_administrador->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_administrador->update(
            [
                'dni' => $this->dni,
                'email' => $this->email,
            ]
        );

        $this->administrador->update(
            [
                'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
            ]
        );

        if ($this->editar_password) {
            //$usuario = User::find($this->administrador->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editar_password;

            $this->usuario_administrador->password = Hash::make($contrasenaNueva);
            $this->usuario_administrador->save();
        }

        $this->emit('mensajeActualizado', "Editado.");

        //return redirect()->route('administrador.administrador.index');
    }

    public function eliminarAdministrador()
    {
        $this->administrador->delete();
        $this->usuario_administrador->delete();

        return redirect()->route('administrador.administrador.index');
    }

    public function render()
    {
        return view('livewire.administrador.administrador.administrador-editar-pagina')->layout('layouts.administrador.index');
    }
}
