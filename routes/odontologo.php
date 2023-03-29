<?php

use App\Http\Controllers\Administrador\CanjeoController;
use App\Http\Controllers\Administrador\VentaController;
use App\Http\Controllers\Odontologo\DescargarProgramaController;
use App\Http\Livewire\Administrador\Canjeo\CanjeoCrearLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoEditarLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoTodoLivewire;
use App\Http\Livewire\Odontologo\CanjeoOdontologo\CanjeoOdontologoCrearLivewire;
use App\Http\Livewire\Odontologo\CanjeoOdontologo\CanjeoOdontologoEditarLivewire;
use App\Http\Livewire\Odontologo\CanjeoOdontologo\CanjeoOdontologoInformacionLivewire;
use App\Http\Livewire\Odontologo\CanjeoOdontologo\CanjeoOdontologoTodoLivewire;
use App\Http\Livewire\Odontologo\DireccionOdontologo\DireccionOdontologoCrearLivewire;
use App\Http\Livewire\Odontologo\DireccionOdontologo\DireccionOdontologoEditarLivewire;
use App\Http\Livewire\Odontologo\ImagenesOdontologo\ImagenesOdontologoTodoLivewire;
use App\Http\Livewire\Odontologo\InicioOdontologo\InicioOdontologoPagina;
use App\Http\Livewire\Odontologo\PacienteOdontologo\PacienteOdontologoInformacionPagina;
use App\Http\Livewire\Odontologo\PacienteOdontologo\PacienteOdontologoTodoPagina;
use App\Http\Livewire\Odontologo\PerfilOdontologo\PerfilOdontologoInformacionPagina;
use App\Http\Livewire\Odontologo\PuntosOdontologo\PuntosOdontologoTodoLivewire;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoEditarLivewire;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoInformacionLivewire;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoTodoLivewire;
use Illuminate\Support\Facades\Route;

Route::get('prueba-administrador', function () {
    return "Administrador";
});

Route::get('principal', InicioOdontologoPagina::class)->name('inicio.odontologo');//

Route::get('perfil', PerfilOdontologoInformacionPagina::class)->name('perfil.odontologo.informacion');//

Route::get('pacientes', PacienteOdontologoTodoPagina::class)->name('paciente.odontologo.index'); //
Route::get('paciente/{paciente}/informacion', PacienteOdontologoInformacionPagina::class)->name('paciente.odontologo.informacion');//

Route::get('radiografias', VentaOdontologoTodoLivewire::class)->name('venta.odontologo.index');//
Route::get('radiografia/{venta}/informacion', VentaOdontologoInformacionLivewire::class)->name('venta.odontologo.informacion');//

Route::get('canjeos', CanjeoOdontologoTodoLivewire::class)->name('canjeo.odontologo.index');
Route::get('canjeo/crear', CanjeoOdontologoCrearLivewire::class)->name('canjeo.odontologo.crear');
Route::get('canjeo/{canjeo}/editar', CanjeoOdontologoEditarLivewire::class)->name('canjeo.odontologo.editar');
Route::get('canjeo/{canjeo}/informacion', CanjeoOdontologoInformacionLivewire::class)->name('canjeo.odontologo.informacion');


Route::get('puntos', PuntosOdontologoTodoLivewire::class)->name('puntos.odontologo.index');//

//Route::get('imagenes', ImagenesOdontologoTodoLivewire::class)->name('imagenes.odontologo.index');

Route::get('direccion', DireccionOdontologoEditarLivewire::class)->name('direccion.odontologo.informacion');//

Route::get('descargar/cdx-view', [DescargarProgramaController::class, 'cdxView'])->name('descargar.cdx.view');
