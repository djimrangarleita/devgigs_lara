<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('/jobs/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/jobs', [ListingController::class, 'save'])->middleware('auth');
Route::get('/jobs/manage', [ListingController::class, 'manage'])->middleware('auth');
Route::get('/jobs/{job}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/jobs/{job}', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/jobs/{job}', [ListingController::class, 'destroy'])->middleware('auth');
Route::get('/jobs/{job}', [ListingController::class, 'show']);
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/users', [UserController::class, 'save'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/auth', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
