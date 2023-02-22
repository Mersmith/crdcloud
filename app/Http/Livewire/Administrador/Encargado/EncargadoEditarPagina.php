<?php

namespace App\Http\Livewire\Administrador\Encargado;

use App\Models\Encargado;
use App\Models\Sede;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EncargadoEditarPagina extends Component
{
    protected $listeners = ['eliminarEncargado'];

    public $usuario_encargado;
    public $encargado;
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
        'nombre' => 'required',
        'apellido' => 'required',
        'celular' => 'required|digits:9',
    ];

    protected $validationAttributes = [
        'sede_id' => 'sede',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'editar_password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
    ];

    protected $messages = [
        'sede_id.unique' => 'La :attribute ya esta asignado a otro encargado.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'editar_password.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'celular.required' => 'El :attribute es requerido.',
    ];

    public function mount(Encargado $encargado)
    {
        $this->sedes = Sede::all();

        $this->usuario_encargado = $encargado->user;
        $this->encargado = $encargado;

        $this->sede_id = $encargado->sede_id;
        $this->email = $encargado->email;
        $this->nombre = $encargado->nombre;
        $this->apellido = $encargado->apellido;
        $this->dni = $this->usuario_encargado->dni;
        $this->celular = $encargado->celular;
    }

    public function editarEncargado()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|digits:8|unique:users,dni,' . $this->usuario_encargado->id;
        $rules['email'] = 'required|unique:users,email,' . $this->usuario_encargado->id;
        $rules['sede_id'] = 'required|unique:encargados,sede_id,' . $this->encargado->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_encargado->update(
            [
                'dni' => $this->dni,
                'email' => $this->email,
            ]
        );

        $this->encargado->update(
            [
                'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
            ]
        );

        if ($this->editar_password) {
            //$usuario = User::find($this->encargado->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editar_password;

            $this->usuario_encargado->password = Hash::make($contrasenaNueva);
            $this->usuario_encargado->save();
        }

        $this->emit('mensajeActualizado', "Editado.");

        //return redirect()->route('administrador.encargado.index');
    }

    public function eliminarEncargado()
    {
        $this->encargado->delete();
        $this->usuario_encargado->delete();

        return redirect()->route('administrador.encargado.index');
    }

    public function render()
    {
        return view('livewire.administrador.encargado.encargado-editar-pagina')->layout('layouts.administrador.index');
    }
}
