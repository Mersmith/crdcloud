<?php

namespace App\Http\Livewire\Odontologo\InicioOdontologo;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InicioOdontologoPagina extends Component
{
    public $cantidad_pacientes;
    public $cantidad_examenes;
    public $cantidad_puntos;

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;

        $this->cantidad_pacientes = $odontologo->pacientes()->count();
        $this->cantidad_examenes = $odontologo->ventas()->count();
        $this->cantidad_puntos = Auth::user()->odontologo->puntos;
    }

    public function render()
    {
        return view('livewire.odontologo.inicio-odontologo.inicio-odontologo-pagina')->layout('layouts.administrador.index');
    }
}
