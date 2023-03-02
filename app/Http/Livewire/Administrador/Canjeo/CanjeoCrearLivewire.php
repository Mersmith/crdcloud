<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use App\Models\Canjeo;
use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CanjeoCrearLivewire extends Component
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
        $link = "",
        $estado = 1,
        $observacion = "";

    public $carrito = [];

    public $informe;

    protected $messages = [
        'paciente_id.required' => 'El paciente es requerido.',
        'servicio.required' => 'El servicio es requerido.',
        'imagenes.required' => 'Las imagenes son requerido.',
        'link.required' => 'El link es requerido.',
    ];

    public function mount()
    {
        $this->sedes = Sede::all();
        $this->servicios = Servicio::select('id', 'nombre')->get();
    }

    public function updatedSedeId($value)
    {
        $this->sede = Sede::find($value);
        $this->sede_id = $this->sede->id;

        $this->odontologos = Odontologo::where('sede_id', $this->sede_id)->get();
        $this->clinicas = Clinica::where('sede_id', $this->sede_id)->get();

        $this->reset(['odontologo_id', 'clinica_id', 'paciente_id']);
    }

    public function updatedOdontologoId($value)
    {
        $this->odontologo = Odontologo::find($value);
        $this->odontologo_id = $this->odontologo->id;
        $this->usuario_odontologo = $this->odontologo->user;

        $this->pacientes = $this->odontologo->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->reset('clinica_id', 'paciente_id');
    }

    public function updatedClinicaId($value)
    {
        $this->clinica = Clinica::find($value);
        $this->clinica_id = $this->clinica->id;
        $this->usuario_clinica = $this->clinica->user;

        $this->pacientes = $this->clinica->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->reset('odontologo_id', 'paciente_id');
    }

    public function agregarCarrito()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['servicio'] = 'required';

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            $servicioCarrito = json_decode($this->servicio, true);

            foreach ($this->carrito as $value) {
                if ($value["id"] == $servicioCarrito["id"]) {
                    $this->emit('mensajeError', "Ya existe el servicio.");
                    return;
                }
            }

            $extraerKeys = ['id', 'nombre'];
            $servicioFiltrado = array_intersect_key($servicioCarrito, array_flip($extraerKeys));

            $precioCompra = $servicioCarrito["puntos_canjeo"];
            $cantidadCompra = $this->cantidad;

            $servicioFiltrado["servicio_id"] = $servicioFiltrado['id'];
            $servicioFiltrado["cantidad"] = $cantidadCompra;
            $servicioFiltrado["puntos"] = $precioCompra;
            $servicioFiltrado["subtotal_compra"] = $cantidadCompra * $precioCompra;

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
            $rules['informe'] = 'required|file|mimes:pdf';
        }

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['imagenes'] = 'required';
        $rules['link'] = 'required';
        $rules['carrito'] = 'required';

        $array_columna = 'subtotal_compra';
        $subTotal = array_sum(array_column($this->carrito, $array_columna));
        $totalPagar = $subTotal;

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            if ($this->odontologo_id) {
                $this->clinica_id = null;

                if ($this->odontologo->puntos < $totalPagar) {
                    $this->emit('mensajeError', "No tienes puntos suficientes.");
                    return;
                }
            } else {
                $this->odontologo_id = null;

                if ($this->clinica->puntos < $totalPagar) {
                    $this->emit('mensajeError', "No tienes puntos suficientes.");
                    return;
                }
            }

            //Tabla Canjeo
            $nuevaVenta = new Canjeo();
            $nuevaVenta->sede_id = $this->sede_id;
            $nuevaVenta->paciente_id = $this->paciente_id;
            $nuevaVenta->odontologo_id = $this->odontologo_id;
            $nuevaVenta->clinica_id = $this->clinica_id;
            $nuevaVenta->estado = $this->estado;
            $nuevaVenta->total_puntos = $totalPagar;
            $nuevaVenta->puntos_usados = $totalPagar;
            $nuevaVenta->link = $this->link;
            $nuevaVenta->observacion = $this->observacion;
            $nuevaVenta->save();

            //Tabla CanjeoDetalle
            $nuevaVenta->canjeoDetalle()->createMany($this->carrito);

            //Tabla Imagen
            foreach ($this->imagenes as $key => $imagen) {
                $urlImagen = Storage::put('radiografias-canjeo', $imagen);

                $nuevaVenta->imagenesCanjeo()->create([
                    'imagen_canjeo_ruta' => $urlImagen,
                    'posicion' => $key + 1,
                ]);
            }

            //Tabla Informe
            if ($this->informe) {
                $informeSubir = $this->informe->store('informes-canjeo');
                $nuevaVenta->informesCanjeo()->create([
                    'informe_canjeo_ruta' => $informeSubir
                ]);
            }

            if ($this->estado == 2) {
                //Tabla Odontologo
                if ($this->odontologo_id) {
                    $this->odontologo->update(
                        [
                            'puntos' => $this->odontologo->puntos - $totalPagar,
                        ]
                    );
                }
                //Tabla Clinica
                else {
                    $this->clinica->update(
                        [
                            'puntos' => $this->clinica->puntos - $totalPagar,
                        ]
                    );
                }
            }

            $this->emit('mensajeCreado', "Creado.");
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function render()
    {
        return view('livewire.administrador.canjeo.canjeo-crear-livewire')->layout('layouts.administrador.index');
    }
}
