<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

define('PAGINATE_COUNT', 50);
Route::middleware('guest:teacher')->group(function () {
   Route::get('/login', [\App\Http\Controllers\Teacher\Auth\LoginController::class, 'get_login'])->name('login');
    Route::post('/logins', [\App\Http\Controllers\Teacher\Auth\LoginController::class, 'login'])->name('login');
});


Route::middleware('auth:teacher')->group(function () {
    Route::get('/', [\App\Http\Controllers\Teacher\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('courses', \App\Http\Controllers\CourseController::class);
    Route::resource('lessons', \App\Http\Controllers\LessonController::class);
});
