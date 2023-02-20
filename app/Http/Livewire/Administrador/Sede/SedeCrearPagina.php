<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;

class SedeCrearPagina extends Component
{
    public $crearFormulario = [
        'nombre' => null,
        'descripcion' => null,
    ];

    protected $rules = [
        'crearFormulario.nombre' => 'required|unique:sedes,nombre',
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

    public function crearSede()
    {
        $rules = $this->rules;

        if ($this->crearFormulario['descripcion']) {
            $rules['crearFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        Sede::create($this->crearFormulario);

        $this->emit('mensajeCreado', "Creado.");
        $this->reset('crearFormulario');
        return redirect()->route('administrador.sede.index');
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-crear-pagina')->layout('layouts.administrador.index');
    }
}
