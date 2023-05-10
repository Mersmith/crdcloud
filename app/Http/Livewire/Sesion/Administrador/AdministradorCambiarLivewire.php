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

    protected $validationAttributes = [
        'email' => 'email',
        'password' => 'constraseña',
        'password_confirmation' => 'confirmarción de contraseña',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'email.exists' => 'El :attribute no existe.',
        'email.email' => 'El :attribute no es correcto.',
        'password.required' => 'La :attribute es requerido.',
        'password.min' => 'La :attribute requiere minimo 8 dígitos.',
        'password.confirmed' => 'La :attribute no es igual a la confirmación.',
        'password_confirmation.required' => 'La :attribute es requerido.',
        'password_confirmation.same' => 'La :attribute es incorrecta.',
    ];

    public function mount(Request $request, $token)
    {
        $this->token = $token;
        $this->email = $request->query('email');
    }

    public function cambiarClave()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
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

            return redirect()->intended(route('ingresar'));
        } else {
            $this->emit('mensajeError', "Ha ocurrido un error.");
        }
    }

    public function render()
    {

        return view('livewire.sesion.administrador.administrador-cambiar-livewire')->layout('layouts.sesion.index');
    }
}
