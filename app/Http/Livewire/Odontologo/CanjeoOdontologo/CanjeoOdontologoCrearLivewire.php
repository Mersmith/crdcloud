<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use App\Models\Canjeo;
use App\Models\Encargado;
use App\Models\Sede;
use App\Models\Servicio;
use App\Models\User;
use App\Notifications\CanjeoRealizadoNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CanjeoOdontologoCrearLivewire extends Component
{
    public $odontologo, $puntos;

    public $servicios;
    public $sedes;

    public
        $servicio = "",
        $sede_id = "",
        $cantidad = 1;

    public
        $nombre = "",
        $apellido = "",
        $dni = "";

    public
        $carrito = [],
        $observacion = "";

    protected $messages = [
        'sede_id.required' => 'La sede es requerido.',
        'servicio.required' => 'El servicio es requerido.',
        'nombre.required' => 'El nombre es requerido.',
        'apellido.required' => 'El apellido es requerido.',
        'dni.required' => 'El DNI es requerido.',
        'carrito.required' => 'El exámen es requerido.',
    ];

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;
        $this->puntos = $odontologo->puntos;

        $this->servicios = Servicio::all();
        $this->sedes = Sede::all();
    }

    public function agregarCarrito()
    {
        $puntosOdontologo = Auth::user()->odontologo->puntos;

        $rules = [];

        $rules['servicio'] = 'required';
        $rules['sede_id'] = 'required';

        $this->validate($rules);

        $servicioCarrito = json_decode($this->servicio, true);

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

    public function crearVenta()
    {
        $rules = [];

        $rules['servicio'] = 'required';
        $rules['nombre'] = 'required';
        $rules['apellido'] = 'required';
        $rules['dni'] = 'required';
        $rules['carrito'] = 'required';
        $rules['sede_id'] = 'required';

        $this->validate($rules);

        $estado = 1;

        $subTotalPuntos = array_sum(array_column($this->carrito, 'subtotal_canjeo'));
        $totalPuntos = $subTotalPuntos;

        $odontologo = Auth::user()->odontologo;
        $puntosOdontologo = $odontologo->puntos;

        if ($totalPuntos <= $puntosOdontologo) {

            //Tabla Canjeo
            $nuevaCanjeo = new Canjeo();
            $nuevaCanjeo->sede_id = $this->sede_id;
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

            $encargado_sede = Encargado::find($this->sede_id);
            $usuario_encargado = User::find($encargado_sede->user_id);
            $usuario_encargado->notify(new CanjeoRealizadoNotification($nuevaCanjeo));

            return redirect()->route('odontologo.canjeo.odontologo.index', $nuevaCanjeo->id);
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-crear-livewire')->layout('layouts.administrador.index');
    }
}
