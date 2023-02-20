<?php

namespace App\Http\Livewire\Administrador\Servicio;

use App\Models\Servicio;
use Livewire\Component;

class ServicioInformacionPagina extends Component
{
    public $servicio;

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    public function render()
    {
        return view('livewire.administrador.servicio.servicio-informacion-pagina')->layout('layouts.administrador.index');
    }
}
