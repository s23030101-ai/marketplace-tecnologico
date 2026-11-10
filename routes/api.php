<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\VerificationController;


Route::get('/verify-student/{qrToken}', [VerificationController::class, 'verifyStudent']);

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);

Route::get('/verify-student/{qrToken}', [VerificationController::class, 'verifyStudent']);