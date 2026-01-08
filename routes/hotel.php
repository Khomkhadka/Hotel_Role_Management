<?php

use App\Http\Controllers\Hotel\HotelBookingController;
use App\Http\Controllers\Hotel\HotelCustomerController;
use App\Http\Controllers\Hotel\HotelownerController;
use App\Http\Controllers\Hotel\HotelPackageController;
use App\Http\Controllers\Hotel\HotelPermissionController;
use App\Http\Controllers\Hotel\HotelStaffController;
use App\Http\Controllers\Hotel\HotelUserController;
use App\Http\Controllers\Hotel\HotelRoleController;
use Illuminate\Support\Facades\Route;


Route::get('/hotel', [HotelownerController::class, 'login'])->name('hotel.login');
Route::post('/hotel/login', [HotelownerController::class, 'store'])->name('hotel.auth');
Route::get('/hoteldashboard', [HotelownerController::class, 'show'])->name('hotel.dashboard');
Route::post('/owner/logout', [HotelownerController::class, 'logout'])->name('hotel.logout');
Route::prefix('owner')->middleware('auth:hotels')->group(function () {


    // customers route
    Route::get('/customers', [HotelCustomerController::class, 'index'])->name('hotel_customers.index');
    Route::get('/customers/create', [HotelCustomerController::class, 'create'])->name('hotel_customers.create');
    Route::post('/customers', [HotelCustomerController::class, 'store'])->name('hotel_customers.store');
    Route::get('/customers/{id}/edit', [HotelCustomerController::class, 'edit'])->name('hotel_customers.edit');
    Route::put('/customers/{id}', [HotelCustomerController::class, 'update'])->name('hotel_customers.update');
    Route::delete('/customers/{id}', [HotelCustomerController::class, 'destroy'])->name('hotel_customers.destroy');

    //packages route
    Route::get('/packages', [HotelPackageController::class, 'index'])->name('hotel_packages.index');
    Route::get('/packages/create', [HotelPackageController::class, 'create'])->name('hotel_packages.create');
    Route::post('/packages', [HotelPackageController::class, 'store'])->name('hotel_packages.store');
    Route::get('/packages/{id}/edit', [HotelPackageController::class, 'edit'])->name('hotel_packages.edit');
    Route::put('/packages/{id}', [HotelPackageController::class, 'update'])->name('hotel_packages.update');
    Route::delete('/packages/{id}', [HotelPackageController::class, 'destroy'])->name('hotel_packages.destroy');

    //booking route
    Route::get('/bookings', [HotelBookingController::class, 'index'])->name('hotel_bookings.index');
    Route::get('/bookings/create', [HotelBookingController::class, 'create'])->name('hotel_bookings.create');
    Route::post('/bookings', [HotelBookingController::class, 'store'])->name('hotel_bookings.store');
    Route::get('/bookings/{id}/edit', [HotelBookingController::class, 'edit'])->name('hotel_bookings.edit');
    Route::put('/bookings/{id}', [HotelBookingController::class, 'update'])->name('hotel_bookings.update');
    Route::delete('/bookings/{id}', [HotelBookingController::class, 'destroy'])->name('hotel_bookings.destroy');

    // //users route
    // Route::get('/users',[HotelUserController::class,'index'])->name('hotel_users.index');
    // Route::get('/users/create',[HotelUserController::class,'create'])->name('hotel_users.create');
    // Route::post('/users',[HotelUserController::class,'store'])->name('hotel_users.store');
    // Route::get('/users/{id}/edit',[HotelUserController::class,'edit'])->name('hotel_users.edit');
    // Route::put('/users/{id}',[HotelUserController::class,'update'])->name('hotel_users.update');
    // Route::delete('/users/{id}',[HotelUserController::class,'destroy'])->name('hotel_users.destroy');

    //staffs route
    Route::get('/staffs', [HotelStaffController::class, 'index'])->name('hotel_staffs.index');
    Route::get('/staffs/create', [HotelStaffController::class, 'create'])->name('hotel_staffs.create');
    Route::post('/staffs', [HotelStaffController::class, 'store'])->name('hotel_staffs.store');
    Route::get('/staffs/{id}/edit', [HotelStaffController::class, 'edit'])->name('hotel_staffs.edit');
    Route::put('/staffs/{id}', [HotelStaffController::class, 'update'])->name('hotel_staffs.update');
    Route::delete('/staffs/{id}', [HotelStaffController::class, 'destroy'])->name('hotel_staffs.destroy');

    //Roles Route
    Route::get('/roles', [HotelRoleController::class, 'index'])->name('hotel_roles.index');
    Route::get('/roles/create', [HotelRoleController::class, 'create'])->name('hotel_roles.create');
    Route::post('/roles', [HotelRoleController::class, 'store'])->name('hotel_roles.store');
    Route::get('/roles/{id}/edit', [HotelRoleController::class, 'edit'])->name('hotel_roles.edit');
    Route::post('/roles/{id}', [HotelRoleController::class, 'update'])->name('hotel_roles.update');
    Route::delete('/roles/{id}', [HotelRoleController::class, 'destroy'])->name('hotel_roles.destroy');

    //permissin Route
    Route::get('/permissions', [HotelPermissionController::class, 'index'])->name('hotel_permissions.index');
    // Route::get('/permissions/create', [HotelPermissionController::class, 'create'])->name('hotel_permissions.create');
    // Route::post('/permissions', [HotelPermissionController::class, 'store'])->name('hotel_permissions.store');
    // Route::get('/permissions/{id}/edit', [HotelPermissionController::class, 'edit'])->name('hotel_permissions.edit');
    // Route::post('/permissions/{id}', [HotelPermissionController::class, 'update'])->name('hotel_permissions.update');
    // Route::delete('/permissions/{id}', [HotelPermissionController::class, 'destroy'])->name('hotel_permissions.destroy');

});
