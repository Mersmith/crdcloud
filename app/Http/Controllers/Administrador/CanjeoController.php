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
            'file' => 'required|image|max:2048'
        ]);

        $urlImagen = Storage::put('radiografias-canjeo', $request->file('file'));

        $canjeo->imagenesCanjeo()->create([
            'imagen_canjeo_ruta' => $urlImagen,
            'posicion' => $canjeo->imagenesCanjeo()->count() + 1,
        ]);
    }
}
