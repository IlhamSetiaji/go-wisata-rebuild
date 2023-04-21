<?php

use App\Http\Controllers\UserController;
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

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'storeLogin'])->name('login.store');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'storeRegister'])->name('register.store');
Route::get('/otp/{id}', [UserController::class, 'showVerifyOtp'])->name('otp');
Route::get('/otp/{id}/resend', [UserController::class, 'resendOtp'])->name('otp.resend');
Route::post('/otp/{id}', [UserController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'resetPasswordView'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::get('/', function () {
    return view('welcome');
})->middleware('account.verified')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function(){
            Route::get('/', [UserController::class, 'listAdmins'])->name('admin');
            Route::post('/', [UserController::class, 'storeAdmin'])->name('admin.store');
            Route::get('/export-users', [UserController::class, 'exportUsers'])->name('admin.export.users');
            Route::post('/{id}/update', [UserController::class, 'updateAdmin'])->name('admin.update');
        });
    });
});
