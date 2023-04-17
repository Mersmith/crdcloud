<?php

namespace App\Http\Livewire\Encargado\VentaSede;

use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\Servicio;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class VentaSedeCrearLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['cambiarPosicionImagenes'];

    public $imagenes = [];

    public $sedes;
    public $odontologos = [];
    public $clinicas = [];
    public $pacientes = [];
    public $servicios;

    public
        $sede,
        $sede_id = "";

    public
        $odontologo,
        $odontologo_id = "",
        $usuario_odontologo;

    public
        $clinica,
        $clinica_id = "",
        $usuario_clinica;

    public
        $paciente_id = "",
        $servicio = "",
        $cantidad = 1,
        $link = null,
        $estado = 1,
        $observacion = null;

    public $carrito = [];

    public $informe;

    public
        $buscarOdontologo,
        $buscarClinica,
        $buscarPaciente,
        $buscarServicio;

    public $filtrar_sede = true;

    protected $messages = [
        'paciente_id.required' => 'El paciente es requerido.',
        'servicio.required' => 'El servicio es requerido.',
        'imagenes.required' => 'Las imagenes son requerido.',
        'link.required' => 'El link es requerido.',
    ];

    public function mount()
    {
        $this->sede = Auth::user()->encargado->sede;
        $this->sede_id = $this->sede->id;
        $this->sedes = Sede::all();

        $this->servicios = Servicio::select('id', 'nombre', 'precio_venta')->get();

        if ($this->filtrar_sede) {
            $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
            $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();
        } else {
            $this->odontologos = Odontologo::where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->get();
            $this->clinicas = Odontologo::where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function updatedFiltrarSede($value)
    {
        $this->sede = Auth::user()->encargado->sede;
        $this->sede_id = $this->sede->id;

        if ($value) {
            $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
            $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();
        } else {
            $this->odontologos = Odontologo::where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->get();;
            $this->clinicas = Odontologo::where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->get();
            $this->reset('sede_id');
        }

        $this->reset(['odontologo_id', 'paciente_id', 'buscarOdontologo', 'buscarClinica', 'buscarPaciente']);
    }

    public function updatedSedeId($value)
    {
        $this->sede = Sede::find($value);
        $this->sede_id = $this->sede->id;
        if ($this->filtrar_sede) {
            $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
            $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();
        } else {
            $this->odontologos = Odontologo::where('rol', '=', 'odontologo')
                ->orderBy('created_at', 'desc')
                ->get();;
            $this->clinicas = Odontologo::where('rol', '=', 'clinica')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $this->reset(['odontologo_id', 'clinica_id', 'paciente_id', 'buscarOdontologo', 'buscarClinica', 'buscarPaciente']);
    }

    public function updatedOdontologoId($value)
    {
        $this->odontologo = Odontologo::find($value);
        $this->odontologo_id = $this->odontologo->id;
        $this->usuario_odontologo = $this->odontologo->user;

        if ($this->filtrar_sede) {
            $this->pacientes = $this->odontologo->pacientes()
                ->orderBy('created_at', 'desc')->get();
        } else {
            $this->pacientes =  Paciente::orderBy('created_at', 'desc')->get();
        }

        $this->reset('clinica_id', 'buscarClinica', 'paciente_id');

        $this->buscarOdontologo = $this->odontologo->nombre . ' ' . $this->odontologo->apellido;
    }

    public function updatedClinicaId($value)
    {
        $this->clinica = Odontologo::find($value);
        $this->clinica_id = $this->clinica->id;
        $this->usuario_clinica = $this->clinica->user;

        if ($this->filtrar_sede) {
            $this->pacientes = $this->clinica->pacientes()
                ->orderBy('created_at', 'desc')->get();
        } else {
            $this->pacientes =  Paciente::orderBy('created_at', 'desc')->get();
        }

        $this->reset('odontologo_id', 'buscarOdontologo', 'paciente_id');

        $this->buscarClinica = $this->clinica->nombre . ' ' . $this->clinica->apellido;
    }

    public function agregarCarrito()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['servicio'] = 'required';

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            $servicioCarrito = json_decode(json_encode($this->servicio), true);

            foreach ($this->carrito as $value) {
                if ($value["id"] == $servicioCarrito["id"]) {
                    $this->emit('mensajeError', "Ya existe el servicio.");
                    return;
                }
            }

            $extraerKeys = ['id', 'nombre'];
            $servicioFiltrado = array_intersect_key($servicioCarrito, array_flip($extraerKeys));

            $precioCompra = $servicioCarrito["precio_venta"];
            $puntosGanar = $servicioCarrito["puntos_ganar"];
            $cantidadCompra = $this->cantidad;

            $servicioFiltrado["servicio_id"] = $servicioFiltrado['id'];
            $servicioFiltrado["cantidad"] = $cantidadCompra;
            $servicioFiltrado["precio"] = $precioCompra;
            $servicioFiltrado["puntos"] = $puntosGanar;
            $servicioFiltrado["subtotal_compra"] = $cantidadCompra * $precioCompra;
            $servicioFiltrado["subtotal_puntos"] = $cantidadCompra * $puntosGanar;

            array_push($this->carrito, $servicioFiltrado);

            $this->emit('mensajeCreado', "Agregado.");
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
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

    public function cambiarPosicionImagenes($sorts)
    {
        $sorted = [];

        foreach ($sorts as  $position) {
            $existe = $this->imagenes[$position];
            array_push($sorted, $existe);
        }

        $this->imagenes = $sorted;
    }

    public function crearVenta()
    {
        $rules = [];

        if ($this->informe) {
            $rules['informe'] = 'required|file|mimes:zip';
        }

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        //$rules['imagenes'] = 'required';
        $rules['carrito'] = 'required';

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            if ($this->odontologo_id) {
                $this->clinica_id = null;
            } else {
                $this->odontologo_id = null;
            }

            $subTotal = array_sum(array_column($this->carrito, 'subtotal_compra'));
            $totalPagar = $subTotal;

            $puntosTotal = array_sum(array_column($this->carrito, 'subtotal_puntos'));
            $totalPuntos = $puntosTotal;

            $nuevaVenta = new Venta();
            $nuevaVenta->sede_id = $this->sede_id;
            $nuevaVenta->paciente_id = $this->paciente_id;

            if ($this->odontologo_id) {
                $nuevaVenta->odontologo_id = $this->odontologo_id;
            } else {
                $nuevaVenta->odontologo_id = $this->clinica_id;
            }

            $nuevaVenta->estado = $this->estado;
            $nuevaVenta->total = $totalPagar;
            $nuevaVenta->puntos_ganados = $totalPuntos;
            $nuevaVenta->link = $this->link;
            $nuevaVenta->observacion = $this->observacion;
            $nuevaVenta->save();

            $nuevaVenta->ventaDetalle()->createMany($this->carrito);

            foreach ($this->imagenes as $key => $imagen) {
                $urlImagen = Storage::put('radiografias', $imagen);

                $nuevaVenta->imagenes()->create([
                    'imagen_ruta' => $urlImagen,
                    'posicion' => $key + 1,
                ]);
            }

            if ($this->informe) {
                $informeSubir = $this->informe->store('informes');
                $nuevaVenta->informes()->create([
                    'informe_ruta' => $informeSubir
                ]);
            }

            //Pagado
            if ($this->estado == 2) {
                if ($this->odontologo_id) {
                    $this->odontologo->update(
                        [
                            'puntos' => $this->odontologo->puntos + $totalPuntos
                        ]
                    );
                } else {
                    $this->clinica->update(
                        [
                            'puntos' => $this->clinica->puntos + $totalPuntos
                        ]
                    );
                }
            }

            $this->emit('mensajeCreado', "Creado.");

            return redirect()->route('encargado.venta.sede.editar', $nuevaVenta->id);
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function render()
    {
        return view('livewire.encargado.venta-sede.venta-sede-crear-livewire')->layout('layouts.administrador.index');
    }
}
