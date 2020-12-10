<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
});

//Patient CRUD
Route::get('/index', [App\Http\Controllers\PatientController::class, 'index']);
Route::post('/book/doctors', [App\Http\Controllers\PatientController::class, 'viewDoctors'])->name('patient.viewDoctors');
Route::post('/book/show', [App\Http\Controllers\PatientController::class, 'show'])->name('patient.show');
Route::get('/book', [App\Http\Controllers\PatientController::class, 'book'])->name('patient.book');
Route::put('/book', [App\Http\Controllers\PatientController::class, 'update'])->name('patient.update');

Auth::routes();

//admin CRUD
Route::resource('/staff', App\Http\Controllers\StaffController::class)->middleware('admin:view');

//Doctor CRUD
Route::group(['middleware' => ['auth', 'doctor']], function () {
    //Create availability
    Route::post('/availability', [App\Http\Controllers\AvailabilityController::class, 'store'])->name('availability.store');
    Route::get('/availability/create', [App\Http\Controllers\AvailabilityController::class, 'create'])->name('availability.create');

    //View and delete availability
    Route::get('/availability', [App\Http\Controllers\AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('/availability/{user_id}/show', [App\Http\Controllers\AvailabilityController::class, 'show'])->name('availability.show');
    Route::post('/availability/delete', [App\Http\Controllers\AvailabilityController::class, 'destroy'])->name('availability.delete');

    //view booked appointments
    Route::post('/appointment', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointment.show');
    Route::get('/appointment', [App\Http\Controllers\AppointmentController::class, 'view'])->name('appointment.view');
});
