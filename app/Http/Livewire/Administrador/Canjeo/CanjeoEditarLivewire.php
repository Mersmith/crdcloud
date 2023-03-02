<?php

namespace App\Http\Livewire\Administrador\Canjeo;

use App\Models\Canjeo;
use App\Models\CanjeoDetalle;
use App\Models\Clinica;
use Livewire\Component;
use App\Models\ImagenCanjeo;
use App\Models\Odontologo;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CanjeoEditarLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['cambiarPosicionImagenes', 'dropImagenes', 'eliminarCanjeo'];

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
        $servicio_id = "",
        $paciente_id = "",
        $odontologo_id = "",
        $clinica_id = "";

    public
        $cantidad = 1,
        $link,
        $estado,
        $observacion;

    public $total;

    public $informe;
    public $editarInforme = null;

    protected $rules = [
        'canjeo.estado' => 'required',
    ];

    public function mount(Canjeo $canjeo)
    {
        $this->canjeo = $canjeo;
        $this->canjeo_id = $canjeo->id;
        $this->canjeo_detalles = $this->canjeo->canjeoDetalle->toArray();

        $this->sedes = Sede::all();
        $this->servicios = Servicio::select('id', 'nombre')->get();
        $this->sede_id = $canjeo->sede_id;
        $this->paciente_id = $canjeo->paciente_id;
        $this->odontologo_id = $canjeo->odontologo_id ? $canjeo->odontologo_id : "";
        $this->clinica_id = $canjeo->clinica_id ? $canjeo->clinica_id : "";
        $this->link = $canjeo->link;
        $this->estado = $canjeo->estado;
        $this->observacion = $canjeo->observacion;
        $this->total = $canjeo->total_puntos;

        $this->odontologos = Odontologo::where('sede_id', $canjeo->sede_id)->get();
        $this->clinicas = Clinica::where('sede_id', $canjeo->sede_id)->get();

        if ($canjeo->odontologo_id) {
            $odontologo = Odontologo::find($canjeo->odontologo_id);
            $this->pacientes = $odontologo->pacientes()
                ->orderBy('created_at', 'desc')->get();
        } else {
            $clinica = Clinica::find($canjeo->clinica_id);
            $this->pacientes = $clinica->pacientes()
                ->orderBy('created_at', 'desc')->get();
        }

        $this->informe = $canjeo->informesCanjeo->count() ? Storage::url($canjeo->informesCanjeo->first()->informe_canjeo_ruta) : null;
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

    public function obtenerTotal()
    {
        return array_reduce($this->canjeo_detalles, function ($carry, $item) {
            return $carry + ($item['cantidad'] * $item['puntos']);
        }, 0);
    }

    public function actualizarCanjeo()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['link'] = 'required';
        $rules['canjeo_detalles'] = 'required';

        if ($this->canjeo->imagenesCanjeo->count()) {
            $this->validate($rules);

            if ($this->odontologo_id) {
                $this->clinica_id = null;
            } else {
                $this->odontologo_id = null;
            }

            $this->total = $this->obtenerTotal();

            $this->canjeo->sede_id = $this->sede_id;
            $this->canjeo->paciente_id = $this->paciente_id;
            $this->canjeo->odontologo_id = $this->odontologo_id;
            $this->canjeo->clinica_id = $this->clinica_id;
            $this->canjeo->estado = $this->estado;
            $this->canjeo->total_puntos = $this->total;
            $this->canjeo->puntos_usados = $this->total;
            $this->canjeo->link = $this->link;
            $this->canjeo->observacion = $this->observacion;

            $this->canjeo->update();

            if (!$this->informe) {
                if ($this->canjeo->informesCanjeo->count()) {
                    $informes = $this->canjeo->informesCanjeo;
                    foreach ($informes as $informeItem) {
                        Storage::delete($informeItem->informe_canjeo_ruta);
                        $informeItem->delete();
                    }
                }
            }

            if ($this->editarInforme) {
                $informeSubir = $this->editarInforme->store('informes-canjeo');
                $this->canjeo->informesCanjeo()->create([
                    'informe_canjeo_ruta' => $informeSubir
                ]);
            }

            $this->emit('mensajeActualizado', "Actualizado.");
        } else {
            $this->emit('mensajeError', "Falta subir imagen.");
        }
    }

    public function actualizarCantidad($canjeo_detalle_id, $nueva_cantidad)
    {
        $detalle_canjeo = CanjeoDetalle::find($canjeo_detalle_id);
        $detalle_canjeo->cantidad = $nueva_cantidad;
        $detalle_canjeo->save();

        $this->total = $this->obtenerTotal();
        $this->canjeo->total_puntos = $this->total;
        $this->canjeo->puntos_usados = $this->total;
        $this->canjeo->update();
    }

    public function agregarServicioAlDetalleCanjeo()
    {
        $rules = [];

        $rules['sede_id'] = 'required';
        $rules['paciente_id'] = 'required';
        $rules['servicio_id'] = 'required';

        if ($this->odontologo_id || $this->clinica_id) {
            $this->validate($rules);

            $servicio = Servicio::findOrFail($this->servicio_id);

            foreach ($this->canjeo_detalles as $detalle) {
                if ($detalle['servicio_id'] == $this->servicio_id) {
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
            $this->canjeo->puntos_usados = $this->total;
            $this->canjeo->update();
        } else {
            $this->emit('mensajeError', "Debe seleccionar un paciente o una clínica.");
        }
    }

    public function eliminarUnDetalleCanjeo($canjeo_detalle_id, $index)
    {
        $canjeo_detalle = CanjeoDetalle::findOrFail($canjeo_detalle_id);
        $canjeo_detalle->delete();

        array_splice($this->canjeo_detalles, $index, 1);

        $this->total = $this->obtenerTotal();
        $this->canjeo->total_puntos = $this->total;
        $this->canjeo->puntos_usados = $this->total;
        $this->canjeo->update();
    }

    public function dropImagenes()
    {
        $this->canjeo = $this->canjeo->fresh();
    }

    public function cambiarPosicionImagenes($sorts)
    {
        $posicion = 1;

        foreach ($sorts as $sort) {

            $slider = ImagenCanjeo::find($sort);
            $slider->posicion = $posicion;
            $slider->save();

            $posicion++;
        }

        $this->dropImagenes();
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
        $imagenes = $this->canjeo->imagenesCanjeo;

        if ($this->canjeo->imagenesCanjeo->count()) {
            foreach ($imagenes as $imagen) {
                Storage::delete($imagen->imagen_canjeo_ruta);
                $imagen->delete();
            }
        }

        if ($this->canjeo) {
            $this->canjeo->canjeoDetalle()->delete();
            $this->canjeo->delete();
        } else {
        }
        return redirect()->route('administrador.canjeo.index');
    }

    public function render()
    {
        return view('livewire.administrador.canjeo.canjeo-editar-livewire')->layout('layouts.administrador.index');
    }
}
