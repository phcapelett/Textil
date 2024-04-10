<?php

use App\Http\Controllers\AsoController;
use App\Http\Controllers\DependenteController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () { return view('home'); });
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/aso', [AsoController::class, 'index'])->name('aso.index');
Route::get('/dependentes', [DependenteController::class, 'index'])->name('dependentes.index');
// Route::get('/dependentes/add', [DependenteController::class, 'add']);
// Route::get('/dependentes/edit/{id}', [DependenteController::class, 'edit']);
// Route::post('/dependentes/add', [DependenteController::class, 'save']);
// Route::delete('/dependentes/delete/{id}', [DependenteController::class, 'remove']);
