<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Odontologo;
use App\Models\Provincia;
use Livewire\Component;

class OdontologoDireccionEditarPagina extends Component
{
    public $odontologo;
    public $usuario_odontologo;
    public $usuario_direccion;

    public $departamentos, $provincias = [], $distritos = [];

    public $direccion = "", $referencia = "", $codigo_postal = "";
    public $departamento_id = "", $provincia_id = "", $distrito_id = "";
    public $departamento_nombre = "", $provincia_nombre = "", $distrito_nombre = "";

    protected $rules = [
        'departamento_id' => 'required',
        'provincia_id' => 'required',
        'distrito_id' => 'required',
        'departamento_nombre' => 'required',
        'provincia_nombre' => 'required',
        'distrito_nombre' => 'required',
    ];

    protected $messages = [
        'departamento_id' => 'El departamento es requerido.',
        'provincia_id' => 'La provincia es requerida.',
        'distrito_id' => 'El distrito es requerido.',
        'direccion' => 'La direccion es requerida.',
        'referencia' => 'La referencia es requerida.',
        'codigo_postal' => 'El código postal es requerido.',
    ];

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo = $odontologo;
        $this->usuario_odontologo = $odontologo->user;
        $this->usuario_direccion = $odontologo->user->direccion;

        $this->direccion = $this->usuario_direccion->direccion;
        $this->referencia = $this->usuario_direccion->referencia;
        $this->codigo_postal = $this->usuario_direccion->codigo_postal;
        $this->departamento_id = $this->usuario_direccion->departamento_id;

        $this->departamento_nombre = $this->usuario_direccion->departamento_nombre;
        $this->provincia_id = $this->usuario_direccion->provincia_id;
        $this->provincia_nombre = $this->usuario_direccion->provincia_nombre;
        $this->distrito_id = $this->usuario_direccion->distrito_id;
        $this->distrito_nombre = $this->usuario_direccion->distrito_nombre;

        $this->departamentos = Departamento::all();
        $this->provincias = Provincia::where('departamento_id', $this->usuario_direccion->departamento_id)->get();
        $this->distritos = Distrito::where('provincia_id', $this->usuario_direccion->provincia_id)->get();
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincias = Provincia::where('departamento_id', $value)->get();
        $nombre = $this->departamentos->where('id', $value)->first();
        $this->reset(['provincia_id', 'distrito_id']);
        $this->departamento_nombre = $nombre['nombre'];
    }

    public function updatedProvinciaId($value)
    {
        $this->distritos = Distrito::where('provincia_id', $value)->get();
        $nombre = $this->provincias->where('id', $value)->first();
        $this->reset('distrito_id');
        $this->provincia_nombre = $nombre['nombre'];
    }

    public function updatedDistritoId($value)
    {
        $nombre = $this->distritos->where('id', $value)->first();
        $this->distrito_nombre = $nombre['nombre'];
    }

    public function editarDireccion()
    {
        $this->validate();

        $this->usuario_direccion->update([
            'departamento_id' => $this->departamento_id,
            'provincia_id' => $this->provincia_id,
            'distrito_id' => $this->distrito_id,
            'direccion' => $this->direccion,
            'referencia' => $this->referencia,
            'departamento_nombre' => $this->departamento_nombre,
            'provincia_nombre' => $this->provincia_nombre,
            'distrito_nombre' => $this->distrito_nombre,
            'codigo_postal' => $this->codigo_postal,
        ]);

        $this->emit('mensajeActualizado', "Dirección actualizado");
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-direccion-editar-pagina')->layout('layouts.administrador.index');
    }
}
