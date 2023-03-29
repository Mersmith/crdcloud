<?php

namespace App\Http\Controllers\Odontologo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DescargarProgramaController extends Controller
{
    public function cdxView()
    {
        $archivo = public_path('programas/_download_CDX_Setup_v1.93.15.4.rel2_Xelis.exe');
        return response()->download($archivo);
        //    <a href="{{ route('odontologo.descargar.cdx.view') }}">Descargar archivo .exe</a>
    }
}
