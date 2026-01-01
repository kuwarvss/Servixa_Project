<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;

Route::get('/', function () {
    return view('welcome');
});

//Superadmin routes
Route::prefix('superadmin')->group(function () {

    //  Login Routes (NO auth)
    Route::get('/', [SuperadminController::class, 'showLoginForm'])
        ->name('superadmin.login');

    Route::post('/', [SuperadminController::class, 'superAdminLogin'])
        ->name('superadmin.login.submit');

    //  Protected Routes (login ke baad)
    Route::get('/dashboard', [SuperadminController::class, 'superAdminDashboard'])
        ->name('superadmin.dashboard');

    Route::get('/create-admin', [SuperadminController::class, 'superAdmin_create_admin'])
        ->name('superadmin.admin.create');

    Route::post('/store-admin', [SuperadminController::class, 'superAdmin_create_admin_data_save'])
        ->name('superadmin.admin.store');

    Route::get('/manage-admins', [SuperadminController::class, 'superAdmin_manage_admin'])
        ->name('superadmin.admin.manage');

    Route::post('/logout', [SuperadminController::class, 'superAdminLogout'])
        ->name('superadmin.logout');
});






// Admin routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




