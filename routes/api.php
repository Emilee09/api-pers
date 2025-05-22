<?php

use App\Http\Controllers\api\ComunaController;
use App\Http\Controllers\api\MunicipioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//COMUNAS
Route::get('/comunas', [ComunaController::class, 'index'])->name('comunas');
Route::post('/comunas', [ComunaController::class, 'store'])->name('comunas');
Route::get('/comunas', [ComunaController::class, 'show'])->name('comunas');
Route::put('/comunas', [ComunaController::class, 'update'])->name('comunas');
Route::delete('/comunas', [ComunaController::class, 'destroy'])->name('comunas');

// MUNICIPIOS
Route::get('/municipios', [ComunaController::class, 'index'])->name('municipios');
Route::post('/municipios', [ComunaController::class, 'store'])->name('municipios');      
Route::get('/municipios', [ComunaController::class, 'show'])->name('municipios');
Route::put('/municipios', [ComunaController::class, 'update'])->name('municipios');
Route::delete('/municipios', [ComunaController::class, 'destroy'])->name('municipios');