<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use App\Models\Canjeo;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CanjeoOdontologoEditarLivewire extends Component
{
    public $odontologo, $puntos;

    public $servicios;

    public
        $servicio = "",
        $cantidad = 1;

    public
        $nombre = "",
        $apellido = "",
        $dni = "";

    public
        $carrito = [],
        $total,
        $observacion;

    public $canjeo;
    public $canjeo_id;
    public $canjeo_detalles = [];

    protected $messages = [
        'servicio.required' => 'El servicio es requerido.',
        'nombre.required' => 'El nombre es requerido.',
        'apellido.required' => 'El apellido es requerido.',
        'dni.required' => 'El DNI es requerido.',
        'carrito.required' => 'El exámen es requerido.',
    ];

    public function mount(Canjeo $canjeo)
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;
        $this->puntos = $odontologo->puntos;

        $this->canjeo = $canjeo;
        $this->canjeo_id = $canjeo->id;
        $this->canjeo_detalles = $this->canjeo->canjeoDetalle->toArray();

        $this->servicios = Servicio::pluck('nombre', 'id');

        $this->observacion = $canjeo->observacion;
        $this->total = $canjeo->total_puntos;

        //dd($this->servicios);

    }

    public function agregarCarrito()
    {
        $rules = [];

        $rules['servicio'] = 'required';

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

        $puntosCanjeo = $servicioCarrito["puntos_canjeo"];
        $cantidadCanjeo = $this->cantidad;

        $servicioFiltrado["servicio_id"] = $servicioFiltrado['id'];
        $servicioFiltrado["cantidad"] = $cantidadCanjeo;
        $servicioFiltrado["puntos"] = $puntosCanjeo;
        $servicioFiltrado["subtotal_canjeo"] = $cantidadCanjeo * $puntosCanjeo;

        array_push($this->carrito, $servicioFiltrado);

        $this->emit('mensajeCreado', "Agregado.");
    }

    public function eliminarServicioCarrito($index)
    {
        array_splice($this->carrito, $index, 1);
    }

    public function crearVenta()
    {
        $rules = [];

        $rules['servicio'] = 'required';
        $rules['nombre'] = 'required';
        $rules['apellido'] = 'required';
        $rules['dni'] = 'required';
        $rules['carrito'] = 'required';

        $this->validate($rules);

        $estado = 1;

        $subTotalPuntos = array_sum(array_column($this->carrito, 'subtotal_canjeo'));
        $totalPuntos = $subTotalPuntos;

        $puntosOdontologo = Auth::user()->odontologo->puntos;

        if ($totalPuntos <= $puntosOdontologo) {

            //Tabla Canjeo
            $nuevaCanjeo = new Canjeo();
            $nuevaCanjeo->odontologo_id = $this->odontologo->id;
            $nuevaCanjeo->nombre = $this->nombre;
            $nuevaCanjeo->apellido = $this->apellido;
            $nuevaCanjeo->dni = $this->dni;
            $nuevaCanjeo->estado = $estado;
            $nuevaCanjeo->total_puntos = $totalPuntos;
            $nuevaCanjeo->puntos_usados = $totalPuntos;
            $nuevaCanjeo->observacion = $this->observacion;
            $nuevaCanjeo->save();

            //Tabla CanjeoDetalle
            $nuevaCanjeo->canjeoDetalle()->createMany($this->carrito);

            $this->emit('mensajeCreado', "Creado.");
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-editar-livewire')->layout('layouts.administrador.index');
    }
}
