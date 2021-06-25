<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/saludo', function () {
    echo json_encode("Hola");
});

Route::get('get/obtenerGeneros', [ApiController::class, 'obtenerGeneros'])->name('obtener.genero');
Route::get('get/obtenerGeneroId/{id}', [ApiController::class, 'obtenerGeneroId'])->name('obtener.id');
Route::get('get/obtenerArtistaId/{id}', [ApiController::class, 'obtenerArtistaId'])->name('obtener.artista');