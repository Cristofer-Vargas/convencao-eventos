<?php

use App\Http\Controllers\estudosLaravel\EstudosLaravel;
use App\Http\Controllers\estudosLaravel\produto\ProdutoController;

use App\Http\Controllers\EventoController;
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

Route::get('/', [EventoController::class, 'index']);
Route::get('/eventos/criar/', [EventoController::class, 'create']);
Route::post('/eventos', [EventoController::class, 'store']);
Route::get('/evento/{id}', [EventoController::class, 'show']);

Route::get('/estudos-laravel', [EstudosLaravel::class, 'index']);