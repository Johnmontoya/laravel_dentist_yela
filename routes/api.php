<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\CitaServicioController;
use App\Http\Controllers\TiempoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/citas', [CitasController::class, 'index']);
    Route::post('/citas', [CitasController::class, 'guardar']);
    Route::put('/citas/{id}', [CitasController::class, 'actualizar']);
    Route::delete('/citas/{id}', [CitasController::class, 'eliminar']);
    Route::post('/citas/buscar', [CitasController::class, 'buscar']);

    Route::get('/servicios', [ServiciosController::class, 'index']);
        
    Route::group(['middleware' => ['admin']], function () {
        Route::post('/servicios/crear', [ServiciosController::class, 'guardar']);
        Route::put('/servicios/{id}', [ServiciosController::class, 'actualizar']);
        Route::delete('/servicios/{id}', [ServiciosController::class, 'eliminar']); 
    });
    
    Route::post('tiempos', [TiempoController::class, 'index']);
    Route::post('/servicecite', [CitaServicioController::class, 'guardar']);
});

Route::post('/register', [LoginController::class, 'createUser']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);