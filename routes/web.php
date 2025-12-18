<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShelterController;

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



Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login'); //return view login
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', function () {
        return view('register.index');
    });
    Route::post('/register', [RegisterController::class, 'store'])->name('registerstore');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
        // Admin dashboard (all doges)
        Route::get('/admin', [DogeController::class, 'fetchDogeAdmin'])->name('admin');
        //User table
        Route::get('admin/manageUser', [AdminController::class, 'fetchUser'])->name('fetchuser');
        Route::get('/admin/banUser/{id}', [AdminController::class, 'banUser'])->name('banuser');

        //Adoption Validation
        Route::get('admin/adoptionRequest', [DogeController::class, 'fetchAdoptionRequest'])->name('admin.fetchadoptionrequest');
        
        Route::get('admin/testEmail', [DogeController::class, 'testEmail']);

        // Reports (admin)
        Route::get('/admin/reports', [AdminController::class, 'fetchReports'])->name('reportsAdmin');
        Route::get('/admin/reports/{id}', [AdminController::class, 'showReport'])->name('admin.reports.show');
        Route::post('/admin/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
        // Admin shelter verification review
        Route::get('/admin/shelter-verifications', [AdminController::class, 'listPendingShelters'])->name('admin.shelter_verifications');
        Route::get('/admin/shelter-verifications/{id}', [AdminController::class, 'showShelterVerification'])->name('admin.shelter_verifications.show');
        Route::post('/admin/shelter-verifications/{id}/accept', [AdminController::class, 'acceptShelter'])->name('admin.shelter_verifications.accept');
        Route::post('/admin/shelter-verifications/{id}/decline', [AdminController::class, 'declineShelter'])->name('admin.shelter_verifications.decline');
        // Admins can view reports but cannot accept/decline them via routes.
    });
    Route::post('/report', [ReportController::class, 'store'])->name('reportSubmit');
    Route::get('/adoptform/{id}', [UserController::class, 'fetchAdopt'])->name('fetchadoptform');
    Route::post('/adoptform', [UserController::class, 'submitAdoptForm'])->name('submitadoptform');

    Route::get('/dogReport', [DogeController::class, 'fetchReport'])->name('reportdog');
    // Route::middleware('role:user')->group(function () {
    // });
});
Route::get('/shelters', [ShelterController::class, 'index'])->name('shelters');
Route::get('/home', [DogeController::class, 'fetch'])->name('home');
Route::get('/', [DogeController::class, 'fetch'])->name('home');

// Shelter owner routes: doge CRUD + adoption requests (for their shelter only)
Route::middleware(['auth', 'role:shelter_owner'])->group(function () {
    // Shelter owner verification form (accessible to shelter_owner even if not verified)
    Route::get('/shelter/verify', [\App\Http\Controllers\ShelterController::class, 'showVerifyForm'])->name('shelter.verify.form');
    Route::post('/shelter/verify', [\App\Http\Controllers\ShelterController::class, 'submitVerify'])->name('shelter.verify.submit');

    // Routes that require the shelter to be verified
    Route::middleware('shelter.verified')->group(function () {
        Route::get('/shelter', [DogeController::class, 'fetchDogeOwner'])->name('shelter.dashboard');
        Route::get('/shelter/edit/{id}', [AdminController::class, 'fetchEditDoge'])->name('fetchedit');
        Route::post('/shelter/edit', [AdminController::class, 'edit'])->name('updatedoge');
        Route::get('/shelter/delete/{id}', [AdminController::class, 'delete'])->name('deletedoge');
        Route::get('/shelter/create', function () {
            return view('admin.create');
        })->name('formCreateDoge');
        Route::post('/shelter/create', [AdminController::class, 'create'])->name('createDoge');

        // Adoption requests for shelter owner (only for doges in their shelter)
        Route::get('shelter/adoptionRequest', [DogeController::class, 'fetchAdoptionRequestForOwner'])->name('shelter.fetchadoptionrequest');
        Route::post('/shelter/accept-adopt', [DogeController::class, 'acceptAdopt'])->name('acceptadopt');
        Route::post('/shelter/decline-adopt', [DogeController::class, 'declineAdopt'])->name('declineadopt');
        
        // Reports management for shelter owner
        Route::get('/shelter/reports', [AdminController::class, 'fetchReports'])->name('reportsShelter');
        Route::get('/shelter/reports/{id}', [AdminController::class, 'showReport'])->name('shelter.reports.show');
        Route::post('/shelter/reports/{id}/accept', [AdminController::class, 'acceptReport'])->name('shelter.reports.accept');
        Route::post('/shelter/reports/{id}/decline', [AdminController::class, 'declineReport'])->name('shelter.reports.decline');
    });
});
