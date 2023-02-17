<?php

use App\Http\Livewire\Administrador\Odontologo\OdontologoCrearPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoDireccionCrearPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoDireccionEditarPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoEditarPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoInformacionPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoPacienteCrearPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoPacienteEditarPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoPacienteTodoPagina;
use App\Http\Livewire\Administrador\Odontologo\OdontologoTodoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteClinicaTodoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteCrearPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteEditarPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteInformacionPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteOdontogoTodoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteOdontologoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteTodoPagina;
use App\Http\Livewire\Administrador\Paciente\PacienteVerPagina;
use Illuminate\Support\Facades\Route;

//http://127.0.0.1:8000/administrador/prueba-administrador
Route::get('prueba-administrador', function () {
    return "Administrador";
});

//http://127.0.0.1:8000/administrador/odontologos
Route::get('odontologos', OdontologoTodoPagina::class)->name('odontologo.index');
Route::get('odontologo/crear', OdontologoCrearPagina::class)->name('odontologo.crear');
Route::get('odontologo/{odontologo}/editar', OdontologoEditarPagina::class)->name('odontologo.editar');
Route::get('odontologo/{odontologo}/informacion', OdontologoInformacionPagina::class)->name('odontologo.informacion');
Route::get('odontologo/{odontologo}/pacientes', OdontologoPacienteTodoPagina::class)->name('odontologo.paciente.todo');
Route::get('odontologo/{odontologo}/paciente/crear', OdontologoPacienteCrearPagina::class)->name('odontologo.paciente.crear');
Route::get('odontologo/{odontologo}/paciente/{paciente}/editar', OdontologoPacienteEditarPagina::class)->name('odontologo.paciente.editar');
Route::get('odontologo/{odontologo}/direccion', OdontologoDireccionCrearPagina::class)->name('odontologo.direccion.crear');
Route::get('odontologo/{odontologo}/direccion/editar', OdontologoDireccionEditarPagina::class)->name('odontologo.direccion.editar');

//http://127.0.0.1:8000/administrador/pacientes
Route::get('pacientes', PacienteTodoPagina::class)->name('paciente.index');
Route::get('paciente/crear', PacienteCrearPagina::class)->name('paciente.crear');
Route::get('paciente/{paciente}/editar', PacienteEditarPagina::class)->name('paciente.editar');
Route::get('paciente/{paciente}/informacion', PacienteInformacionPagina::class)->name('paciente.informacion');
Route::get('paciente/{paciente}/odontologos', PacienteOdontogoTodoPagina::class)->name('paciente.odontologo.todo');
Route::get('paciente/{paciente}/clinicas', PacienteClinicaTodoPagina::class)->name('paciente.clinica.todo');
