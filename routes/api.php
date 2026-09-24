<?php

use App\Http\Controllers\Api\JobApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes for Live Website
|--------------------------------------------------------------------------
*/

Route::get('/jobs', [JobApiController::class, 'index']);
Route::get('/jobs/{id}', [JobApiController::class, 'show']);
Route::get('/sectors', [JobApiController::class, 'sectors']);
