<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);