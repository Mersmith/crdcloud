<?php

use App\Http\Livewire\Administrador\Odontologo\OdontologoCrearPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoDireccionPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoEditarPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoPacientePagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoTodoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteCrearPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteEditarPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteOdontologoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteTodoPagina;
use Illuminate\Support\Facades\Route;

//http://127.0.0.1:8000/administrador/prueba-administrador
Route::get('prueba-administrador', function () {
    return "Administrador";
});

//http://127.0.0.1:8000/administrador/odontologos
Route::get('odontologos', OdontologoTodoPagina::class)->name('odontologo.index');
Route::get('odontologo/crear', OdontologoCrearPagina::class)->name('odontologo.crear');
Route::get('odontologo/{odontologo}/editar', OdontologoEditarPagina::class)->name('odontologo.editar');
Route::get('odontologo/{odontologo}/ver', OdontologoEditarPagina::class)->name('odontologo.ver');
Route::get('odontologo/{odontologo}/pacientes', OdontologoPacientePagina::class)->name('odontologo.paciente');
Route::get('odontologo/{odontologo}/direcciones', OdontologoDireccionPagina::class)->name('odontologo.direccion');

//http://127.0.0.1:8000/administrador/pacientes
Route::get('pacientes', PacienteTodoPagina::class)->name('paciente.index');
Route::get('paciente/crear', PacienteCrearPagina::class)->name('paciente.crear');
Route::get('paciente/{paciente}/editar', PacienteEditarPagina::class)->name('paciente.editar');
Route::get('paciente/{paciente}/ver', PacienteEditarPagina::class)->name('paciente.ver');
Route::get('paciente/{paciente}/odontologo', PacienteOdontologoPagina::class)->name('paciente.odontologo');
