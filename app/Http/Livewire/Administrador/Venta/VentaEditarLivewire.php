<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Clinica;
use App\Models\Venta;
use Livewire\Component;
use App\Models\Imagen;
use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\Servicio;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class VentaEditarLivewire extends Component
{
    public $venta_id;
    public $venta;
    public $servicios;
    public $estado;
    public $venta_detalles = [];

    public $total;

    public $nuevo_servicio_id;
    public $nueva_cantidad;

    protected $rules = [
        'venta.estado' => 'required',
    ];

    public function mount(Venta $venta)
    {
        $this->venta_id = $venta->id;
        $this->venta = Venta::findOrFail($venta->id);
        $this->servicios = Servicio::all();
        $this->venta_detalles = $this->venta->ventaDetalle->toArray();
        $this->total = $this->venta->total;
        $this->estado = $this->venta->estado;

    }



    public function actualizarVenta()
    {
        $this->validate();

        $this->venta->total = $this->total;

        $this->venta->save();
    }

    public function actualizarDetalleVenta($venta_detalle_id, $cantidad)
    {
        $venta_detalle = VentaDetalle::findOrFail($venta_detalle_id);
        $venta_detalle->cantidad = $cantidad;
        $venta_detalle->save();
    }

    public function agregarServicioAlDetalleVenta()
    {
        $servicio = Servicio::findOrFail($this->nuevo_servicio_id);

        foreach ($this->venta_detalles as $detalle) {
            if ($detalle['servicio_id'] == $this->nuevo_servicio_id) {
                $this->emit('mensajeError', "Ya existe el servicio.");

                return;
            }
        }

        $venta_detalle = new VentaDetalle();
        $venta_detalle->venta_id = $this->venta_id;
        $venta_detalle->servicio_id = $this->nuevo_servicio_id;
        $venta_detalle->cantidad = $this->nueva_cantidad;
        $venta_detalle->precio =  $servicio->precio_venta;

        $venta_detalle->save();

        $this->venta_detalles = $this->venta->ventaDetalle->toArray();

        //array_push($this->venta_detalles, $this->venta->ventaDetalle->toArray());


        //$this->venta->refresh();
    }

    public function eliminarUnDetalleVenta($venta_detalle_id)
    {
        $venta_detalle = VentaDetalle::findOrFail($venta_detalle_id);
        $venta_detalle->delete();

        $this->venta_detalles = $this->venta->ventaDetalle->toArray();
        $this->venta->refresh();
    }

    public function actualizarTotal()
    {
        $this->total = $this->obtenerTotal();

        $this->venta->total = $this->total;
        $this->venta->save();
    }

    public function obtenerTotal()
    {
        return array_reduce($this->venta_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['precio']);
        }, 0);
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-editar-livewire')->layout('layouts.administrador.index');
    }
}
