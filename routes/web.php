<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hotels/login',[AuthenticatedSessionController::class,'hotelLogin']);
Route::post('/hotels/login',[AuthenticatedSessionController::class,'hotelStore']);

Route::get('/dashboard',[HotelController::class,'admindashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //permissin Route
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    
    //Roles Route
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
     


Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Customers Routes
Route::get('/customers',[CustomerController::class,'index'])->name('customers.index');
Route::get('/customers/create',[CustomerController::class,'create'])->name('customers.create');
Route::post('/customers/create',[CustomerController::class,'store'])->name('customers.store');
Route::get('/customers/{id}/edit',[CustomerController::class,'edit'])->name('customers.edit');
Route::put('/customers/{id}',[CustomerController::class,'update'])->name('customers.update');
Route::delete('/customers/{id}',[CustomerController::class,'destroy'])->name('customers.destroy');

//Booking Routes
Route::get('/hotels',[HotelController::class,'index'])->name('hotels.index');
Route::get('/hotel/create',[HotelController::class,'create'])->name('hotels.create');
Route::post('/hotels/create',[HotelController::class,'store'])->name('hotels.store');
Route::get('/hotels/{id}/edit',[HotelController::class,'edit'])->name('hotels.edit');
Route::put('/hotels/{id}',[HotelController::class,'update'])->name('hotels.update');
Route::delete('/hotels/{id}',[HotelController::class,'destroy'])->name('hotels.destroy');

Route::middleware(['auth'])->group(function () {
// Package Routes
Route::get('/packages',[PackageController::class,'index'])->name('packages.index');
Route::get('/packages/create',[PackageController::class,'create'])->name('packages.create');
Route::post('/packages/create',[PackageController::class,'store'])->name('packages.store');
Route::get('/packages/{id}/edit',[PackageController::class,'edit'])->name('packages.edit');
Route::put('/packages/{id}',[PackageController::class,'update'])->name('packages.update');
Route::delete('/packages/{id}',[PackageController::class,'destroy'])->name('packages.destroy');
});

// Booking Routes
Route::get('/bookings',[BookingController::class,'index'])->name('bookings.index');
Route::get('/bookings/create',[BookingController::class,'create'])->name('bookings.create');
Route::post('/bookings/create',[BookingController::class,'store'])->name('bookings.store');
Route::get('/bookings/{id}/edit',[BookingController::class,'edit'])->name('bookings.edit');
Route::put('/bookings/{id}',[BookingController::class,'update'])->name('bookings.update');
Route::delete('/bookings/{id}',[BookingController::class,'destroy'])->name('bookings.destroy');

//hotel Routes
Route::get('/hotels',[HotelController::class,'index'])->name('hotels.index');
Route::get('/hotels/create',[HotelController::class,'create'])->name('hotels.create');
Route::post('/hotels/create',[HotelController::class,'store'])->name('hotels.store');
Route::get('/hotels/{id}/edit',[HotelController::class,'edit'])->name('hotels.edit');
Route::put('/hotels/{id}',[HotelController::class,'update'])->name('hotels.update');
Route::delete('/hotels/{id}',[HotelController::class,'destroy'])->name('hotels.destroy');

//user Routes
Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/create',[UserController::class,'store'])->name('users.store');
Route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
Route::put('/users/{id}',[UserController::class,'update'])->name('users.update');
Route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');
});

//login page ("email","password")
// credential -> post request to /hotels/login
//create login get and store in function



require __DIR__.'/auth.php';
require __DIR__.'/hotel.php';
require __DIR__.'/staff.php';
