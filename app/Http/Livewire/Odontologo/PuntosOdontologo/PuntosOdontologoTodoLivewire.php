<?php

namespace App\Http\Livewire\Odontologo\PuntosOdontologo;

use App\Models\Canjeo;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
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

    public $ventas_canjeos;

    public $cantidad_ventas_canjeos = 0;

    public function mount()
    {
        $odontologo = Auth::user()->odontologo;
        $this->odontologo = $odontologo;

        $this->ventas = $odontologo->ventas()->where('estado', Venta::PAGADO)->orderBy('created_at', 'desc')->get();

        $this->ventasPagadas = $this->ventas->filter(function ($venta) {
            return $venta->estado == Venta::PAGADO;
        })->sum('puntos_ganados');

        $this->canjeos = $odontologo->canjeos()->where('estado', Canjeo::APLICADO)->orderBy('created_at', 'desc')->get();

        $this->canjeosPagadas = $this->canjeos->filter(function ($canjeo) {
            return $canjeo->estado == Canjeo::APLICADO;
        })->sum('total_puntos');

        $this->cantidad_ventas_canjeos = $this->canjeos->count() + $this->ventas->count();

        $this->ventas_canjeos = $this->ventas->merge($this->canjeos)->sortByDesc('created_at')->toJson();
        /*$imagenesVentas = collect();
        foreach ($this->ventas as $venta) {
            $imagenesVentas = $imagenesVentas->merge($venta->imagenes);
        }

        $this->imagenesTodos = $imagenesVentas;*/

    }

    public function render()
    {
        return view('livewire.odontologo.puntos-odontologo.puntos-odontologo-todo-livewire')->layout('layouts.administrador.index');
    }
}
