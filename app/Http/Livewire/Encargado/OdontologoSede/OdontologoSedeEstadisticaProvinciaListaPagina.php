<?php

namespace App\Http\Livewire\Encargado\OdontologoSede;

use App\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoSedeEstadisticaProvinciaListaPagina extends Component
{
    public $odontologos_provincias, $odontologos_distritos_cantidad;

    public function mount(Provincia $provincia)
    {
        $sede = Auth::user()->encargado->sede;

        $provincia_id = $provincia->id;

        $this->odontologos_distritos_cantidad = DB::table('distritos')
            ->leftJoin('direccions', 'distritos.id', '=', 'direccions.distrito_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->join('odontologo_sede', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
            ->where('odontologos.rol', '=', 'odontologo')
            ->where('distritos.provincia_id', '=', $provincia_id)
            ->where('odontologo_sede.sede_id', '=', $sede->id)
            ->select('distritos.id', 'distritos.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->groupBy('distritos.id', 'distritos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.encargado.odontologo-sede.odontologo-sede-estadistica-provincia-lista-pagina')->layout('layouts.administrador.index');
    }
}
