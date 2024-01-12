<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ListingController::class, 'index']);
Route::get('/jobs/create', [ListingController::class, 'create']);
Route::post('/jobs', [ListingController::class, 'save']);
Route::get('/jobs/{job}/edit', [ListingController::class, 'edit']);
Route::put('/jobs/{job}', [ListingController::class, 'update']);
Route::delete('/jobs/{job}', [ListingController::class, 'destroy']);
Route::get('/jobs/{job}', [ListingController::class, 'show']);
