<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Sede;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use DOMDocument;
use DOMXPath;

class OdontologoEditarPagina extends Component
{
    protected $listeners = ['eliminarOdontologo'];

    public $usuario_odontologo;
    public $odontologo;
    public $especialidades;
    public $sedes;

    public
        $especialidad_id = "",
        $sedesSeleccionadas  = [],
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

    protected $rules = [
        'especialidad_id' => 'required',
        'sedesSeleccionadas' => 'required|array|min:1',
        'sedesSeleccionadas.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'username' => 'required',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
        'puntos' => 'required',
    ];

    protected $validationAttributes = [
        'sedesSeleccionadas' => 'sedes',
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
    ];

    protected $messages = [
        'sedesSeleccionadas.required' => 'La :attribute es requerido.',
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
    ];

    public function mount(Odontologo $odontologo)
    {
        $this->especialidades = Especialidad::all();
        $this->sedes = Sede::all();

        $this->usuario_odontologo = $odontologo->user;
        $this->odontologo = $odontologo;

        $this->especialidad_id = $odontologo->especialidad_id;
        $this->sedesSeleccionadas = $odontologo->sedes->pluck('id')->toArray();
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

        if ($odontologo->rol == "odontologo") {
            $this->tiene_clinica = false;
        } else {
            $this->tiene_clinica = true;
        }
    }

    public function editarOdontologo()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|digits:8|unique:odontologos,dni,' . $this->odontologo->id;
        $rules['cop'] = 'required|max:6|unique:odontologos,cop,' . $this->odontologo->id;

        if ($this->tiene_clinica) {
            $rules['ruc'] = 'required|digits:11';
            $rules['nombre_clinica'] = 'required|unique:odontologos,nombre_clinica,' . $this->odontologo->id;
            $rol = "clinica";
        } else {
            $this->ruc = null;
            $this->nombre_clinica = null;
            $rol = "odontologo";
        }

        $this->validate($rules);

        $respuesta_cop = $this->validarCop();

        if ($respuesta_cop->length == 0) {
            $this->emit('mensajeError', "COP no existe.");
            return;
        }

        $this->odontologo->update(
            [
                'especialidad_id' => $this->especialidad_id,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'dni' => $this->dni,
                'cop' => $this->cop,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
                'puntos' => $this->puntos,
                'rol' => $rol,
                'ruc' => $this->ruc,
                'nombre_clinica' => $this->nombre_clinica,
            ]
        );

        $this->odontologo->sedes()->sync($this->sedesSeleccionadas);

        $this->emit('mensajeActualizado', "Editado.");
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

    public function validarCop()
    {
        $theFile = file_get_contents('https://sigacop.cop.org.pe/consultas_web/consulta_colegiado.asp?TxtBusqueda=' . $this->cop);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($theFile);
        $body = "";
        foreach ($dom->getElementsByTagName("body")->item(0)->childNodes as $child) {
            $body .= $dom->saveHTML($child);
        }

        $finder = new DOMXPath($dom);
        $nodes = $finder->query("/html/body/form/table");

        return $nodes;
    }


    public function eliminarOdontologo()
    {
        if ($this->usuario_odontologo->direccion) {
            $this->usuario_odontologo->direccion->delete();
        }

        if ($this->odontologo->imagenPerfil) {
            $imagenEliminar = $this->odontologo->imagenPerfil;
            Storage::delete([$this->odontologo->imagenPerfil->imagen_perfil_ruta]);

            $imagenEliminar->delete();
        }

        $this->odontologo->sedes()->detach();

        $this->odontologo->delete();

        $this->usuario_odontologo->delete();

        return redirect()->route('administrador.odontologo.index');
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-editar-pagina')->layout('layouts.administrador.index');
    }
}
