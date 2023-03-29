<?php

namespace App\Http\Livewire\Odontologo\PacienteOdontologo;

use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PacienteOdontologoInformacionPagina extends Component
{
    public $paciente;
    public $usuario_paciente;
    public $odontologos;
    public $clinicas;
    public $direccion;
    public $sedes;
    public $ventas;
    public $imagenes;

    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;

        $this->usuario_paciente = $paciente->user;

        $this->odontologos = $paciente->odontologos()->where('rol', '=', 'odontologo')->limit(10)->get();

        $this->clinicas = $paciente->odontologos()->where('rol', '=', 'clinica')->limit(10)->get();

        $this->direccion = $paciente->user->direccion;

        $this->sedes = $paciente->sedes->pluck('nombre')->toArray();

        $this->ventas = DB::table('ventas')
            ->leftJoin('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->leftJoin('servicios', 'venta_detalles.servicio_id', '=', 'servicios.id')
            ->select('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at', DB::raw('GROUP_CONCAT(servicios.nombre SEPARATOR ", ") as nombre'))
            ->where('ventas.paciente_id', $paciente->id)
            ->groupBy('ventas.id', 'ventas.estado', 'ventas.link', 'ventas.descargas_imagen', 'ventas.created_at')
            ->orderBy('ventas.id')
            ->get();

        $ventas = $paciente->ventas;

        $imagenesVentas = collect();
        foreach ($ventas as $venta) {
            $imagenesVentas = $imagenesVentas->merge($venta->imagenes);
        }
        $this->imagenes = $imagenesVentas;
    }

    public function render()
    {
        return view('livewire.odontologo.paciente-odontologo.paciente-odontologo-informacion-pagina')->layout('layouts.administrador.index');
    }
}
