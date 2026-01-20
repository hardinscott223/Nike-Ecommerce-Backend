<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->name('login');
 Route::middleware(['auth:cognito', 'checkIpAddress', 'operationLog'])->name('api.')->group(function () {  
    Route::prefix('/auth')->name('Auth.')->group(function () {
        Route::prefix('/login-setting')->name('loginSetting.')->group(function () {
            Route::post('/password-update', [LoginSettingController::class, 'updatePassword'])->name('updatePassword');
        });
    });
    
     //Staff
    Route::prefix('/staff-managements')->name('StaffManagements')->group(function () {
        Route::post('/staff-create', [StaffManagementsController::class, 'createStaff'])->name('createStaff');
        Route::get('/staff-get', [StaffManagementsController::class, 'getStaff'])->name('getStaff');
        Route::post('/staff-update', [StaffManagementsController::class, 'updateStaff'])->name('updateStaff');
        Route::post('/staff-delete', [StaffManagementsController::class, 'deleteStaff'])->name('deleteStaff');
    });

    //Category
    Route::prefix('/category-managements')->name('CategoryManagements')->group(function () {
        Route::post('/category-create', [CategoryManagementsController::class, 'createCategory'])->name('createCategory');
        Route::get('/category-get', [CategoryManagementsController::class, 'getCategory'])->name('getCategory');
        Route::post('/Category-update', [CategoryManagementsController::class, 'updateCategory'])->name('updateCategory');
        Route::post('/Category-delete', [CategoryManagementsController::class, 'deleteCategory'])->name('deleteCategory');
    });

 });

