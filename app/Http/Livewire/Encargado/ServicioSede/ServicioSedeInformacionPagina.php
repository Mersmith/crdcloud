<?php

namespace App\Http\Livewire\Encargado\ServicioSede;

use App\Models\Servicio;
use Livewire\Component;

class ServicioSedeInformacionPagina extends Component
{
    public $servicio;

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    public function render()
    {
        return view('livewire.encargado.servicio-sede.servicio-sede-informacion-pagina')->layout('layouts.administrador.index');
    }
}
