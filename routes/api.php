<?php

use App\Http\Controllers\Api\FooController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/foos', [FooController::class, 'index']);
    Route::post('/foos', [FooController::class, 'store']);
    Route::get('/foos/{foo}', [FooController::class, 'show']);
    Route::post('/foos/{foo}', [FooController::class, 'update']);
});
