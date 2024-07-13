<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employee',         [EmployeeController::class, 'index']);
Route::get('/employee/{employee}',      [EmployeeController::class, 'show']);
Route::post('/employee',        [EmployeeController::class, 'store']);
Route::put('/employee/{employee}',      [EmployeeController::class, 'update']);
Route::delete('/employee/{employee}',       [EmployeeController::class, 'destroy']);
