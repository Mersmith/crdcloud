<?php

namespace App\Http\Livewire\Odontologo\PerfilOdontologo;

use App\Models\Especialidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class PerfilOdontologoInformacionPagina extends Component
{
    use WithFileUploads;

    public $usuario_odontologo;
    public $odontologo;
    public $especialidades;
    public $sedes;

    public
        $especialidad_id = "",
        $nombre,
        $apellido,
        $username,
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

    public $tiene_clinica;

    public $imagen;
    public $editarImagen = null;

    protected $rules = [
        'especialidad_id' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'username' => 'required',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'username.required' => 'El :attribute es requerido.',
        'username.unique' => 'El :attribute ya existe.',
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
        'editarImagen' => 'imagen',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'editar_password.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'cop.required' => 'El :attribute es requerido.',
        'cop.unique' => 'El :attribute ya existe.',
        'cop.digits' => 'El :attribute acepta 6 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'puntos.required' => 'Los :attribute son requerido.',
        'ruc.required' => 'El :attribute es requerido.',
        'ruc.unique' => 'El :attribute ya existe.',
        'ruc.digits' => 'El :attribute acepta 11 dígitos.',
        'nombre_clinica.required' => 'El :attribute es requerido.',
        'nombre_clinica.unique' => 'El :attribute ya existe.',
        'editarImagen.required' => 'La :attribute es requerido.',
        'editarImagen.image' => 'La :attribute debe ser jpg o png.',
        'editarImagen.max' => 'La :attribute no debe ser mayor de 1024kb',
    ];

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;

        $this->especialidades = Especialidad::all();

        $this->usuario_odontologo = $odontologo->user;
        $this->odontologo = $odontologo;

        $this->especialidad_id = $odontologo->especialidad_id;
        $this->email = $odontologo->email;
        $this->nombre = $odontologo->nombre;
        $this->apellido = $odontologo->apellido;
        $this->username = $this->usuario_odontologo->username;
        $this->dni = $odontologo->dni;
        $this->cop = $odontologo->cop;
        $this->celular = $odontologo->celular;
        $this->fecha_nacimiento = $odontologo->fecha_nacimiento;
        $this->genero = $odontologo->genero;
        $this->puntos = $odontologo->puntos;
        $this->ruc = $odontologo->ruc;
        $this->nombre_clinica = $odontologo->nombre_clinica;

        $this->imagen = $this->odontologo->imagenPerfil ? $this->odontologo->imagenPerfil->imagen_perfil_ruta : null;

        if ($odontologo->rol == "odontologo") {
            $this->tiene_clinica = false;
        } else {
            $this->tiene_clinica = true;
        }
        $this->sedes = $odontologo->sedes->pluck('nombre')->toArray();
    }

    public function editarOdontologo()
    {
        $rules = $this->rules;

        $rules['username'] = 'required|unique:users,username,' . $this->usuario_odontologo->id;
        $rules['dni'] = 'required|digits:8|unique:odontologos,dni,' . $this->odontologo->id;
        $rules['cop'] = 'required|max:6|unique:odontologos,cop,' . $this->odontologo->id;

        if ($this->tiene_clinica) {
            $rules['ruc'] = 'required|digits:11|unique:odontologos,ruc,' . $this->odontologo->id;
            $rules['nombre_clinica'] = 'required|unique:odontologos,nombre_clinica,' . $this->odontologo->id;
            $rol = "clinica";
        } else {
            $this->ruc = null;
            $this->nombre_clinica = null;
            $rol = "odontologo";
        }

        $this->validate($rules);

        $this->odontologo->update(
            [
                'especialidad_id' => $this->especialidad_id,
                //'sede_id' => $this->sede_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'dni' => $this->dni,
                'cop' => $this->cop,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'rol' => $rol,
                'ruc' => $this->ruc,
                'nombre_clinica' => $this->nombre_clinica,
            ]
        );

        $this->emit('mensajeActualizado', "Datos actualizado.");
    }

    public function editarAcceso()
    {
        $rules = [];

        $rules['email'] = 'required|unique:users,email,' . $this->usuario_odontologo->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_odontologo->update(
            [
                'email' => $this->email,
            ]
        );

        $this->odontologo->update(
            [
                'email' => $this->email,
            ]
        );

        if ($this->editar_password) {
            $contrasenaNueva = $this->editar_password;

            $this->usuario_odontologo->password = Hash::make($contrasenaNueva);
            $this->usuario_odontologo->save();
        }

        $this->emit('mensajeActualizado', "Acceso actualizado.");
    }

    public function editarImagen()
    {
        $rules = [];

        if ($this->editarImagen) {
            $rules['editarImagen'] = 'required|image|max:1024';
            $imagenSubir = $this->editarImagen->store('perfiles');
        }

        if (count($rules) > 0) {
            $this->validate($rules);
        }

        if (!$this->imagen) {
            if ($this->odontologo->imagenPerfil) {
                $imagenEliminar = $this->odontologo->imagenPerfil;
                Storage::delete([$this->odontologo->imagenPerfil->imagen_perfil_ruta]);

                $imagenEliminar->delete();
            }
        }

        if ($this->editarImagen) {
            if ($this->odontologo->imagenPerfil) {
                $imagenAntigua = $this->odontologo->imagenPerfil;
                Storage::delete([$this->odontologo->imagenPerfil->imagen_perfil_ruta]);

                $imagenAntigua->delete();
            }

            $this->odontologo->imagenPerfil()->create([
                'imagen_perfil_ruta' => $imagenSubir
            ]);
        }

        $this->emitTo('administrador.menu.menu-principal', 'render');

        $this->emit('mensajeActualizado', "Imagen actualizada.");
    }
    public function render()
    {
        return view('livewire.odontologo.perfil-odontologo.perfil-odontologo-informacion-pagina')->layout('layouts.administrador.index');
    }
}
