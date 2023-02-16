<?php

use App\Http\Livewire\Administrador\Odontologo\OdontologoCrearPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoDireccionPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoEditarPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoPacientePagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoTodoPagina;
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
