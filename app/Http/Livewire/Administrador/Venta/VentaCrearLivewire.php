<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Clinica;
use App\Models\Encargado;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VentaCrearLivewire extends Component
{
    public $encargados;
    public $odontologos = [];
    public $clinicas = [];
    public $pacientes = [];
    public $servicios;

    public
        $encargado,
        $encargado_id = "",
        $usuario_encargado,
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
        $servicio = "";

    public $carrito = [];

    public function mount()
    {
        $this->encargados = Encargado::all();
        $this->servicios = Servicio::select('id', 'nombre')->get();
    }

    public function updatedEncargadoId($value)
    {
        $this->encargado = Encargado::find($value);
        $this->encargado_id = $this->encargado->id;
        $this->usuario_encargado = $this->encargado->user;
        $this->sede_id = $this->encargado->sede_id;

        $this->odontologos = Odontologo::where('sede_id', $this->encargado->sede_id)->get();
        $this->clinicas = Clinica::where('sede_id', $this->encargado->sede_id)->get();

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

        $rules['encargado_id'] = 'required';
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

            $precioCompra = $servicioCarrito["precio_venta"];
            $cantidadCompra = 1;

            $servicioFiltrado["servicio_id"] = $servicioFiltrado['id'];
            $servicioFiltrado["precio"] = $precioCompra;
            $servicioFiltrado["cantidad"] = $cantidadCompra;
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

    public function crearCompra()
    {
        /*$array_columna = 'subtotal_compra';
        $subTotal = array_sum(array_column($this->carrito, $array_columna));
        $totalPagar = $subTotal + ($subTotal * $this->impuesto) / 100;

        $nuevaVenta = new Venta();
        $nuevaVenta->total = $totalPagar;
        $nuevaVenta->impuesto = $this->impuesto;
        $nuevaVenta->proveedor_id = $this->proveedor_id;
        $nuevaVenta->user_id = Auth::user()->id;

        $nuevaVenta->save();

        $nuevaVenta->ventaDetalle()->createMany($this->carrito);*/

        $this->emit('mensajeCreado', "Creado.");
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-crear-livewire')->layout('layouts.administrador.index');
    }
}
