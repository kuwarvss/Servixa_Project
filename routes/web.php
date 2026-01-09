<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SuperAdmin\BranchController;
Route::get('/', function () {
    return view('welcome');
});

//Superadmin routes
Route::prefix('superadmin')->group(function () {

    // Login (NO middleware)
    Route::get('/', [SuperadminController::class, 'showLoginForm'])
        ->name('superadmin.login');

    Route::post('/', [SuperadminController::class, 'superAdminLogin'])
        ->name('superadmin.login.submit');

    // Protected routes
    Route::middleware('superadmin.auth')->group(function () {

        Route::get('/dashboard', [SuperadminController::class, 'superAdminDashboard'])
            ->name('superadmin.dashboard');

        Route::get('/create-admin', [SuperadminController::class, 'superAdmin_create_admin'])
            ->name('superadmin.admin.create');

        Route::post('/store-admin', [SuperadminController::class, 'superAdmin_create_admin_data_save'])
            ->name('superadmin.admin.store');

        Route::get('/manage-admins', [SuperadminController::class, 'superAdmin_manage_admin'])
            ->name('superadmin.admin.manage');

        Route::get('/edit-admin/{id}', [SuperadminController::class, 'superAdmin_edit_admin'])
            ->name('superadmin.admin.edit');
            
        Route::post('/update-admin/{id}', [SuperadminController::class, 'superAdmin_update_admin'])
            ->name('superadmin.admin.update');
            
        Route::get('/delete-admin/{id}', [SuperadminController::class, 'superAdmin_delete_admin'])
            ->name('superadmin.admin.delete');  
        
        Route::prefix('branches')->name('superadmin.branches.')->group(function () {

            Route::get('/', [BranchController::class, 'index'])
                ->name('index');

            Route::get('/create', [BranchController::class, 'create'])
                ->name('create');

            Route::post('/', [BranchController::class, 'store'])
                ->name('store');

            Route::get('/{id}/edit', [BranchController::class, 'edit'])
                ->name('edit');

            Route::put('/{id}', [BranchController::class, 'update'])
                ->name('update');

            Route::delete('/{id}', [BranchController::class, 'destroy'])
                ->name('delete');
        });  

        Route::post('/logout', [SuperadminController::class, 'superAdminLogout'])
            ->name('superadmin.logout');
    });
});








// Admin routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/admin-dashboard', function(){
//     return view('auth.dashboard');
// })->middleware('admin.auth')->name('admin.dashboard');
Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])
    ->middleware('auth:admin')
    ->name('admin.dashboard');




Route::post('/change-password', [AuthController::class, 'changepassworddata'])->name('admin.change.password');


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('logout');

    
// Route::middleware('auth:admin')->group(function () {

//     Route::get('/branches', [BranchController::class, 'index'])
//         ->name('admin.branches.index');

//     // Route::get('/branches/create', [BranchController::class, 'create'])
//     //     ->name('admin.branches.create');

//     Route::post('/branches/store', [BranchController::class, 'store'])
//         ->name('admin.branches.store');

//     Route::get('/branches/edit/{id}', [BranchController::class, 'edit'])
//         ->name('admin.branches.edit');

//     Route::post('/branches/update/{id}', [BranchController::class, 'update'])
//         ->name('admin.branches.update');
    
//     Route::get('/branches/manage', [BranchController::class, 'manage'])
//         ->name('admin.branches.manage');    

//     Route::get('/branches/delete/{id}', [BranchController::class, 'destroy'])
//         ->name('admin.branches.delete');
// });


