<?php

namespace App\Http\Livewire\Sesion\Administrador;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdministradorIngresarLivewire extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    protected $validationAttributes = [
        'email' => 'email',
        'password' => 'contraseña',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'password.required' => 'La :attribute es requerido.',
    ];

    public function ingresar()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            $usuario = Auth::user();

            if ($usuario->rol == "administrador") {
                return redirect()->route('administrador.encargado.index');
            } elseif ($usuario->rol == "encargado") {
                return redirect()->route('encargado.odontologo.index');
            } elseif ($usuario->rol == "odontologo") {
                return redirect()->route('odontologo.encargado.index');
            } elseif ($usuario->rol == "clinica") {
                return redirect()->route('clinica.encargado.index');
            } elseif ($usuario->rol == "paciente") {
                return redirect()->route('paciente.encargado.index');
            } else {
                return redirect()->route('inicio');
            }

        } else {
            $this->emit('mensajeError', "Verifique los datos ingresados.");
        }
    }

    public function render()
    {
        return view('livewire.sesion.administrador.administrador-ingresar-livewire')->layout('layouts.sesion.index');
    }
}
