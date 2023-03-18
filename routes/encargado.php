<?php

use App\Http\Controllers\Administrador\CanjeoController;
use App\Http\Controllers\Administrador\VentaController;
use App\Http\Livewire\Administrador\Canjeo\CanjeoCrearLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoEditarLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoTodoLivewire;
use App\Http\Livewire\Administrador\Especialidad\EspecialidadCrearPagina;
use App\Http\Livewire\Administrador\Especialidad\EspecialidadEditarPagina;
use App\Http\Livewire\Administrador\Servicio\ServicioCrearPagina;
use App\Http\Livewire\Administrador\Servicio\ServicioEditarPagina;
use App\Http\Livewire\Administrador\Servicio\ServicioInformacionPagina;
use App\Http\Livewire\Administrador\Servicio\ServicioTodoPagina;
use App\Http\Livewire\Administrador\Usuario\UsuarioEstadisticaDepartamentoCantidadPagina;
use App\Http\Livewire\Administrador\Usuario\UsuarioEstadisticaDepartamentoListaPagina;
use App\Http\Livewire\Administrador\Venta\VentaCrearLivewire;
use App\Http\Livewire\Administrador\Venta\VentaEditarLivewire;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeTodoPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaClinicaCantidadPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaClinicaListaPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaOdontologoCantidadPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaOdontologoListaPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeInformacionPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeTodoPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeTodoPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeTodoPagina;
use App\Http\Livewire\Encargado\VentaSede\VentaSedeTodoLivewire;
use Illuminate\Support\Facades\Route;

Route::get('especialidades', EspecialidadSedeTodoPagina::class)->name('especialidad.sede.index');//
Route::get('especialidad/crear', EspecialidadCrearPagina::class)->name('especialidad.crear');//
Route::get('especialidad/{especialidad}/editar', EspecialidadEditarPagina::class)->name('especialidad.editar');//
Route::get('especialidad/{especialidad}/informacion', EspecialidadSedeInformacionPagina::class)->name('especialidad.sede.informacion');//
Route::get('especialidad/odontologos', EspecialidadSedeEstadisticaOdontologoCantidadPagina::class)->name('especialidad.sede.estadistica.odontologo.cantidad');//
Route::get('especialidad/{especialidad}/odontologos', EspecialidadSedeEstadisticaOdontologoListaPagina::class)->name('especialidad.sede.estadistica.odontologo.lista');//
Route::get('especialidad/clinicas', EspecialidadSedeEstadisticaClinicaCantidadPagina::class)->name('especialidad.sede.estadistica.clinica.cantidad');//
Route::get('especialidad/{especialidad}/clinicas', EspecialidadSedeEstadisticaClinicaListaPagina::class)->name('especialidad.sede.estadistica.clinica.lista');//

Route::get('odontologos', OdontologoSedeTodoPagina::class)->name('odontologo.sede.index');//

Route::get('clinicas', ClinicaSedeTodoPagina::class)->name('clinica.sede.index');//

Route::get('servicios', ServicioTodoPagina::class)->name('servicio.index');//
Route::get('servicio/crear', ServicioCrearPagina::class)->name('servicio.crear');//
Route::get('servicio/{servicio}/editar', ServicioEditarPagina::class)->name('servicio.editar');//
Route::get('servicio/{servicio}/informacion', ServicioInformacionPagina::class)->name('servicio.informacion');//

Route::get('pacientes', PacienteSedeTodoPagina::class)->name('paciente.sede.index');//

Route::get('ventas', VentaSedeTodoLivewire::class)->name('venta.sede.index');
Route::get('venta/crear', VentaCrearLivewire::class)->name('venta.crear');
Route::get('venta/{venta}/editar', VentaEditarLivewire::class)->name('venta.editar');
Route::post('venta/{venta}/dropzone', [VentaController::class, 'dropzone'])->name('venta.dropzone');

Route::get('usuarios/departamentos', UsuarioEstadisticaDepartamentoCantidadPagina::class)->name('usuario.estadistica.departamento.cantidad');
Route::get('usuarios/departamento/{departamento}', UsuarioEstadisticaDepartamentoListaPagina::class)->name('usuario.estadistica.departamento.lista');

Route::get('canjeos', CanjeoTodoLivewire::class)->name('canjeo.index');
Route::get('canjeo/crear', CanjeoCrearLivewire::class)->name('canjeo.crear');
Route::get('canjeo/{canjeo}/editar', CanjeoEditarLivewire::class)->name('canjeo.editar');
Route::post('canjeo/{canjeo}/dropzone', [CanjeoController::class, 'dropzone'])->name('canjeo.dropzone');
