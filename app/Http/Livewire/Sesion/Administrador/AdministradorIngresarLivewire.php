<?php

namespace App\Http\Livewire\Sesion\Administrador;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class AdministradorIngresarLivewire extends Component
{
    public $email;
    public $password;
    public $recordarme;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    protected $validationAttributes = [
        'email' => 'email o usuario',
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
            'password' => $this->password,
        ];
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $this->email;
        } else {
            $credentials['username'] = $this->email;
        }
        if (Auth::attempt($credentials, $this->recordarme)) {
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
                return redirect()->route('inicio');
            }
        } else {
            $errors = ['email' => 'Email o usuario incorrecto.'];
            if (User::where('email', $this->email)->count() > 0) {
                $errors = ['password' => 'La contraseña es incorrecta.'];
            }
            throw ValidationException::withMessages($errors);
        }
    }

    public function render()
    {
        return view('livewire.sesion.administrador.administrador-ingresar-livewire')->layout('layouts.sesion.index');
    }
}
