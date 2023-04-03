<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoSedeEstadisticaDepartamentoCantidadPagina extends Component
{
    public $departamentos_odontologos_cantidad;

    public function mount()
    {
        $sede = Auth::user()->encargado->sede;
     
        $this->departamentos_odontologos_cantidad = DB::table('departamentos')
            ->leftJoin('direccions', 'departamentos.id', '=', 'direccions.departamento_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->join('odontologo_sede', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
            ->select('departamentos.id', 'departamentos.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->where('odontologos.rol', '=', 'odontologo')
            ->where('odontologo_sede.sede_id', '=', $sede->id)
            ->groupBy('departamentos.id', 'departamentos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.encargado.odontologo-sede.odontologo-sede-estadistica-departamento-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
