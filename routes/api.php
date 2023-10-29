<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// login route
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

// group comments APIs
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('comment', App\Http\Controllers\CommentController::class)->only(['store']);
    Route::resource('lessons-watched', App\Http\Controllers\LessonsWatchedController::class)->only(['store']);
});
