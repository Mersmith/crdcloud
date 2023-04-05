<?php

namespace App\Http\Controllers\Encargado;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VentaController extends Controller
{
    public function dropzone(Venta $venta, Request $request)
    {
        $request->validate([
            'nuevaImagen' => 'required|image|max:2048'
        ]);

        $urlImagen = Storage::put('radiografias', $request->file('nuevaImagen'));

        $venta->imagenes()->create([
            'imagen_ruta' => $urlImagen,
            'posicion' => $venta->imagenes()->count() + 1,
        ]);
    }

    public function dropzoneInforme(Venta $venta, Request $request)
    {
        $request->validate([
            'nuevoZip' => 'required|mimes:zip'
        ]);

        if ($venta->informes->count()) {
            //Elimina
            $informes = $venta->informes;
            foreach ($informes as $informeItem) {
                Storage::delete($informeItem->informe_ruta);
                $informeItem->delete();
            }
            //Agrega
            $urlInforme = Storage::put('informes', $request->file('nuevoZip'));

            $venta->informes()->create([
                'informe_ruta' => $urlInforme,
            ]);
        } else {
            //Agrega
            $urlInforme = Storage::put('informes', $request->file('nuevoZip'));

            $venta->informes()->create([
                'informe_ruta' => $urlInforme,
            ]);
        }
    }
}
