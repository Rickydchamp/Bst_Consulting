<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/import-employee', [EmployeeController::class, 'import']);

Route::get('/all-employees', [EmployeeController::class, 'all']);

Route::post('/search-employees', [EmployeeController::class, 'search']);
