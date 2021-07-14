<?php

use App\Http\Controllers\AlertaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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



//Route::apiResource('usuarios', UsuarioController::class);


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('videos', VideoController::class);
    Route::apiResource('dispositivos', DispositivoController::class);
    Route::apiResource('alertas', AlertaController::class);
    Route::apiResource('usuario', UsuarioController::class);
    Route::apiResource('sensores', SensorController::class);
});



Route::post('usuarios/acceso', 'App\Http\Controllers\UsuarioController@acceso');
Route::post('usuarios/registro', 'App\Http\Controllers\UsuarioController@registro');
