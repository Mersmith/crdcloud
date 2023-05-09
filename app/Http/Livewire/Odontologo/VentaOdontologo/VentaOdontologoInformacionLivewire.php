<?php

namespace App\Http\Livewire\Odontologo\VentaOdontologo;

use App\Models\Venta;
use Livewire\Component;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class VentaOdontologoInformacionLivewire extends Component
{
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
        $paciente,
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

    public $archivo;

    protected $rules = [
        'venta.estado' => 'required',
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
        $this->paciente = Paciente::find($venta->paciente_id);

        $this->link = $venta->link;
        $this->estado = $venta->estado;
        $this->observacion = $venta->observacion;
        $this->total = $venta->total;

        $this->informe = $venta->informes->count() ? Storage::url($venta->informes->first()->informe_ruta) : null;
    }

    public function descargarImagenes()
    {
        $rutasImagenes = $this->venta->imagenes->pluck('imagen_ruta')->toArray();

        $zip = new ZipArchive();
        $nombreArchivo =  'imagenes-' . $this->venta->id . '.zip';

        $rutaArchivo = storage_path('app/temp/' . $nombreArchivo);

        if ($zip->open($rutaArchivo, ZipArchive::CREATE) !== true) {
            return false;
        }

        foreach ($rutasImagenes as $rutaImagen) {
            if (file_exists(storage_path('app/public/' . $rutaImagen))) {
                $zip->addFile(storage_path('app/public/' . $rutaImagen), basename($rutaImagen));
            }
        }

        $zip->close();

        $this->venta->descargas_imagen = $this->venta->descargas_imagen + 1;

        $this->venta->update();

        return response()->download($rutaArchivo, $nombreArchivo);
    }

    public function descargarInforme()
    {
        $informe = $this->venta->informes->first();

        $archivo_ruta = storage_path('app/public/' . $informe->informe_ruta);

        if (!Storage::exists($informe->informe_ruta)) {
            abort(404);
        }

        $archivo_nombre = 'informe-' . $this->venta->id . '-' . basename($archivo_ruta);

        $headers = [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $archivo_nombre . '"',
        ];

        $this->venta->descargas_informe = $this->venta->descargas_informe + 1;

        $this->venta->update();

        return response()->download($archivo_ruta, $archivo_nombre, $headers);
    }

    public function abrirLink()
    {
        $this->emit('abrirLink', ['link' => $this->link]);

        $this->venta->descargas_link = $this->venta->descargas_link + 1;

        $this->venta->update();
    }

    public function aumentarVistas(){
        $this->venta->vistas_imagen = $this->venta->vistas_imagen + 1;

        $this->venta->update();
    }

    public function render()
    {
        return view('livewire.odontologo.venta-odontologo.venta-odontologo-informacion-livewire')->layout('layouts.administrador.index');
    }
}
