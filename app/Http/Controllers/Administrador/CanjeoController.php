<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Canjeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CanjeoController extends Controller
{
    public function dropzone(Canjeo $canjeo, Request $request)
    {
        $request->validate([
            'nuevaImagen' => 'required|image|max:2048'
        ]);

        $urlImagen = Storage::put('radiografias-canjeo', $request->file('nuevaImagen'));

        $canjeo->imagenesCanjeo()->create([
            'imagen_canjeo_ruta' => $urlImagen,
            'posicion' => $canjeo->imagenesCanjeo()->count() + 1,
        ]);
    }

    public function dropzoneInforme(Canjeo $canjeo, Request $request)
    {
        $request->validate([
            'nuevoZip' => 'required|mimes:zip'
        ]);

        if ($canjeo->informesCanjeo->count()) {
            //Elimina
            $informes = $canjeo->informesCanjeo;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_canjeo_ruta);
                $informeItem->delete();
            }
            //Agrega
            $urlInforme = Storage::put('informes-canjeo', $request->file('nuevoZip'));

            $canjeo->informesCanjeo()->create([
                'informe_canjeo_ruta' => $urlInforme,
            ]);
        } else {
            //Agrega
            $urlInforme = Storage::put('informes-canjeo', $request->file('nuevoZip'));

            $canjeo->informesCanjeo()->create([
                'informe_canjeo_ruta' => $urlInforme,
            ]);
        }
    }
}
