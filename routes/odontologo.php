<?php

use App\Http\Controllers\Administrador\CanjeoController;
use App\Http\Controllers\Administrador\VentaController;
use App\Http\Livewire\Administrador\Canjeo\CanjeoCrearLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoEditarLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoTodoLivewire;
use App\Http\Livewire\Administrador\Venta\VentaCrearLivewire;
use App\Http\Livewire\Administrador\Venta\VentaEditarLivewire;
use App\Http\Livewire\Encargado\VentaSede\VentaSedeTodoLivewire;
use App\Http\Livewire\Odontologo\PacienteOdontologo\PacienteOdontologoTodoPagina;
use App\Http\Livewire\Odontologo\VentaOdontologo\VentaOdontologoTodoLivewire;
use Illuminate\Support\Facades\Route;

Route::get('prueba-administrador', function () {
    return "Administrador";
});

Route::get('pacientes', PacienteOdontologoTodoPagina::class)->name('paciente.odontologo.index');//

Route::get('ventas', VentaOdontologoTodoLivewire::class)->name('venta.odontologo.index');
Route::get('venta/crear', VentaCrearLivewire::class)->name('venta.crear');
Route::get('venta/{venta}/editar', VentaEditarLivewire::class)->name('venta.editar');
Route::post('venta/{venta}/dropzone', [VentaController::class, 'dropzone'])->name('venta.dropzone');

Route::get('canjeos', CanjeoTodoLivewire::class)->name('canjeo.index');
Route::get('canjeo/crear', CanjeoCrearLivewire::class)->name('canjeo.crear');
Route::get('canjeo/{canjeo}/editar', CanjeoEditarLivewire::class)->name('canjeo.editar');
Route::post('canjeo/{canjeo}/dropzone', [CanjeoController::class, 'dropzone'])->name('canjeo.dropzone');
