<?php

namespace App\Http\Livewire\Administrador\Servicio;

use App\Models\Servicio;
use Livewire\Component;

class ServicioCrearPagina extends Component
{
    public $crearFormulario = [
        'nombre' => null,
        'descripcion' => null,
        'precio_venta' => null,
        'puntos_ganar' => 0,
        'puntos_canjeo' => 0,
    ];

    protected $rules = [
        'crearFormulario.nombre' => 'required|unique:servicios,nombre',
        'crearFormulario.precio_venta' => 'required',
        'crearFormulario.puntos_ganar' => 'required',
        'crearFormulario.puntos_canjeo' => 'required',
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre',
        'crearFormulario.precio_venta' => 'precio',
        'crearFormulario.puntos_ganar' => 'puntos a ganar',
        'crearFormulario.puntos_canjeo' => 'puntos para canjear',
        'crearFormulario.descripcion' => 'descripción',
    ];

    protected $messages = [
        'crearFormulario.nombre.required' => 'El :attribute es requerido.',
        'crearFormulario.nombre.unique' => 'El :attribute ya existe.',
        'crearFormulario.precio_venta.required' => 'El :attribute es requerido.',
        'crearFormulario.puntos_ganar.required' => 'Los :attribute son requerido.',
        'crearFormulario.puntos_canjeo.required' => 'Los :attribute son requerido.',
        'crearFormulario.descripcion.required' => 'La :attribute es requerido.',
    ];

    public function crearServicio()
    {
        $rules = $this->rules;

        if ($this->crearFormulario['descripcion']) {
            $rules['crearFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        Servicio::create($this->crearFormulario);

        $this->emit('mensajeCreado', "Creado.");
        $this->reset('crearFormulario');
        return redirect()->route('administrador.servicio.index');
    }

    public function render()
    {
        return view('livewire.administrador.servicio.servicio-crear-pagina')->layout('layouts.administrador.index');
    }
}
