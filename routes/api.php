<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactApiController;
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
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/contacts', [ContactApiController::class, 'index']);
    Route::get('/contacts/{id}', [ContactApiController::class, 'show']);
    Route::post('/contacts', [ContactApiController::class, 'store']);
    Route::put('/contacts/{id}', [ContactApiController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactApiController::class, 'destroy']);
});
