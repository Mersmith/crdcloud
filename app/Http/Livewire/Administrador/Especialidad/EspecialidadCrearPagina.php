<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Livewire\Component;

class EspecialidadCrearPagina extends Component
{
    public $crearFormulario = [
        'nombre' => null,
        'descripcion' => null,
    ];

    protected $rules = [
        'crearFormulario.nombre' => 'required|unique:especialidads,nombre',
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre',
        'crearFormulario.descripcion' => 'descripción',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.nombre.unique' => 'El :attribute ya existe.',
        'crearFormulario.descripcion.required' => 'La :attribute es requerido.',
    ];

    public function crearEspecialidad()
    {
        $rules = $this->rules;

        if ($this->crearFormulario['descripcion']) {
            $rules['crearFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        Especialidad::create($this->crearFormulario);

        $this->emit('mensajeCreado', "Creado.");
        $this->reset('crearFormulario');
        return redirect()->route('administrador.especialidad.index');

    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-crear-pagina')->layout('layouts.administrador.index');
    }
}
