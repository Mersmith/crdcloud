<?php

namespace App\Http\Livewire\Odontologo\VentaOdontologo;

use App\Models\Venta;
use Livewire\Component;
use App\Models\Odontologo;
use App\Models\Paciente;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;

class VentaOdontologoEditarLivewire extends Component
{
    public $venta;
    public $venta_id;
    public $venta_detalles = [];

    public $sedes;
    public $servicios;
    public $odontologos;
    public $clinicas;
    public $pacientes;

    public
        $sede,
        $odontologo,
        $paciente,
        $clinica;

    public
        $sede_id = "",
        $servicio_id = "",
        $paciente_id = "",
        $odontologo_id = "",
        $clinica_id = "";

    public
        $cantidad = 1,
        $link,
        $estado,
        $observacion;

    public $total;

    public $informe;
    public $editarInforme = null;

    protected $rules = [
        'venta.estado' => 'required',
    ];

    public function mount(Venta $venta)
    {
        $this->venta = $venta;
        $this->venta_id = $venta->id;
        $this->venta_detalles = $this->venta->ventaDetalle->toArray();

        $this->sedes = Sede::all();
        $this->servicios = Servicio::select('id', 'nombre')->get();
        $this->sede_id = $venta->sede_id;
        $this->sede = Sede::find($venta->sede_id);
        $this->paciente = Paciente::find($venta->paciente_id);

        $this->link = $venta->link;
        $this->estado = $venta->estado;
        $this->observacion = $venta->observacion;
        $this->total = $venta->total;

        $this->informe = $venta->informes->count() ? Storage::url($venta->informes->first()->informe_ruta) : null;
    }

    public function render()
    {
        return view('livewire.odontologo.venta-odontologo.venta-odontologo-editar-livewire')->layout('layouts.administrador.index');
    }
}
