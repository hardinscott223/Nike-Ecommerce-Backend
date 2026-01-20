<?php

use Illuminate\Support\Facades\Route;

Route::prefix("api")->group(function () {
    Route::post('/login/{identifier}', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::get('/', function () {
    return view('welcome');
});
