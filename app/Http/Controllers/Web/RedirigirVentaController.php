<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirigirVentaController extends Controller
{
    public function redirigirVenta(Request $request, $idodontologo = null, $idventa = null)
    {
        //http://127.0.0.1:8000/miradiografia?idodontologo=316&idventa=6350

        $idodontologo = $request->input('idodontologo');
        $idventa = $request->input('idventa');

        if ($idodontologo && $idventa) {

            $user = User::find($idodontologo);

            if ($user) {

                Auth::loginUsingId($user->id);

                if ($user->rol == "odontologo") {
                    return redirect()->route('odontologo.venta.odontologo.informacion', $idventa);
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

    public function redirigirCanjeo(Request $request, $email = null, $password = null, $idcanjeo = null)
    {
        //http://127.0.0.1:8000/micanjeo?email=DAVID&password=11885&idcanjeo=2
        //http://127.0.0.1:8000/micanjeo?email=odontologiavacio324@gmail.com&password=11885&idcanjeo=2
        $email = $request->input('email');
        $password = $request->input('password');
        $idcanjeo = $request->input('idcanjeo');

        if ($email && $password && $idcanjeo) {

            $credentials = [
                'password' => $password,
            ];

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $email;
            } else {
                $credentials['username'] = $email;
            }

            if (Auth::attempt($credentials)) {

                $usuario = Auth::user();

                if ($usuario->rol == "odontologo") {
                    return redirect()->route('odontologo.canjeo.odontologo.informacion', $idcanjeo);
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
