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
Route::post('/login' , [\App\Http\Controllers\Api\Auth\LoginController::class,"login"]);
Route::resource('links','App\Http\Controllers\Api\LinkController')->middleware("auth:api");
