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

Route::get('/', function () {
    return response()->json([
        'environment' => env('APP_ENV'),
        'commit' => env('BUILD_COMMIT'),
        'version' => env('BUILD_NUMBER'),
        'timestamp' => env('BUILD_TIMESTAMP'),
    ], 200);
});
Route::get('/health', function () {
    return response()->json(['message' => 'OK'], 200);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/foos', [FooController::class, 'index']);
    Route::post('/foos', [FooController::class, 'store']);
    Route::get('/foos/{foo}', [FooController::class, 'show']);
    Route::post('/foos/{foo}', [FooController::class, 'update']);
});
