<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

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

Route::get('/', [SessionController::class, 'index']); //return view login

Route::get('/register', function () {
    return view('register.index');
});
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [SessionController::class, 'login']);
Route::post('/logout', [SessionController::class, 'logout']);

Route::get('/home', [DogeController::class, 'fetch'])->name('home');
