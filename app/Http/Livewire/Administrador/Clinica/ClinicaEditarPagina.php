<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Clinica;
use App\Models\Especialidad;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ClinicaEditarPagina extends Component
{
    protected $listeners = ['eliminarClinica'];

    public $usuario_clinica;
    public $clinica;
    public $especialidades;
    public $sedes;

    public
        $especialidad_id = "",
        $sede_id = "",
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
        $puntos,
        $ruc,
        $nombre_clinica;

    protected $rules = [
        'especialidad_id' => 'required',
        'sede_id' => 'required',
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
        'ruc' => 'ruc',
        'nombre_clinica' => 'nombre de la clínica',
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
        'ruc.required' => 'El :attribute es requerido.',
        'ruc.unique' => 'El :attribute ya existe.',
        'nombre_clinica.required' => 'El :attribute es requerido.',
        'nombre_clinica.unique' => 'El :attribute ya existe.',
    ];

    public function mount(Clinica $clinica)
    {
        $this->especialidades = Especialidad::all();
        $this->sedes = Sede::all();

        $this->usuario_clinica = $clinica->user;
        $this->clinica = $clinica;

        $this->especialidad_id = $clinica->especialidad_id;
        $this->sede_id = $clinica->sede_id;
        $this->email = $clinica->email;
        $this->nombre = $clinica->nombre;
        $this->apellido = $clinica->apellido;
        $this->dni = $this->usuario_clinica->dni;
        $this->cop = $this->usuario_clinica->cop;
        $this->celular = $clinica->celular;
        $this->fecha_nacimiento = $clinica->fecha_nacimiento;
        $this->genero = $clinica->genero;
        $this->puntos = $clinica->puntos;
        $this->ruc = $clinica->ruc;
        $this->nombre_clinica = $clinica->nombre_clinica;
    }

    public function editarClinica()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|unique:users,dni,' . $this->usuario_clinica->id;
        $rules['cop'] = 'required|unique:users,cop,' . $this->usuario_clinica->id;
        $rules['email'] = 'required|unique:users,email,' . $this->usuario_clinica->id;
        $rules['ruc'] = 'required|unique:clinicas,ruc,' . $this->clinica->id;
        $rules['nombre_clinica'] = 'required|unique:clinicas,nombre_clinica,' . $this->clinica->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_clinica->update(
            [
                'dni' => $this->dni,
                'cop' => $this->cop,
                'email' => $this->email,
            ]
        );

        $this->clinica->update(
            [
                'especialidad_id' => $this->especialidad_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'puntos' => $this->puntos,
                'ruc' => $this->ruc,
                'nombre_clinica' => $this->nombre_clinica,
            ]
        );

        if ($this->editar_password) {
            $usuario = User::find($this->clinica->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editar_password;

            $usuario->password = Hash::make($contrasenaNueva);
            $usuario->save();
        }

        $this->emit('mensajeActualizado', "Editado.");

        //return redirect()->route('administrador.clinica.index');
    }

    public function eliminarClinica()
    {
        $this->clinica->delete();

        $usuario = User::find($this->usuario_clinica->id);
        $usuario->delete();

        return redirect()->route('administrador.clinica.index');
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-editar-pagina')->layout('layouts.administrador.index');
    }
}
