<?php

use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeCrearPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEditarPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaClinicaCantidadPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaClinicaListaPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaOdontologoCantidadPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeEstadisticaOdontologoListaPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeInformacionPagina;
use App\Http\Livewire\Encargado\EspecialidadSede\EspecialidadSedeTodoPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeCrearPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeDireccionCrearPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeDireccionEditarPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeEditarPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeEstadisticaDepartamentoCantidadPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeEstadisticaDepartamentoListaPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeEstadisticaDistritoListaPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeEstadisticaProvinciaListaPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeInformacionPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedePacienteCrearPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedePacienteEditarPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedePacienteTodoPagina;
use App\Http\Livewire\Encargado\OdontologoSede\OdontologoSedeTodoPagina;
use App\Http\Controllers\Administrador\CanjeoController;
use App\Http\Controllers\Encargado\VentaController as EncargadoVentaController;
use App\Http\Livewire\Administrador\Canjeo\CanjeoCrearLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoEditarLivewire;
use App\Http\Livewire\Administrador\Canjeo\CanjeoTodoLivewire;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeCrearPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeDireccionCrearPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeDireccionEditarPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeEditarPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeEstadisticaDepartamentoCantidadPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeEstadisticaDepartamentoListaPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeEstadisticaDistritoListaPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeEstadisticaProvinciaListaPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeInformacionPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedePacienteCrearPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedePacienteEditarPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedePacienteTodoPagina;
use App\Http\Livewire\Encargado\ClinicaSede\ClinicaSedeTodoPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeClinicaTodoPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeCrearPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeDireccionCrearPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeDireccionEditarPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeEditarPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeInformacionPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeOdontogoTodoPagina;
use App\Http\Livewire\Encargado\PacienteSede\PacienteSedeTodoPagina;
use App\Http\Livewire\Encargado\ServicioSede\ServicioSedeCrearPagina;
use App\Http\Livewire\Encargado\ServicioSede\ServicioSedeEditarPagina;
use App\Http\Livewire\Encargado\ServicioSede\ServicioSedeInformacionPagina;
use App\Http\Livewire\Encargado\ServicioSede\ServicioSedeTodoPagina;
use App\Http\Livewire\Encargado\VentaSede\VentaSedeCrearLivewire;
use App\Http\Livewire\Encargado\VentaSede\VentaSedeEditarLivewire;
use App\Http\Livewire\Encargado\VentaSede\VentaSedeTodoLivewire;
use Illuminate\Support\Facades\Route;

Route::get('especialidades', EspecialidadSedeTodoPagina::class)->name('especialidad.sede.index');//ok
Route::get('especialidad/crear', EspecialidadSedeCrearPagina::class)->name('especialidad.sede.crear');//ok
Route::get('especialidad/{especialidad}/editar', EspecialidadSedeEditarPagina::class)->name('especialidad.sede.editar');//ok
Route::get('especialidad/{especialidad}/informacion', EspecialidadSedeInformacionPagina::class)->name('especialidad.sede.informacion');//ok
Route::get('especialidad/odontologos', EspecialidadSedeEstadisticaOdontologoCantidadPagina::class)->name('especialidad.sede.estadistica.odontologo.cantidad');//ok
Route::get('especialidad/{especialidad}/odontologos', EspecialidadSedeEstadisticaOdontologoListaPagina::class)->name('especialidad.sede.estadistica.odontologo.lista');//ok
Route::get('especialidad/clinicas', EspecialidadSedeEstadisticaClinicaCantidadPagina::class)->name('especialidad.sede.estadistica.clinica.cantidad');//ok
Route::get('especialidad/{especialidad}/clinicas', EspecialidadSedeEstadisticaClinicaListaPagina::class)->name('especialidad.sede.estadistica.clinica.lista');//ok

Route::get('odontologos', OdontologoSedeTodoPagina::class)->name('odontologo.sede.index');//ok
Route::get('odontologo/crear', OdontologoSedeCrearPagina::class)->name('odontologo.sede.crear');//ok
Route::get('odontologo/{odontologo}/editar', OdontologoSedeEditarPagina::class)->name('odontologo.sede.editar');//ok
Route::get('odontologo/{odontologo}/informacion', OdontologoSedeInformacionPagina::class)->name('odontologo.sede.informacion');//ok
Route::get('odontologo/{odontologo}/pacientes', OdontologoSedePacienteTodoPagina::class)->name('odontologo.sede.paciente.todo');//ok
Route::get('odontologo/{odontologo}/paciente/crear', OdontologoSedePacienteCrearPagina::class)->name('odontologo.sede.paciente.crear');//ok
Route::get('odontologo/{odontologo}/paciente/{paciente}/editar', OdontologoSedePacienteEditarPagina::class)->name('odontologo.sede.paciente.editar');//ok
Route::get('odontologo/{odontologo}/direccion/crear', OdontologoSedeDireccionCrearPagina::class)->name('odontologo.sede.direccion.crear');//ok
Route::get('odontologo/{odontologo}/direccion/editar', OdontologoSedeDireccionEditarPagina::class)->name('odontologo.sede.direccion.editar');//ok
Route::get('odontologos/departamentos', OdontologoSedeEstadisticaDepartamentoCantidadPagina::class)->name('odontologo.sede.estadistica.departamento.cantidad');//ok
Route::get('odontologos/departamento/{departamento}', OdontologoSedeEstadisticaDepartamentoListaPagina::class)->name('odontologo.sede.estadistica.departamento.lista');//ok
Route::get('odontologos/provincia/{provincia}', OdontologoSedeEstadisticaProvinciaListaPagina::class)->name('odontologo.sede.estadistica.provincia.lista');//ok
Route::get('odontologos/distrito/{distrito}', OdontologoSedeEstadisticaDistritoListaPagina::class)->name('odontologo.sede.estadistica.distrito.lista');//ok

