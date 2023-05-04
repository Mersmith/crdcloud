<?php

namespace App\Http\Livewire\Sesion\Administrador;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Illuminate\Auth\Passwords\PasswordBrokerResult;

class AdministradorRecuperarLivewire extends Component
{
    public $email;
    public $estado;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    protected $validationAttributes = [
        'email' => 'email',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'email.exists' => 'El :attribute no existe.',
        'email.email' => 'El :attribute no es correcto.',
    ];

    public function recuperar()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        $token = Password::broker()->createToken($user);

        if ($token) {

            //$resetLink = route('cambiar.clave', ['token' => $token, 'email' => urlencode($this->email)]);

            $resetLink = url('cambiar-clave/' . $token) . '?email=' . urlencode($this->email);

            Mail::send('emails.recuperar-clave', ['resetLink' => $resetLink], function ($message) {
                $message->to($this->email);
                $message->subject('Recuperar clave');
            });

            $this->emit('mensajeCreado', "Revise su correo electrónico.");
        } else {
            $this->emit('mensajeError', "Ha ocurrido un error.");
        }
    }

    public function render()
    {
        return view('livewire.sesion.administrador.administrador-recuperar-livewire')->layout('layouts.sesion.index');
    }
}
