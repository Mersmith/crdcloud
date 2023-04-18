<?php

namespace App\Http\Livewire\Encargado\PacienteSede;

use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PacienteSedeEditarPagina extends Component
{
    protected $listeners = ['eliminarPaciente', 'eliminarUnDetalleOdontologo', 'actualizarOdontologosDetalles', 'eliminarUnDetalleClinica', 'actualizarOdontologosDetalles'];

    public $paciente;
    public $sedes;
    public $usuario_paciente;

    public
        $sedesSeleccionadas  = [],
        $nombre,
        $apellido,
        $email,
        $dni,
        $carnet_extranjeria,
        $edad,
        $celular,
        $genero;

    public $es_extranjero;

    public $odontologos_detalles = [], $odontologos, $odontologo_id = "", $buscarOdontologo;

    protected $rules = [
        'sedesSeleccionadas' => 'required|array|min:1',
        'sedesSeleccionadas.*' => 'exists:sedes,id',
        'nombre' => 'required',
        'apellido' => 'required',
        'edad' => 'required',
        'genero' => 'required',
    ];

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'email',
        'dni' => 'DNI',
        'carnet_extranjeria' => 'carnet de extranjería',
        'edad' => 'edad',
        'celular' => 'celular',
        'genero' => 'genero',
    ];

    protected $messages = [
        'sedesSeleccionadas.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'apellido.required' => 'El :attribute es requerido.',
        'email.required' => 'El :attribute es requerido.',
        'email.unique' => 'El :attribute ya existe.',
        'dni.required' => 'El :attribute es requerido.',
        'dni.unique' => 'El :attribute ya existe.',
        'dni.digits' => 'El :attribute acepta 8 dígitos.',
        'carnet_extranjeria.unique' => 'El :attribute ya existe.',
        'edad.required' => 'La :attribute es requerido.',
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
        $this->email = $paciente->email;

        $this->dni = $paciente->dni;
        $this->carnet_extranjeria = $paciente->carnet_extranjeria;

        if ($this->dni) {
            $this->es_extranjero = false;
        } else {
            $this->es_extranjero = true;
        }

        $this->edad = $paciente->edad;
        $this->celular = $paciente->celular;
        $this->genero = $paciente->genero;

        $sede = Auth::user()->encargado->sede;

        $this->odontologos = $sede->odontologos()->get();

        $this->odontologos_detalles = $paciente->odontologos->toArray();
    }

    public function editarPaciente()
    {
        $rules = $this->rules;

        $rules['email'] = 'unique:users,email,' . $this->usuario_paciente->id;

        if ($this->es_extranjero) {
            $rules['carnet_extranjeria'] = 'unique:pacientes,carnet_extranjeria,' . $this->paciente->id;
            $this->reset('dni');
            $documentoIdentidad = $this->carnet_extranjeria;
        } else {
            $rules['dni'] = 'digits:8|unique:pacientes,dni,' . $this->paciente->id;
            $this->reset('carnet_extranjeria');
            $documentoIdentidad = $this->dni;
        }

        if ($this->email) {
            $email = $this->email;
        } else {
            $email = $documentoIdentidad . '@crd.com';
        }

        $this->validate($rules);

        $this->usuario_paciente->update(
            [
                'email' => $email,
            ]
        );

        $this->paciente->update(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'dni' => $this->dni,
                'carnet_extranjeria' => $this->carnet_extranjeria,
                'edad' => $this->edad,
                'email' => $email,
                'celular' => $this->celular,
                'genero' => $this->genero,
            ]
        );

        $this->paciente->sedes()->sync($this->sedesSeleccionadas);

        $this->emit('mensajeActualizado', "Editado.");
    }

    public function updatedOdontologoId($value)
    {
        if ($value) {
            $odontologo = Odontologo::find($value);
            $this->odontologo_id = $odontologo->id;

            $this->buscarOdontologo = $odontologo->nombre_clinica
                ? $odontologo->nombre_clinica . ' - ' . $odontologo->nombre . ' ' . $odontologo->apellido
                : $odontologo->nombre . ' ' . $odontologo->apellido;
        }
    }

    public function agregarOdontologo()
    {
        if ($this->odontologo_id) {
            foreach ($this->odontologos_detalles as $detalle) {
                if ($detalle['id'] == $this->odontologo_id) {
                    $this->emit('mensajeError', "Ya existe el odontólogo.");
                    return;
                }
            }

            $this->paciente->odontologos()->attach($this->odontologo_id);

            $this->emit('mensajeCreado', "Agregado.");

            $this->reset('odontologo_id', 'buscarOdontologo');

            //$this->odontologos_detalles = $this->paciente->odontologos->toArray();

            $this->emit('actualizarOdontologosDetalles');
        } else {
            $this->emit('mensajeError', "Debe seleccionar un odontólogo.");
        }
    }

    public function actualizarOdontologosDetalles()
    {
        $this->odontologos_detalles = $this->paciente->odontologos->toArray();
    }

    public function eliminarUnDetalleOdontologo($odontologo_detalle_id, $index)
    {
        array_splice($this->odontologos_detalles, $index, 1);
        $odontologos_ids = array_column($this->odontologos_detalles, 'id');
        $this->paciente->odontologos()->sync($odontologos_ids);
    }

    public function eliminarPaciente()
    {
        if ($this->usuario_paciente->direccion) {
            $this->usuario_paciente->direccion->delete();
        }

        $this->paciente->sedes()->detach();

        $this->paciente->odontologos()->detach();

        $this->paciente->delete();

        $this->usuario_paciente->delete();

        return redirect()->route('encargado.paciente.sede.index');
    }

    public function render()
    {
        return view('livewire.encargado.paciente-sede.paciente-sede-editar-pagina')->layout('layouts.administrador.index');
    }
}
