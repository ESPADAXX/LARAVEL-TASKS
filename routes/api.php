<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::post('/register', [RegisterController::class,"register"]);
Route::post('/login', [LoginController::class,"login"]);

Route::middleware('auth:api')->group(function () {
    Route::get('/members', [MemberController::class,'index']);
    Route::get('/members/{member}', [MemberController::class,'show']);
    Route::post('/members', [MemberController::class,'store']);
    Route::put('/members/{member}', [MemberController::class,'update']);
    Route::delete('/members/{member}', [MemberController::class,'destroy']);
});
