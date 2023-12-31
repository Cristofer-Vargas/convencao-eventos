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
Route::get('/eventos/criar/', [EventoController::class, 'create'])->middleware('auth');
Route::delete('/evento/excluir/{id}', [EventoController::class, 'destroy'])->middleware('auth');
Route::post('/eventos', [EventoController::class, 'store']);
Route::get('/evento/{id}', [EventoController::class, 'show']);
Route::get('/dashboard', [EventoController::class, 'dashboard'])->middleware('auth');
Route::get('/evento/editar/{id}', [EventoController::class, 'edit'])->middleware('auth');
Route::put('/evento/salvar/{id}', [EventoController::class, 'update'])->middleware('auth');

Route::post('/evento/entrar/{id}', [EventoController::class, 'alterarPresenca'])->middleware('auth');

Route::get('/estudos-laravel', function () {
  return view('estudos-laravel.estudos-laravel');
});