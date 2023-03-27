<?php

namespace App\Http\Livewire\Odontologo\ImagenesOdontologo;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ImagenesOdontologoTodoLivewire extends Component
{
    public $odontologo;
    public $ventas;
    public $ventasPagadas;
    public $imagenesTodos;

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;

        $this->ventas = $odontologo->ventas()->orderBy('created_at', 'desc')->get();

        $this->ventasPagadas = $this->ventas->filter(function ($venta) {
            return $venta->estado == Venta::PAGADO;
        })->sum('puntos_ganados');

        $imagenesVentas = collect();
        foreach ($this->ventas as $venta) {
            $imagenesVentas = $imagenesVentas->merge($venta->imagenes);
        }

        $this->imagenesTodos = $imagenesVentas;
    }


    public function render()
    {
        return view('livewire.odontologo.imagenes-odontologo.imagenes-odontologo-todo-livewire')->layout('layouts.administrador.index');
    }
}
