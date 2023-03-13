<?php

namespace App\Http\Livewire\Administrador\Paciente;

use App\Models\Clinica;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PacienteEditarPagina extends Component
{
    protected $listeners = ['eliminarPaciente'];

    public $paciente;
    public $sedes;
    public $usuario_paciente;

    public
        $sedesSeleccionadas  = [],
        $nombre,
        $apellido,
        $username,
        $email,
        $dni,
        $celular,
        $genero;

    protected $rules = [
        'sedesSeleccionadas' => 'required|array|min:1',
        'sedesSeleccionadas.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'celular' => 'required|digits:9',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'dni' => 'DNI',
        'celular' => 'celular',
        'genero' => 'genero',
    ];

    protected $messages = [
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'celular.required' => 'El :attribute es requerido.',
        'celular.digits' => 'El :attribute acepta 9 dígitos.',
        'genero.required' => 'El :attribute es requerido.',
    ];

    public function mount(Paciente $paciente)
    {
        $this->sedes = Sede::all();

        $this->paciente = $paciente;
        $this->usuario_paciente = $paciente->user;

        $this->sedesSeleccionadas = $paciente->sedes->pluck('id')->toArray();

        $this->nombre = $paciente->nombre;
        $this->apellido = $paciente->apellido;
        $this->username = $this->usuario_paciente->username;
        $this->email = $paciente->email;
        $this->dni = $paciente->dni;
        $this->celular = $paciente->celular;
        $this->genero = $paciente->genero;
    }

    public function editarPaciente()
    {
        $rules = $this->rules;

        $rules['username'] = 'required|unique:users,username,' . $this->usuario_paciente->id;
        $rules['email'] = 'required|unique:users,email,' . $this->usuario_paciente->id;
        $rules['dni'] = 'required|digits:8|unique:pacientes,dni,' . $this->paciente->id;

        $this->validate($rules);

        $this->usuario_paciente->update(
            [
                //'username' => $this->username,
                'email' => $this->email,
            ]
        );

        $this->paciente->update(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'dni' => $this->dni,
                'celular' => $this->celular,
                'genero' => $this->genero,
            ]
        );

        $this->paciente->sedes()->sync($this->sedesSeleccionadas);

        $this->emit('mensajeActualizado', "Editado.");
        //return redirect()->route('administrador.paciente.index');
    }

    public function eliminarPaciente()
    {
        $this->paciente->sedes()->detach();

        $this->paciente->odontologos()->detach();

        $this->paciente->delete();

        $this->usuario_paciente->delete();

        return redirect()->route('administrador.paciente.index');
    }

    public function render()
    {
        return view('livewire.administrador.paciente.paciente-editar-pagina')->layout('layouts.administrador.index');
    }
}
