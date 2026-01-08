<?php

use App\Http\Controllers\Hotel\HotelownerController;
use App\Http\Controllers\Staff\StaffCustomerController;
use App\Http\Controllers\Staff\StaffPackageController;
use App\Http\Controllers\Staff\StaffBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/hotel',[HotelownerController::class,'login'])->name('hotel.login');
Route::post('/hotel/login',[HotelownerController::class,'store'])->name('hotel.auth');
Route::prefix('owner')->middleware('auth:staffs')->group(function(){
    Route::get('/staffdashboard',[HotelownerController::class,'staffShow'])->name('staff.dashboard');
    
    

Route::get('/staff/customers',[StaffCustomerController::class,'index'])->name('staff_customers.index');
Route::get('/staff/customers/create',[StaffCustomerController::class,'create'])->name('staff_customers.create');
Route::post('/staff/customers',[StaffCustomerController::class,'store'])->name('staff_customers.store');
Route::get('/staff/customers/{id}/edit',[StaffCustomerController::class,'edit'])->name('staff_customers.edit');
Route::put('/staff/customers/{id}',[StaffCustomerController::class,'update'])->name('staff_customers.update');
Route::delete('/staff/customers/{id}',[StaffCustomerController::class,'destroy'])->name('staff_customers.destroy');

//packages route
Route::get('/staff/packages',[StaffPackageController::class,'index'])->name('staff_packages.index');
Route::get('/staff/packages/create',[StaffPackageController::class,'create'])->name('staff_packages.create');
Route::post('/staff/packages',[StaffPackageController::class,'store'])->name('staff_packages.store');
Route::get('/staff/packages/{id}/edit',[StaffPackageController::class,'edit'])->name('staff_packages.edit');
Route::put('/staff/packages/{id}',[StaffPackageController::class,'update'])->name('staff_packages.update');
Route::delete('/staff/packages/{id}',[StaffPackageController::class,'destroy'])->name('staff_packages.destroy');

//booking route
Route::get('/staff/bookings',[StaffBookingController::class,'index'])->name('staff_bookings.index');
Route::get('/staff/bookings/create',[StaffBookingController::class,'create'])->name('staff_bookings.create');
Route::post('/staff/bookings',[StaffBookingController::class,'store'])->name('staff_bookings.store');
Route::get('/staff/bookings/{id}/edit',[StaffBookingController::class,'edit'])->name('staff_bookings.edit');
Route::put('/staff/bookings/{id}',[StaffBookingController::class,'update'])->name('staff_bookings.update');
Route::delete('/staff/bookings/{id}',[StaffBookingController::class,'destroy'])->name('staff_bookings.destroy');

});