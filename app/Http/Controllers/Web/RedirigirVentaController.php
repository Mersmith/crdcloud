<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirigirVentaController extends Controller
{
    public function redirigirVenta(Request $request, $i = null, $r = null)
    {
        //http://127.0.0.1:8000/miradiografia?i=316&r=6350

        $id_user = $request->input('i');
        $id_venta = $request->input('r');

        if ($id_user && $id_venta) {

            $user = User::find($id_user);

            if ($user) {

                Auth::loginUsingId($user->id);

                if ($user->rol == "odontologo") {
                    return redirect()->route('odontologo.venta.odontologo.informacion', $id_venta);
                } else {
                    return redirect()->route('inicio');
                }
            } else {
                return redirect()->route('inicio');
            }
        } else {
            return redirect()->route('inicio');
        }
    }

    public function redirigirCanjeo(Request $request, $i = null, $c = null)
    {
        //http://127.0.0.1:8000/micanjeo?email=DAVID&password=11885&c=2
        //http://127.0.0.1:8000/micanjeo?email=odontologiavacio324@gmail.com&password=11885&c=2
        //http://127.0.0.1:8000/micanjeo?i=316&c=2

        $id_user = $request->input('i');
        $id_canjeo = $request->input('c');

        if ($id_user && $id_canjeo) {

            $user = User::find($id_user);

            if ($user) {

                Auth::loginUsingId($user->id);

                if ($user->rol == "odontologo") {
                    return redirect()->route('odontologo.canjeo.odontologo.informacion', $id_canjeo);

                } else {
                    return redirect()->route('inicio');
                }
            } else {
                return redirect()->route('inicio');
            }
        } else {
            return redirect()->route('inicio');
        }
    }
}
