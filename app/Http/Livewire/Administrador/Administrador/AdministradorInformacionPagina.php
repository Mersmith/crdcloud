<?php

namespace App\Http\Livewire\Administrador\Administrador;

use Livewire\Component;
use App\Models\Administrador;

class AdministradorInformacionPagina extends Component
{
    public $administrador;
    public $usuario_administrador;

    public function mount(Administrador $administrador)
    {
        $this->administrador = $administrador;
        $this->usuario_administrador = $administrador->user;
    }

    public function render()
    {
        return view('livewire.administrador.administrador.administrador-informacion-pagina')->layout('layouts.administrador.index');
    }
}