Route::get('clinicas', ClinicaSedeTodoPagina::class)->name('clinica.sede.index');//ok
Route::get('clinica/crear', ClinicaSedeCrearPagina::class)->name('clinica.sede.crear');//ok
Route::get('clinica/{clinica}/editar', ClinicaSedeEditarPagina::class)->name('clinica.sede.editar');//ok
Route::get('clinica/{clinica}/informacion', ClinicaSedeInformacionPagina::class)->name('clinica.sede.informacion');//ok
Route::get('clinica/{clinica}/pacientes', ClinicaSedePacienteTodoPagina::class)->name('clinica.sede.paciente.todo');//ok
Route::get('clinica/{clinica}/paciente/crear', ClinicaSedePacienteCrearPagina::class)->name('clinica.sede.paciente.crear');//ok
Route::get('clinica/{clinica}/paciente/{paciente}/editar', ClinicaSedePacienteEditarPagina::class)->name('clinica.sede.paciente.editar');//ok
Route::get('clinica/{clinica}/direccion/crear', ClinicaSedeDireccionCrearPagina::class)->name('clinica.sede.direccion.crear');//ok
Route::get('clinica/{clinica}/direccion/editar', ClinicaSedeDireccionEditarPagina::class)->name('clinica.sede.direccion.editar');//ok
Route::get('clinicas/departamentos', ClinicaSedeEstadisticaDepartamentoCantidadPagina::class)->name('clinica.sede.estadistica.departamento.cantidad');//ok
Route::get('clinicas/departamento/{departamento}', ClinicaSedeEstadisticaDepartamentoListaPagina::class)->name('clinica.sede.estadistica.departamento.lista');//ok
Route::get('clinicas/provincia/{provincia}', ClinicaSedeEstadisticaProvinciaListaPagina::class)->name('clinica.sede.estadistica.provincia.lista');//ok
Route::get('clinicas/distrito/{distrito}', ClinicaSedeEstadisticaDistritoListaPagina::class)->name('clinica.sede.estadistica.distrito.lista');//ok

Route::get('servicios', ServicioSedeTodoPagina::class)->name('servicio.sede.index');//ok
Route::get('servicio/crear', ServicioSedeCrearPagina::class)->name('servicio.sede.crear');//ok
Route::get('servicio/{servicio}/editar', ServicioSedeEditarPagina::class)->name('servicio.sede.editar');//ok
Route::get('servicio/{servicio}/informacion', ServicioSedeInformacionPagina::class)->name('servicio.sede.informacion');//ok

Route::get('pacientes', PacienteSedeTodoPagina::class)->name('paciente.sede.index');//ok
Route::get('paciente/crear', PacienteSedeCrearPagina::class)->name('paciente.sede.crear');//ok
Route::get('paciente/{paciente}/editar', PacienteSedeEditarPagina::class)->name('paciente.sede.editar');//ok
Route::get('paciente/{paciente}/informacion', PacienteSedeInformacionPagina::class)->name('paciente.sede.informacion');//ok
Route::get('paciente/{paciente}/odontologos', PacienteSedeOdontogoTodoPagina::class)->name('paciente.sede.odontologo.todo');//ok
Route::get('paciente/{paciente}/clinicas', PacienteSedeClinicaTodoPagina::class)->name('paciente.sede.clinica.todo');//ok
Route::get('paciente/{paciente}/direccion/crear', PacienteSedeDireccionCrearPagina::class)->name('paciente.sede.direccion.crear');//ok
Route::get('paciente/{paciente}/direccion/editar', PacienteSedeDireccionEditarPagina::class)->name('paciente.sede.direccion.editar');//ok

Route::get('ventas', VentaSedeTodoLivewire::class)->name('venta.sede.index');//ok
Route::get('venta/crear', VentaSedeCrearLivewire::class)->name('venta.sede.crear');//ok
Route::get('venta/{venta}/editar', VentaSedeEditarLivewire::class)->name('venta.sede.editar');//OK
Route::post('venta/{venta}/dropzone', [EncargadoVentaController::class, 'dropzone'])->name('venta.sede.dropzone');//ok
Route::post('venta/{venta}/dropzone-zip', [EncargadoVentaController::class, 'dropzoneInforme'])->name('venta.sede.dropzone.zip');//ok

Route::get('canjeos', CanjeoTodoLivewire::class)->name('canjeo.sede.index');
Route::get('canjeo/crear', CanjeoCrearLivewire::class)->name('canjeo.sede.crear');
Route::get('canjeo/{canjeo}/editar', CanjeoEditarLivewire::class)->name('canjeo.sede.editar');
Route::post('canjeo/{canjeo}/dropzone', [CanjeoController::class, 'dropzone'])->name('canjeo.dropzone');
