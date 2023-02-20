<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;

class SedeEditarPagina extends Component
{
    public $sede;

    public $editarFormulario = [
        'nombre' => null,
        'descripcion' => null,
    ];

    protected $validationAttributes = [
        'editarFormulario.nombre' => 'nombre',
        'editarFormulario.descripcion' => 'descripción',
    ];

    protected $messages = [
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.nombre.unique' => 'El :attribute ya existe.',
        'editarFormulario.descripcion.required' => 'La :attribute es requerido.',
    ];

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->editarFormulario['nombre'] = $sede->nombre;
        $this->editarFormulario['descripcion'] = $sede->descripcion;
    }

    public function editarSede()
    {
        $rules = [];

        $rules['editarFormulario.nombre'] = 'required|unique:sedes,nombre,' . $this->sede->id;

        if ($this->editarFormulario['descripcion']) {
            $rules['editarFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        $this->sede->update($this->editarFormulario);
        $this->emit('mensajeActualizado', "Actualizado.");
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-editar-pagina')->layout('layouts.administrador.index');
    }
}
