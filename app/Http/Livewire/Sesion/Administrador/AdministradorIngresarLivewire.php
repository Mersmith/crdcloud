<?php

namespace App\Http\Livewire\Sesion\Administrador;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdministradorIngresarLivewire extends Component
{
    public $email;
    public $password;
    public $remember;

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
                return redirect()->route('encargado.especialidad.sede.index');
            } elseif ($usuario->rol == "odontologo") {
                return redirect()->route('odontologo.paciente.odontologo.index');
            } elseif ($usuario->rol == "paciente") {
                return redirect()->route('encargado.odontologo.index');
            } else {
                return redirect()->route('inicio');
            }

        } else {
            $this->emit('mensajeError', "Verifique los datos ingresados.");
        }
    }

    public function authenticate()
    {
        $credentials = [
            'password' => $this->password,
        ];
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $this->email;
        } else {
            $credentials['username'] = $this->email;
        }
        if (Auth::attempt($credentials, $this->remember)) {
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

            //return redirect()->intended('/');
            //return redirect()->route('administrador.encargado.index');
        }
        $this->addError('email', 'Credenciales inválidas');
    }

    public function contra()
    {
        /*$users = DB::table('users')->get();

        // Actualizar la contraseña de cada usuario
        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => bcrypt($user->password)]);
        }*/

        $users = DB::table('users')->where('id', '>=', 8330)->get();

        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => bcrypt($user->password)]);
        }
    }

    public function render()
    {
        return view('livewire.sesion.administrador.administrador-ingresar-livewire')->layout('layouts.sesion.index');
    }
}
