<?php

namespace App\Http\Livewire\Encargado\ServicioSede;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class ServicioSedeTodoPagina extends Component
{
    use WithPagination;
    public $buscarServicio;
    public $cantidad_total_servicios;
    protected $paginate = 20;

    public function updatingBuscarServicio()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->cantidad_total_servicios = Servicio::count();
    }

    public function render()
    {
        $servicios = Servicio::where('nombre', 'like', '%' . $this->buscarServicio . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        return view('livewire.encargado.servicio-sede.servicio-sede-todo-pagina', compact('servicios'))->layout('layouts.administrador.index');
    }
}
