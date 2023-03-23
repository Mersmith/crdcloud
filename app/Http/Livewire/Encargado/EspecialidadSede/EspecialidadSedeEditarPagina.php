<?php

namespace App\Http\Livewire\Encargado\EspecialidadSede;

use App\Models\Especialidad;
use Livewire\Component;

class EspecialidadSedeEditarPagina extends Component
{
    protected $listeners = ['eliminarEspecialidad'];

    public $especialidad;

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

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;
        $this->editarFormulario['nombre'] = $especialidad->nombre;
        $this->editarFormulario['descripcion'] = $especialidad->descripcion;
    }

    public function editarEspecialidad()
    {
        $rules = [];

        $rules['editarFormulario.nombre'] = 'required|unique:especialidads,nombre,' . $this->especialidad->id;

        if ($this->editarFormulario['descripcion']) {
            $rules['editarFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        $this->especialidad->update($this->editarFormulario);
        $this->emit('mensajeActualizado', "Actualizado.");
    }

    public function eliminarEspecialidad()
    {
        $this->especialidad->delete();

        return redirect()->route('encargado.especialidad.sede.index');
    }

    public function render()
    {
        return view('livewire.encargado.especialidad-sede.especialidad-sede-editar-pagina')->layout('layouts.administrador.index');
    }
}
