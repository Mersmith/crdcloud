<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VentaController extends Controller
{
    public function dropzone(Venta $venta, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $urlImagen = Storage::put('radiografias', $request->file('file'));

        $venta->imagenes()->create([
            'imagen_ruta' => $urlImagen,
            'posicion' => $venta->imagenes()->count() + 1,
        ]);
    }
}
