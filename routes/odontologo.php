<?php

use App\Http\Controllers\Administrador\CanjeoController;
use App\Http\Controllers\Administrador\VentaController;
use App\Http\Livewire\Administrador\Canjeo\CanjeoCrearLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoEditarLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoTodoLivewire;
use App\Http\Livewire\Odontologo\PacienteOdontologo\PacienteOdontologoInformacionPagina;
use App\Http\Livewire\Odontologo\PacienteOdontologo\PacienteOdontologoTodoPagina;
use App\Http\Livewire\Odontologo\PerfilOdontologo\PerfilOdontologoInformacionPagina;
use App\Http\Livewire\Odontologo\PuntosOdontologo\PuntosOdontologoTodoLivewire;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoEditarLivewire;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoTodoLivewire;
use Illuminate\Support\Facades\Route;

Route::get('prueba-administrador', function () {
    return "Administrador";
});

Route::get('perfil', PerfilOdontologoInformacionPagina::class)->name('perfil.odontologo.informacion');

Route::get('pacientes', PacienteOdontologoTodoPagina::class)->name('paciente.odontologo.index');//
Route::get('paciente/{paciente}/informacion', PacienteOdontologoInformacionPagina::class)->name('paciente.odontologo.informacion');

Route::get('ventas', VentaOdontologoTodoLivewire::class)->name('venta.odontologo.index');
Route::get('venta/{venta}/editar', VentaOdontologoEditarLivewire::class)->name('venta.odontologo.editar');
Route::post('venta/{venta}/dropzone', [VentaController::class, 'dropzone'])->name('venta.dropzone');

Route::get('canjeos', CanjeoTodoLivewire::class)->name('canjeo.index');
Route::get('canjeo/crear', CanjeoCrearLivewire::class)->name('canjeo.crear');
Route::get('canjeo/{canjeo}/editar', CanjeoEditarLivewire::class)->name('canjeo.editar');
Route::post('canjeo/{canjeo}/dropzone', [CanjeoController::class, 'dropzone'])->name('canjeo.dropzone');

Route::get('puntos', PuntosOdontologoTodoLivewire::class)->name('puntos.odontologo.index');
