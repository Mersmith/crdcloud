<?php

use App\Http\Controllers\Web\InicioController;
use App\Http\Controllers\Web\RedirigirVentaController;
use App\Http\Livewire\Sesion\Administrador\AdministradorCambiarLivewire;
use App\Http\Livewire\Sesion\Administrador\AdministradorIngresarLivewire;
use App\Http\Livewire\Sesion\Administrador\AdministradorRecuperarLivewire;
//use App\Http\Livewire\Sesion\Odontologo\OdontologoRegistrarLivewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', InicioController::class)->name('inicio');

Route::redirect('/login', '/ingresar');

Route::get('/ingresar', AdministradorIngresarLivewire::class)->name('ingresar')->middleware('verificar.ingreso');

Route::get('/recuperar-clave', AdministradorRecuperarLivewire::class)->name('recuperar.clave')->middleware('verificar.ingreso');

Route::get('/cambiar-clave/{token}', AdministradorCambiarLivewire::class)->name('cambiar.clave')->middleware('verificar.ingreso');

Route::get('/miradiografia', [RedirigirVentaController::class, 'redirigirVenta'])->name('redirigir.venta');

Route::get('/micanjeo', [RedirigirVentaController::class, 'redirigirCanjeo'])->name('redirigir.canjeo');

//Route::get('registrar', OdontologoRegistrarLivewire::class)->name('regitrar.odontologo');

/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
*/
