<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\Recarga_CombustibleController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\Tipo_VehiculoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ViajeController;



Route::resource('conductores', ConductorController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('empresas', EmpresaController::class);
Route::resource('licencias', LicenciaController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('recarga_combustibles', Recarga_CombustibleController::class);
Route::resource('rutas', RutaController::class);
Route::resource('tipo_vehiculos', Tipo_VehiculoController::class);
Route::resource('vehiculos', VehiculoController::class);
Route::resource('viajes', ViajeController::class);



    
 Route::get('/', function () {
    return view('welcome');
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// parametros de la entidad marca
//Route::resource('marcas', MarcaController::class);
//Route::get('cambioestadomarca', [MarcaController::class, 'cambioestadomarca'])->name('cambioestadomarca');
// En routes/web.php
Route::post('/marcas/{id}/cambio-estado', [MarcaController::class, 'cambioestadomarca'])->name('marcas.cambio-estado');
Route::post('/recarga_combustibles/{id}/cambio-estado', [Recarga_CombustibleController::class, 'cambioestadorecarga_combustible'])->name('recarga_combustibles.cambio-estado');

//usar http://127.0.0.1:8000/about para la ruta simple
// Route::get('/about', function () {
// return 'Acerca de nosotros';
// }); 

//usar http://127.0.0.1:8000/contacto para la ruta nombrada
// Route::get('/contacto', function () {
// return 'Página de contacto';
// })->name('contacto'); 


//usar http://127.0.0.1:8000/user/123 para la ruta con restricción
// Route::get('/user/{id}', function ($id) {
//  return 'ID de usuario: ' . $id;
// })->where('id', '[0-9]{3}');


// Route::prefix('admin')->group(function () {
// Route::get('/', function () {
// return 'Panel de administración';
// });
// Route::get('/users', function () {
// return 'Lista de usuarios';
// });
// }); 