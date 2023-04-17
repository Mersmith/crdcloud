<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Especialidad;
use App\Models\Odontologo;
use App\Models\Sede;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use DOMDocument;
use DOMXPath;

class ClinicaEditarPagina extends Component
{
    protected $listeners = ['eliminarClinica'];

    public $usuario_clinica;
    public $clinica;
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

    protected $rules = [
        'especialidad_id' => 'required',
        'sedesSeleccionadas' => 'required|array|min:1',
        'nombre' => 'required',
        'apellido' => 'required',
        'username' => 'required',
        'celular' => 'required|digits:9',
        //'fecha_nacimiento' => 'required',
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

    public function mount(Odontologo $clinica)
    {
        $this->especialidades = Especialidad::all();
        $this->sedes = Sede::all();

        $this->usuario_clinica = $clinica->user;
        $this->clinica = $clinica;

        $this->especialidad_id = $clinica->especialidad_id;
        $this->sedesSeleccionadas = $clinica->sedes->pluck('id')->toArray();
        $this->email = $clinica->email;
        $this->nombre = $clinica->nombre;
        $this->apellido = $clinica->apellido;
        $this->username = $this->usuario_clinica->username;
        $this->dni = $clinica->dni;
        $this->cop = $clinica->cop;
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

        $rules['dni'] = 'required|digits:8|unique:odontologos,dni,' . $this->clinica->id;
        $rules['cop'] = 'required|unique:odontologos,cop,' . $this->clinica->id;
        $rules['ruc'] = 'required|digits:11|unique:odontologos,ruc,' . $this->clinica->id;
        $rules['nombre_clinica'] = 'required|unique:odontologos,nombre_clinica,' . $this->clinica->id;

        $this->validate($rules);

        $respuesta_cop = $this->validarCop();

        if ($respuesta_cop->length == 0) {
            $this->emit('mensajeError', "COP no existe.");
            return;
        }

        $this->clinica->update(
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
                'ruc' => $this->ruc,
                'nombre_clinica' => $this->nombre_clinica,
            ]
        );

        $this->clinica->sedes()->sync($this->sedesSeleccionadas);

        $this->emit('mensajeActualizado', "Editado.");
    }

    public function editarAcceso()
    {
        $rules = [];

        $rules['email'] = 'required|unique:users,email,' . $this->usuario_clinica->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_clinica->update(
            [
                'email' => $this->email,
            ]
        );

        $this->clinica->update(
            [
                'email' => $this->email,
            ]
        );

        if ($this->editar_password) {
            $contrasenaNueva = $this->editar_password;

            $this->usuario_clinica->password = Hash::make($contrasenaNueva);
            $this->usuario_clinica->save();
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

    public function eliminarClinica()
    {
        if ($this->usuario_clinica->direccion) {
            $this->usuario_clinica->direccion->delete();
        }

        if ($this->clinica->imagenPerfil) {
            $imagenEliminar = $this->clinica->imagenPerfil;
            Storage::delete([$this->clinica->imagenPerfil->imagen_perfil_ruta]);

            $imagenEliminar->delete();
        }

        $this->clinica->sedes()->detach();

        $this->clinica->delete();

        //$usuario = User::find($this->usuario_clinica->id);
        $this->usuario_clinica->delete();

        return redirect()->route('administrador.clinica.index');
    }

    public function render()
    {
        return view('livewire.administrador.clinica.clinica-editar-pagina')->layout('layouts.administrador.index');
    }
}
