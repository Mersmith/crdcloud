<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OdontologoCrearPagina extends Component
{
    public $especialidades;
    public $sedes;

    public
        $especialidad_id = "",
        //$sede_id = "",
        $sedesArray = [],
        $nombre = null,
        $apellido = null,
        $email = null,
        $password = null,
        $dni = null,
        $cop = null,
        $celular = null,
        $fecha_nacimiento = null,
        $genero = "hombre",
        $puntos = 0,
        $ruc = null,
        $nombre_clinica = null;

    public $tiene_clinica = true;

    protected $rules = [
        'especialidad_id' => 'required',
        'sedesArray' => 'required|array|min:1',
        'sedesArray.*' => 'exists:sedes,id',
        //'sede_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'dni' => 'required|digits:8|unique:users',
        'cop' => 'required|digits:6|unique:users',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
        'puntos' => 'required',
        //'ruc' => 'required|digits:11',
        //'nombre_clinica' => 'required|unique:odontologos',
    ];

    protected $validationAttributes = [
        'especialidad_id' => 'especialidad',
        //'sede_id' => 'sede',
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
        'ruc' => 'ruc',
        'nombre_clinica' => 'nombre de la clínica',
    ];

    protected $messages = [
        'especialidad_id.required' => 'La :attribute es requerido.',
        //'sede_id.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'password.required' => 'La :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'cop.unique' => 'El :attribute ya existe.',
        'cop.required' => 'El :attribute es requerido.',
        'cop.digits' => 'El :attribute acepta 6 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
        'puntos.required' => 'Los :attribute son requerido.',
        'ruc.required' => 'El :attribute es requerido.',
        'ruc.unique' => 'El :attribute ya existe.',
        'ruc.digits' => 'El :attribute acepta 11 dígitos.',
        'nombre_clinica.required' => 'El :attribute es requerido.',
        'nombre_clinica.unique' => 'El :attribute ya existe.',
    ];

    public function mount()
    {
        $this->especialidades = Especialidad::all();
        $this->sedes = Sede::all();
    }

    public function crearOdontologo()
    {
        $rules = $this->rules;

        if ($this->tiene_clinica) {
            $rules['ruc'] = 'required|digits:11';
            $rules['nombre_clinica'] = 'required|unique:odontologos';
            $rol = "clinica";
        } else {
            $this->ruc = null;
            $this->nombre_clinica = null;
            $rol = "odontologo";
        }

        $this->validate($rules);

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
                //'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'puntos' => $this->puntos,
                'rol' => $rol,
                'ruc' => $this->ruc,
                'nombre_clinica' => $this->nombre_clinica,
            ]
        );

        $usuario->odontologo->sedes()->attach($this->sedesArray);

        $this->emit('mensajeCreado', "Creado.");

        return redirect()->route('administrador.odontologo.editar', $usuario->odontologo->id);
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-crear-pagina')->layout('layouts.administrador.index');
    }
}
