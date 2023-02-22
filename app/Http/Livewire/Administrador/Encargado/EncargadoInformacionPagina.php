<?php

namespace App\Http\Livewire\Administrador\Encargado;

use App\Models\Encargado;
use Livewire\Component;

class EncargadoInformacionPagina extends Component
{
    public $encargado;
    public $usuario_encargado;

    public function mount(Encargado $encargado)
    {
        $this->encargado = $encargado;
        $this->usuario_encargado = $encargado->user;
    }

    public function render()
    {
        return view('livewire.administrador.encargado.encargado-informacion-pagina')->layout('layouts.administrador.index');
    }
}
