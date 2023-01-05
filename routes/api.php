<?php

use App\Http\Controllers\TodolistController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/todolist')->group(function () {
    Route::get('/', [TodolistController::class, 'getAll']);
    Route::post('/add', [TodolistController::class, 'add']);
    Route::post('/update', [TodolistController::class, 'update']);
    Route::post('/delete', [TodolistController::class, 'delete']);
    Route::post('/toggle', [TodolistController::class, 'toggle']);
});
