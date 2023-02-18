<?php

namespace App\Http\Livewire\Administrador\Usuario;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UsuarioEstadisticaDepartamentoCantidadPagina extends Component
{
    public $departamentos_usuarios_cantidad;

    public function mount()
    {
        $this->departamentos_usuarios_cantidad = DB::table('departamentos')
            ->leftJoin('direccions', 'departamentos.id', '=', 'direccions.departamento_id')
            ->leftJoin('users', 'direccions.user_id', '=', 'users.id')
            ->select('departamentos.id', 'departamentos.nombre', DB::raw('count(users.id) as cantidad'))
            ->groupBy('departamentos.id', 'departamentos.nombre')
            ->get();           
    }
    
    public function render()
    {
        return view('livewire.administrador.usuario.usuario-estadistica-departamento-cantidad-pagina')->layout('layouts.administrador.index');
    }
}
