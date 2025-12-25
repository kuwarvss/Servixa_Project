<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;

Route::get('/', function () {
    return view('welcome');
});

//Superadmin routes
Route::get('/superadmin', [SuperadminController::class, 'showLoginForm'])->name('superadmin');
Route::post('/superadmin', [SuperadminController::class, 'superAdminLogin']);
Route::get('/superadmin-dashboard', [SuperadminController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
Route::get('/superadmin-create_admin', [SuperadminController::class, 'superAdmin_create_admin'])->name('superadmin.create_admin');
Route::post('/superadmin-create_admin', [SuperadminController::class, 'superAdmin_create_admin_data_save'])->name('superadmin.create_admin');
Route::get('/superadmin-manage_admin', [SuperadminController::class, 'superAdmin_manage_admin'])->name('superadmin.manage_admin');
Route::get('/superadmin-logout', [SuperadminController::class, 'superAdminLogout'])->name('superadmin.logout');





// Admin routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




