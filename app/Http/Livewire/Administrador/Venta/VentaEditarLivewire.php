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
    use WithFileUploads;

    protected $listeners = ['cambiarPosicionImagenes', 'dropImagenes', 'eliminarVenta'];

    public $venta;
    public $venta_detalle;
    public $venta_detalle_editado;

    public $sedes;
    public $odontologos;
    public $clinicas;
    public $pacientes;
    public $servicios;

    public
        $sede,
        $odontologo,
        $clinica;

    public
        $sede_id,
        $paciente_id,
        $odontologo_id,
        $clinica_id;

    public
        $cantidad = 1,
        $link,
        $estado,
        $observacion;

    public $sub_total = 0;
    public $total = 0;

    public $updatedQuantities = [];

    public function editSaleDetail($id, $servicio_id, $cantidad)
    {
        // Set the initial quantity for the sale detail being edited
        $this->updatedQuantities[$id] = $cantidad;
    }

    public function updateSaleDetailQuantity($id)
    {
        $cantidad = $this->updatedQuantities[$id];

        $venta_detalle = VentaDetalle::find($id);
        $venta_detalle->cantidad = $cantidad;
        $venta_detalle->save();

        $this->venta_detalle = $this->venta_detalle->fresh();

        // Recalculate the sub total
        $this->sub_total = 0;
        foreach ($this->venta_detalle as $venta_detalle_item) {
            $this->sub_total += $venta_detalle_item->precio * $venta_detalle_item->cantidad;
        }
    }


    public function mount(Venta $venta)
    {
        $this->venta = $venta;
        $this->venta_detalle = $venta->ventaDetalle;
        $this->venta_detalle_editado = $venta->ventaDetalle;
        $this->sedes = Sede::all();
        $this->servicios = Servicio::select('id', 'nombre')->get();
        $this->sede_id = $venta->sede_id;
        $this->paciente_id = $venta->paciente_id;
        $this->odontologo_id = $venta->odontologo_id;
        $this->clinica_id = $venta->clinica_id;
        $this->link = $venta->link;
        $this->estado = $venta->estado;
        $this->observacion = $venta->observacion;
        $this->total = $venta->total;

        $this->odontologos = Odontologo::where('sede_id', $venta->sede_id)->get();
        $this->clinicas = Clinica::where('sede_id', $venta->sede_id)->get();

        if ($venta->odontologo_id) {
            $odontologo = Odontologo::find($venta->odontologo_id);
            $this->pacientes = $odontologo->pacientes()
                ->orderBy('created_at', 'desc')->get();
        } else {
            $clinica = Clinica::find($venta->clinica_id);
            $this->pacientes = $clinica->pacientes()
                ->orderBy('created_at', 'desc')->get();
        }
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

        $this->pacientes = $this->odontologo->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->reset('clinica_id', 'paciente_id');
    }

    public function updatedClinicaId($value)
    {
        $this->clinica = Clinica::find($value);
        $this->clinica_id = $this->clinica->id;

        $this->pacientes = $this->clinica->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->reset('odontologo_id', 'paciente_id');
    }


    public function editarDetalleVenta($venta_detalle_id, $servicio_id, $cantidad)
    {
        $venta_detalle = VentaDetalle::find($venta_detalle_id);
        $venta_detalle->update([
            'servicio_id' => $servicio_id,
            'cantidad' => $cantidad,
        ]);
    }

    public function editarVenta()
    {
        if ($this->venta->imagenes->count()) {

            $this->venta->total = $this->total;

            $this->venta->update();

            // Update the quantities of each sale detail in the database
            foreach ($this->updatedQuantities as $id => $cantidad) {
                $venta_detalle = VentaDetalle::find($id);
                $venta_detalle->cantidad = $cantidad;
                $venta_detalle->save();
            }

            // Recalculate the sub total
            $this->sub_total = 0;
            foreach ($this->venta_detalle as $venta_detalle_item) {
                $this->sub_total += $venta_detalle_item->precio * $venta_detalle_item->cantidad;
            }

            $this->venta_detalle = $this->venta_detalle->fresh();

            $this->emit('mensajeActualizado', "El producto ha sido actualizado.");
        } else {
            $this->emit('mensajeError', "Falta subir imagen.");
        }
    }

    public function dropImagenes()
    {
        $this->venta = $this->venta->fresh();
    }

    public function cambiarPosicionImagenes($sorts)
    {
        $posicion = 1;

        foreach ($sorts as $sort) {

            $slider = Imagen::find($sort);
            $slider->posicion = $posicion;
            $slider->save();

            $posicion++;
        }

        $this->dropImagenes();
    }

    public function eliminarImagen(Imagen $imagen)
    {
        Storage::delete([$imagen->imagen_ruta]);
        $imagen->delete();

        $this->venta = $this->venta->fresh();
        $this->emit('mensajeEliminado', "Eliminado.");
    }

    public function eliminarVenta()
    {
        $imagenes = $this->venta->imagenes;

        if ($this->venta->imagenes->count()) {
            foreach ($imagenes as $imagen) {
                Storage::delete($imagen->imagen_ruta);
                $imagen->delete();
            }
        }

        $this->venta->delete();

        return redirect()->route('administrador.venta.index');
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-editar-livewire')->layout('layouts.administrador.index');
    }
}
