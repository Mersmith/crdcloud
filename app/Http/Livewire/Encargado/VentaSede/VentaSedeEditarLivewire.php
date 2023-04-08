<?php

namespace App\Http\Livewire\Encargado\VentaSede;

use App\Models\Venta;
use Livewire\Component;
use App\Models\Imagen;
use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\Servicio;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class VentaSedeEditarLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['dropImagenes', 'dropZip', 'eliminarVenta'];

    public $venta;
    public $venta_id;
    public $venta_detalles = [];

    public $sedes;
    public $servicios;
    public $odontologos;
    public $clinicas;
    public $pacientes;

    public
        $sede,
        $odontologo,
        $clinica;

    public
        $sede_id = "",
        $servicio_id = "",
        $paciente_id = "",
        $odontologo_id = "",
        $clinica_id = "";

    public
        $cantidad = 1,
        $link,
        $estado,
        $observacion;

    public $total, $puntos_ganados;

    public $informe;
    public $editarInforme = null;

    public
        $odontologo_inicial,
        $estado_inicial;

    protected $rules = [
        'venta.estado' => 'required',
    ];

    protected $messages = [
        'paciente_id.required' => 'El paciente es requerido.',
    ];

    public function mount(Venta $venta)
    {
        $this->venta = $venta;
        $this->venta_id = $venta->id;
        $this->venta_detalles = $this->venta->ventaDetalle->toArray();

        $this->sedes = Sede::all();
        $this->servicios = Servicio::pluck('nombre', 'id');
        $this->sede_id = $venta->sede_id;
        $this->sede = Sede::find($venta->sede_id);
        $odontologo = Odontologo::find($venta->odontologo_id);
        $this->odontologo = $odontologo;
        $this->odontologo_id = $odontologo->id;
        $this->odontologo_inicial = $odontologo;
        $this->estado_inicial = $venta->estado;

        $this->link = $venta->link;
        $this->estado = $venta->estado;
        $this->observacion = $venta->observacion;
        $this->total = $venta->total;

        $this->odontologos = $this->sede->odontologos()->get();

        $this->pacientes = $odontologo->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->paciente_id = $venta->paciente_id;

        if ($this->pacientes->contains('id', $this->paciente_id)) {
            $this->paciente_id = $venta->paciente_id;
        } else {
            $this->paciente_id = "";
        }

        $this->informe = $venta->informes->count() ? Storage::url($venta->informes->first()->informe_ruta) : null;
    }

    public function updatedSedeId($value)
    {
        $this->sede = Sede::find($value);
        $this->sede_id = $this->sede->id;

        $this->odontologos = $this->sede->odontologos()->where('rol', '=', 'odontologo')->get();
        $this->clinicas = $this->sede->odontologos()->where('rol', '=', 'clinica')->get();

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
        $this->clinica = Odontologo::find($value);
        $this->clinica_id = $this->clinica->id;

        $this->pacientes = $this->clinica->pacientes()
            ->orderBy('created_at', 'desc')->get();

        $this->reset('odontologo_id', 'paciente_id');
    }

    public function obtenerTotal()
    {
        return array_reduce($this->venta_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['precio']);
        }, 0);
    }

    public function obtenerTotalPuntos()
    {
        return array_reduce($this->venta_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['puntos']);
        }, 0);
    }

    public function aumentaPuntosOdontologo($puntos_actualizado)
    {
        $this->odontologo->update(
            [
                'puntos' => $this->odontologo->puntos + $puntos_actualizado
            ]
        );
    }

    public function disminuyePuntosOdontologo($puntos_actualizado)
    {
        $this->odontologo->update(
            [
                'puntos' => $this->odontologo->puntos - $puntos_actualizado
            ]
        );
    }

    public function actualizarPaciente()
    {
        $this->venta->paciente_id = $this->paciente_id;
        $this->venta->update();
    }

    public function actualizarEstado()
    {
        $puntos_anterior = $this->venta->puntos_ganados;
        $estado_venta_anterior = $this->venta->estado;

        $this->venta->estado = $this->estado;
        $this->venta->update();

        if ($estado_venta_anterior == 1 && $this->estado == 2) {
            $this->aumentaPuntosOdontologo($puntos_anterior);
        } elseif ($estado_venta_anterior == 1 && $this->estado == 3) {
        } elseif ($estado_venta_anterior == 2 && $this->estado == 3) {
            $this->disminuyePuntosOdontologo($puntos_anterior);
        } elseif ($estado_venta_anterior == 2 && $this->estado == 1) {
            $this->disminuyePuntosOdontologo($puntos_anterior);
        } elseif ($estado_venta_anterior == 3 && $this->estado == 2) {
            $this->aumentaPuntosOdontologo($puntos_anterior);
        } elseif ($estado_venta_anterior == 3 && $this->estado == 1) {
        }
    }

    public function actualizarOdontologo()
    {
        if ($this->venta->odontologo_id != $this->odontologo_id) {

            $odontologo_anterior = Odontologo::find($this->venta->odontologo_id);
            $odontologo_nuevo = Odontologo::find($this->odontologo_id);

            $puntos_venta = (int)$this->venta->puntos_ganados;

            if ($this->venta->estado == 2) {
                $odontologo_anterior->update(
                    [
                        'puntos' => $odontologo_anterior->puntos - $puntos_venta
                    ]
                );

                $odontologo_nuevo->update(
                    [
                        'puntos' => $odontologo_nuevo->puntos + $puntos_venta
                    ]
                );
            }
            $this->venta->odontologo_id = $odontologo_nuevo->id;
            $this->venta->update();
        }
    }

    public function actualizarVenta()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['venta_detalles'] = 'required';

        if ($this->venta->imagenes->count()) {
            $this->validate($rules);


            $this->venta->observacion = $this->observacion;
            $this->venta->link = $this->link;

            $this->venta->update();

            $this->emit('mensajeActualizado', "Actualizado.");
        } else {
            $this->emit('mensajeError', "Falta subir imagen.");
        }
    }

    public function actualizarPuntosYTotalVenta()
    {
        $this->total = $this->obtenerTotal();
        $this->puntos_ganados = $this->obtenerTotalPuntos();
        $this->venta->total = $this->total;
        $this->venta->puntos_ganados = $this->puntos_ganados;
        $this->venta->update();
    }

    public function agregarServicioAlDetalleVenta()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['servicio_id'] = 'required';

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            $servicio = Servicio::findOrFail($this->servicio_id);

            foreach ($this->venta_detalles as $detalle) {
                if ($detalle['servicio_id'] == $this->servicio_id) {
                    $this->emit('mensajeError', "Ya existe el servicio.");
                    return;
                }
            }

            $venta_detalle = new VentaDetalle();
            $venta_detalle->venta_id = $this->venta_id;
            $venta_detalle->servicio_id = $servicio->id;
            $venta_detalle->cantidad = $this->cantidad;
            $venta_detalle->precio =  $servicio->precio_venta;
            $venta_detalle->puntos =  $servicio->puntos_ganar;

            $venta_detalle->save();

            $this->venta_detalles[] = $venta_detalle->toArray();

            if ($this->venta->estado == 2) {
                $this->aumentaPuntosOdontologo($servicio->puntos_ganar);
            }

            $this->actualizarPuntosYTotalVenta();
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function eliminarUnDetalleVenta($venta_detalle_id, $index)
    {
        $venta_detalle = VentaDetalle::findOrFail($venta_detalle_id);
        $venta_detalle->delete();

        array_splice($this->venta_detalles, $index, 1);

        if ($this->venta->estado == 2) {
            $this->disminuyePuntosOdontologo($venta_detalle->puntos);
        }

        $this->actualizarPuntosYTotalVenta();
    }

    public function dropImagenes()
    {
        $this->venta = $this->venta->fresh();
    }

    public function dropZip()
    {
        $this->venta = $this->venta->fresh();
    }

    public function eliminarImagen(Imagen $imagen)
    {
        Storage::delete([$imagen->imagen_ruta]);
        $imagen->delete();

        $this->venta = $this->venta->fresh();
        $this->emit('mensajeEliminado', "Imagen eliminado.");
    }

    public function eliminarInforme()
    {
        if ($this->venta->informes->count()) {
            $informes = $this->venta->informes;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_ruta);
                $informeItem->delete();
            }
            $this->reset(['informe']);

            $this->venta = $this->venta->fresh();

            $this->emit('mensajeEliminado', "Ficha eliminado");
        }
    }

    public function eliminarVenta()
    {
        $puntos_venta = (int)$this->venta->puntos_ganados;

        if ($this->venta->estado == 2) {
            $this->odontologo->update(
                [
                    'puntos' => $this->odontologo->puntos - $puntos_venta
                ]
            );
        }

        if ($this->venta->imagenes->count()) {
            $imagenes = $this->venta->imagenes;
            foreach ($imagenes as $imagen) {
                Storage::delete($imagen->imagen_ruta);
                $imagen->delete();
            }
        }

        if ($this->venta->informes->count()) {
            $informes = $this->venta->informes;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_ruta);
                $informeItem->delete();
            }
        }

        if ($this->venta) {
            $this->venta->ventaDetalle()->delete();
            $this->venta->delete();
        }

        return redirect()->route('encargado.venta.sede.index');
    }

    public function render()
    {
        return view('livewire.encargado.venta-sede.venta-sede-editar-livewire')->layout('layouts.administrador.index');
    }
}
