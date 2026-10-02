<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ParController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtiquetaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('operaciones', OperacionController::class)->parameters([
    'operaciones' => 'operacion'
]);
Route::resource('cuentas', CuentaController::class)->parameters([
    'cuentas' => 'cuenta'
]);
Route::resource('pares', ParController::class)->parameters([
    'pares' => 'par'
]);
Route::resource('etiquetas', EtiquetaController::class)->parameters([
    'etiquetas' => 'etiqueta'
]);