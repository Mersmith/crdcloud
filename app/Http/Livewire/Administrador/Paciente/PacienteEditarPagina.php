<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PacienteEditarPagina extends Component
{
    protected $listeners = ['eliminarPaciente'];

    public $usuario_paciente;
    public $paciente;

    public
        $nombre,
        $apellido,
        $email,
        $password = "contrasenaejemplo",
        $editar_password = null,
        $dni,
        $celular,
        $fecha_nacimiento,
        $genero;

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'password' => 'required',
        'celular' => 'required|digits:9',
        'fecha_nacimiento' => 'required',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'celular' => 'celular',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'genero' => 'genero',
    ];

    protected $messages = [
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'password.required' => 'La :attribute es requerido.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'fecha_nacimiento.required' => 'La :attribute es requerido.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function mount(Paciente $paciente)
    {
        $this->usuario_paciente = $paciente->user;
        $this->paciente = $paciente;

        $this->nombre = $paciente->nombre;
        $this->apellido = $paciente->apellido;
        $this->email = $paciente->email;
        $this->dni = $paciente->user->dni;
        $this->celular = $paciente->celular;
        $this->fecha_nacimiento = $paciente->fecha_nacimiento;
        $this->genero = $paciente->genero;
    }

    public function editarPaciente()
    {
        $rules = $this->rules;

        $rules['dni'] = 'required|digits:8|unique:users,dni,' . $this->usuario_paciente->id;
        $rules['email'] = 'required|unique:users,email,' . $this->usuario_paciente->id;

        if ($this->editar_password) {
            $rules['editar_password'] = 'required';
        } else {
            $this->editar_password = null;
        }

        $this->validate($rules);

        $this->usuario_paciente->update(
            [
                'dni' => $this->dni,
                'email' => $this->email,
            ]
        );

        $this->paciente->update(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'celular' => $this->celular,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero' => $this->genero,
            ]
        );

        if ($this->editar_password) {
            //$usuario = User::find($this->paciente->user_id);

            //$contrasenaAntiguaHash = $usuario->password;
            $contrasenaNueva = $this->editar_password;

            $this->usuario_paciente->password = Hash::make($contrasenaNueva);
            $this->usuario_paciente->save();
        }

        $this->emit('mensajeActualizado', "Editado.");
        //return redirect()->route('administrador.paciente.index');
    }

    public function eliminarPaciente()
    {
        $this->paciente->delete();

        //$usuario = User::find($this->usuario_odontologo->id);
        $this->usuario_paciente->delete();

        return redirect()->route('administrador.paciente.index');
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-editar-pagina')->layout('layouts.administrador.index');
    }
}
