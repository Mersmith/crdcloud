<?php

namespace App\Http\Livewire\Sesion\Odontologo;

use App\Models\Especialidad;
use App\Models\Sede;
use App\Models\User;
use DOMDocument;
use DOMXPath;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class OdontologoRegistrarLivewire extends Component
{
    public $especialidades;

    public
        $especialidad_id = "",
        $nombre = null,
        $apellido = null,
        $email = null,
        $password = null,
        $dni = null,
        $cop = null,
        $celular = null,
        $fecha_nacimiento = null,
        $genero = "hombre",
        $ruc = null,
        $nombre_clinica = null;

    public $tiene_clinica = true;

    protected $rules = [
        'especialidad_id' => 'required',
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:5',
        'dni' => 'required|digits:8|unique:users',
        'cop' => 'required|digits:6|unique:users',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'especialidad_id' => 'especialidad',
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'cop' => 'COP',
        'celular' => 'celular',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'genero' => 'genero',
        'ruc' => 'ruc',
        'nombre_clinica' => 'nombre de la clínica',
    ];

    protected $messages = [
        'especialidad_id.required' => 'La :attribute es requerido.',
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
        'ruc.required' => 'El :attribute es requerido.',
        'ruc.unique' => 'El :attribute ya existe.',
        'ruc.digits' => 'El :attribute acepta 11 dígitos.',
        'nombre_clinica.required' => 'El :attribute es requerido.',
        'nombre_clinica.unique' => 'El :attribute ya existe.',
    ];

    public function mount()
    {
        $this->especialidades = Especialidad::all();
    }

    public function register()
    {
        $rules = $this->rules;

        if ($this->tiene_clinica) {
            $rules['ruc'] = 'required|digits:11|unique:clinicas';
            $rules['nombre_clinica'] = 'required|unique:clinicas';
            $rol = "clinica";
        } else {
            $this->ruc = null;
            $this->nombre_clinica = null;
            $rol = "odontologo";
        }

        $this->validate($rules);

        /*$respuesta_cop = $this->validarCop();

        if ($respuesta_cop->length == 0) {
            $this->emit('mensajeError', "COP no existe.");
            return;
        }

        $respuesta_reniec = $this->validarDni();

        if (count($respuesta_reniec) > 3) {
            $dni = $respuesta_reniec['dni'];
            $nombres = $respuesta_reniec['nombres'];
            $apellidoPaterno = $respuesta_reniec['apellidoPaterno'];
            $apellidoMaterno = $respuesta_reniec['apellidoMaterno'];
        } else {
            $this->emit('mensajeError', "DNI no existe.");
            return;
        }*/

        $usuario = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'dni' => $this->dni,
            'cop' => $this->cop,
            'rol' => $rol,
        ]);

        if ($this->tiene_clinica) {
            $usuario->clinica()->create(
                [
                    'especialidad_id' => $this->especialidad_id,
                    'sede_id' => 1,
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'email' => $this->email,
                    'celular' => $this->celular,
                    'fecha_nacimiento' => $this->fecha_nacimiento,
                    'genero' => $this->genero,
                    'puntos' => 5,
                    'ruc' => $this->ruc,
                    'nombre_clinica' => $this->nombre_clinica,
                ]
            );
        } else {
            $usuario->odontologo()->create(
                [
                    'especialidad_id' => $this->especialidad_id,
                    'sede_id' => 1,
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'email' => $this->email,
                    'celular' => $this->celular,
                    'fecha_nacimiento' => $this->fecha_nacimiento,
                    'genero' => $this->genero,
                    'puntos' => 5,
                ]
            );
        }

        $this->emit('mensajeCreado', "Creado.");

        //event(new Registered($usuario));
        //auth()->login($usuario);

        return redirect()->route('inicio');
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

    public function validarDni()
    {
        $response = Http::get('https://dniruc.apisperu.com/api/v1/dni/' . $this->dni . '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1lcnNtaXRoMTRAZ21haWwuY29tIn0.b1l7fSgqx6MaTwy20I2XjtTE_rLwyEBPtbquIkH6Pyc');
        $persona = $response->json();

        return $persona;
    }

    public function render()
    {
        return view('livewire.sesion.odontologo.odontologo-registrar-livewire')->layout('layouts.sesion.index');
    }
}
