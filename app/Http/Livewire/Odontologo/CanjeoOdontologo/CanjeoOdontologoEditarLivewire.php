<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use App\Models\Canjeo;
use App\Models\CanjeoDetalle;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CanjeoOdontologoEditarLivewire extends Component
{
    protected $listeners = ['eliminarCanjeo'];

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

        $this->nombre = $canjeo->nombre;
        $this->apellido = $canjeo->apellido;
        $this->dni = $canjeo->dni;

        $this->observacion = $canjeo->observacion;
        $this->total = $canjeo->total_puntos;
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

    public function obtenerTotal()
    {
        return array_reduce($this->canjeo_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['puntos']);
        }, 0);
    }

    public function actualizarCanjeo()
    {
        $rules = [];

        $rules['canjeo_detalles'] = 'required';

        $this->validate($rules);

        $subTotalPuntos = $this->obtenerTotal();
        $totalPuntos = $subTotalPuntos;

        $puntosOdontologo = Auth::user()->odontologo->puntos;

        if ($totalPuntos <= $puntosOdontologo) {

            $this->canjeo->nombre = $this->nombre;
            $this->canjeo->apellido = $this->apellido;
            $this->canjeo->dni = $this->dni;
            $this->canjeo->total_puntos = $totalPuntos;
            $this->canjeo->puntos_usados = $totalPuntos;
            $this->canjeo->observacion = $this->observacion;
            $this->canjeo->update();

            $this->emit('mensajeCreado', "Actualizado.");
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function actualizarCantidad($canjeo_detalle_id, $nueva_cantidad)
    {
        $detalle_canjeo = CanjeoDetalle::find($canjeo_detalle_id);
        $detalle_canjeo->cantidad = $nueva_cantidad;
        $detalle_canjeo->save();

        $this->total = $this->obtenerTotal();
        $this->canjeo->total_puntos = $this->total;
        $this->canjeo->update();
    }

    public function agregarServicioAlDetalleCanjeo()
    {
        $rules = [];

        $rules['servicio'] = 'required';

        $this->validate($rules);

        $servicio = Servicio::findOrFail($this->servicio);

        foreach ($this->canjeo_detalles as $detalle) {
            if ($detalle['servicio_id'] == $this->servicio) {
                $this->emit('mensajeError', "Ya existe el servicio.");
                return;
            }
        }

        $canjeo_detalle = new CanjeoDetalle();
        $canjeo_detalle->canjeo_id = $this->canjeo_id;
        $canjeo_detalle->servicio_id = $servicio->id;
        $canjeo_detalle->cantidad = $this->cantidad;
        $canjeo_detalle->puntos =  $servicio->puntos_canjeo;
        $canjeo_detalle->save();

        $this->canjeo_detalles[] = $canjeo_detalle->toArray();

        $this->total = $this->obtenerTotal();
        $this->canjeo->total_puntos = $this->total;
        $this->canjeo->update();
    }

    public function eliminarUnDetalleCanjeo($canjeo_detalle_id, $index)
    {
        $canjeo_detalle = CanjeoDetalle::findOrFail($canjeo_detalle_id);
        $canjeo_detalle->delete();

        array_splice($this->canjeo_detalles, $index, 1);

        $this->total = $this->obtenerTotal();
        $this->canjeo->total_puntos = $this->total;
        $this->canjeo->update();
    }

    public function eliminarCanjeo()
    {
        if ($this->canjeo) {
            $this->canjeo->canjeoDetalle()->delete();
            $this->canjeo->delete();
        } else {
        }
        return redirect()->route('odontologo.canjeo.odontologo.index');
    }

    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-editar-livewire')->layout('layouts.administrador.index');
    }
}
