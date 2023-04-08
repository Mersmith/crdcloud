<?php

namespace App\Http\Livewire\Odontologo\PuntosOdontologo;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;

class PuntosOdontologoTodoLivewire extends Component
{
    public $odontologo;
    public $ventas;
    public $ventasPagadas;
    public $imagenesTodos;

    public $canjeos;
    public $canjeosPagadas;

    public $ventasYCanjeos;

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;

        $this->ventas = $odontologo->ventas()->orderBy('created_at', 'desc')->get();

        $this->ventasPagadas = $this->ventas->filter(function ($venta) {
            return $venta->estado == Venta::PAGADO;
        })->sum('puntos_ganados');

        $this->canjeos = $odontologo->canjeos()->orderBy('created_at', 'desc')->get();

        $this->canjeosPagadas = $this->canjeos->filter(function ($canjeo) {
            return $canjeo->estado == Venta::PAGADO;
        })->sum('total_puntos');

        $imagenesVentas = collect();
        foreach ($this->ventas as $venta) {
            $imagenesVentas = $imagenesVentas->merge($venta->imagenes);
        }

        $this->imagenesTodos = $imagenesVentas;
    }

    public function render()
    {
        return view('livewire.odontologo.puntos-odontologo.puntos-odontologo-todo-livewire')->layout('layouts.administrador.index');
    }
}
