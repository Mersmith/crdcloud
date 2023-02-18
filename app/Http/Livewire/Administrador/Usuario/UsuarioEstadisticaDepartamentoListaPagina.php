<?php

namespace App\Http\Livewire\Administrador\Usuario;

use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UsuarioEstadisticaDepartamentoListaPagina extends Component
{
    public $usuarios;

    public function mount(Departamento $departamento)
    {
        $id_departamento = $departamento->id;
        $this->usuarios = DB::table('users')
            ->join('direccions', 'users.id', '=', 'direccions.user_id')
            ->where('direccions.departamento_id', '=', $id_departamento)
            ->select('users.*')
            ->get();
    }

    public function render()
    {
        return view('livewire.administrador.usuario.usuario-estadistica-departamento-lista-pagina')->layout('layouts.administrador.index');
    }
}
