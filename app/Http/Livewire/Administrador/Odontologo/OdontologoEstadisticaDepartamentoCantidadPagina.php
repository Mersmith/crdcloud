<?php

namespace App\Http\Livewire\Administrador\Odontologo;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OdontologoEstadisticaDepartamentoCantidadPagina extends Component
{

    public function mount()
    {
        $departamento_id = 12;
        $odontologos = DB::table('odontologos')
                 ->join('users', 'odontologos.user_id', '=', 'users.id')
                 ->join('direccions', 'users.id', '=', 'direccions.user_id')
                 ->join('departamentos', 'direccions.departamento_id', '=', 'departamentos.id')
                 ->where('departamentos.id', '=', $departamento_id)
                 ->select('odontologos.*')
                 ->get();

        dd($odontologos);
    }

    public function render()
    {
        return view('livewire.administrador.odontologo.odontologo-estadistica-departamento-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
