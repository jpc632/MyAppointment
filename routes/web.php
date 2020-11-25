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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('staff', App\Http\Controllers\StaffController::class)->middleware('admin:view');

Route::group(['middleware' => ['auth', 'doctor']], function(){
    Route::resource('appointment', App\Http\Controllers\AppointmentController::class);
    Route::post('appointment/check', [App\Http\Controllers\AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('appointment/delete', [App\Http\Controllers\AppointmentController::class, 'destroy'])->name('appointment.delete');
});

Route::get('/appointment/{user_id}/show/{date}', [App\Http\Controllers\AppointmentController::class, 'show']);