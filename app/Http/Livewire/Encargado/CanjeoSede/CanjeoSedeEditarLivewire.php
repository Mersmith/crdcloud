<?php

namespace App\Http\Livewire\Encargado\CanjeoSede;

use App\Models\Canjeo;
use App\Models\CanjeoDetalle;
use Livewire\Component;
use App\Models\ImagenCanjeo;
use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CanjeoSedeEditarLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['dropImagenes', 'dropZip', 'eliminarVenta'];

    public $canjeo;
    public $canjeo_id;
    public $canjeo_detalles = [];

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
        $servicio = "",
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
        'canjeo.estado' => 'required',
    ];

    protected $messages = [
        'paciente_id.required' => 'El paciente es requerido.',
    ];

    public function actualizarPaciente()
    {
        $this->canjeo->paciente_id = $this->paciente_id;
        $this->canjeo->update();
    }

    public function mount(Canjeo $canjeo)
    {
        $this->canjeo = $canjeo;
        $this->canjeo_id = $canjeo->id;
        $this->canjeo_detalles = $this->canjeo->canjeoDetalle->toArray();

        $this->sedes = Sede::all();
        $this->servicios = Servicio::pluck('nombre', 'id');

        $odontologo = Odontologo::find($canjeo->odontologo_id);
        $this->odontologo = $odontologo;
        $this->odontologo_id = $odontologo->id;

        $this->sede_id = $canjeo->sede_id;
        $this->sede = Sede::find($canjeo->sede_id);

        $this->estado_inicial = $canjeo->estado;

        $this->link = $canjeo->link;
        $this->estado = $canjeo->estado;
        $this->observacion = $canjeo->observacion;
        $this->total = $canjeo->total_puntos;

        $this->pacientes = $odontologo->pacientes()
            ->orderBy('created_at', 'desc')->get();

        if ($this->pacientes->contains('id', $canjeo->paciente_id)) {
            $this->paciente_id = $canjeo->paciente_id;
        } else {
            $this->paciente_id = "";
        }

        $this->informe = $canjeo->informesCanjeo->count() ? Storage::url($canjeo->informesCanjeo->first()->informe_canjeo_ruta) : null;
    }

    public function actualizarVenta()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['canjeo_detalles'] = 'required';

        if ($this->canjeo->imagenesCanjeo->count()) {
            $this->validate($rules);

            $this->canjeo->observacion = $this->observacion;
            $this->canjeo->link = $this->link;

            $this->canjeo->update();

            $this->emit('mensajeActualizado', "Actualizado.");
        } else {
            $this->emit('mensajeError', "Falta subir imagen.");
        }
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

    public function actualizarEstado()
    {
        $puntos_anterior = $this->canjeo->total_puntos;
        $estado_canjeo_anterior = $this->canjeo->estado;

        $this->canjeo->estado = $this->estado;
        $this->canjeo->update();

        if ($estado_canjeo_anterior == 1 && $this->estado == 2) {
            $this->disminuyePuntosOdontologo($puntos_anterior);
        } elseif ($estado_canjeo_anterior == 1 && $this->estado == 3) {
        } elseif ($estado_canjeo_anterior == 2 && $this->estado == 3) {
            $this->aumentaPuntosOdontologo($puntos_anterior);
        } elseif ($estado_canjeo_anterior == 2 && $this->estado == 1) {
            $this->aumentaPuntosOdontologo($puntos_anterior);
        } elseif ($estado_canjeo_anterior == 3 && $this->estado == 2) {
            $this->disminuyePuntosOdontologo($puntos_anterior);
        } elseif ($estado_canjeo_anterior == 3 && $this->estado == 1) {
        }
    }

    public function obtenerTotal()
    {
        return array_reduce($this->canjeo_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['puntos']);
        }, 0);
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

    public function agregarServicioAlDetalleCanjeo()
    {
        $puntosOdontologo = $this->odontologo->puntos;

        $rules = [];

        $rules['servicio'] = 'required';

        $this->validate($rules);

        $servicio = Servicio::findOrFail($this->servicio);

        $subTotalPuntos = $this->obtenerTotal();
        $totalPuntos = $subTotalPuntos + $servicio->puntos_canjeo;

        if ($totalPuntos <= $puntosOdontologo) {
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

            $this->emit('mensajeCreado', "Agregado.");
        } else {
            $this->emit('mensajeError', "Puntos insuficientes.");
        }
    }

    public function dropImagenes()
    {
        $this->canjeo = $this->canjeo->fresh();
    }

    public function dropZip()
    {
        $this->canjeo = $this->canjeo->fresh();
    }

    public function eliminarImagen(ImagenCanjeo $imagen)
    {
        Storage::delete([$imagen->imagen_canjeo_ruta]);
        $imagen->delete();

        $this->canjeo = $this->canjeo->fresh();
        $this->emit('mensajeEliminado', "Imagen eliminado.");
    }

    public function eliminarInforme()
    {
        if ($this->canjeo->informesCanjeo->count()) {
            $informes = $this->canjeo->informesCanjeo;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_canjeo_ruta);
                $informeItem->delete();
            }
            $this->reset(['informe']);

            $this->canjeo = $this->canjeo->fresh();

            $this->emit('mensajeEliminado', "Ficha eliminado");
        }
    }

    public function eliminarCanjeo()
    {
        $puntos_canjeo = (int)$this->canjeo->puntos_usados;

        if ($this->canjeo->estado == 2) {

            $this->odontologo->update(
                [
                    'puntos' => $this->odontologo->puntos + $puntos_canjeo
                ]
            );
        }

        if ($this->canjeo->imagenesCanjeo->count()) {
            $imagenes = $this->canjeo->imagenesCanjeo;
            foreach ($imagenes as $imagen) {
                Storage::delete($imagen->imagen_canjeo_ruta);
                $imagen->delete();
            }
        }

        if ($this->canjeo->informesCanjeo->count()) {
            $informes = $this->canjeo->informesCanjeo;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_canjeo_ruta);
                $informeItem->delete();
            }
        }

        if ($this->canjeo) {
            $this->canjeo->canjeoDetalle()->delete();
            $this->canjeo->delete();
        }

        return redirect()->route('encargado.canjeo.sede.index');
    }

    public function render()
    {
        return view('livewire.encargado.canjeo-sede.canjeo-sede-editar-livewire')->layout('layouts.administrador.index');
    }
}
