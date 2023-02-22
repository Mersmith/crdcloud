<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Especialidad;
use App\Models\Odontologo;
use Livewire\Component;

class OdontologoInformacionPagina extends Component
{
    public $odontologo;
    public $usuario_odontologo;
    public $especialidad;
    public $direccion;

    public function mount(Odontologo $odontologo)
    {
        $this->odontologo = $odontologo;
        $this->usuario_odontologo = $odontologo->user;
        $this->especialidad = Especialidad::find($odontologo->especialidad_id);
        $this->direccion = $odontologo->user->direccion;
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-informacion-pagina')->layout('layouts.administrador.index');
    }
}
