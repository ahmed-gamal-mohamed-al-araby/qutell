<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/homepage', function () {
    return "Home";
});

Auth::routes();

Route::get('register/events/{id}', [App\Http\Controllers\EventController::class, 'RegisterEvents'])->name('register.events');
Route::post('register/events/post/{id}', [App\Http\Controllers\EventController::class, 'RegisterEventsPost'])->name('register.events.post');
Route::get('event/attend/{code}', [App\Http\Controllers\EventController::class, 'eventAttend'])->name('event.attend');


Route::get('all/events', [App\Http\Controllers\EventController::class, 'showAllEvent'])->name('all.events');
Route::get('check_attendance', [App\Http\Controllers\EventController::class, 'checkAttendance'])->name('check_attendance');
