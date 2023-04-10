<?php

namespace App\Http\Livewire\Encargado\CanjeoSede;

use App\Models\Canjeo;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CanjeoSedeCrearLivewire extends Component
{
    use WithFileUploads;

    public $imagenes = [];

    public $sedes;
    public $odontologos = [];
    public $pacientes = [];
    public $servicios;

    public
        $sede,
        $sede_id = "";

    public
        $odontologo,
        $odontologo_id = "",
        $usuario_odontologo,
        $puntos = 0;

    public
        $paciente_id = "",
        $servicio = "",
        $cantidad = 1,
        $link = null,
        $estado = 1,
        $observacion = null;

    public
        $nombre = "",
        $apellido = "",
        $dni = "";

    public
        $carrito = [];

    public $informe;

    public
        $buscarOdontologo,
        $buscarPaciente,
        $buscarServicio;

    public $filtrar_sede = true;

    protected $messages = [
        'sede_id.required' => 'La sede es requerido.',
        'servicio.required' => 'El servicio es requerido.',
        'nombre.required' => 'El nombre es requerido.',
        'apellido.required' => 'El apellido es requerido.',
        'dni.required' => 'El DNI es requerido.',
        'carrito.required' => 'El exámen es requerido.',
        'odontologo_id.required' => 'El odontólogo es requerido.',
    ];

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;
        $this->sede_id = $this->sede->id;
        $this->sedes = Sede::all();

        $this->servicios = Servicio::all();

        if ($this->filtrar_sede) {
            $this->odontologos = $this->sede->odontologos;
        } else {
            $this->odontologos = Odontologo::all();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;
        $this->sede_id = $this->sede->id;

        if ($value) {
            $this->odontologos = $this->sede->odontologos;
        } else {
            $this->odontologos = Odontologo::all();
            $this->reset('sede_id');
        }

        $this->reset(['odontologo_id', 'paciente_id', 'buscarOdontologo', 'buscarPaciente', 'puntos']);
    }

    public function updatedSedeId($value)
    {
        $this->sede = Sede::find($value);
        $this->sede_id = $this->sede->id;

        if ($this->filtrar_sede) {
            $this->odontologos = $this->sede->odontologos;
        } else {

            $this->odontologos = Odontologo::all();
        }

        $this->reset(['odontologo_id', 'paciente_id', 'buscarOdontologo', 'buscarPaciente', 'puntos']);
    }

    public function updatedOdontologoId($value)
    {
        if ($value) {
            $this->odontologo = Odontologo::find($value);
            $this->odontologo_id = $this->odontologo->id;
            $this->usuario_odontologo = $this->odontologo->user;
            $this->puntos = $this->odontologo->puntos;

            if ($this->filtrar_sede) {
                $this->pacientes = $this->odontologo->pacientes()
                    ->orderBy('created_at', 'desc')->get();
            } else {
                $this->pacientes =  Paciente::orderBy('created_at', 'desc')->get();
            }
            
            $this->reset('paciente_id', 'buscarPaciente');

            $this->buscarOdontologo = $this->odontologo->nombre . ' ' . $this->odontologo->apellido;
        }
    }

    public function agregarCarrito()
    {
        $puntosOdontologo = $this->puntos;

        $rules = [];

        $rules['servicio'] = 'required';
        $rules['sede_id'] = 'required';
        $rules['odontologo_id'] = 'required';

        $this->validate($rules);

        $servicioCarrito = json_decode(json_encode($this->servicio), true);

        $subTotalPuntos = array_sum(array_column($this->carrito, 'subtotal_canjeo'));
        $totalPuntos = $subTotalPuntos + $servicioCarrito["puntos_canjeo"];

        if ($totalPuntos <= $puntosOdontologo) {
            foreach ($this->carrito as $value) {
                if ($value["id"] == $servicioCarrito["id"]) {
                    $this->emit('mensajeError', "Ya existe el servicio.");
                    return;
                }
            }

            $extraerKeys = ['id', 'nombre'];
            $servicioFiltrado = array_intersect_key($servicioCarrito, array_flip($extraerKeys));

            $puntosCanjeo = $servicioCarrito["puntos_canjeo"];
            $cantidadCanjeo = $this->cantidad;

            $servicioFiltrado["servicio_id"] = $servicioFiltrado['id'];
            $servicioFiltrado["cantidad"] = $cantidadCanjeo;
            $servicioFiltrado["puntos"] = $puntosCanjeo;
            $servicioFiltrado["subtotal_canjeo"] = $cantidadCanjeo * $puntosCanjeo;

            array_push($this->carrito, $servicioFiltrado);

            $this->emit('mensajeCreado', "Agregado.");
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function eliminarServicioCarrito($index)
    {
        array_splice($this->carrito, $index, 1);
    }

    public function eliminarImagen($index)
    {
        array_splice($this->imagenes, $index, 1);
    }

    public function crearVenta()
    {
        $rules = [];

        if ($this->informe) {
            $rules['informe'] = 'required|file|mimes:zip';
        }

        $rules['sede_id'] = 'required';
        $rules['nombre'] = 'required';
        $rules['apellido'] = 'required';
        $rules['dni'] = 'required';
        $rules['carrito'] = 'required';
        $rules['odontologo_id'] = 'required';

        $this->validate($rules);

        if (!$this->paciente_id) {
            $this->paciente_id == null;
        }

        $estado = 1;

        $subTotalPuntos = array_sum(array_column($this->carrito, 'subtotal_canjeo'));
        $totalPuntos = $subTotalPuntos;

        $puntosOdontologo = $this->puntos;

        if ($totalPuntos <= $puntosOdontologo) {

            //Tabla Canjeo
            $nuevaCanjeo = new Canjeo();
            $nuevaCanjeo->sede_id = $this->sede_id;
            $nuevaCanjeo->odontologo_id = $this->odontologo->id;
            $nuevaCanjeo->paciente_id = $this->paciente_id;
            $nuevaCanjeo->nombre = $this->nombre;
            $nuevaCanjeo->apellido = $this->apellido;
            $nuevaCanjeo->dni = $this->dni;
            $nuevaCanjeo->estado = $this->estado;
            $nuevaCanjeo->total_puntos = $totalPuntos;
            $nuevaCanjeo->puntos_usados = $totalPuntos;
            $nuevaCanjeo->observacion = $this->observacion;
            $nuevaCanjeo->save();

            //Tabla CanjeoDetalle
            $nuevaCanjeo->canjeoDetalle()->createMany($this->carrito);

            foreach ($this->imagenes as $key => $imagen) {
                $urlImagen = Storage::put('radiografias-canjeo', $imagen);

                $nuevaCanjeo->imagenesCanjeo()->create([
                    'imagen_canjeo_ruta' => $urlImagen,
                    'posicion' => $key + 1,
                ]);
            }

            if ($this->informe) {
                $informeSubir = $this->informe->store('informes-canjeo');
                $nuevaCanjeo->informesCanjeo()->create([
                    'informe_canjeo_ruta' => $informeSubir
                ]);
            }

            //Pagado
            if ($this->estado == 2) {
                if ($this->odontologo_id) {
                    $this->odontologo->update(
                        [
                            'puntos' => $this->odontologo->puntos - $totalPuntos
                        ]
                    );
                }
            }

            $this->emit('mensajeCreado', "Creado.");

            return redirect()->route('encargado.canjeo.sede.editar', $nuevaCanjeo->id);
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function render()
    {
        return view('livewire.encargado.canjeo-sede.canjeo-sede-crear-livewire')->layout('layouts.administrador.index');
    }
}
