<?php

namespace App\Http\Livewire\Odontologo\CanjeoOdontologo;

use App\Models\Canjeo;
use Livewire\Component;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class CanjeoOdontologoInformacionLivewire extends Component
{
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
        'canjeo.estado' => 'required',
    ];

    public function mount(Canjeo $canjeo)
    {
        $this->canjeo = $canjeo;
        $this->canjeo_id = $canjeo->id;
        $this->canjeo_detalles = $this->canjeo->canjeoDetalle->toArray();

        $this->sedes = Sede::all();
        $this->servicios = Servicio::pluck('nombre', 'id');
        $this->sede_id = $canjeo->sede_id;
        $this->sede = Sede::find($canjeo->sede_id);
        $this->paciente = Paciente::find($canjeo->paciente_id);

        $this->link = $canjeo->link;
        $this->estado = $canjeo->estado;
        $this->observacion = $canjeo->observacion;
        $this->total = $canjeo->total;

        $this->informe = $canjeo->informesCanjeo->count() ? Storage::url($canjeo->informesCanjeo->first()->informe_canjeo_ruta) : null;
    }

    public function descargarImagenes()
    {
        $rutasImagenes = $this->canjeo->imagenesCanjeo->pluck('imagen_canjeo_ruta')->toArray();
        //dd( $rutasImagenes);
        $zip = new ZipArchive();
        $nombreArchivo =  'imagenes-' . $this->canjeo->id . '.zip';

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

        $this->canjeo->descargas_imagen = $this->canjeo->descargas_imagen + 1;

        $this->canjeo->update();

        return response()->download($rutaArchivo, $nombreArchivo);
    }

    public function descargarInforme()
    {
        $informe = $this->canjeo->informesCanjeo->first();

        $archivo_ruta = storage_path('app/public/' . $informe->informe_canjeo_ruta);

        if (!Storage::exists($informe->informe_canjeo_ruta)) {
            abort(404);
        }

        $archivo_nombre = 'informe-' . $this->canjeo->id . '-' . basename($archivo_ruta);

        $headers = [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $archivo_nombre . '"',
        ];

        $this->canjeo->descargas_informe = $this->canjeo->descargas_informe + 1;

        $this->canjeo->update();

        return response()->download($archivo_ruta, $archivo_nombre, $headers);
    }

    public function abrirLink()
    {
        $this->emit('abrirLink', ['link' => $this->link]);

        $this->canjeo->descargas_link = $this->canjeo->descargas_link + 1;

        $this->canjeo->update();
    }

    public function render()
    {
        return view('livewire.odontologo.canjeo-odontologo.canjeo-odontologo-informacion-livewire')->layout('layouts.administrador.index');
    }
}
