<?php

namespace App\Http\Livewire\Administrador\Servicio;

use App\Models\Servicio;
use Livewire\Component;

class ServicioEditarPagina extends Component
{
    protected $listeners = ['eliminarServicio'];

    public $servicio;

    public $editarFormulario = [
        'nombre' => null,
        'descripcion' => null,
        'precio_venta' => null,
        'puntos_ganar' => 0,
        'puntos_canjeo' => 0,
    ];

    protected $rules = [
        'editarFormulario.precio_venta' => 'required',
        'editarFormulario.puntos_ganar' => 'required',
        'editarFormulario.puntos_canjeo' => 'required',
    ];

    protected $validationAttributes = [
        'editarFormulario.nombre' => 'nombre',
        'editarFormulario.precio_venta' => 'precio',
        'editarFormulario.puntos_ganar' => 'puntos a ganar',
        'editarFormulario.puntos_canjeo' => 'puntos para canjear',
        'editarFormulario.descripcion' => 'descripción',
    ];

    protected $messages = [
        'editarFormulario.nombre.required' => 'El :attribute es requerido.',
        'editarFormulario.nombre.unique' => 'El :attribute ya existe.',
        'editarFormulario.precio_venta.required' => 'El :attribute es requerido.',
        'editarFormulario.puntos_ganar.required' => 'Los :attribute son requerido.',
        'editarFormulario.puntos_canjeo.required' => 'Los :attribute son requerido.',
        'editarFormulario.descripcion.required' => 'La :attribute es requerido.',
    ];

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
        $this->editarFormulario['nombre'] = $servicio->nombre;
        $this->editarFormulario['precio_venta'] = $servicio->precio_venta;
        $this->editarFormulario['puntos_ganar'] = $servicio->puntos_ganar;
        $this->editarFormulario['puntos_canjeo'] = $servicio->puntos_canjeo;
        $this->editarFormulario['descripcion'] = $servicio->descripcion;
    }

    public function editarServicio()
    {
        $rules = $this->rules;

        $rules['editarFormulario.nombre'] = 'required|unique:servicios,nombre,' . $this->servicio->id;

        if ($this->editarFormulario['descripcion']) {
            $rules['editarFormulario.descripcion'] = 'required';
        }

        $this->validate($rules);

        $this->servicio->update($this->editarFormulario);
        $this->emit('mensajeActualizado', "Actualizado.");
    }

    public function eliminarServicio()
    {
        $this->servicio->delete();

        return redirect()->route('administrador.servicio.index');
    }

    public function render()
    {
        return view('livewire.administrador.servicio.servicio-editar-pagina')->layout('layouts.administrador.index');
    }
}
