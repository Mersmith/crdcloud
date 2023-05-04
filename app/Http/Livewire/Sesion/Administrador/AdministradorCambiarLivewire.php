<?php

namespace App\Http\Livewire\Sesion\Administrador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class AdministradorCambiarLivewire extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount(Request $request, $token)
    {
        $this->token = $token;
        $this->email = $request->query('email');
    }

    public function cambiarClave()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $estado = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
                //Auth::login($user);
            }
        );

        if ($estado === Password::PASSWORD_RESET) {

            $this->emit('mensajeCreado', "Recuperaste correctamente.");

            return redirect()->intended('/');
        } else {
            $this->emit('mensajeError', "Ha ocurrido un error.");
        }
    }

    public function render()
    {

        return view('livewire.sesion.administrador.administrador-cambiar-livewire')->layout('layouts.sesion.index');
    }
}
