<?php

namespace App\Http\Livewire\Administrador\Especialidad;

use App\Models\Especialidad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EspecialidadInformacionPagina extends Component
{
    public $especialidad, $odontologos;

    public function mount(Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;
        $especialidad_id = $especialidad->id;

        $this->odontologos = $this->especialidad->odontologos()->limit(10)->get();
        /*$this->odontologos = DB::table('especialidads')
        ->join('odontologos', 'especialidads.id', '=', 'odontologos.especialidad_id')
        ->select('odontologos.nombre', 'odontologos.apellido', 'odontologos.email')
        ->where('especialidads.id', '=', $especialidad_id)
        ->get();*/
    }

    public function render()
    {
        return view('livewire.administrador.especialidad.especialidad-informacion-pagina')->layout('layouts.administrador.index');
    }
}
