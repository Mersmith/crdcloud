<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Provincia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoEstadisticaProvinciaListaPagina extends Component
{
    public $odontologos_provincias, $odontologos_distritos_cantidad;

    public function mount(Provincia $provincia)
    {
        $provincia_id = $provincia->id;

        /*$this->odontologos_provincias = DB::table('odontologos')
            ->join('direccions', 'odontologos.user_id', '=', 'direccions.user_id')
            ->join('provincias', 'direccions.provincia_id', '=', 'provincias.id')
            ->select('odontologos.*')
            ->where('provincias.id', '=', $provincia_id)
            ->get();*/

        $this->odontologos_distritos_cantidad = DB::table('distritos')
            ->leftJoin('direccions', 'distritos.id', '=', 'direccions.distrito_id')
            ->leftJoin('odontologos', 'direccions.user_id', '=', 'odontologos.user_id')
            ->select('distritos.id', 'distritos.nombre', DB::raw('count(odontologos.user_id) as cantidad'))
            ->where('distritos.provincia_id', '=', $provincia_id)
            ->groupBy('distritos.id', 'distritos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-estadistica-provincia-lista-pagina')->layout('layouts.administrador.index');
    }
}
