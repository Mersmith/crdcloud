<?php

namespace App\Http\Livewire\Encargado\ClinicaSede;

use App\Models\Distrito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaSedeEstadisticaDistritoListaPagina extends Component
{
    use WithPagination;
    public $buscarOdontologo;
    protected $paginate = 10;

    public $distrito_id;
    public $sede_id;

    public function updatingBuscarOdontologo()
    {
        $this->resetPage();
    }

    public function mount(Distrito $distrito)
    {
        $this->sede_id = Auth::user()->encargado->sede->id;

        $this->distrito_id = $distrito->id;
    }

    public function render()
    {
        $odontologos_distritos = DB::table('odontologos')
            ->join('direccions', 'odontologos.user_id', '=', 'direccions.user_id')
            ->where('direccions.distrito_id', '=', $this->distrito_id)
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarOdontologo . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->buscarOdontologo . '%');
            })
            ->where('odontologos.rol', '=', 'clinica')
            ->where('odontologo_sede.sede_id', '=', $this->sede_id)
            ->join('odontologo_sede', 'odontologos.id', '=', 'odontologo_sede.odontologo_id')
            ->orderBy('odontologos.created_at', 'desc')
            ->paginate(10);

        return view('livewire.encargado.clinica-sede.clinica-sede-estadistica-distrito-lista-pagina', compact('odontologos_distritos'))->layout('layouts.administrador.index');
    }
}
