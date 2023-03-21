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
Route::get('/', function () {
    return view('welcome');
})->middleware('account.verified');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});
