<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;

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

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::get('levels', [App\Http\Controllers\Api\LevelController::class, 'index']);
Route::post('levels', [App\Http\Controllers\Api\LevelController::class, 'store']);
Route::get('levels/{level}', [App\Http\Controllers\Api\LevelController::class, 'show']);
Route::put('levels/{level}', [App\Http\Controllers\Api\LevelController::class, 'update']);
Route::delete('levels/{level}', [App\Http\Controllers\Api\LevelController::class, 'destroy']);

Route::get('users', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('users', [App\Http\Controllers\Api\UserController::class, 'store']);
Route::get('users/{user}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::put('users/{user}', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::delete('users/{user}', [App\Http\Controllers\Api\UserController::class, 'destroy']);