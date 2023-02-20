<?php

namespace App\Http\Livewire\Administrador\Sede;

use App\Models\Sede;
use Livewire\Component;

class SedeInformacionPagina extends Component
{
    public $sede;

    public function mount(Sede $sede)
    {
        $this->sede = $sede;
    }

    public function render()
    {
        return view('livewire.administrador.sede.sede-informacion-pagina')->layout('layouts.administrador.index');
    }
}
