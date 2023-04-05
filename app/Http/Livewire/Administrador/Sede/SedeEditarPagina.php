<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;

class SedeEditarPagina extends Component
{
    protected $listeners = ['eliminarSede'];

    public $sede;

    public $editarFormulario = [
        'nombre' => null,
        'direccion' => null,
    ];

    protected $validationAttributes = [
        'editarFormulario.nombre' => 'nombre',
        'editarFormulario.direccion' => 'dirección',
    ];

    protected $messages = [
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.nombre.unique' => 'El :attribute ya existe.',
        'editarFormulario.direccion.required' => 'La :attribute es requerido.',
    ];

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
        $this->editarFormulario['nombre'] = $sede->nombre;
        $this->editarFormulario['direccion'] = $sede->direccion;
    }

    public function editarSede()
    {
        $rules = [];

        $rules['editarFormulario.nombre'] = 'required|unique:sedes,nombre,' . $this->sede->id;
        $rules['editarFormulario.direccion'] = 'required';

        if($this->editarFormulario['direccion']){
            $rules['editarFormulario.direccion'] = 'required';
        }else{
            $this->editarFormulario['direccion'] = null;
        }

        $this->validate($rules);

        $this->sede->update($this->editarFormulario);
        $this->emit('mensajeActualizado', "Actualizado.");
    }

    public function eliminarSede()
    {
        $this->sede->delete();

        return redirect()->route('administrador.sede.index');
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-editar-pagina')->layout('layouts.administrador.index');
    }
}
