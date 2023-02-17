<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OdontologoEditarPagina extends Component
{
    protected $listeners = ['eliminarOdontologo'];

    public $usuario_odontologo;
    public $odontologo;
    public $especialidades;

    public
        $especialidad_id = "",
        $sede_id,
        $nombre,
        $apellido,
        $email,
        $password = "contrasenaejemplo",
        $editar_password = null,
        $dni,
        $cop,
        $celular,
        $fecha_nacimiento,
        $genero,
        $puntos;

    protected $rules = [
        'especialidad_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
        'puntos' => 'required',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'editar_password' => 'contraseña',
        'dni' => 'DNI',
        'cop' => 'COP',
        'celular' => 'celular',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'genero' => 'genero',
        'puntos' => 'puntos',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'editar_password.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'cop.required' => 'El :attribute es requerido.',
        'cop.unique' => 'El :attribute ya existe.',
        'celular.required' => 'El :attribute es requerido.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'puntos.required' => 'Los :attribute son requerido.',
    ];

    public function mount(Odontologo $odontologo)
    {
        $this->especialidades = Especialidad::all();

        $this->usuario_odontologo = $odontologo->user;
        $this->odontologo = $odontologo;

        $this->especialidad_id = $odontologo->especialidad_id;
        $this->email = $odontologo->email;
        $this->nombre = $odontologo->nombre;
        $this->apellido = $odontologo->apellido;
        $this->dni = $this->usuario_odontologo->dni;
        $this->cop = $this->usuario_odontologo->cop;
        $this->celular = $odontologo->celular;
        $this->fecha_nacimiento = $odontologo->fecha_nacimiento;
        $this->genero = $odontologo->genero;
        $this->puntos = $odontologo->puntos;
    }

    public function editarOdontologo()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|unique:users,dni,' . $this->usuario_odontologo->id;
        $rules['cop'] = 'required|unique:users,cop,' . $this->usuario_odontologo->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_odontologo->update(
            [
                'dni' => $this->dni,
                'cop' => $this->cop,
            ]
        );

        $this->odontologo->update(
            [
                'especialidad_id' => $this->especialidad_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'puntos' => $this->puntos,
            ]
        );

        if ($this->editar_password) {
            $usuario = User::find($this->odontologo->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editar_password;

            $usuario->password = Hash::make($contrasenaNueva);
            $usuario->save();
        }

        $this->emit('mensajeActualizado', "Editado.");

        //return redirect()->route('administrador.odontologo.index');
    }

    public function eliminarOdontologo()
    {
        $this->odontologo->delete();

        $usuario = User::find($this->usuario_odontologo->id);
        $usuario->delete();

        return redirect()->route('administrador.odontologo.index');
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-editar-pagina')->layout('layouts.administrador.index');
    }
}
