<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarIngreso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $usuario = Auth::user();

            if ($usuario->rol == "administrador") {
                return redirect()->route('administrador.encargado.index');
            } elseif ($usuario->rol == "encargado") {
                return redirect()->route('encargado.especialidad.sede.index');
            } elseif ($usuario->rol == "odontologo") {
                return redirect()->route('odontologo.paciente.odontologo.index');
            } elseif ($usuario->rol == "paciente") {
                return redirect()->route('encargado.odontologo.index');
            } else {
                return redirect()->route('ingresar');
            }
        }
        return $next($request);
    }
}
