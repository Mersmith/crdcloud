<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;

class SedeCrearPagina extends Component
{
    public $crearFormulario = [
        'nombre' => null,
        'direccion' => null,
    ];

    protected $rules = [
        'crearFormulario.nombre' => 'required|unique:sedes,nombre',
        'crearFormulario.direccion' => 'required',
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre',
        'crearFormulario.direccion' => 'dirección',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.nombre.unique' => 'El :attribute ya existe.',
        'crearFormulario.direccion.required' => 'La :attribute es requerido.',
    ];

    public function crearSede()
    {
        $rules = $this->rules;

        if($this->crearFormulario['direccion']){
            $rules['crearFormulario.direccion'] = 'required';
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
