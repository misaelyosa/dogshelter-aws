<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

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



Route::middleware('guest')->group(function() {
    Route::get('/login', [SessionController::class, 'index'])->name('login'); //return view login
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', function () {return view('register.index');});
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
        //Doge Table
       Route::get('/admin', [DogeController::class, 'fetchDogeAdmin'])->name('admin');
       Route::get('/admin/edit/{id}', [AdminController::class, 'fetchEditDoge'])->name('fetchedit'); //return view edit + select id 
       Route::post('/admin/edit', [AdminController::class, 'edit'])->name('updatedoge'); //post edit
       Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('deletedoge');
       Route::get('/admin/create', function(){
           return view('admin.create');
        })->name('formCreateDoge');
        Route::post('/admin/create', [AdminController::class, 'create'])->name('createDoge');
        
        //User table
        Route::get('admin/manageUser', [AdminController::class, 'fetchUser'])->name('fetchuser');
        Route::get('/admin/banUser/{id}', [AdminController::class, 'banUser'])->name('banuser');
    });

    Route::get('/adoptform/{id}', [UserController::class, 'fetchAdopt'])->name('fetchadoptform');
    Route::post('/adoptform', [UserController::class, 'submitAdoptForm'])->name('submitadoptform');

    // Route::middleware('role:user')->group(function () {
    // });
});

Route::get('/home', [DogeController::class, 'fetch'])->name('home');
Route::get('/', [DogeController::class, 'fetch'])->name('home');


