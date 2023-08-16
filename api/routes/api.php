<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('withoutAuth', function () {
    return response()->json('Usuário não autenticado.');
})->name('withoutAuth');

Route::post('login', [App\Http\Controllers\LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout']);
    Route::apiResource('users', App\Http\Controllers\UserController::class);
    Route::apiResource('endereco', App\Http\Controllers\EnderecoController::class);
    Route::apiResource('papel', App\Http\Controllers\PapelController::class);
    Route::post('userendereco', [App\Http\Controllers\UserEnderecosController::class, 'store']);
    Route::get('userendereco/destroy', [App\Http\Controllers\UserEnderecosController::class, 'destroy']);
});
