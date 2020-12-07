<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//patient Crud
Route::get('/index', [App\Http\Controllers\PatientController::class, 'index']);
Route::get('/book', [App\Http\Controllers\PatientController::class, 'book']);
Route::post('/book', [App\Http\Controllers\PatientController::class, 'viewDoctors'])->name('patient.viewDoctors');
Route::put('/book', [App\Http\Controllers\PatientController::class, 'update'])->name('patient.update');

//admin CRUD
Route::resource('/staff', App\Http\Controllers\StaffController::class)->middleware('admin:view');

//Doctor CRUD
Route::group(['middleware' => ['auth', 'doctor']], function () {
    //Create availability
    Route::post('/appointment', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointment.create');

    //View and delete availability
    Route::get('/appointment', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointment.index');
    Route::post('/appointment/check', [App\Http\Controllers\AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/delete', [App\Http\Controllers\AppointmentController::class, 'destroy'])->name('appointment.delete');

    //view booked appointments
    Route::post('/appointment/{user_id}/bookings', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointment.show');
    Route::get('/appointment/{user_id}/bookings', [App\Http\Controllers\AppointmentController::class, 'view'])->name('appointment.view');
});
