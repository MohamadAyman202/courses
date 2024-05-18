<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizationController;
use App\Http\Controllers\QuizeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/pay/callback', [PaymentController::class, 'callback'])->name('callback');

Route::get('logout', function () {
    Auth::guard('web')->logout();
    return back();
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/quize/index', [QuizeController::class, 'index'])->name('quize.index');
    Route::post('/quize/store', [QuizeController::class, 'store'])->name('quize.store');
    Route::PUT('/quize/update{id}', [QuizeController::class, 'update'])->name('quize.update');
    Route::delete('/quize/destroy{id}', [QuizeController::class, 'destroy'])->name('quize.destroy');

    Route::get('/quization/index', [QuizationController::class, 'index'])->name('quization.index');
    Route::post('/quization/store', [QuizationController::class, 'store'])->name('quization.store');
    Route::PUT('/quization/update{id}', [QuizationController::class, 'update'])->name('quization.update');
    Route::delete('/quization/destroy{id}', [QuizationController::class, 'destroy'])->name('quization.destroy');

});


