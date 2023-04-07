<?php

namespace App\Http\Livewire\Administrador\Clinica;

use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaEstadisticaDistritoListaPagina extends Component
{
    use WithPagination;
    public $buscarClinica;
    protected $paginate = 10;

    public $distrito_id;

    public function updatingBuscarClinica()
    {
        $this->resetPage();
    }

    public function mount(Distrito $distrito)
    {
        $this->distrito_id = $distrito->id;
    }

    public function render()
    {
        $clinicas_distritos = DB::table('odontologos')
            ->join('direccions', 'odontologos.user_id', '=', 'direccions.user_id')
            ->where('direccions.distrito_id', '=', $this->distrito_id)
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarClinica . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->buscarClinica . '%');
            })
            ->where('odontologos.rol', '=', 'clinica')
            ->orderBy('odontologos.created_at', 'desc')
            ->select('odontologos.*', 'odontologos.id as odontologo_id') // agregar el nuevo campo
            ->paginate(10);

        return view('livewire.administrador.clinica.clinica-estadistica-distrito-lista-pagina', compact('clinicas_distritos'))->layout('layouts.administrador.index');
    }
}
