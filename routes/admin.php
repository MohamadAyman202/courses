<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

define('PAGINATE_COUNT', 50);
Route::middleware('guest:admin')->group(function () {
    Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('courses', \App\Http\Controllers\CourseController::class);
    Route::resource('lessons', \App\Http\Controllers\LessonController::class);
    Route::post('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
});
