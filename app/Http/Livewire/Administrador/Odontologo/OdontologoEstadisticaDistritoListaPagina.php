<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoEstadisticaDistritoListaPagina extends Component
{
    public $odontologos_distritos;

    public function mount(Distrito $distrito)
    {
        $distrito_id = $distrito->id;

        $this->odontologos_distritos = DB::table('odontologos')
            ->join('direccions', 'odontologos.user_id', '=', 'direccions.user_id')
            ->where('direccions.distrito_id', '=', $distrito_id)
            ->select('odontologos.*')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-estadistica-distrito-lista-pagina')->layout('layouts.administrador.index');
    }
}
