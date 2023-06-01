<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClasesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list', [ClasesController::class, 'index']);

Route::post('/add', [ClasesController::class, 'store']);

Route::put('/edit/{id}', [ClasesController::class, 'update']);

Route::delete('/delete/{id}', [ClasesController::class, 'destroy']);